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
        Schema::create('rt_rw', function (Blueprint $table) {
            $table->id('rt_rw_id');

            $table->foreignId('dusun_id')
                ->constrained('dusun', 'dusun_id')
                ->onDelete('cascade');

            $table->string('nama_rt');
            $table->string('nama_rw');

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['dusun_id', 'nama_rt', 'nama_rw']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rt_rw');
    }
};
