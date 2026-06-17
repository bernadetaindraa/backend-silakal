<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kebudayaan', function (Blueprint $table) {
            $table->id('kebudayaan_id');
            $table->foreignId('jenis_kebudayaan_id')->constrained('jenis_kebudayaan', 'jenis_kebudayaan_id')->onDelete('cascade');
            $table->string('judul_kebudayaan');
            $table->text('deskripsi_kebudayaan');
            $table->year('tahun_ditetapkan');
            $table->string('lokasi_kebudayaan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebudayaan');
    }
};
