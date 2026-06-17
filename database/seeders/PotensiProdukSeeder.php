<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PotensiProduk;
use App\Models\PotensiProdukFoto;

class PotensiProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            // =====================================================
            // POTENSI DAERAH
            // =====================================================

            [
                'judul_potensi_produk' => 'Keindahan Wisata Alam Kaliurang',
                'artikel_potensi_produk' => '
                    <p>Kawasan Kaliurang merupakan salah satu destinasi wisata alam unggulan yang berada di wilayah Kalurahan Hargobinangun. Kawasan ini dikenal memiliki udara yang sejuk, pemandangan alam yang indah, serta suasana pegunungan yang masih asri. Letaknya yang berada di lereng Gunung Merapi menjadikan Kaliurang sebagai tujuan wisata favorit bagi masyarakat lokal maupun wisatawan dari luar daerah. Setiap akhir pekan dan musim liburan, kawasan ini selalu ramai dikunjungi wisatawan yang ingin menikmati suasana alam dan melepas penat dari aktivitas perkotaan.</p>

                    <p>Selain panorama alam yang memukau, Kaliurang juga memiliki berbagai fasilitas wisata yang mendukung aktivitas pengunjung. Terdapat wisata jeep lava tour yang mengajak wisatawan menyusuri jalur erupsi Merapi, kawasan camping ground, jalur tracking, serta taman wisata keluarga. Potensi wisata ini memberikan dampak ekonomi yang besar bagi masyarakat sekitar karena banyak warga yang membuka usaha penginapan, kuliner, jasa wisata, hingga penjualan oleh-oleh khas daerah.</p>

                    <p>Pemerintah kalurahan bersama masyarakat terus melakukan pengembangan kawasan wisata dengan menjaga kebersihan lingkungan dan memperbaiki fasilitas umum. Berbagai kegiatan budaya dan festival lokal juga sering diselenggarakan untuk menarik wisatawan sekaligus memperkenalkan budaya masyarakat setempat. Dengan pengelolaan yang baik, Kaliurang diharapkan mampu menjadi destinasi wisata berkelanjutan yang dapat meningkatkan kesejahteraan masyarakat Kalurahan Hargobinangun.</p>
                ',
                'nama_potensi_produk' => 'Wisata Kaliurang',
                'tanggal_potensi_produk' => '2026-01-15',
                'kategori_potensi_produk' => 'Potensi Daerah',
                'foto' => [
                    'potensi/kaliurang.jpg',
                ]
            ],

            [
                'judul_potensi_produk' => 'Potensi Pertanian Salak di Hargobinangun',
                'artikel_potensi_produk' => '
                    <p>Kalurahan Hargobinangun memiliki potensi pertanian yang cukup besar, salah satunya adalah perkebunan salak. Buah salak yang dihasilkan masyarakat memiliki kualitas yang baik dengan rasa manis dan tekstur yang khas. Kondisi tanah yang subur serta iklim pegunungan yang sejuk membuat tanaman salak dapat tumbuh dengan optimal. Banyak masyarakat menggantungkan penghasilan dari hasil pertanian ini, baik melalui penjualan langsung maupun pengolahan hasil panen menjadi produk olahan.</p>

                    <p>Selain dijual dalam bentuk buah segar, salak juga diolah menjadi berbagai produk seperti keripik salak, dodol salak, hingga minuman olahan. Produk-produk tersebut menjadi salah satu daya tarik UMKM lokal yang dipasarkan kepada wisatawan maupun melalui pameran daerah. Dengan adanya inovasi pengolahan produk, nilai jual hasil pertanian menjadi lebih tinggi dan mampu meningkatkan pendapatan masyarakat.</p>

                    <p>Pemerintah kalurahan juga memberikan dukungan melalui pelatihan pertanian modern dan pengembangan pemasaran digital untuk produk hasil pertanian masyarakat. Harapannya, potensi perkebunan salak dapat terus berkembang dan menjadi identitas unggulan Kalurahan Hargobinangun. Selain meningkatkan ekonomi warga, sektor pertanian juga berperan penting dalam menjaga ketahanan pangan dan keberlanjutan lingkungan desa.</p>
                ',
                'nama_potensi_produk' => 'Perkebunan Salak',
                'tanggal_potensi_produk' => '2026-02-03',
                'kategori_potensi_produk' => 'Potensi Daerah',
                'foto' => [
                    'potensi/salak.jpg',
                ]
            ],

            [
                'judul_potensi_produk' => 'Keripik Singkong UMKM Wonorejo',
                'artikel_potensi_produk' => '
                    <p>Keripik singkong merupakan salah satu produk usaha unggulan masyarakat Kalurahan Hargobinangun, khususnya di wilayah Wonorejo. Produk ini dihasilkan oleh pelaku UMKM lokal dengan menggunakan bahan baku singkong pilihan dari hasil pertanian masyarakat sekitar. Proses produksi dilakukan secara higienis dengan mempertahankan cita rasa khas yang gurih dan renyah. Saat ini keripik singkong telah dipasarkan hingga ke luar daerah dan menjadi oleh-oleh favorit wisatawan.</p>

                    <p>Pelaku usaha terus melakukan inovasi dengan menghadirkan berbagai varian rasa seperti balado, keju, barbeque, hingga rasa original. Selain meningkatkan kualitas produk, UMKM juga mulai memanfaatkan media sosial dan marketplace sebagai sarana pemasaran digital. Langkah ini membantu memperluas jangkauan penjualan sekaligus memperkenalkan produk lokal kepada masyarakat yang lebih luas.</p>

                    <p>Pemerintah kalurahan mendukung pengembangan UMKM melalui berbagai pelatihan kewirausahaan, bantuan promosi, dan partisipasi dalam kegiatan pameran produk daerah. Dengan adanya dukungan tersebut, usaha keripik singkong diharapkan mampu berkembang lebih besar dan membuka lapangan pekerjaan bagi masyarakat sekitar. Produk lokal seperti ini menjadi bukti bahwa potensi usaha masyarakat desa memiliki peluang besar untuk bersaing di pasar yang lebih luas.</p>
                ',
                'nama_potensi_produk' => 'Keripik Singkong',
                'tanggal_potensi_produk' => '2026-04-12',
                'kategori_potensi_produk' => 'Produk Usaha Daerah',
                'foto' => [
                    'produk/keripik-singkong.jpg',
                ]
            ],

        ];

        foreach ($data as $item) {

            $potensi = PotensiProduk::create([
                'judul_potensi_produk' => $item['judul_potensi_produk'],
                'artikel_potensi_produk' => $item['artikel_potensi_produk'],
                'nama_potensi_produk' => $item['nama_potensi_produk'],
                'tanggal_potensi_produk' => $item['tanggal_potensi_produk'],
                'kategori_potensi_produk' => $item['kategori_potensi_produk'],
            ]);

            foreach ($item['foto'] as $foto) {

                PotensiProdukFoto::create([
                    'potensi_produk_id' => $potensi->potensi_produk_id,
                    'url_foto_potensi_produk' => $foto,
                ]);
            }
        }
    }
}