<?php
declare(strict_types=1);

namespace App\Entities;

/** Una fila de la tabla profesores. */
final class Profesore
{
    public function __construct(
        public ?int $profesor_id = null,
        public string $nombre = '',
        public string $apellido = '',
        public string $especialidad = '',
        public string $email = '',
    ) {
    }

    public static function fromArray(array $d): self
    {
        return new self(
            profesor_id: (isset($d['profesor_id']) && $d['profesor_id'] !== '' ? (int) $d['profesor_id'] : null),
            nombre: (string) ($d['nombre'] ?? ''),
            apellido: (string) ($d['apellido'] ?? ''),
            especialidad: (string) ($d['especialidad'] ?? ''),
            email: (string) ($d['email'] ?? ''),
        );
    }

    public function toArray(): array
    {
        return [
            'profesor_id' => $this->profesor_id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'especialidad' => $this->especialidad,
            'email' => $this->email,
        ];
    }
}
