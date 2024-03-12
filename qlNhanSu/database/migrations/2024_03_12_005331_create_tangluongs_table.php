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
            $table->string("maTangLuong")->unique("maTangLuongUnique");
            $table->date("ngaytangluong");
            $table->string("lidotangluong");
            $table->string("chitiettangluong");
            $table->string("mans");

            $table->foreign('mans')->references("Manhansu")->on("nhansus");
            $table->timestamps(); 
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
