<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiseaseIdToUltrasoundImagesTable extends Migration
{
    public function up()
    {
        Schema::table('ultrasound_images', function (Blueprint $table) {
            $table->foreignId('disease_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ultrasound_images', function (Blueprint $table) {
            $table->dropForeign(['disease_id']);
            $table->dropColumn('disease_id');
        });
    }
}
