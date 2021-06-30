<?php

namespace Tests\Unit;

use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentCastsTest extends TestCase
{
    use RefreshDatabase;

    public function testSavingEquipment(): void
    {
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
                "category_id" => 1,
                "serial_number" => "test",
                "properties" => $properties,
                "user_id" => 1,
            ]
        );

        $equipment = Equipment::first();
        dump($properties);
        dump($equipment->properties->toArray());
        $this->assertEquals($properties, $equipment->properties->toArray());

//        $this->assertDatabaseHas(
//            'equipment',
//            [
//                "properties" => [
//                    "property1" => "value1",
//                    "property2" => "value2",
//                    "property3" => "value3",
//                ],
//            ]
//        );
    }
}
