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
        Schema::table('jawaban_survey', function (Blueprint $table) {

            $table->foreignId('periode_survey_id')
                ->nullable()
                ->after('jawaban_survey_id')
                ->constrained(
                    'periode_survey',
                    'periode_survey_id'
                )
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawaban_survey', function (Blueprint $table) {

            $table->dropForeign([
                'periode_survey_id'
            ]);

            $table->dropColumn(
                'periode_survey_id'
            );
        });
    }
};