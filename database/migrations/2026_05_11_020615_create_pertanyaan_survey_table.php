<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertanyaan_survey', function (Blueprint $table) {
            $table->id('pertanyaan_survey_id');
            $table->string('pertanyaan_survey');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_survey');
    }
};