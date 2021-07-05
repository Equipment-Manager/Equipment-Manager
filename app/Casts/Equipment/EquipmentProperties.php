<?php

declare(strict_types=1);

namespace App\Casts\Equipment;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class EquipmentProperties implements Castable, Arrayable
{
    /** @var Collection|EquipmentProperty[] */
    protected Collection $properties;

    protected int $currentTurn;

    public function __construct()
    {
        $this->properties = new Collection();
    }

    public function addProperty(EquipmentProperty $property): void
    {
        $this->properties->add($property);
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new EquipmentPropertiesCast();
    }

    public function toArray(): array
    {
        return $this->properties->toArray();
    }
}
