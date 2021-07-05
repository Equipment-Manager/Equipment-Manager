<?php

declare(strict_types=1);

namespace App\Models\Castables\Equipment;

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
        return new class() implements CastsAttributes {
            public function get($model, $key, $value, $attributes): ?EquipmentProperties
            {
                if ($value === null) {
                    return null;
                }

                $properties = json_decode($value, true);
                $equipmentPropeties = new EquipmentProperties();

                foreach ($properties as $property) {
                    $equipmentPropeties->addProperty(new EquipmentProperty($property["name"], $property["value"]));
                }

                return $equipmentPropeties;
            }

            public function set($model, $key, $value, $attributes): ?string
            {
                if ($value === null) {
                    return null;
                }

                if (is_array($value)) {
                    return json_encode($value, JSON_THROW_ON_ERROR);
                }

                return json_encode($value->toArray(), JSON_THROW_ON_ERROR);
            }
        };
    }

    public function toArray(): array
    {
        return $this->properties->toArray();
    }
}
