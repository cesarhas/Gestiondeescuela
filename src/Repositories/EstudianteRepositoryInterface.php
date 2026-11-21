<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Estudiante;

interface EstudianteRepositoryInterface
{
    /** @return Estudiante[] */
    public function all(): array;

    public function find(int $id): ?Estudiante;

    public function create(Estudiante $entity): int;

    public function update(Estudiante $entity): void;

    public function delete(int $id): void;
}
