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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignId('role_id')->constrained('roles', 'role_id')->onDelete('cascade');
            $table->foreignId('dusun_id')->constrained('dusun', 'dusun_id')->onDelete('cascade');
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('pekerjaan')->nullable();
            $table->enum('pendidikan_terakhir', ['Tidak Sekolah', 'SD', 'SMP', 'SMA/K', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->string('nomor_telepon')->nullable();    
            $table->string('email')->unique();
            $table->string('password'); 
            $table->string('url_foto_profil')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
