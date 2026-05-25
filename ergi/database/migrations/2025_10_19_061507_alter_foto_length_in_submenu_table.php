<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('submenu', function (Blueprint $table) {
            $table->string('foto', 255)->nullable()->change(); // ubah dari 100 jadi 255
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submenu', function (Blueprint $table) {
            $table->string('foto', 100)->nullable()->change();
        });
    }
};
