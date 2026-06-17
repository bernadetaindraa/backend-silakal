<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opsi_jawaban_survey', function (Blueprint $table) {

            $table->id('opsi_jawaban_survey_id');

            $table->foreignId('pertanyaan_survey_id')
                ->constrained('pertanyaan_survey', 'pertanyaan_survey_id')
                ->onDelete('cascade');

            $table->string('opsi_jawaban');

            // nilai untuk IKM
            $table->tinyInteger('nilai_jawaban');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opsi_jawaban_survey');
    }
};