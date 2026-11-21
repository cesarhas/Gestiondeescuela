<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Asignacione;
use PDO;

final class AsignacioneRepository implements AsignacioneRepositoryInterface
{
    private const WRITABLE = ['estudiante_id', 'profesor_id', 'materia'];

    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $rows = $this->pdo
            ->query('SELECT * FROM "asignaciones" ORDER BY "asignacion_id" DESC')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            [Asignacione::class, 'fromArray'],
            $rows
        );
    }

    public function find(int $id): ?Asignacione
    {
        $st = $this->pdo->prepare(
            'SELECT * FROM "asignaciones" WHERE "asignacion_id" = :id'
        );

        $st->execute(['id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);

        return $row ? Asignacione::fromArray($row) : null;
    }

    public function create(Asignacione $entity): int
    {
        $sql = '
            INSERT INTO "asignaciones" ("estudiante_id", "profesor_id", "materia")
            VALUES (:estudiante_id, :profesor_id, :materia)
            RETURNING "asignacion_id"
        ';

        $st = $this->pdo->prepare($sql);
        $st->execute($this->data($entity));

        return (int) $st->fetchColumn();
    }

    public function update(Asignacione $entity): void
    {
        $sql = '
            UPDATE "asignaciones"
            SET "estudiante_id" = :estudiante_id, "profesor_id" = :profesor_id, "materia" = :materia
            WHERE "asignacion_id" = :__pk
        ';

        $st = $this->pdo->prepare($sql);

        $st->execute(
            $this->data($entity) + [
                '__pk' => $entity->asignacion_id
            ]
        );
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare(
            'DELETE FROM "asignaciones" WHERE "asignacion_id" = :id'
        );

        $st->execute(['id' => $id]);
    }

    private function data(Asignacione $entity): array
    {
        return array_intersect_key(
            $entity->toArray(),
            array_flip(self::WRITABLE)
        );
    }
}
