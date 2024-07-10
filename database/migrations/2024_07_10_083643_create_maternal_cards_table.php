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
        Schema::create('maternal_cards', function (Blueprint $table) {
            $table->id();
            $table->string('maternalCard');
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
        Schema::dropIfExists('maternal_cards');
    }
};
