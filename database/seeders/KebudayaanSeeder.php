<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kebudayaan;
use App\Models\KebudayaanFoto;

class KebudayaanSeeder extends Seeder
{
    public function run(): void
    {
        $dataKebudayaan = [
            [
                'jenis_kebudayaan_id' => 1,
                'judul_kebudayaan' => 'Upacara Adat Merti Dusun',
                'deskripsi_kebudayaan' => '
                    <p>
                    Upacara adat Merti Dusun merupakan salah satu tradisi budaya masyarakat Kalurahan Hargobinangun yang masih dilestarikan hingga saat ini. Tradisi ini dilaksanakan sebagai bentuk rasa syukur masyarakat kepada Tuhan Yang Maha Esa atas hasil panen, keselamatan warga, serta keberkahan yang diberikan kepada dusun. Kegiatan Merti Dusun biasanya dilaksanakan setiap tahun dan melibatkan seluruh lapisan masyarakat mulai dari anak-anak, pemuda, hingga para sesepuh desa.
                    </p>

                    <p>
                    Dalam pelaksanaannya, masyarakat akan melakukan berbagai persiapan seperti membersihkan lingkungan dusun, menghias jalan, serta menyiapkan gunungan hasil bumi yang nantinya akan diarak bersama. Gunungan tersebut berisi berbagai hasil pertanian seperti sayuran, buah-buahan, padi, dan hasil kebun lainnya yang menjadi simbol kemakmuran masyarakat desa. Selain kirab budaya, kegiatan ini juga dimeriahkan dengan pertunjukan seni tradisional seperti jathilan, karawitan, campursari, dan pentas tari daerah yang menampilkan kekayaan budaya lokal.
                    </p>

                    <p>
                    Tradisi Merti Dusun tidak hanya memiliki nilai budaya, tetapi juga memperkuat nilai gotong royong dan kebersamaan masyarakat. Warga saling membantu dalam menyiapkan acara tanpa membedakan latar belakang sosial maupun ekonomi. Nilai kebersamaan tersebut menjadi bagian penting dalam menjaga keharmonisan kehidupan masyarakat Kalurahan Hargobinangun.
                    </p>

                    <p>
                    Selain sebagai warisan budaya, Merti Dusun juga memiliki potensi wisata budaya yang menarik perhatian wisatawan lokal maupun luar daerah. Banyak pengunjung datang untuk menyaksikan prosesi adat dan menikmati suasana budaya khas pedesaan. Pemerintah kalurahan bersama masyarakat terus berupaya menjaga tradisi ini agar tetap lestari dan dapat diwariskan kepada generasi muda sebagai identitas budaya daerah.
                    </p>
                ',
                'tahun_ditetapkan' => 1995,
                'lokasi_kebudayaan' => 'Padukuhan Wonorejo',
                'foto' => [
                    'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf',
                    'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
                ]
            ],

            [
                'jenis_kebudayaan_id' => 2,
                'judul_kebudayaan' => 'Kerajinan Anyaman Bambu',
                'deskripsi_kebudayaan' => '
                    <p>
                    Kerajinan anyaman bambu merupakan salah satu warisan budaya masyarakat Kalurahan Hargobinangun yang berkembang secara turun-temurun. Kerajinan ini dibuat menggunakan bahan utama bambu yang banyak ditemukan di wilayah sekitar lereng Merapi. Masyarakat memanfaatkan bambu menjadi berbagai produk rumah tangga seperti tampah, besek, keranjang, tempat nasi, hingga hiasan dekoratif yang memiliki nilai ekonomi tinggi.
                    </p>

                    <p>
                    Proses pembuatan anyaman bambu membutuhkan keterampilan khusus dan ketelitian tinggi. Pengrajin biasanya memulai proses dengan memilih bambu berkualitas baik yang kemudian dipotong dan diraut menjadi bilah-bilah tipis. Setelah itu, bilah bambu dianyam menggunakan pola tertentu hingga membentuk produk yang diinginkan. Teknik anyaman yang digunakan diwariskan secara turun-temurun dan menjadi ciri khas masyarakat setempat.
                    </p>

                    <p>
                    Selain memiliki fungsi praktis, kerajinan anyaman bambu juga mencerminkan nilai budaya dan filosofi kehidupan masyarakat desa yang sederhana namun kreatif. Kegiatan menganyam sering dilakukan bersama anggota keluarga sehingga menjadi sarana mempererat hubungan sosial di lingkungan masyarakat. Anak-anak muda juga mulai dikenalkan dengan keterampilan ini agar budaya kerajinan lokal tidak hilang akibat perkembangan zaman.
                    </p>

                    <p>
                    Saat ini kerajinan anyaman bambu tidak hanya dipasarkan di lingkungan lokal, tetapi juga mulai dikenal oleh wisatawan yang datang ke kawasan wisata Kaliurang dan sekitarnya. Pemerintah kalurahan bersama kelompok pengrajin aktif mengikuti pelatihan dan pameran UMKM untuk meningkatkan kualitas produk serta memperluas pemasaran. Dengan demikian, kerajinan anyaman bambu diharapkan mampu menjadi identitas budaya sekaligus sumber penghasilan masyarakat Kalurahan Hargobinangun.
                    </p>
                ',
                'tahun_ditetapkan' => 2001,
                'lokasi_kebudayaan' => 'Padukuhan Kaliurang Barat',
                'foto' => [
                    'https://images.unsplash.com/photo-1523419409543-04e4f0bdfd8b',
                    'https://images.unsplash.com/photo-1516321497487-e288fb19713f',
                ]
            ],

            [
                'jenis_kebudayaan_id' => 3,
                'judul_kebudayaan' => 'Kesenian Jathilan',
                'deskripsi_kebudayaan' => '
                    <p>
                    Kesenian Jathilan merupakan salah satu seni pertunjukan tradisional yang sangat dikenal oleh masyarakat Kalurahan Hargobinangun. Kesenian ini menampilkan tarian menggunakan properti kuda kepang yang dimainkan secara dinamis mengikuti irama gamelan tradisional Jawa. Pertunjukan Jathilan biasanya ditampilkan pada acara adat, perayaan desa, penyambutan tamu, hingga kegiatan budaya masyarakat.
                    </p>

                    <p>
                    Dalam pertunjukan Jathilan, para penari mengenakan kostum tradisional lengkap dengan atribut khas seperti ikat kepala, gelang kaki, serta properti kuda anyaman bambu. Gerakan tari yang energik dipadukan dengan musik gamelan menciptakan suasana meriah dan penuh semangat. Salah satu bagian yang paling menarik perhatian penonton adalah atraksi trance atau kesurupan yang menjadi ciri khas pertunjukan Jathilan di berbagai daerah Jawa.
                    </p>

                    <p>
                    Masyarakat Kalurahan Hargobinangun memandang Jathilan bukan sekadar hiburan, tetapi juga bagian dari identitas budaya yang memiliki nilai spiritual dan sejarah panjang. Kelompok seni Jathilan di desa aktif melakukan latihan rutin dan melibatkan generasi muda agar kesenian tradisional ini tetap lestari di tengah perkembangan budaya modern. Dukungan masyarakat dan pemerintah desa sangat penting dalam menjaga keberlangsungan kelompok seni tersebut.
                    </p>

                    <p>
                    Selain menjadi hiburan masyarakat, kesenian Jathilan juga memiliki daya tarik wisata budaya. Banyak wisatawan yang tertarik menyaksikan pertunjukan secara langsung karena menampilkan nuansa tradisional yang autentik. Dengan terus dilestarikan dan dikembangkan, Jathilan diharapkan mampu menjadi media pelestarian budaya sekaligus sarana memperkenalkan kekayaan budaya Kalurahan Hargobinangun kepada masyarakat luas.
                    </p>
                ',
                'tahun_ditetapkan' => 1998,
                'lokasi_kebudayaan' => 'Padukuhan Kaliurang Timur',
                'foto' => [
                    'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee',
                    'https://images.unsplash.com/photo-1493246507139-91e8fad9978e',
                ]
            ],
        ];

        foreach ($dataKebudayaan as $item) {

            $kebudayaan = Kebudayaan::create([
                'jenis_kebudayaan_id' => $item['jenis_kebudayaan_id'],
                'judul_kebudayaan' => $item['judul_kebudayaan'],
                'deskripsi_kebudayaan' => $item['deskripsi_kebudayaan'],
                'tahun_ditetapkan' => $item['tahun_ditetapkan'],
                'lokasi_kebudayaan' => $item['lokasi_kebudayaan'],
            ]);

            foreach ($item['foto'] as $foto) {

                KebudayaanFoto::create([
                    'kebudayaan_id' => $kebudayaan->kebudayaan_id,
                    'url_foto_kebudayaan' => $foto,
                ]);
            }
        }
    }
}