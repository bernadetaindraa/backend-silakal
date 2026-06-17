<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DusunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_dusun' => 'Jetisan'],
            ['nama_dusun' => 'Sawungan'],
            ['nama_dusun' => 'Sawungsari'],
            ['nama_dusun' => 'Dari'],
            ['nama_dusun' => 'Purworejo'],
            ['nama_dusun' => 'Banteng'],
            ['nama_dusun' => 'Sidorejo'],
            ['nama_dusun' => 'Boyong'],
            ['nama_dusun' => 'Ngipiksari'],
            ['nama_dusun' => 'Kaliurang Timur'],
            ['nama_dusun' => 'Kaliurang Barat'],
            ['nama_dusun' => 'Pandanpuro'],
            ['nama_dusun' => 'Gondanglegi'],
            ['nama_dusun' => 'Randu'],
            ['nama_dusun' => 'Wonokerso'],
            ['nama_dusun' => 'Ngetehan'],
            ['nama_dusun' => 'Tanen'],
            ['nama_dusun' => 'Selorejo'],
            ['nama_dusun' => 'Panggeran'],
            ['nama_dusun' => 'Wonorejo'],
            ['nama_dusun' => 'Ponggol'],
        ];

        foreach ($data as $item) {
            \App\Models\Dusun::create($item);
        }

    }
}