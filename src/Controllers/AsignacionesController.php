<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Entities\Asignacione;
use App\Repositories\AsignacioneRepository;
use App\Services\AsignacioneService;
use PDOException;

final class AsignacionesController extends Controller
{
    private AsignacioneService $service;

    public function __construct(?AsignacioneService $service = null)
    {
        parent::__construct();

        $this->service = $service
            ?? new AsignacioneService(
                new AsignacioneRepository(Database::connection())
            );
    }

    public function index(): void
    {
        $this->render(
            'asignaciones/index',
            ['items' => $this->service->list()],
            'Asignaciones'
        );
    }

    public function create(): void
    {
        $this->form(new Asignacione(), [], 'asignaciones/store', 'Nuevo Asignacione');
    }

    public function store(): void
    {
        $this->requirePost();

        $entity = Asignacione::fromArray($this->request->allPost());
        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form($entity, $errors, 'asignaciones/store', 'Nuevo Asignacione');
            return;
        }

        $this->service->create($entity);

        $this->redirect('asignaciones', 'Registro creado correctamente.');
    }

    public function edit(?int $id = null): void
    {
        $entity = $this->service->get((int) $id);

        $this->form(
            $entity,
            [],
            'asignaciones/update/' . $entity->asignacion_id,
            'Editar Asignacione'
        );
    }

    public function update(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        $entity = Asignacione::fromArray($this->request->allPost());
        $entity->asignacion_id = (int) $id;

        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form(
                $entity,
                $errors,
                'asignaciones/update/' . $id,
                'Editar Asignacione'
            );
            return;
        }

        $this->service->update($entity);

        $this->redirect('asignaciones', 'Registro actualizado correctamente.');
    }

    public function delete(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        try {
            $this->service->delete((int) $id);
        } catch (PDOException) {
            $this->redirect(
                'asignaciones',
                'No se pudo eliminar: el registro esta en uso.',
                'error'
            );
        }

        $this->redirect('asignaciones', 'Registro eliminado.');
    }

    private function form(
        Asignacione $entity,
        array $errors,
        string $action,
        string $title
    ): void {
        $this->render(
            'asignaciones/form',
            compact('entity', 'errors', 'action'),
            $title
        );
    }
}
