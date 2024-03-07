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
        Schema::create('bikiluats', function (Blueprint $table) {
            $table->id();
            $table->string('maKiLuat');
            $table->string('Manhansu');
            // Thêm khóa ngoại
            $table->foreign('maKiLuat')->references('maKiLuat')->on('kiluats');
            $table->foreign('Manhansu')->references('Manhansu')->on('nhansus');
            $table->string("Lido");
            $table->string("MucDo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bikiluats');
    }
};
