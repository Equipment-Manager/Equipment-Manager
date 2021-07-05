<?php

declare(strict_types=1);

namespace App\Casts\Equipment;

use Illuminate\Contracts\Support\Arrayable;

class EquipmentProperty implements Arrayable
{
    protected string $name;
    protected string $value;

    public function __construct(string $name, mixed $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "value" => $this->value,
        ];
    }
}
