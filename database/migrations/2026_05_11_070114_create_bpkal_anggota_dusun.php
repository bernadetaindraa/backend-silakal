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
        Schema::create('bpkal_anggota_dusun', function (Blueprint $table) {

            $table->id('bpkal_anggota_dusun_id');

            $table->foreignId('bpkal_anggota_id')
                ->constrained('bpkal_anggota', 'bpkal_anggota_id')
                ->onDelete('cascade');

            $table->foreignId('dusun_id')
                ->constrained('dusun', 'dusun_id')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpkal_anggota_dusun');
    }
};