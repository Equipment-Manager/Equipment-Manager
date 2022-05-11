<?php

declare(strict_types=1);

namespace App\Casts\Equipment;

use Illuminate\Contracts\Support\Arrayable;

class EquipmentProperty implements Arrayable
{
    protected string $uuid;
    protected mixed $value;

    public function __construct(string $uuid, mixed $value)
    {
        $this->uuid = $uuid;
        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            "uuid" => $this->uuid,
            "value" => $this->value,
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
