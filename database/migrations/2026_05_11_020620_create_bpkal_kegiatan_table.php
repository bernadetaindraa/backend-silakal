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
        Schema::create('bpkal_kegiatan', function (Blueprint $table) {
            $table->id('bpkal_kegiatan_id');
            $table->string('judul_kegiatan');
            $table->string('status_kegiatan');
            $table->year('tahun_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpkal_kegiatan');
    }
};
