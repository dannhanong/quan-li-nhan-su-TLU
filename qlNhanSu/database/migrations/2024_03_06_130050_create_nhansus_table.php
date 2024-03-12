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
            $table->string('Manhansu')->unique();
            $table->string('Hoten');
            $table->date('Ngaysinh');
            $table->boolean('Gioitinh');
            $table->string('CCCD')->unique();
            $table->date('Ngaybatdau');
            $table->string('Diachi');
            $table->string('SDT')->unique();
            $table->string('Quequan');
            $table->unsignedBigInteger('Maphongban');
            $table->unsignedBigInteger('Machucvu');
            $table->unsignedBigInteger('Makhoa');
            $table->string('Anhdaidien')->default('default.jpg');
            $table->string('email')->unique()->nullable();
            $table->decimal('Hesoluong', 10, 2)->default(1);
            $table->integer('Bacluong')->default(1);
            $table->unsignedBigInteger('Matrangthai')->nullable();
            $table->string('Chucvu_Cu')->nullable();
            $table->timestamps();
            $table->foreign('Maphongban')->references('id')->on('phongbans')->onDelete('cascade');
            $table->foreign('Machucvu')->references('id')->on('chucvus')->onDelete('cascade');
            $table->foreign('Makhoa')->references('id')->on('khoas')->onDelete('cascade');
            $table->foreign('Matrangthai')->references('id')->on('trangthais')->onDelete('cascade');
            $table->dateTime('deleted_at')->nullable();
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
