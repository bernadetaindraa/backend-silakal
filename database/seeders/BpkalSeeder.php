<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BpkalAnggota;
use App\Models\BpkalAnggotaDusun;
use Illuminate\Support\Facades\Hash;

class BpkalSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Dony Rukmana Putra',
                'agama' => 'Islam',
                'pendidikan' => 'D3',
                'jabatan' => 'Anggota BPKal',
                'wilayah' => [1, 3, 5, 6],
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nama' => 'Winarwan',
                'agama' => 'Islam',
                'pendidikan' => 'SMA/K',
                'jabatan' => 'Wakil Ketua Bidang Pemerintahan dan Pemberdayaan Masyarakat',
                'wilayah' => [8],
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nama' => 'Budi Nugroho',
                'agama' => 'Islam',
                'pendidikan' => 'SMA/K',
                'jabatan' => 'Anggota BPKal',
                'wilayah' => [9],
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nama' => 'Suroto',
                'agama' => 'Islam',
                'pendidikan' => 'SMA/K',
                'jabatan' => 'Wakil Ketua Bidang Pembangunan Kalurahan dan Pembinaan Masyarakat',
                'wilayah' => [12, 14, 17, 20],
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nama' => 'Granita Elsara',
                'agama' => 'Islam',
                'pendidikan' => 'S1',
                'jabatan' => 'Anggota BPKal',
                'wilayah' => [11],
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nama' => 'Wantoro',
                'agama' => 'Islam',
                'pendidikan' => 'SMA/K',
                'jabatan' => 'Anggota BPKal',
                'wilayah' => [12, 14, 17, 20],
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nama' => 'RR. Titik Mardiyati',
                'agama' => 'Islam',
                'pendidikan' => null,
                'jabatan' => 'Wakil Ketua BPKal',
                'wilayah' => [],
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nama' => 'Sugiyarsa, BA.',
                'agama' => 'Islam',
                'pendidikan' => null,
                'jabatan' => 'Ketua BPKal',
                'wilayah' => [10],
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nama' => 'Agus Setyawan',
                'agama' => 'Islam',
                'pendidikan' => 'SMA/K',
                'jabatan' => 'Sekretaris BPKal',
                'wilayah' => [1, 3, 5, 6],
                'jenis_kelamin' => 'Laki-laki',
            ],
        ];

        foreach ($data as $index => $item) {

            $email = strtolower(
                str_replace([' ', ',', '.'], '', $item['nama'])
            ) . '@gmail.com';

            $user = User::create([
                'role_id' => 5,
                'dusun_id' => $item['wilayah'][0] ?? 1,
                'nik' => '3404' . str_pad($index + 1, 12, '0', STR_PAD_LEFT),
                'nama_lengkap' => $item['nama'],
                'tempat_lahir' => 'Sleman',
                'tanggal_lahir' => '1980-01-01',
                'jenis_kelamin' => $item['jenis_kelamin'],
                'pekerjaan' => $item['jabatan'],
                'pendidikan_terakhir' => $item['pendidikan'],
                'status_perkawinan' => 'Kawin',
                'agama' => $item['agama'],
                'nomor_telepon' => '08123456789',
                'email' => $email,
                'password' => Hash::make('password'),
                'url_foto_profil' => null,
            ]);

            $anggota = BpkalAnggota::create([
                'user_id' => $user->user_id,
                'jabatan' => $item['jabatan'],
            ]);

            foreach ($item['wilayah'] as $dusunId) {
                BpkalAnggotaDusun::create([
                    'bpkal_anggota_id' => $anggota->bpkal_anggota_id,
                    'dusun_id' => $dusunId,
                ]);
            }
        }
    }
}