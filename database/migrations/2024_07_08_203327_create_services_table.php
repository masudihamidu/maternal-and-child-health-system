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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name', 25);
            $table->string('description');
            $table->boolean('week12')->default(false);
            $table->boolean('week20')->default(false);
            $table->boolean('week26')->default(false);
            $table->boolean('week30')->default(false);
            $table->boolean('week36')->default(false);
            $table->boolean('week38')->default(false);
            $table->boolean('week40')->default(false);
            $table->unsignedBigInteger('mother_id'); // Foreign key
            $table->timestamps();
            $table->foreign('mother_id')->references('id')->on('mothers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};