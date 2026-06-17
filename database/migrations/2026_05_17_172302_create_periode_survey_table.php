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
        Schema::create('periode_survey', function (Blueprint $table) {

            $table->id('periode_survey_id');

            $table->string('nama_periode');

            $table->date('tanggal_mulai');

            $table->date('tanggal_selesai');

            $table->enum('status_periode', [
                'Buka',
                'Tutup'
            ])->default('Tutup');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_survey');
    }
};