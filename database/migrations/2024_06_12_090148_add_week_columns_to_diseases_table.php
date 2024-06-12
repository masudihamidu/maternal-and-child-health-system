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
        Schema::table('diseases', function (Blueprint $table) {
            $table->boolean('week12')->default(false);
            $table->boolean('week20')->default(false);
            $table->boolean('week26')->default(false);
            $table->boolean('week30')->default(false);
            $table->boolean('week36')->default(false);
            $table->boolean('week38')->default(false);
            $table->boolean('week40')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diseases', function (Blueprint $table) {
            $table->dropColumn(['week12', 'week20', 'week26', 'week30', 'week36', 'week38', 'week40']);
        });
    }
};
