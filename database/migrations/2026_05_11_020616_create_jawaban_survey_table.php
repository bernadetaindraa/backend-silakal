<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jawaban_survey', function (Blueprint $table) {
            $table->id('jawaban_survey_id');
            $table->string('umur_responden');
            $table->enum('jenis_kelamin_responden', [
                'Laki-laki',
                'Perempuan'
            ]);

            $table->string('pekerjaan_responden')->nullable();
            $table->enum('pendidikan_responden', [
                'Tidak Sekolah',
                'Tidak Tamat SD/Sederajat',
                'Tamat SD/Sederajat',
                'Tidak Tamat SMP/Sederajat',
                'Tamat SMP/Sederajat',
                'Tidak Tamat SMU/Sederajat',
                'Tamat SMU/Sederajat',
                'Tamat D1, D2 atau D3',
                'Tamat S1, S2, S3'
            ]);
            $table->date('tanggal_survey');
            $table->string('jenis_layanan');
            $table->text('saran_masukan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_survey');
    }
};