<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    public function up(): void
    {
        Schema::create("invites", function (Blueprint $table): void {
            $table->id();
            $table->string("email");
            $table->string("token", 16)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
