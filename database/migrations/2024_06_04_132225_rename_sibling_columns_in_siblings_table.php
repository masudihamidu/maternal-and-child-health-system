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
        Schema::table('siblings', function (Blueprint $table) {
            $table->renameColumn('firstname', 'sibling_firstname');
            $table->renameColumn('middlename', 'sibling_middlename');
            $table->renameColumn('surname', 'sibling_surname');
            $table->renameColumn('phone_number', 'sibling_phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siblings', function (Blueprint $table) {
            $table->renameColumn('sibling_firstname', 'firstname');
            $table->renameColumn('sibling_middlename', 'middlename');
            $table->renameColumn('sibling_surname', 'surname');
            $table->renameColumn('sibling_phone_number', 'phone_number');
        });
    }
};
