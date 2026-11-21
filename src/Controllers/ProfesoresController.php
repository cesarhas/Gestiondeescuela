<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Entities\Profesore;
use App\Repositories\ProfesoreRepository;
use App\Services\ProfesoreService;
use PDOException;

final class ProfesoresController extends Controller
{
    private ProfesoreService $service;

    public function __construct(?ProfesoreService $service = null)
    {
        parent::__construct();

        $this->service = $service
            ?? new ProfesoreService(
                new ProfesoreRepository(Database::connection())
            );
    }

    public function index(): void
    {
        $this->render(
            'profesores/index',
            ['items' => $this->service->list()],
            'Profesores'
        );
    }

    public function create(): void
    {
        $this->form(new Profesore(), [], 'profesores/store', 'Nuevo Profesore');
    }

    public function store(): void
    {
        $this->requirePost();

        $entity = Profesore::fromArray($this->request->allPost());
        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form($entity, $errors, 'profesores/store', 'Nuevo Profesore');
            return;
        }

        $this->service->create($entity);

        $this->redirect('profesores', 'Registro creado correctamente.');
    }

    public function edit(?int $id = null): void
    {
        $entity = $this->service->get((int) $id);

        $this->form(
            $entity,
            [],
            'profesores/update/' . $entity->profesor_id,
            'Editar Profesore'
        );
    }

    public function update(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        $entity = Profesore::fromArray($this->request->allPost());
        $entity->profesor_id = (int) $id;

        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form(
                $entity,
                $errors,
                'profesores/update/' . $id,
                'Editar Profesore'
            );
            return;
        }

        $this->service->update($entity);

        $this->redirect('profesores', 'Registro actualizado correctamente.');
    }

    public function delete(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        try {
            $this->service->delete((int) $id);
        } catch (PDOException) {
            $this->redirect(
                'profesores',
                'No se pudo eliminar: el registro esta en uso.',
                'error'
            );
        }

        $this->redirect('profesores', 'Registro eliminado.');
    }

    private function form(
        Profesore $entity,
        array $errors,
        string $action,
        string $title
    ): void {
        $this->render(
            'profesores/form',
            compact('entity', 'errors', 'action'),
            $title
        );
    }
}
