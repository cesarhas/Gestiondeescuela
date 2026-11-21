<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\NotFoundException;
use App\Entities\Profesore;
use App\Repositories\ProfesoreRepositoryInterface;

final class ProfesoreService
{
    public function __construct(
        private ProfesoreRepositoryInterface $repository
    ) {
    }

    public function list(): array
    {
        return $this->repository->all();
    }

    public function get(int $id): Profesore
    {
        return $this->repository->find($id)
            ?? throw new NotFoundException();
    }

    public function validate(Profesore $e): array
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
        if (trim((string) $e->especialidad) === '') {
            $errors['especialidad'] = 'Especialidad es obligatorio.';
        }
        if (mb_strlen((string) $e->especialidad) > 100) {
            $errors['especialidad'] = 'Especialidad admite maximo 100 caracteres.';
        }
        if (trim((string) $e->email) === '') {
            $errors['email'] = 'Email es obligatorio.';
        }
        if (mb_strlen((string) $e->email) > 100) {
            $errors['email'] = 'Email admite maximo 100 caracteres.';
        }
        if ((string) $e->email !== '' && !filter_var($e->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email no es un correo valido.';
        }

        return $errors;
    }

    public function create(Profesore $e): int
    {
        return $this->repository->create($e);
    }

    public function update(Profesore $e): void
    {
        $this->repository->update($e);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
