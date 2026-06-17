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
        Schema::create('pengaduan_file', function (Blueprint $table) {
            $table->id('pengaduan_file_id');
            $table->foreignId('pengaduan_id')->constrained('pengaduan', 'pengaduan_id')->onDelete('cascade');
            $table->string('url_file_pengaduan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_file');
    }
};
