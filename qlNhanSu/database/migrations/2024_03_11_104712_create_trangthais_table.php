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
        Schema::create('trangthais', function (Blueprint $table) {
            $table->id();
            $table->string('maTrangThai')->unique("maTrangThaiUnique");;
            $table->string('tenTrangThai')->unique("tenTrangThaiUnique");;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trangthais');
    }
};
