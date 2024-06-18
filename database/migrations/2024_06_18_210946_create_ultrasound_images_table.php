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
        Schema::create('ultrasound_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mother_id');
            $table->foreign('mother_id')->references('id')->on('mothers')->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ultrasound_images');
    }
};
