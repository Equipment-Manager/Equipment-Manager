<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Casts\Category\CategoryProperties;
use App\Casts\Category\CategoryProperty;
use App\Casts\Equipment\EquipmentProperty;
use App\Exceptions\Equipment\PropertyIsNotAllowedException;
use App\Exceptions\Equipment\WrongPropertyTypeException;
use App\Models\Category;
use App\Models\Equipment;

class EquipmentPropertiesValidator
{
    protected CategoryProperties $categoryProperties;

    /**
     * @throws PropertyIsNotAllowedException
     * @throws WrongPropertyTypeException
     */
    public function arePropertiesValid(Equipment $equipment): bool
    {
        $this->getCategoryProperties($equipment);

        foreach ($equipment->properties as $property) {
            if (!$this->isPropertyAllowed($property)) {
                throw new PropertyIsNotAllowedException();
            }
            if (!$this->isTypeOfPropertyCorrect($property)) {
                throw new WrongPropertyTypeException();
            }
        }

        return true;
    }

    protected function isPropertyAllowed(EquipmentProperty $property): bool
    {
        if ($this->findPropertyByUuid($property->getUuid())) {
            return true;
        }

        return false;
    }

    protected function isTypeOfPropertyCorrect(EquipmentProperty $property): bool
    {
        $propertyType = $this->findPropertyByUuid($property->getUuid())->getType();

        if (getType($property->getValue()) !== $propertyType) {
            return false;
        }

        return true;
    }

    protected function getCategoryProperties(Equipment $equipment): void
    {
        /** @var Category $category */
        $category = $equipment->category();

        $this->categoryProperties = $category->category_properties;
    }

    protected function findPropertyByUuid(string $uuid): ?CategoryProperty
    {
        /** @var CategoryProperty|null */
        return $this->categoryProperties->getCategoryProperties()->firstWhere("uuid", $uuid);
    }
}
