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
        Schema::create('layanan_dokumen', function (Blueprint $table) {
            $table->id('layanan_dokumen_id');
            $table->foreignId('layanan_id')->constrained('layanan', 'layanan_id')->onDelete('cascade');
            $table->string('jenis_dokumen');
            $table->string('url_file_dokumen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_dokumen');
    }
};
