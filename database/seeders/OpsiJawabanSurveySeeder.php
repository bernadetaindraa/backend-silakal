<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpsiJawabanSurvey;

class OpsiJawabanSurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opsi = [

            /**
             * Pertanyaan 1
             */
            [
                'pertanyaan_survey_id' => 1,
                'opsi_jawaban' => 'Tidak Sesuai',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 1,
                'opsi_jawaban' => 'Kurang Sesuai',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 1,
                'opsi_jawaban' => 'Sesuai',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 1,
                'opsi_jawaban' => 'Sangat Sesuai',
                'nilai_jawaban' => 4,
            ],

            /**
             * Pertanyaan 2
             */
            [
                'pertanyaan_survey_id' => 2,
                'opsi_jawaban' => 'Tidak Mudah',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 2,
                'opsi_jawaban' => 'Kurang Mudah',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 2,
                'opsi_jawaban' => 'Mudah',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 2,
                'opsi_jawaban' => 'Sangat Mudah',
                'nilai_jawaban' => 4,
            ],

            /**
             * Pertanyaan 3
             */
            [
                'pertanyaan_survey_id' => 3,
                'opsi_jawaban' => 'Tidak',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 3,
                'opsi_jawaban' => 'Kurang',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 3,
                'opsi_jawaban' => 'Baik',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 3,
                'opsi_jawaban' => 'Sangat Baik',
                'nilai_jawaban' => 4,
            ],

            /**
             * Pertanyaan 4
             */
            [
                'pertanyaan_survey_id' => 4,
                'opsi_jawaban' => 'Sangat Mahal',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 4,
                'opsi_jawaban' => 'Cukup Mahal',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 4,
                'opsi_jawaban' => 'Murah',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 4,
                'opsi_jawaban' => 'Gratis',
                'nilai_jawaban' => 4,
            ],

            /**
             * Pertanyaan 5
             */
            [
                'pertanyaan_survey_id' => 5,
                'opsi_jawaban' => 'Tidak',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 5,
                'opsi_jawaban' => 'Kurang',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 5,
                'opsi_jawaban' => 'Baik',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 5,
                'opsi_jawaban' => 'Sangat Baik',
                'nilai_jawaban' => 4,
            ],

            /**
             * Pertanyaan 6
             */
            [
                'pertanyaan_survey_id' => 6,
                'opsi_jawaban' => 'Tidak Kompeten',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 6,
                'opsi_jawaban' => 'Kurang Kompeten',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 6,
                'opsi_jawaban' => 'Kompeten',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 6,
                'opsi_jawaban' => 'Sangat Kompeten',
                'nilai_jawaban' => 4,
            ],

            /**
             * Pertanyaan 7
             */
            [
                'pertanyaan_survey_id' => 7,
                'opsi_jawaban' => 'Tidak Sopan dan Ramah',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 7,
                'opsi_jawaban' => 'Kurang Sopan dan Ramah',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 7,
                'opsi_jawaban' => 'Sopan dan Ramah',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 7,
                'opsi_jawaban' => 'Sangat Sopan dan Ramah',
                'nilai_jawaban' => 4,
            ],

            /**
             * Pertanyaan 8
             */
            [
                'pertanyaan_survey_id' => 8,
                'opsi_jawaban' => 'Buruk',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 8,
                'opsi_jawaban' => 'Cukup',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 8,
                'opsi_jawaban' => 'Baik',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 8,
                'opsi_jawaban' => 'Sangat Baik',
                'nilai_jawaban' => 4,
            ],

            /**
             * Pertanyaan 9
             */
            [
                'pertanyaan_survey_id' => 9,
                'opsi_jawaban' => 'Tidak Ada',
                'nilai_jawaban' => 1,
            ],
            [
                'pertanyaan_survey_id' => 9,
                'opsi_jawaban' => 'Ada Tetapi Tidak Berfungsi',
                'nilai_jawaban' => 2,
            ],
            [
                'pertanyaan_survey_id' => 9,
                'opsi_jawaban' => 'Berfungsi Kurang Maksimal',
                'nilai_jawaban' => 3,
            ],
            [
                'pertanyaan_survey_id' => 9,
                'opsi_jawaban' => 'Dikelola Dengan Baik',
                'nilai_jawaban' => 4,
            ],
        ];

        foreach ($opsi as $item) {
            OpsiJawabanSurvey::create($item);
        }
    }
}