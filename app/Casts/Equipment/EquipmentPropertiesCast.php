<?php

declare(strict_types=1);

namespace App\Casts\Equipment;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class EquipmentPropertiesCast implements CastsAttributes
{
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
}
