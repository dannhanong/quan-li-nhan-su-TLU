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
        Schema::create('khenthuongs', function (Blueprint $table) {
            $table->id();
            $table->string('Manhansu');
            $table->date('ngayKhenThuong');
            $table->text('lyDo');
            $table->string('chiTietKhenThuong');
            $table->timestamps();
            $table->foreign('Manhansu')->references('Manhansu')->on('nhansus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khenthuongs');
    }
};
