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
        Schema::create('mother_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->string('allergy', 15);
            $table->integer('gravidity');
            $table->integer('parity');
            $table->integer('childrens_born_niti');
            $table->integer('miscarriages');
            $table->integer('out_of_pocket');
            $table->integer('died_child');
            $table->integer('living_children');
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
        Schema::dropIfExists('mother_backgrounds');
    }
};
