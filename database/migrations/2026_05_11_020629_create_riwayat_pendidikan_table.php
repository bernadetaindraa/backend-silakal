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
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id('riwayat_pendidikan_id');
            $table->foreignId('aparatur_id')->constrained('aparatur', 'aparatur_id')->onDelete('cascade');
            $table->enum('tingkat_pendidikan', ['TK', 'SD', 'SMP', 'SMA/K', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3']);
            $table->string('jurusan')->nullable();
            $table->string('nama_instansi');
            $table->year('tahun_masuk');
            $table->year('tahun_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
};
