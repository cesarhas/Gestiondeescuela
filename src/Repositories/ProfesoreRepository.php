<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Profesore;
use PDO;

final class ProfesoreRepository implements ProfesoreRepositoryInterface
{
    private const WRITABLE = ['nombre', 'apellido', 'especialidad', 'email'];

    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $rows = $this->pdo
            ->query('SELECT * FROM "profesores" ORDER BY "profesor_id" DESC')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            [Profesore::class, 'fromArray'],
            $rows
        );
    }

    public function find(int $id): ?Profesore
    {
        $st = $this->pdo->prepare(
            'SELECT * FROM "profesores" WHERE "profesor_id" = :id'
        );

        $st->execute(['id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);

        return $row ? Profesore::fromArray($row) : null;
    }

    public function create(Profesore $entity): int
    {
        $sql = '
            INSERT INTO "profesores" ("nombre", "apellido", "especialidad", "email")
            VALUES (:nombre, :apellido, :especialidad, :email)
            RETURNING "profesor_id"
        ';

        $st = $this->pdo->prepare($sql);
        $st->execute($this->data($entity));

        return (int) $st->fetchColumn();
    }

    public function update(Profesore $entity): void
    {
        $sql = '
            UPDATE "profesores"
            SET "nombre" = :nombre, "apellido" = :apellido, "especialidad" = :especialidad, "email" = :email
            WHERE "profesor_id" = :__pk
        ';

        $st = $this->pdo->prepare($sql);

        $st->execute(
            $this->data($entity) + [
                '__pk' => $entity->profesor_id
            ]
        );
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare(
            'DELETE FROM "profesores" WHERE "profesor_id" = :id'
        );

        $st->execute(['id' => $id]);
    }

    private function data(Profesore $entity): array
    {
        return array_intersect_key(
            $entity->toArray(),
            array_flip(self::WRITABLE)
        );
    }
}
