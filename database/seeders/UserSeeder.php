<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([

            /*
            |--------------------------------------------------------------------------
            | ADMIN SISTEM
            |--------------------------------------------------------------------------
            */
            [
                'role_id' => 1,
                'dusun_id' => 1,
                'nik' => '3404010101010001',
                'nama_lengkap' => 'Administrator Sistem Kalurahan',
                'tempat_lahir' => 'Sleman',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'pekerjaan' => 'Administrator Sistem',
                'pendidikan_terakhir' => 'S1',
                'status_perkawinan' => 'Belum Kawin',
                'agama' => 'Islam',
                'nomor_telepon' => '081111111111',
                'email' => 'indrabernadet+admin@gmail.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | PETUGAS PELAYANAN
            |--------------------------------------------------------------------------
            */
            [
                'role_id' => 2,
                'dusun_id' => 1,
                'nik' => '3404010202020002',
                'nama_lengkap' => 'Petugas Pelayanan Kalurahan',
                'tempat_lahir' => 'Sleman',
                'tanggal_lahir' => '1995-02-02',
                'jenis_kelamin' => 'Perempuan',
                'pekerjaan' => 'Petugas Pelayanan',
                'pendidikan_terakhir' => 'D3',
                'status_perkawinan' => 'Belum Kawin',
                'agama' => 'Islam',
                'nomor_telepon' => '082222222222',
                'email' => 'indrabernadet+pelayanan@gmail.com',
                'password' => Hash::make('pelayanan123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | DUKUH
            |--------------------------------------------------------------------------
            */
            [
                'role_id' => 3,
                'dusun_id' => 1,
                'nik' => '3404010303030003',
                'nama_lengkap' => 'Dukuh Wonorejo',
                'tempat_lahir' => 'Sleman',
                'tanggal_lahir' => '1985-03-03',
                'jenis_kelamin' => 'Laki-laki',
                'pekerjaan' => 'Kepala Dusun',
                'pendidikan_terakhir' => 'S1',
                'status_perkawinan' => 'Kawin',
                'agama' => 'Islam',
                'nomor_telepon' => '083333333333',
                'email' => 'indrabernadet+dukuh@gmail.com',
                'password' => Hash::make('dukuh123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}