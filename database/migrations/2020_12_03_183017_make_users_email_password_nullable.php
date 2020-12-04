<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUsersEmailPasswordNullable extends Migration
{
    public function up(): void
    {
        Schema::table("users", function(Blueprint $table): void {
            $table->string("password")->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table("users", function (Blueprint $table): void {
            $table->string("email")->change();
        });
    }
}
