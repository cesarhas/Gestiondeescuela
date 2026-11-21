<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Entities\Estudiante;
use App\Repositories\EstudianteRepository;
use App\Services\EstudianteService;
use PDOException;

final class EstudiantesController extends Controller
{
    private EstudianteService $service;

    public function __construct(?EstudianteService $service = null)
    {
        parent::__construct();

        $this->service = $service
            ?? new EstudianteService(
                new EstudianteRepository(Database::connection())
            );
    }

    public function index(): void
    {
        $this->render(
            'estudiantes/index',
            ['items' => $this->service->list()],
            'Estudiantes'
        );
    }

    public function create(): void
    {
        $this->form(new Estudiante(), [], 'estudiantes/store', 'Nuevo Estudiante');
    }

    public function store(): void
    {
        $this->requirePost();

        $entity = Estudiante::fromArray($this->request->allPost());
        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form($entity, $errors, 'estudiantes/store', 'Nuevo Estudiante');
            return;
        }

        $this->service->create($entity);

        $this->redirect('estudiantes', 'Registro creado correctamente.');
    }

    public function edit(?int $id = null): void
    {
        $entity = $this->service->get((int) $id);

        $this->form(
            $entity,
            [],
            'estudiantes/update/' . $entity->estudiante_id,
            'Editar Estudiante'
        );
    }

    public function update(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        $entity = Estudiante::fromArray($this->request->allPost());
        $entity->estudiante_id = (int) $id;

        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form(
                $entity,
                $errors,
                'estudiantes/update/' . $id,
                'Editar Estudiante'
            );
            return;
        }

        $this->service->update($entity);

        $this->redirect('estudiantes', 'Registro actualizado correctamente.');
    }

    public function delete(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        try {
            $this->service->delete((int) $id);
        } catch (PDOException) {
            $this->redirect(
                'estudiantes',
                'No se pudo eliminar: el registro esta en uso.',
                'error'
            );
        }

        $this->redirect('estudiantes', 'Registro eliminado.');
    }

    private function form(
        Estudiante $entity,
        array $errors,
        string $action,
        string $title
    ): void {
        $this->render(
            'estudiantes/form',
            compact('entity', 'errors', 'action'),
            $title
        );
    }
}
