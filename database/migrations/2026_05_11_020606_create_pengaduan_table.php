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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('pengaduan_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->date('tanggal_pengaduan');
            $table->string('nama_pengadu');
            $table->string('kontak_pengadu');
            $table->string('jenis_pengaduan');
            $table->string('judul_pengaduan');
            $table->text('isi_pengaduan');
            $table->string('lokasi_kejadian');
            $table->string('status_pengaduan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
