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
        Schema::create('potensi_produk_foto', function (Blueprint $table) {
            $table->id('potensi_produk_foto_id');
            $table->foreignId('potensi_produk_id')->constrained('potensi_produk', 'potensi_produk_id')->onDelete('cascade');
            $table->string('url_foto_potensi_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potensi_produk_foto');
    }
};
