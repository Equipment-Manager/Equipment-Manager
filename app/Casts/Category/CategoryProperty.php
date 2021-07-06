<?php

declare(strict_types=1);

namespace App\Casts\Category;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

class CategoryProperty implements Arrayable
{
    protected string $uuid;
    protected string $name;
    protected string $type;
    protected string $unit;

    public function __construct(string $name, string $type, string $unit, string $uuid = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->unit = $unit;
        $this->uuid = $uuid ?: (string)Str::uuid();
    }

    public function toArray(): array
    {
        return [
            "uuid" => $this->uuid,
            "name" => $this->name,
            "type" => $this->type,
            "unit" => $this->unit,
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}
