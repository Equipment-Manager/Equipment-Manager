<?php

declare(strict_types=1);

namespace App\Models\Castables\Category;

use Illuminate\Contracts\Support\Arrayable;

class CategoryProperty implements Arrayable
{
    protected string $name;
    protected string $type;
    protected string $unit;

    public function __construct(string $name, string $type, string $unit)
    {
        $this->name = $name;
        $this->type = $type;
        $this->unit = $unit;
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "type" => $this->type,
            "unit" => $this->unit,
        ];
    }
}
