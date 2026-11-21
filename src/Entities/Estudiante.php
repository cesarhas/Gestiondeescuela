<?php
declare(strict_types=1);

namespace App\Entities;

/** Una fila de la tabla estudiantes. */
final class Estudiante
{
    public function __construct(
        public ?int $estudiante_id = null,
        public string $nombre = '',
        public string $apellido = '',
        public string $fecha_nacimiento = '',
        public string $grado = '',
    ) {
    }

    public static function fromArray(array $d): self
    {
        return new self(
            estudiante_id: (isset($d['estudiante_id']) && $d['estudiante_id'] !== '' ? (int) $d['estudiante_id'] : null),
            nombre: (string) ($d['nombre'] ?? ''),
            apellido: (string) ($d['apellido'] ?? ''),
            fecha_nacimiento: (string) ($d['fecha_nacimiento'] ?? ''),
            grado: (string) ($d['grado'] ?? ''),
        );
    }

    public function toArray(): array
    {
        return [
            'estudiante_id' => $this->estudiante_id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'grado' => $this->grado,
        ];
    }
}
