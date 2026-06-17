<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan', function (Blueprint $table) {

            // kategori layanan
            $table->string('kategori_layanan')->nullable();

            // pengajuan
            $table->enum('jenis_pengajuan', [
                'sendiri',
                'orang_lain'
            ])->default('sendiri');

            $table->string('hubungan_pengaju')->nullable();

            // data warga yang diajukan
            $table->string('nik_pengajuan')->nullable();
            $table->string('nama_pengajuan')->nullable();
            $table->string('telepon_pengajuan')->nullable();

            $table->string('tempat_lahir_pengajuan')->nullable();
            $table->date('tanggal_lahir_pengajuan')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {

            $table->dropColumn([
                'kategori_layanan',
                'jenis_pengajuan',
                'hubungan_pengaju',
                'nik_pengajuan',
                'nama_pengajuan',
                'telepon_pengajuan',
                'tempat_lahir_pengajuan',
                'tanggal_lahir_pengajuan',
            ]);

        });
    }
};