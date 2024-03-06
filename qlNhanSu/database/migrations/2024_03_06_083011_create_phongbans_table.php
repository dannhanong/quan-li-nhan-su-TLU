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
        Schema::create('phongbans', function (Blueprint $table) {
            $table->id();
            $table->string("maPhongBan")->unique("maPhongBanUnique");
            $table->string("tenPhongBan")->unique("tenPhongBanUnique");
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phong_bans', function (Blueprint $table) {
            
            // Xóa unique constraint khi rollback
            $table->dropUnique('maPhongBanUnique');
            $table->dropUnique('tenPhongBanUnique');
            
            // Xóa cột khi rollback
            $table->dropColumn('maPhongBan');
            $table->dropColumn('tenPhongBan');
        });
        Schema::dropIfExists('phongbans');
    }
};
