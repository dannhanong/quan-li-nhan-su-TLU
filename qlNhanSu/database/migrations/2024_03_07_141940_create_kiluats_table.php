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
        Schema::create('kiluats', function (Blueprint $table) {
            $table->id();
            $table->string("maKiLuat")->unique("maKiLuatUnique");
            $table->string("tenKiLuat")->unique("tenKiLuatUnique");
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kiluats');
    }
};
