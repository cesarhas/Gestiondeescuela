<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\NotFoundException;
use App\Entities\Estudiante;
use App\Repositories\EstudianteRepositoryInterface;

final class EstudianteService
{
    public function __construct(
        private EstudianteRepositoryInterface $repository
    ) {
    }

    public function list(): array
    {
        return $this->repository->all();
    }

    public function get(int $id): Estudiante
    {
        return $this->repository->find($id)
            ?? throw new NotFoundException();
    }

    public function validate(Estudiante $e): array
    {
        $errors = [];

        if (trim((string) $e->nombre) === '') {
            $errors['nombre'] = 'Nombre es obligatorio.';
        }
        if (mb_strlen((string) $e->nombre) > 50) {
            $errors['nombre'] = 'Nombre admite maximo 50 caracteres.';
        }
        if (trim((string) $e->apellido) === '') {
            $errors['apellido'] = 'Apellido es obligatorio.';
        }
        if (mb_strlen((string) $e->apellido) > 50) {
            $errors['apellido'] = 'Apellido admite maximo 50 caracteres.';
        }
        if (trim((string) $e->fecha_nacimiento) === '') {
            $errors['fecha_nacimiento'] = 'Fecha nacimiento es obligatorio.';
        }
        if (trim((string) $e->grado) === '') {
            $errors['grado'] = 'Grado es obligatorio.';
        }
        if (mb_strlen((string) $e->grado) > 20) {
            $errors['grado'] = 'Grado admite maximo 20 caracteres.';
        }

        return $errors;
    }

    public function create(Estudiante $e): int
    {
        return $this->repository->create($e);
    }

    public function update(Estudiante $e): void
    {
        $this->repository->update($e);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
