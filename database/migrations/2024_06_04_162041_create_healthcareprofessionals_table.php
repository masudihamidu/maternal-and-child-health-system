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
        
        Schema::create('healthcareprofessionals', function (Blueprint $table) {
            $table->id();
            $table->string('professional_name', 40);
            $table->string('rank', 12);
            $table->unsignedBigInteger('mother_id'); // Foreign key
            $table->foreign('mother_id')->references('id')->on('mothers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthcareprofessionals');
    }
};
