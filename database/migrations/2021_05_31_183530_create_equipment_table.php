<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    public function up(): void
    {
        Schema::create("equipment", function (Blueprint $table): void {
            $table->id();
            $table->string("name");
            $table->foreignId("category_id")->constrained("categories");
            $table->string("serial_number");
            $table->json("properties");
            $table->foreignId("user_id")->constrained("users")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("equipment");
    }
}
