<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;
use App\Models\AgendaItem;
use App\Models\PiketDukuh;
use App\Models\IzinCuti;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $dataAgenda = [

            [
                'tanggal' => '2026-06-01',
                'judul' => 'Agenda Senin Kalurahan',
                'agenda_item' => [
                    [
                        'user_id' => 1,
                        'kategori_agenda' => 'Di Dalam Kantor Kalurahan',
                        'waktu_agenda' => '08:00:00',
                        'nama_agenda' => 'Pelayanan Administrasi Kependudukan',
                        'tempat_agenda' => 'Balai Kalurahan',
                        'penyelenggara_agenda' => 'Pemerintah Kalurahan',
                    ]
                ],
                'piket_dukuh' => [
                    [
                        'user_id' => 4,
                        'waktu_piket' => '08:00:00',
                        'keterangan_piket' => 'Piket pelayanan masyarakat',
                    ]
                ],
                'izin_cuti' => [
                    [
                        'user_id' => 7,
                        'tanggal_mulai_izin_cuti' => '2026-06-01',
                        'tanggal_selesai_izin_cuti' => '2026-06-01',
                        'alasan_izin_cuti' => 'Keperluan keluarga',
                    ]
                ],
            ],

            [
                'tanggal' => '2026-06-02',
                'judul' => 'Agenda Selasa Kalurahan',
                'agenda_item' => [
                    [
                        'user_id' => 2,
                        'kategori_agenda' => 'Di Luar Kantor Kalurahan',
                        'waktu_agenda' => '09:00:00',
                        'nama_agenda' => 'Monitoring Padukuhan',
                        'tempat_agenda' => 'Padukuhan Jetisan',
                        'penyelenggara_agenda' => 'Kalurahan Hargobinangun',
                    ]
                ],
                'piket_dukuh' => [
                    [
                        'user_id' => 5,
                        'waktu_piket' => '08:00:00',
                        'keterangan_piket' => 'Piket administrasi surat',
                    ]
                ],
                'izin_cuti' => [
                    [
                        'user_id' => 8,
                        'tanggal_mulai_izin_cuti' => '2026-06-02',
                        'tanggal_selesai_izin_cuti' => '2026-06-02',
                        'alasan_izin_cuti' => 'Pemeriksaan kesehatan',
                    ]
                ],
            ],

            [
                'tanggal' => '2026-06-03',
                'judul' => 'Agenda Rabu Kalurahan',
                'agenda_item' => [
                    [
                        'user_id' => 3,
                        'kategori_agenda' => 'Di Dalam Kantor Kalurahan',
                        'waktu_agenda' => '13:00:00',
                        'nama_agenda' => 'Rapat Koordinasi Harian',
                        'tempat_agenda' => 'Ruang Rapat Kalurahan',
                        'penyelenggara_agenda' => 'Lurah Hargobinangun',
                    ]
                ],
                'piket_dukuh' => [
                    [
                        'user_id' => 6,
                        'waktu_piket' => '08:00:00',
                        'keterangan_piket' => 'Piket informasi masyarakat',
                    ]
                ],
                'izin_cuti' => [
                    [
                        'user_id' => 9,
                        'tanggal_mulai_izin_cuti' => '2026-06-03',
                        'tanggal_selesai_izin_cuti' => '2026-06-03',
                        'alasan_izin_cuti' => 'Keperluan pribadi',
                    ]
                ],
            ],

            [
                'tanggal' => '2026-06-04',
                'judul' => 'Agenda Kamis Kalurahan',
                'agenda_item' => [
                    [
                        'user_id' => 1,
                        'kategori_agenda' => 'Di Luar Kantor Kalurahan',
                        'waktu_agenda' => '10:00:00',
                        'nama_agenda' => 'Sosialisasi UMKM',
                        'tempat_agenda' => 'Gedung Serbaguna',
                        'penyelenggara_agenda' => 'Dinas Koperasi',
                    ]
                ],
                'piket_dukuh' => [
                    [
                        'user_id' => 4,
                        'waktu_piket' => '08:00:00',
                        'keterangan_piket' => 'Piket pelayanan umum',
                    ]
                ],
                'izin_cuti' => [
                    [
                        'user_id' => 7,
                        'tanggal_mulai_izin_cuti' => '2026-06-04',
                        'tanggal_selesai_izin_cuti' => '2026-06-04',
                        'alasan_izin_cuti' => 'Acara keluarga',
                    ]
                ],
            ],

            [
                'tanggal' => '2026-06-05',
                'judul' => 'Agenda Jumat Kalurahan',
                'agenda_item' => [
                    [
                        'user_id' => 2,
                        'kategori_agenda' => 'Di Luar Kantor Kalurahan',
                        'waktu_agenda' => '07:30:00',
                        'nama_agenda' => 'Kerja Bakti Lingkungan',
                        'tempat_agenda' => 'Padukuhan Boyong',
                        'penyelenggara_agenda' => 'Kalurahan Hargobinangun',
                    ]
                ],
                'piket_dukuh' => [
                    [
                        'user_id' => 5,
                        'waktu_piket' => '08:00:00',
                        'keterangan_piket' => 'Piket pelayanan surat',
                    ]
                ],
                'izin_cuti' => [
                    [
                        'user_id' => 8,
                        'tanggal_mulai_izin_cuti' => '2026-06-05',
                        'tanggal_selesai_izin_cuti' => '2026-06-05',
                        'alasan_izin_cuti' => 'Keperluan pribadi',
                    ]
                ],
            ],

            [
                'tanggal' => '2026-06-06',
                'judul' => 'Agenda Sabtu Kalurahan',
                'agenda_item' => [
                    [
                        'user_id' => 3,
                        'kategori_agenda' => 'Di Dalam Kantor Kalurahan',
                        'waktu_agenda' => '09:00:00',
                        'nama_agenda' => 'Pelatihan Digitalisasi Arsip',
                        'tempat_agenda' => 'Balai Kalurahan',
                        'penyelenggara_agenda' => 'Diskominfo',
                    ]
                ],
                'piket_dukuh' => [
                    [
                        'user_id' => 6,
                        'waktu_piket' => '08:00:00',
                        'keterangan_piket' => 'Piket pelayanan informasi',
                    ]
                ],
                'izin_cuti' => [
                    [
                        'user_id' => 9,
                        'tanggal_mulai_izin_cuti' => '2026-06-06',
                        'tanggal_selesai_izin_cuti' => '2026-06-06',
                        'alasan_izin_cuti' => 'Sakit',
                    ]
                ],
            ],

            [
                'tanggal' => '2026-06-07',
                'judul' => 'Agenda Minggu Kalurahan',
                'agenda_item' => [
                    [
                        'user_id' => 1,
                        'kategori_agenda' => 'Di Luar Kantor Kalurahan',
                        'waktu_agenda' => '08:00:00',
                        'nama_agenda' => 'Senam dan Jalan Sehat',
                        'tempat_agenda' => 'Lapangan Kalurahan',
                        'penyelenggara_agenda' => 'PKK Hargobinangun',
                    ]
                ],
                'piket_dukuh' => [
                    [
                        'user_id' => 4,
                        'waktu_piket' => '08:00:00',
                        'keterangan_piket' => 'Piket pelayanan minggu',
                    ]
                ],
                'izin_cuti' => [
                    [
                        'user_id' => 7,
                        'tanggal_mulai_izin_cuti' => '2026-06-07',
                        'tanggal_selesai_izin_cuti' => '2026-06-07',
                        'alasan_izin_cuti' => 'Keperluan keluarga',
                    ]
                ],
            ],

        ];

        foreach ($dataAgenda as $data) {

            $agenda = Agenda::create([
                'judul_agenda' => $data['judul'],
                'tanggal_agenda' => $data['tanggal'],
            ]);

            foreach ($data['agenda_item'] as $item) {

                AgendaItem::create([
                    'agenda_id' => $agenda->agenda_id,
                    ...$item
                ]);
            }

            foreach ($data['piket_dukuh'] as $piket) {

                PiketDukuh::create([
                    'agenda_id' => $agenda->agenda_id,
                    ...$piket
                ]);
            }

            foreach ($data['izin_cuti'] as $izin) {

                IzinCuti::create([
                    'agenda_id' => $agenda->agenda_id,
                    ...$izin
                ]);
            }
        }
    }
}