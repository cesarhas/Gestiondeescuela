<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Profesore;

interface ProfesoreRepositoryInterface
{
    /** @return Profesore[] */
    public function all(): array;

    public function find(int $id): ?Profesore;

    public function create(Profesore $entity): int;

    public function update(Profesore $entity): void;

    public function delete(int $id): void;
}
