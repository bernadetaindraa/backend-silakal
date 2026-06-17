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
        Schema::create('berita_foto', function (Blueprint $table) {
            $table->id('berita_foto_id');
            $table->foreignId('berita_id')->constrained('berita', 'berita_id')->onDelete('cascade');
            $table->string('url_file_berita');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_foto');
    }
};
