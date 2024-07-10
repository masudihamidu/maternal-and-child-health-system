<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER after_mother_insert
            AFTER INSERT ON mothers
            FOR EACH ROW
            BEGIN
                INSERT INTO maternal_cards (maternalCard, mother_id, created_at, updated_at)
                VALUES (CONCAT("MC-", NEW.id), NEW.id, NOW(), NOW());
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_mother_insert');
    }
};
