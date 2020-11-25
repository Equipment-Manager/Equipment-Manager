<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create("users", function (Blueprint $table): void {
            $table->id();
            $table->string("name", 64);
            $table->string("surname", 64);
            $table->string("email")->unique();
            $table->string("avatar", 128)->nullable();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->boolean("is_verified")->default(false);
            $table->boolean("is_active")->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("users");
    }
}
