<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKebudayaanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_kebudayaan')->insert([

            // BENDA
            [
                'kategori_kebudayaan_id' => 1,
                'nama_jenis' => 'Warisan Budaya Benda',
            ],
            [
                'kategori_kebudayaan_id' => 1,
                'nama_jenis' => 'Manuskrip',
            ],
            [
                'kategori_kebudayaan_id' => 1,
                'nama_jenis' => 'Teknologi Tradisional',
            ],

            // NON BENDA
            [
                'kategori_kebudayaan_id' => 2,
                'nama_jenis' => 'Adat Istiadat',
            ],
            [
                'kategori_kebudayaan_id' => 2,
                'nama_jenis' => 'Bahasa',
            ],
            [
                'kategori_kebudayaan_id' => 2,
                'nama_jenis' => 'Ritus',
            ],
            [
                'kategori_kebudayaan_id' => 2,
                'nama_jenis' => 'Seni',
            ],
            [
                'kategori_kebudayaan_id' => 2,
                'nama_jenis' => 'Pengetahuan Tradisional',
            ],
            [
                'kategori_kebudayaan_id' => 2,
                'nama_jenis' => 'Permainan Rakyat',
            ],
            [
                'kategori_kebudayaan_id' => 2,
                'nama_jenis' => 'Olahraga Tradisional',
            ],
            [
                'kategori_kebudayaan_id' => 2,
                'nama_jenis' => 'Tradisi Lisan',
            ],
        ]);
    }
}