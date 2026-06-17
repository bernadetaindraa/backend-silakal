<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKebudayaanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_kebudayaan')->insert([
            [
                'nama_kategori' => 'Kebudayaan Benda',
            ],
            [
                'nama_kategori' => 'Kebudayaan Non-Benda',
            ],
        ]);
    }
}