<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\NotFoundException;
use App\Entities\Asignacione;
use App\Repositories\AsignacioneRepositoryInterface;

final class AsignacioneService
{
    public function __construct(
        private AsignacioneRepositoryInterface $repository
    ) {
    }

    public function list(): array
    {
        return $this->repository->all();
    }

    public function get(int $id): Asignacione
    {
        return $this->repository->find($id)
            ?? throw new NotFoundException();
    }

    public function validate(Asignacione $e): array
    {
        $errors = [];

        if (trim((string) $e->materia) === '') {
            $errors['materia'] = 'Materia es obligatorio.';
        }
        if (mb_strlen((string) $e->materia) > 100) {
            $errors['materia'] = 'Materia admite maximo 100 caracteres.';
        }

        return $errors;
    }

    public function create(Asignacione $e): int
    {
        return $this->repository->create($e);
    }

    public function update(Asignacione $e): void
    {
        $this->repository->update($e);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
