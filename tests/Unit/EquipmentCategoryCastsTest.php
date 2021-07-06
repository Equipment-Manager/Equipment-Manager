<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentCategoryCastsTest extends TestCase
{
    use RefreshDatabase;

    public function testSavingEquipmentCategory(): void
    {
        $properties = [
            [
                "name" => "property1",
                "type" => "type1",
                "unit" => "",
            ],
            [
                "name" => "property2",
                "type" => "type2",
                "unit" => "in",
            ],
            [
                "name" => "property3",
                "type" => "type3",
                "unit" => "Gb",
            ],
        ];

        Category::create(
            [
                "name" => "test",
                "category_properties" => $properties,
            ]
        );

        $category = Category::first();

        $this->assertSame($properties, $category->category_properties->toArray());
    }
}
