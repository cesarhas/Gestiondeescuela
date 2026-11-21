<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Estudiante;
use PDO;

final class EstudianteRepository implements EstudianteRepositoryInterface
{
    private const WRITABLE = ['nombre', 'apellido', 'fecha_nacimiento', 'grado'];

    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $rows = $this->pdo
            ->query('SELECT * FROM "estudiantes" ORDER BY "estudiante_id" DESC')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            [Estudiante::class, 'fromArray'],
            $rows
        );
    }

    public function find(int $id): ?Estudiante
    {
        $st = $this->pdo->prepare(
            'SELECT * FROM "estudiantes" WHERE "estudiante_id" = :id'
        );

        $st->execute(['id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);

        return $row ? Estudiante::fromArray($row) : null;
    }

    public function create(Estudiante $entity): int
    {
        $sql = '
            INSERT INTO "estudiantes" ("nombre", "apellido", "fecha_nacimiento", "grado")
            VALUES (:nombre, :apellido, :fecha_nacimiento, :grado)
            RETURNING "estudiante_id"
        ';

        $st = $this->pdo->prepare($sql);
        $st->execute($this->data($entity));

        return (int) $st->fetchColumn();
    }

    public function update(Estudiante $entity): void
    {
        $sql = '
            UPDATE "estudiantes"
            SET "nombre" = :nombre, "apellido" = :apellido, "fecha_nacimiento" = :fecha_nacimiento, "grado" = :grado
            WHERE "estudiante_id" = :__pk
        ';

        $st = $this->pdo->prepare($sql);

        $st->execute(
            $this->data($entity) + [
                '__pk' => $entity->estudiante_id
            ]
        );
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare(
            'DELETE FROM "estudiantes" WHERE "estudiante_id" = :id'
        );

        $st->execute(['id' => $id]);
    }

    private function data(Estudiante $entity): array
    {
        return array_intersect_key(
            $entity->toArray(),
            array_flip(self::WRITABLE)
        );
    }
}
