<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukHukum;

class ProdukHukumSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            // =========================
            // PERENCANAAN
            // =========================
            [
                'nama_dokumen' => 'Rencana Kerja Pemerintah Kalurahan Tahun 2026',
                'nomor_dokumen' => '01/RKPKal/2026',
                'tanggal_ditetapkan' => '2026-01-05',
                'kategori_dokumen' => 'Perencanaan Penganggaran',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/rkpkal-2026.pdf',
            ],

            [
                'nama_dokumen' => 'Rencana Pembangunan Infrastruktur Padukuhan Tahun 2026',
                'nomor_dokumen' => '02/RPI/2026',
                'tanggal_ditetapkan' => '2026-01-10',
                'kategori_dokumen' => 'Perencanaan Penganggaran',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/rpi-2026.pdf',
            ],

            [
                'nama_dokumen' => 'Dokumen Perencanaan Ketahanan Pangan Kalurahan',
                'nomor_dokumen' => '03/KP/2026',
                'tanggal_ditetapkan' => '2026-02-01',
                'kategori_dokumen' => 'Perencanaan Penganggaran',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/ketahanan-pangan.pdf',
            ],

            // =========================
            // PENGANGGARAN
            // =========================
            [
                'nama_dokumen' => 'APBKal Tahun Anggaran 2026',
                'nomor_dokumen' => '01/APBKal/2026',
                'tanggal_ditetapkan' => '2026-01-15',
                'kategori_dokumen' => 'Perencanaan Penganggaran',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/apbkal-2026.pdf',
            ],

            [
                'nama_dokumen' => 'Perubahan APBKal Tahun 2026',
                'nomor_dokumen' => '02/P-APBKal/2026',
                'tanggal_ditetapkan' => '2026-06-20',
                'kategori_dokumen' => 'Perencanaan Penganggaran',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/perubahan-apbkal.pdf',
            ],

            [
                'nama_dokumen' => 'Dokumen Penganggaran Dana Keistimewaan',
                'nomor_dokumen' => '03/DAIS/2026',
                'tanggal_ditetapkan' => '2026-03-12',
                'kategori_dokumen' => 'Perencanaan Penganggaran',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/dais-2026.pdf',
            ],

            // =========================
            // PERATURAN KALURAHAN
            // =========================
            [
                'nama_dokumen' => 'Peraturan Kalurahan tentang Ketertiban Lingkungan',
                'nomor_dokumen' => '01/Perkal/2026',
                'tanggal_ditetapkan' => '2026-02-10',
                'kategori_dokumen' => 'Peraturan Kalurahan',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/perkal-ketertiban.pdf',
            ],

            [
                'nama_dokumen' => 'Peraturan Kalurahan tentang Pengelolaan Sampah',
                'nomor_dokumen' => '02/Perkal/2026',
                'tanggal_ditetapkan' => '2026-03-05',
                'kategori_dokumen' => 'Peraturan Kalurahan',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/perkal-sampah.pdf',
            ],

            [
                'nama_dokumen' => 'Peraturan Kalurahan tentang Wisata Desa',
                'nomor_dokumen' => '03/Perkal/2026',
                'tanggal_ditetapkan' => '2026-04-11',
                'kategori_dokumen' => 'Peraturan Lurah',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/perkal-wisata.pdf',
            ],

            // =========================
            // LAPORAN
            // =========================
            [
                'nama_dokumen' => 'Laporan Realisasi APBKal Semester I Tahun 2026',
                'nomor_dokumen' => '01/LRA/2026',
                'tanggal_ditetapkan' => '2026-07-01',
                'kategori_dokumen' => 'Laporan',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/lra-semester1.pdf',
            ],

            [
                'nama_dokumen' => 'Laporan Kegiatan Pembangunan Kalurahan Tahun 2026',
                'nomor_dokumen' => '02/LKP/2026',
                'tanggal_ditetapkan' => '2026-08-14',
                'kategori_dokumen' => 'Laporan',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/laporan-pembangunan.pdf',
            ],

            [
                'nama_dokumen' => 'Laporan Pertanggungjawaban Dana Desa Tahun 2026',
                'nomor_dokumen' => '03/LPJ-DD/2026',
                'tanggal_ditetapkan' => '2026-12-20',
                'kategori_dokumen' => 'Laporan',
                'tipe_dokumen' => 'PDF',
                'url_dokumen' => 'dokumen/lpj-dd.pdf',
            ],
        ];

        foreach ($data as $item) {
            ProdukHukum::create($item);
        }
    }
}