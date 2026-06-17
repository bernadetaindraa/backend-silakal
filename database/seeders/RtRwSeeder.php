<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dusun;
use App\Models\RtRw;

class RtRwSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Wonorejo' => [
                '027' => ['002'],
                '028' => ['003','004'],
            ],
            'Ponggol' => [
                '027' => ['001'],
            ],
        ];

        foreach ($data as $namaDusun => $rws) {
            $dusun = Dusun::where('nama_dusun', $namaDusun)->first();

            if (!$dusun) continue;

            foreach ($rws as $rw => $rts) {
                foreach ($rts as $rt) {
                    RtRw::create([
                        'dusun_id' => $dusun->id,
                        'nama_rt' => $rt,
                        'nama_rw' => $rw,
                    ]);
                }
            }
        }
    }
}