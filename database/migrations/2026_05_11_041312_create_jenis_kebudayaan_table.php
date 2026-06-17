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
        Schema::create('jenis_kebudayaan', function (Blueprint $table) {
            $table->id('jenis_kebudayaan_id');

            $table->foreignId('kategori_kebudayaan_id')
                  ->constrained('kategori_kebudayaan', 'kategori_kebudayaan_id')
                  ->onDelete('cascade');

            $table->string('nama_jenis');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kebudayaan');
    }
};
