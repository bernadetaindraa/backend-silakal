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
        Schema::create('potensi_produk', function (Blueprint $table) {
            $table->id('potensi_produk_id');
            $table->string('judul_potensi_produk');
            $table->text('artikel_potensi_produk');
            $table->string('nama_potensi_produk');
            $table->date('tanggal_potensi_produk');
            $table->enum('kategori_potensi_produk', ['Potensi Daerah', 'Produk Usaha Daerah'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potensi_produk');
    }
};
