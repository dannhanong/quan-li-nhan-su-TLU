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
        Schema::create('hopdongs', function (Blueprint $table) {
            $table->id();
            $table->string('maHopdong');
            $table->string('Manhansu');
            $table->timestamps();
            $table->date('Ngaybatdau');
            $table->date('Ngayketthuc');
            $table->date('Ngayky');
            $table->integer('Lanky');
            $table->foreign('Manhansu')->references('Manhansu')->on('nhansus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hopdongs');
    }
};
