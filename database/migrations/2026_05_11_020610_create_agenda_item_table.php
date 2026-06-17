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
        Schema::create('agenda_item', function (Blueprint $table) {
            $table->id('agenda_item_id');
            $table->foreignId('agenda_id')->constrained('agenda', 'agenda_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->enum('kategori_agenda', ['Di Dalam Kantor Kalurahan', 'Di Luar Kantor Kalurahan']);
            $table->time('waktu_agenda');
            $table->string('nama_agenda');
            $table->string('tempat_agenda');
            $table->string('penyelenggara_agenda');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_item');
    }
};
