<?php

declare(strict_types=1);

namespace App\Casts\Category;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class CategoryProperties implements Castable, Arrayable
{
    /** @var Collection|CategoryProperty[] */
    protected Collection $properties;

    public function __construct()
    {
        $this->properties = new Collection();
    }

    public function addProperty(CategoryProperty $property): void
    {
        $this->properties->add($property);
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new CategoryPropertiesCast();
    }

    public function toArray(): array
    {
        return $this->properties->toArray();
    }
}
