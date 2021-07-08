<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table(
            "invites",
            function (Blueprint $table): void {
                $table->string("status")->default("pending");
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(
            "invites",
            function (Blueprint $table): void {
                $table->dropColumn("status");
            }
        );
    }
};
