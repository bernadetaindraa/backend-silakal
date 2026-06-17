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
        Schema::create('izin_cuti', function (Blueprint $table) {
            $table->id('izin_cuti_id');
            $table->foreignId('agenda_id')->constrained('agenda', 'agenda_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->date('tanggal_mulai_izin_cuti');
            $table->date('tanggal_selesai_izin_cuti');
            $table->string('alasan_izin_cuti');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin_cuti');
    }
};
