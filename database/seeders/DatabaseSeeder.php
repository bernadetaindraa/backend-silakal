<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            RtRwSeeder::class,
            DusunSeeder::class,
            KategoriKebudayaanSeeder::class,
            JenisKebudayaanSeeder::class,
            PertanyaanSurveySeeder::class,
            OpsiJawabanSurveySeeder::class,
            AparaturSeeder::class,
            BpkalSeeder::class,
            BpkalKegiatanSeeder::class,
            KategoriBeritaSeeder::class,
            BeritaSeeder::class,
            AgendaSeeder::class,
            ProdukHukumSeeder::class,
            PotensiProdukSeeder::class,
            KebudayaanSeeder::class,
        ]);
    }
}
