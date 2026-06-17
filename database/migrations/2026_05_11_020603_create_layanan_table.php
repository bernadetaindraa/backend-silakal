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
        Schema::create('layanan', function (Blueprint $table) {
            $table->id('layanan_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('jenis_layanan');
            $table->string('keperluan_layanan');
            $table->enum('status_layanan', ['menunggu', 'diverifikasi', 'ditolak', 'diproses', 'siap_diambil', 'selesai'])->default('menunggu');
            $table->string('nomor_layanan')->unique();
            $table->date('tanggal_layanan'); 
            $table->enum('pengiriman_layanan', ['ambil', 'email'])->default('ambil');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
