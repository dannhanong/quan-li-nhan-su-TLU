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
        Schema::create('nhansus', function (Blueprint $table) {
            $table->id();
            $table->string('HoTen');
            $table->date('NgaySinh');
            $table->string('GioiTinh');
            $table->string('CCCD');
            $table->string('DiaChi');
            $table->string('SĐT');
            $table->string('QueQuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhansus');
    }
};
