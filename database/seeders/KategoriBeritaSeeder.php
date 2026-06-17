<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBerita;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Berita'],
            ['nama_kategori' => 'Agenda'],
            ['nama_kategori' => 'Sosial'],
            ['nama_kategori' => 'Budaya'],
            ['nama_kategori' => 'Lingkungan'],
            ['nama_kategori' => 'Kesehatan'],
            ['nama_kategori' => 'Pendidikan'],
            ['nama_kategori' => 'Pembangunan'],
            ['nama_kategori' => 'Teknologi'],
        ];

        foreach ($kategori as $item) {
            KategoriBerita::create($item);
        }
    }
}