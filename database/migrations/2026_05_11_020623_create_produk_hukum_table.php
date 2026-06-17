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
        Schema::create('produk_hukum', function (Blueprint $table) {
            $table->id('produk_hukum_id');
            $table->string('nama_dokumen')->nullable();
            $table->string('nomor_dokumen')->nullable();
            $table->date('tanggal_ditetapkan')->nullable();
            $table->enum('kategori_dokumen', ['Perencanaan Penganggaran', 'Peraturan Kalurahan', 'Laporan', 'Peraturan Lurah'])->nullable();
            $table->string('tipe_dokumen')->nullable();
            $table->string('url_dokumen')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_hukum');
    }
};
