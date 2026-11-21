<?php
declare(strict_types=1);

namespace App\Entities;

/** Una fila de la tabla asignaciones. */
final class Asignacione
{
    public function __construct(
        public ?int $asignacion_id = null,
        public int $estudiante_id = 0,
        public int $profesor_id = 0,
        public string $materia = '',
    ) {
    }

    public static function fromArray(array $d): self
    {
        return new self(
            asignacion_id: (isset($d['asignacion_id']) && $d['asignacion_id'] !== '' ? (int) $d['asignacion_id'] : null),
            estudiante_id: (int) ($d['estudiante_id'] ?? 0),
            profesor_id: (int) ($d['profesor_id'] ?? 0),
            materia: (string) ($d['materia'] ?? ''),
        );
    }

    public function toArray(): array
    {
        return [
            'asignacion_id' => $this->asignacion_id,
            'estudiante_id' => $this->estudiante_id,
            'profesor_id' => $this->profesor_id,
            'materia' => $this->materia,
        ];
    }
}
