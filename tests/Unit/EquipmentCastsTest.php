<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentCastsTest extends TestCase
{
    use RefreshDatabase;

    public function testSavingEquipment(): void
    {
        Category::factory()->times(1)->create();

        $properties = [
            [
                "name" => "property1",
                "value" => "value1",
            ],
            [
                "name" => "property2",
                "value" => "value2",
            ],
            [
                "name" => "property3",
                "value" => "value3",
            ],
        ];

        Equipment::create(
            [
                "name" => "test",
                "category_id" => Category::first()->id,
                "serial_number" => "test",
                "properties" => $properties,
            ]
        );

        $equipment = Equipment::first();

        $this->assertSame($properties, $equipment->properties->toArray());
    }
}
