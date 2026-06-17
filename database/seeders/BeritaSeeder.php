<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

                        [
                'user_id' => 1,
                'judul_berita' => 'Penyampaian Bantuan Langsung Tunai Dana Desa Kalurahan Hargobinangun',
                'isi_berita' => 'Selasa, 19 Mei 2026 telah dilaksanakan kegiatan Penyampaian Bantuan Langsung Tunai Dana Desa Tahap ke 5 di Balai Kalurahan Hargobinangun. Kegiatan ini merupakan salah satu bentuk perhatian pemerintah kepada masyarakat yang terdampak kondisi ekonomi dan membutuhkan bantuan untuk memenuhi kebutuhan pokok sehari-hari. Penyaluran bantuan berlangsung dengan tertib dan lancar serta dihadiri oleh perangkat kalurahan, pendamping desa, dan masyarakat penerima manfaat. Sebanyak 12 warga penerima bantuan hadir sesuai jadwal yang telah ditentukan sebelumnya.

                Dalam pelaksanaan kegiatan ini, pemerintah kalurahan memastikan seluruh proses berjalan transparan dan sesuai dengan ketentuan yang berlaku. Warga penerima bantuan telah melalui proses pendataan dan verifikasi berdasarkan kriteria yang telah ditetapkan oleh pemerintah, seperti kehilangan mata pencaharian, memiliki anggota keluarga dengan penyakit kronis, lansia tunggal, maupun keluarga yang belum menerima bantuan sosial lainnya. Bantuan yang diberikan diharapkan mampu membantu masyarakat dalam memenuhi kebutuhan sehari-hari dan meringankan beban ekonomi keluarga.

                Selain penyerahan bantuan, pemerintah kalurahan juga memberikan pengarahan kepada masyarakat agar bantuan digunakan secara bijak dan diprioritaskan untuk kebutuhan utama rumah tangga. Masyarakat penerima manfaat menyampaikan rasa syukur dan terima kasih atas perhatian pemerintah kalurahan terhadap kondisi warga. Pemerintah Kalurahan Hargobinangun berharap bantuan ini dapat memberikan manfaat nyata bagi masyarakat serta meningkatkan kesejahteraan warga secara bertahap.',
                'tanggal_berita' => '2026-05-19',
                'status_berita' => 'Published',
                'kategori' => [1, 3],
            ],

            [
                'user_id' => 1,
                'judul_berita' => 'Sosialisasi Padat Karya Tunai Pembangunan Corblok Jalan Ketapang',
                'isi_berita' => 'Jumat, 8 Mei 2026 dilaksanakan kegiatan Sosialisasi Padat Karya Tunai Pembangunan Corblok Jalan Ketapang di Padukuhan Pandanpuro. Kegiatan ini dilaksanakan sebagai langkah awal sebelum dimulainya pembangunan jalan yang nantinya akan menjadi akses penghubung antarwilayah di Kalurahan Hargobinangun. Jalan tersebut direncanakan mendukung mobilitas masyarakat serta memperlancar akses menuju lahan pertanian dan kawasan yang akan dikembangkan menjadi lokasi Lumbung Mataraman.

                Sosialisasi dihadiri oleh pemerintah kalurahan, tokoh masyarakat, dan warga sekitar yang nantinya terlibat dalam kegiatan pembangunan. Dalam kegiatan tersebut dijelaskan mengenai tujuan pembangunan, tahapan pekerjaan, sistem pelaksanaan padat karya, serta manfaat yang akan dirasakan masyarakat setelah pembangunan selesai. Pemerintah kalurahan menekankan bahwa pembangunan ini tidak hanya bertujuan meningkatkan kualitas infrastruktur, tetapi juga membantu meningkatkan perekonomian masyarakat melalui penyerapan tenaga kerja lokal.

                Dengan menggunakan sistem padat karya, masyarakat sekitar diberikan kesempatan untuk terlibat langsung sebagai tenaga kerja sehingga dapat memperoleh tambahan penghasilan. Selain itu, pemerintah juga berharap masyarakat ikut menjaga hasil pembangunan agar dapat dimanfaatkan dalam jangka panjang. Warga menyambut baik program tersebut karena dinilai dapat membantu memperbaiki akses jalan yang selama ini menjadi kendala aktivitas masyarakat, khususnya saat musim hujan. Pemerintah Kalurahan Hargobinangun berharap pembangunan berjalan lancar dan memberikan manfaat besar bagi masyarakat.',
                'tanggal_berita' => '2026-05-08',
                'status_berita' => 'Published',
                'kategori' => [1, 8],
            ],

            [
                'user_id' => 1,
                'judul_berita' => 'Pemantauan Faktor Risiko Penyakit Tidak Menular dengan Posbindu',
                'isi_berita' => 'Jumat, 8 Mei 2026 dilaksanakan kegiatan Posbindu sebagai upaya pemantauan faktor risiko Penyakit Tidak Menular bagi Lurah, BPKal, Pamong, dan Staf Kalurahan Hargobinangun. Kegiatan ini bekerja sama dengan tenaga kesehatan setempat dan dilaksanakan di lingkungan Balai Kalurahan Hargobinangun. Pemeriksaan kesehatan meliputi pengecekan tekanan darah, gula darah, berat badan, lingkar perut, dan konsultasi kesehatan ringan bagi peserta yang hadir.

                Kegiatan Posbindu bertujuan meningkatkan kesadaran masyarakat dan aparatur kalurahan terhadap pentingnya menjaga kesehatan serta melakukan pemeriksaan rutin secara berkala. Penyakit tidak menular seperti hipertensi, diabetes, dan kolesterol tinggi sering kali tidak disadari sejak awal sehingga diperlukan pemeriksaan berkala untuk mendeteksi risiko sedini mungkin. Melalui kegiatan ini, peserta mendapatkan edukasi mengenai pola hidup sehat, pentingnya aktivitas fisik, menjaga pola makan, serta mengurangi konsumsi makanan yang berisiko terhadap kesehatan.

                Pemerintah Kalurahan Hargobinangun berharap kegiatan Posbindu dapat menjadi agenda rutin sebagai bentuk perhatian terhadap kesehatan para pelayan publik maupun masyarakat secara umum. Dengan kondisi tubuh yang sehat dan bugar, pelayanan kepada masyarakat dapat berjalan lebih optimal. Peserta kegiatan juga menyampaikan apresiasi terhadap pelaksanaan Posbindu karena membantu mereka mengetahui kondisi kesehatan sejak dini dan memberikan motivasi untuk menerapkan gaya hidup yang lebih sehat dalam kehidupan sehari-hari.',
                'tanggal_berita' => '2026-05-08',
                'status_berita' => 'Published',
                'kategori' => [1, 6],
            ],
            [
                'user_id' => 1,
                'judul_berita' => 'Rapat Koordinasi Bulan Mei 2026',
                'isi_berita' => 'Pemerintah Kalurahan Hargobinangun melaksanakan Rapat Koordinasi Bulanan...',
                'tanggal_berita' => '2026-05-04',
                'status_berita' => 'Published',
                'kategori' => [1, 2],
            ],

            [
                'user_id' => 1,
                'judul_berita' => 'Sosialisasi Bantuan RTLH DAIS Tahun 2026',
                'isi_berita' => 'Dilaksanakan kegiatan Sosialisasi Bantuan Rumah Tidak Layak Huni...',
                'tanggal_berita' => '2026-04-22',
                'status_berita' => 'Published',
                'kategori' => [1, 3],
            ],

            [
                'user_id' => 1,
                'judul_berita' => 'Penyampaian Bantuan Langsung Tunai Dana Desa Tahap 4',
                'isi_berita' => 'Selasa, 21 April 2026 telah dilaksanakan penyampaian BLT Dana Desa...',
                'tanggal_berita' => '2026-04-21',
                'status_berita' => 'Published',
                'kategori' => [1, 3],
            ],

            [
                'user_id' => 1,
                'judul_berita' => 'Penanaman Bersama Tanaman Konservasi',
                'isi_berita' => 'Kegiatan penanaman tanaman konservasi dilaksanakan di Bukit Songo Papat...',
                'tanggal_berita' => '2026-01-22',
                'status_berita' => 'Published',
                'kategori' => [7],
            ],

        ];

        foreach ($data as $item) {

            $kategori = $item['kategori'];

            unset($item['kategori']);

            $berita = Berita::create($item);

            $berita->kategori()->attach($kategori);
        }
    }
}