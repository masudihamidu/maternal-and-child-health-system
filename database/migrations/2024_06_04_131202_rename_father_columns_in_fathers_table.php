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
        Schema::table('fathers', function (Blueprint $table) {
            $table->renameColumn('firstname', 'father_firstname');
            $table->renameColumn('middlename', 'father_middlename');
            $table->renameColumn('surname', 'father_surname');
            $table->renameColumn('phone_number', 'father_phone_number');
            $table->renameColumn('education', 'father_education');
            $table->renameColumn('occupation', 'father_occupation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fathers', function (Blueprint $table) {
            $table->renameColumn('father_firstname', 'firstname');
            $table->renameColumn('father_middlename', 'middlename');
            $table->renameColumn('father_surname', 'surname');
            $table->renameColumn('father_phone_number', 'phone_number');
            $table->renameColumn('father_education', 'education');
            $table->renameColumn('father_occupation', 'occupation');
        });
    }
};
