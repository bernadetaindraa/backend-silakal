<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {

            $table->dropForeign(['kategori_berita_id']);
            $table->dropColumn('kategori_berita_id');
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {

            $table->unsignedBigInteger('kategori_berita_id')->nullable();

            $table->foreign('kategori_berita_id')
                ->references('kategori_berita_id')
                ->on('kategori_beritas')
                ->onDelete('set null');
        });
    }
};