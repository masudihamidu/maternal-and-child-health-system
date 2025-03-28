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
        Schema::create('fathers', function (Blueprint $table) {
            $table->id();
            $table->string('father_firstname', 20);
            $table->string('father_middlename', 20);
            $table->string('father_surname', 20);
            $table->string('father_phone_number', 12);
            $table->string('father_education');
            $table->string('father_occupation');
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
        Schema::dropIfExists('fathers');
    }
};
