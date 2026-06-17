<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan', function (Blueprint $table) {

            $table->string('nomor_surat')->nullable()->after('nomor_layanan');

            $table->string('jabatan_penandatangan')
                ->nullable()
                ->after('nomor_surat');

            $table->string('nama_penandatangan')
                ->nullable()
                ->after('jabatan_penandatangan');

            $table->text('isi_surat')
                ->nullable()
                ->after('nama_penandatangan');

            $table->string('file_surat')
                ->nullable()
                ->after('isi_surat');

            $table->timestamp('tanggal_surat')
                ->nullable()
                ->after('file_surat');
        });
    }

    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {

            $table->dropColumn([
                'nomor_surat',
                'jabatan_penandatangan',
                'nama_penandatangan',
                'isi_surat',
                'file_surat',
                'tanggal_surat',
            ]);

        });
    }
};