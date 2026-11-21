<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Asignacione;

interface AsignacioneRepositoryInterface
{
    /** @return Asignacione[] */
    public function all(): array;

    public function find(int $id): ?Asignacione;

    public function create(Asignacione $entity): int;

    public function update(Asignacione $entity): void;

    public function delete(int $id): void;
}
