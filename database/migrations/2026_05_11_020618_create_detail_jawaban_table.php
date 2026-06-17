<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_jawaban', function (Blueprint $table) {
            $table->id('detail_jawaban_id');
            $table->foreignId('jawaban_survey_id')
                ->constrained('jawaban_survey', 'jawaban_survey_id')
                ->onDelete('cascade');
            $table->foreignId('pertanyaan_survey_id')
                ->constrained('pertanyaan_survey', 'pertanyaan_survey_id')
                ->onDelete('cascade');
            $table->foreignId('opsi_jawaban_survey_id')
                ->constrained('opsi_jawaban_survey', 'opsi_jawaban_survey_id')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_jawaban');
    }
};