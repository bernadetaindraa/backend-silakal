<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_kategori', function (Blueprint $table) {

            $table->id('berita_kategori_id');

            $table->unsignedBigInteger('berita_id');
            $table->unsignedBigInteger('kategori_berita_id');

            $table->timestamps();

            $table->foreign('berita_id', 'fk_berita_kategori_berita')
                ->references('berita_id')
                ->on('berita')
                ->onDelete('cascade');

            $table->foreign('kategori_berita_id', 'fk_berita_kategori_kategori')
                ->references('kategori_berita_id')
                ->on('kategori_beritas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_kategori');
    }
};