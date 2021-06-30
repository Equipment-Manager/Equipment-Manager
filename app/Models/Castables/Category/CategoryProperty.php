<?php

declare(strict_types=1);

namespace App\Models\Castables\Category;

use Illuminate\Contracts\Support\Arrayable;

class CategoryProperty implements Arrayable
{
    protected string $name;
    protected string $type;

    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "type" => $this->type,
        ];
    }
}
