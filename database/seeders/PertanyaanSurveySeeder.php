<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PertanyaanSurvey;

class PertanyaanSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pertanyaan = [
            [
                'pertanyaan_survey' => 'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?'
            ],
            [
                'pertanyaan_survey' => 'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?'
            ],
            [
                'pertanyaan_survey' => 'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?'
            ],
            [
                'pertanyaan_survey' => 'Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?'
            ],
            [
                'pertanyaan_survey' => 'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan dengan hasil yang diberikan?'
            ],
            [
                'pertanyaan_survey' => 'Bagaimana pendapat Saudara tentang kompetensi/kemampuan petugas dalam pelayanan?'
            ],
            [
                'pertanyaan_survey' => 'Bagaimana pendapat Saudara tentang perilaku petugas dalam pelayanan (kesopanan & keramahan)?'
            ],
            [
                'pertanyaan_survey' => 'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?'
            ],
            [
                'pertanyaan_survey' => 'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?'
            ],
        ];

        foreach ($pertanyaan as $item) {
            PertanyaanSurvey::create($item);
        }
    }
}