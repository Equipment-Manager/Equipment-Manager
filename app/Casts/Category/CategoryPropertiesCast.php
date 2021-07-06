<?php

declare(strict_types=1);

namespace App\Casts\Category;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CategoryPropertiesCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): ?CategoryProperties
    {
        if ($value === null) {
            return null;
        }

        $properties = json_decode($value, true);
        $categoryPropeties = new CategoryProperties();

        foreach ($properties as $property) {
            $categoryPropeties->addProperty(
                new CategoryProperty($property["name"], $property["type"], $property["unit"])
            );
        }

        return $categoryPropeties;
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
