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
        Schema::create('tangluongs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Manhansu');
            $table->integer('Bacluong');
            $table->string('Lydo');
            $table->text('Chitiet');
            $table->timestamps();
            $table->foreign('Manhansu')->references('id')->on('nhansus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tangluongs');
    }
};
