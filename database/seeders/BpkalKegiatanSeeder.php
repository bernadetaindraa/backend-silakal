<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BpkalKegiatan;

class BpkalKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatan = [
            [
                'judul_kegiatan' => 'Musrenbang Kalurahan Hargobinangun',
                'status_kegiatan' => 'Selesai',
                'tahun_kegiatan' => '2026',
                'deskripsi_kegiatan' => 'Kegiatan musyawarah perencanaan pembangunan kalurahan bersama masyarakat dan pemerintah kalurahan.',
            ],
            [
                'judul_kegiatan' => 'Penyerapan Aspirasi Masyarakat',
                'status_kegiatan' => 'Berjalan',
                'tahun_kegiatan' => '2026',
                'deskripsi_kegiatan' => 'Kegiatan penyerapan aspirasi masyarakat terkait pembangunan dan pelayanan kalurahan.',
            ],
            [
                'judul_kegiatan' => 'Pengawasan Pembangunan Infrastruktur',
                'status_kegiatan' => 'Selesai',
                'tahun_kegiatan' => '2026',
                'deskripsi_kegiatan' => 'Pengawasan pelaksanaan pembangunan infrastruktur di wilayah kalurahan.',
            ],
            [
                'judul_kegiatan' => 'Sosialisasi Peraturan Kalurahan',
                'status_kegiatan' => 'Berjalan',
                'tahun_kegiatan' => '2026',
                'deskripsi_kegiatan' => 'Sosialisasi peraturan kalurahan kepada masyarakat dan tokoh wilayah.',
            ],
            [
                'judul_kegiatan' => 'Evaluasi Kinerja Pemerintah Kalurahan',
                'status_kegiatan' => 'Berjalan',
                'tahun_kegiatan' => '2026',
                'deskripsi_kegiatan' => 'Evaluasi pelaksanaan program dan kinerja pemerintah kalurahan selama tahun berjalan.',
            ],
            [
                'judul_kegiatan' => 'Pemberdayaan UMKM Lokal',
                'status_kegiatan' => 'Selesai',
                'tahun_kegiatan' => '2026',
                'deskripsi_kegiatan' => 'Program pendampingan dan pemberdayaan UMKM lokal di wilayah kalurahan.',
            ],
            [
                'judul_kegiatan' => 'Monitoring Dana Desa',
                'status_kegiatan' => 'Selesai',
                'tahun_kegiatan' => '2026',
                'deskripsi_kegiatan' => 'Monitoring penggunaan dana desa agar sesuai dengan program dan kebutuhan masyarakat.',
            ],
        ];

        foreach ($kegiatan as $item) {
            BpkalKegiatan::create($item);
        }
    }
}