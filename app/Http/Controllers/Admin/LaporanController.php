<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pengaduan;
use App\Models\JawabanSurvey;
use App\Models\DetailJawaban;
use App\Models\PertanyaanSurvey;
use App\Models\Layanan;
use App\Models\Kebudayaan;
use App\Models\JenisKebudayaan;
use App\Models\PotensiProduk;
use App\Exports\PengaduanExport;
use App\Exports\SurveyExport;
use App\Exports\LayananExport;
use App\Exports\BudayaExport;
use App\Exports\PotensiProdukExport;

class LaporanController extends Controller
{
    /**
     * =====================================================
     * DASHBOARD LAPORAN
     * =====================================================
     */
    public function index()
    {
        return view('admin.laporan.index');
    }

    /**
     * =====================================================
     * 1. LAPORAN PENGADUAN MASYARAKAT
     * =====================================================
     */
    private function queryPengaduan(Request $request)
    {
        $query = Pengaduan::with('fotoPengaduan');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pengadu', 'like', '%' . $request->search . '%')
                    ->orWhere('judul_pengaduan', 'like', '%' . $request->search . '%')
                    ->orWhere('jenis_pengaduan', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi_kejadian', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status_pengaduan')) {
            $query->where('status_pengaduan', $request->status_pengaduan);
        }

        if ($request->filled('jenis_pengaduan')) {
            $query->where('jenis_pengaduan', $request->jenis_pengaduan);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_pengaduan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        return $query;
    }

    public function pengaduan(Request $request)
    {
        $data = $this->queryPengaduan($request)
            ->latest('tanggal_pengaduan')
            ->paginate(10)
            ->withQueryString();

        $jenisPengaduan = Pengaduan::select('jenis_pengaduan')
            ->distinct()
            ->orderBy('jenis_pengaduan')
            ->pluck('jenis_pengaduan');

        return view('admin.laporan.pengaduan', compact('data', 'jenisPengaduan'));
    }

    public function pengaduanPdf(Request $request)
    {
        $data = $this->queryPengaduan($request)
            ->latest('tanggal_pengaduan')
            ->get();

        $pdf = Pdf::loadView(
            'admin.laporan.pdf.pengaduan',
            compact('data')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'laporan-pengaduan-' . now()->format('YmdHis') . '.pdf'
        );
    }

    public function pengaduanExcel(Request $request)
    {
        $data = $this->queryPengaduan($request)
            ->latest('tanggal_pengaduan')
            ->get();

        return Excel::download(
            new PengaduanExport($data, $request),
            'laporan-pengaduan-' . now()->format('YmdHis') . '.xlsx'
        );
    }

   /**
     * =====================================================
     * 2. LAPORAN SURVEY KEPUASAN MASYARAKAT (IKM)
     * =====================================================
     */

    private function querySurvey(Request $request)
    {
        $query = JawabanSurvey::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'jenis_layanan',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'pekerjaan_responden',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'pendidikan_responden',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        if ($request->filled('jenis_layanan')) {

            $query->where(
                'jenis_layanan',
                $request->jenis_layanan
            );
        }

        if (
            $request->filled('tanggal_awal')
            &&
            $request->filled('tanggal_akhir')
        ) {

            $query->whereBetween(
                'tanggal_survey',
                [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]
            );
        }

        return $query;
    }

    /**
     * =====================================================
     * HITUNG IKM
     * =====================================================
     */
    private function getIkmData()
    {
        $jumlahUnsur = PertanyaanSurvey::count();

        $nilaiIkm = 0;
        $mutu = '-';
        $kinerja = '-';
        $hasilUnsur = [];

        if ($jumlahUnsur > 0) {

            $bobotUnsur = 1 / $jumlahUnsur;

            $pertanyaan = PertanyaanSurvey::with([
                'detailJawaban.opsiJawaban'
            ])->get();

            $totalNilai = 0;

            foreach ($pertanyaan as $item) {

                $detailJawaban = $item->detailJawaban;

                $jumlahRespondenUnsur =
                    $detailJawaban->count();

                $totalPersepsi =
                    $detailJawaban->sum(function ($detail) {

                        return $detail
                            ->opsiJawaban
                            ->nilai_jawaban ?? 0;
                    });

                $rataRata =
                    $jumlahRespondenUnsur > 0
                        ? $totalPersepsi / $jumlahRespondenUnsur
                        : 0;

                $nilaiTertimbang =
                    $rataRata * $bobotUnsur;

                $totalNilai += $nilaiTertimbang;

                $hasilUnsur[] = [

                    'pertanyaan' =>
                        $item->pertanyaan_survey,

                    'rata_rata' =>
                        round($rataRata, 2),
                ];
            }

            $nilaiIkm =
                round($totalNilai * 25, 2);

            if ($nilaiIkm >= 88.31) {

                $mutu = 'A';
                $kinerja = 'Sangat Baik';

            } elseif ($nilaiIkm >= 76.61) {

                $mutu = 'B';
                $kinerja = 'Baik';

            } elseif ($nilaiIkm >= 65.00) {

                $mutu = 'C';
                $kinerja = 'Kurang Baik';

            } else {

                $mutu = 'D';
                $kinerja = 'Tidak Baik';
            }
        }

        return compact(
            'nilaiIkm',
            'mutu',
            'kinerja',
            'hasilUnsur'
        );
    }

    /**
     * =====================================================
     * HALAMAN LAPORAN SURVEY
     * =====================================================
     */
    public function survey(Request $request)
    {
        $data = $this->querySurvey($request)
            ->latest('tanggal_survey')
            ->paginate(10)
            ->withQueryString();

        $filteredData = $this->querySurvey($request)
            ->get();

        $totalResponden =
            $filteredData->count();

        $lakiLaki =
            $filteredData
                ->where(
                    'jenis_kelamin_responden',
                    'Laki-laki'
                )
                ->count();

        $perempuan =
            $filteredData
                ->where(
                    'jenis_kelamin_responden',
                    'Perempuan'
                )
                ->count();

        $pendidikan =
            $filteredData
                ->groupBy(
                    'pendidikan_responden'
                )
                ->map(
                    fn ($item) => $item->count()
                );

        extract($this->getIkmData());

        return view(
            'admin.laporan.survey',
            compact(
                'data',
                'totalResponden',
                'lakiLaki',
                'perempuan',
                'pendidikan',
                'nilaiIkm',
                'mutu',
                'kinerja',
                'hasilUnsur'
            )
        );
    }

    /**
     * =====================================================
     * EXPORT PDF
     * =====================================================
     */
    public function surveyPdf(Request $request)
    {
        $data = $this->querySurvey($request)
            ->latest('tanggal_survey')
            ->get();

        $totalResponden =
            $data->count();

        $lakiLaki =
            $data
                ->where(
                    'jenis_kelamin_responden',
                    'Laki-laki'
                )
                ->count();

        $perempuan =
            $data
                ->where(
                    'jenis_kelamin_responden',
                    'Perempuan'
                )
                ->count();

        $pendidikan =
            $data
                ->groupBy(
                    'pendidikan_responden'
                )
                ->map(
                    fn ($item) => $item->count()
                );

        extract($this->getIkmData());

        $pdf = Pdf::loadView(
            'admin.laporan.pdf.survey',
            compact(
                'data',
                'totalResponden',
                'lakiLaki',
                'perempuan',
                'pendidikan',
                'nilaiIkm',
                'mutu',
                'kinerja',
                'hasilUnsur'
            )
        );

        $pdf->setPaper(
            'A4',
            'landscape'
        );

        return $pdf->download(
            'laporan-survey-' .
            now()->format('YmdHis') .
            '.pdf'
        );
    }

    /**
     * =====================================================
     * EXPORT EXCEL
     * =====================================================
     */
    public function surveyExcel(Request $request)
    {
        $data = $this->querySurvey($request)
            ->latest('tanggal_survey')
            ->get();

        $lakiLaki =
            $data
                ->where(
                    'jenis_kelamin_responden',
                    'Laki-laki'
                )
                ->count();

        $perempuan =
            $data
                ->where(
                    'jenis_kelamin_responden',
                    'Perempuan'
                )
                ->count();

        $pendidikan =
            $data
                ->groupBy(
                    'pendidikan_responden'
                )
                ->map(
                    fn ($item) => $item->count()
                );

        extract($this->getIkmData());

        return Excel::download(
            new SurveyExport(
                $data,
                $request,
                $nilaiIkm,
                $mutu,
                $kinerja,
                $lakiLaki,
                $perempuan,
                $pendidikan
            ),
            'laporan-survey-' .
            now()->format('YmdHis') .
            '.xlsx'
        );
    }
    
    /**
     * =====================================================
     * 3. LAPORAN PENGAJUAN LAYANAN
     * =====================================================
     */

    private function queryLayanan(Request $request)
    {
        $query = Layanan::with('user');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_layanan', 'like', '%' . $request->search . '%')
                ->orWhere('nama_pengajuan', 'like', '%' . $request->search . '%')
                ->orWhere('nik_pengajuan', 'like', '%' . $request->search . '%')
                ->orWhere('jenis_layanan', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('jenis_layanan')) {
            $query->where('jenis_layanan', $request->jenis_layanan);
        }

        if ($request->filled('status_layanan')) {
            $query->where('status_layanan', $request->status_layanan);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_layanan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        return $query;
    }

    private function getLayananStatistik($data)
    {
        return [
            'totalPengajuan' => $data->count(),
            'menunggu' => $data->where('status_layanan', 'menunggu')->count(),
            'diverifikasi' => $data->where('status_layanan', 'diverifikasi')->count(),
            'diproses' => $data->where('status_layanan', 'diproses')->count(),
            'selesai' => $data->where('status_layanan', 'selesai')->count(),
            'ditolak' => $data->where('status_layanan', 'ditolak')->count(),

            'ambil' => $data->where('pengiriman_layanan', 'ambil')->count(),
            'email' => $data->where('pengiriman_layanan', 'email')->count(),

            'sendiri' => $data->where('jenis_pengajuan', 'sendiri')->count(),
            'orangLain' => $data->where('jenis_pengajuan', 'orang_lain')->count(),

            'statistikJenisLayanan' => $data
                ->groupBy('jenis_layanan')
                ->map(fn ($item) => $item->count()),
        ];
    }

    public function layanan(Request $request)
    {
        $data = $this->queryLayanan($request)
            ->latest('tanggal_layanan')
            ->paginate(10)
            ->withQueryString();

        $jenisLayanan = [
            'ktp_baru' => 'Pengajuan E-KTP',
            'kk_baru' => 'Pengajuan Kartu Keluarga',
            'pindah_domisili' => 'Surat Keterangan Pindah Domisili',
            'akta_kelahiran' => 'Pengajuan Akta Kelahiran',
            'akta_kematian' => 'Pengajuan Akta Kematian',
            'sktm' => 'Surat Keterangan Tidak Mampu (SKTM)',
            'sku' => 'Surat Keterangan Usaha (SKU)',
            'kehilangan_kk' => 'Surat Keterangan Kehilangan KK',
            'janda' => 'Surat Keterangan Janda',
            'beda_nama' => 'Surat Keterangan Beda Nama',
            'domisili_instansi' => 'Surat Keterangan Domisili Instansi',
            'domisili_usaha' => 'Surat Keterangan Domisili Usaha',
            'domisili_pribadi' => 'Surat Keterangan Domisili Pribadi',
        ];

        extract(
            $this->getLayananStatistik(
                $this->queryLayanan($request)->get()
            )
        );

        return view('admin.laporan.layanan', compact(
            'data',
            'jenisLayanan',
            'totalPengajuan',
            'menunggu',
            'diverifikasi',
            'diproses',
            'selesai',
            'ditolak',
            'ambil',
            'email',
            'sendiri',
            'orangLain'
        ));
    }

    public function layananPdf(Request $request)
    {
        $data = $this->queryLayanan($request)
            ->latest('tanggal_layanan')
            ->get();

        extract(
            $this->getLayananStatistik($data)
        );

        $pdf = Pdf::loadView(
            'admin.laporan.pdf.layanan',
            compact(
                'data',
                'totalPengajuan',
                'menunggu',
                'diverifikasi',
                'diproses',
                'selesai',
                'ditolak',
                'ambil',
                'email',
                'sendiri',
                'orangLain'
            )
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'laporan-layanan-' . now()->format('YmdHis') . '.pdf'
        );
    }

    public function layananExcel(Request $request)
    {
        $data = $this->queryLayanan($request)
            ->latest('tanggal_layanan')
            ->get();

        extract(
            $this->getLayananStatistik($data)
        );

        return Excel::download(
            new LayananExport(
                $data,
                $request,
                $totalPengajuan,
                $menunggu,
                $diverifikasi,
                $diproses,
                $selesai,
                $ditolak,
                $ambil,
                $email,
                $sendiri,
                $orangLain
            ),
            'laporan-layanan-' . now()->format('YmdHis') . '.xlsx'
        );
    }

    /**
     * =====================================================
     * 5. LAPORAN POTENSI & PRODUK UMKM
     * =====================================================
     */
    private function queryPotensiProduk(Request $request)
    {
        $query = PotensiProduk::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'judul_potensi_produk',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'nama_potensi_produk',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'kategori_potensi_produk',
                    'like',
                    '%' . $request->search . '%'
                );

            });
        }

        if ($request->filled('kategori_potensi_produk')) {

            $query->where(
                'kategori_potensi_produk',
                $request->kategori_potensi_produk
            );
        }

        if (
            $request->filled('tanggal_awal') &&
            $request->filled('tanggal_akhir')
        ) {

            $query->whereBetween(
                'tanggal_potensi_produk',
                [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]
            );
        }

        return $query;
    }

    private function getPotensiProdukStatistik($data)
    {
        $totalPotensiProduk = $data->count();

        $potensiDaerah = $data
            ->where(
                'kategori_potensi_produk',
                'Potensi Daerah'
            )
            ->count();

        $produkUsaha = $data
            ->where(
                'kategori_potensi_produk',
                'Produk Usaha Daerah'
            )
            ->count();

        $perKategori = $data
            ->groupBy('kategori_potensi_produk')
            ->map(fn ($item) => $item->count());

        return compact(
            'totalPotensiProduk',
            'potensiDaerah',
            'produkUsaha',
            'perKategori'
        );
    }

    public function potensiProduk(Request $request)
    {
        $data = $this->queryPotensiProduk($request)
            ->latest('tanggal_potensi_produk')
            ->paginate(10)
            ->withQueryString();

        $kategori = [
            'Potensi Daerah',
            'Produk Usaha Daerah'
        ];

        extract(
            $this->getPotensiProdukStatistik(
                $this->queryPotensiProduk($request)->get()
            )
        );

        return view(
            'admin.laporan.potensi-produk',
            compact(
                'data',
                'kategori',
                'totalPotensiProduk',
                'potensiDaerah',
                'produkUsaha',
                'perKategori'
            )
        );
    }

    public function potensiProdukPdf(Request $request)
    {  
        $data = $this->queryPotensiProduk($request)->get();

        extract(
            $this->getPotensiProdukStatistik($data)
        );

        $pdf = Pdf::loadView(
            'admin.laporan.pdf.potensi-produk',
            compact(
                'data',
                'totalPotensiProduk',
                'potensiDaerah',
                'produkUsaha',
                'perKategori'
            )
        )->setPaper(
            'A4',
            'landscape'
        );

        return $pdf->download(
            'laporan-potensi-produk.pdf'
        );
    }

    public function potensiProdukExcel(Request $request)
    {
        $data = $this->queryPotensiProduk($request)->get();

        extract(
            $this->getPotensiProdukStatistik($data)
        );

        return Excel::download(
            new PotensiProdukExport(
            $data,
            $request,
            $totalPotensiProduk,
            $potensiDaerah,
            $produkUsaha,
            $perKategori
        ),
            'laporan-potensi-produk.xlsx'
        );
    }

    /**
     * =====================================================
     * 6. LAPORAN DATA KEBUDAYAAN
     * =====================================================
     */
    private function queryBudaya(Request $request)
    {
        $query = Kebudayaan::with([
            'jenisKebudayaan.kategoriKebudayaan'
        ]);

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'judul_kebudayaan',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'lokasi_kebudayaan',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'tahun_ditetapkan',
                    'like',
                    '%' . $request->search . '%'
                );

            });
        }

        if ($request->filled('jenis_kebudayaan_id')) {

            $query->where(
                'jenis_kebudayaan_id',
                $request->jenis_kebudayaan_id
            );
        }

        if ($request->filled('tahun_awal')) {

            $query->where(
                'tahun_ditetapkan',
                '>=',
                $request->tahun_awal
            );
        }

        if ($request->filled('tahun_akhir')) {

            $query->where(
                'tahun_ditetapkan',
                '<=',
                $request->tahun_akhir
            );
        }

        return $query;
    }

    private function getBudayaStatistik($data)
    {
        $totalKebudayaan = $data->count();

        $perKategori = $data
            ->groupBy(function ($item) {

                return optional(
                    $item->jenisKebudayaan?->kategoriKebudayaan
                )->nama_kategori ?? 'Lainnya';

            })
            ->map(fn($item) => $item->count());

        $perJenis = $data
            ->groupBy(function ($item) {

                return optional(
                    $item->jenisKebudayaan
                )->nama_jenis ?? 'Lainnya';

            })
            ->map(fn($item) => $item->count());

        return compact(
            'totalKebudayaan',
            'perKategori',
            'perJenis'
        );
    }

   public function budaya(Request $request)
    {
        $data = $this->queryBudaya($request)
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        $jenisKebudayaan = JenisKebudayaan::orderBy(
            'nama_jenis'
        )->pluck(
            'nama_jenis',
            'jenis_kebudayaan_id'
        );

        extract(
            $this->getBudayaStatistik(
                $this->queryBudaya($request)->get()
            )
        );

        return view(
            'admin.laporan.budaya',
            compact(
                'data',
                'jenisKebudayaan',
                'totalKebudayaan',
                'perKategori',
                'perJenis'
            )
        );
    }

    public function budayaPdf(Request $request)
    {
        $data = $this->queryBudaya($request)->get();

        extract(
            $this->getBudayaStatistik($data)
        );

        $pdf = Pdf::loadView(
            'admin.laporan.pdf.budaya',
            compact(
                'data',
                'totalKebudayaan',
                'perKategori',
                'perJenis'
            )
        )->setPaper(
            'a4',
            'landscape'
        );

        return $pdf->download(
            'laporan-kebudayaan.pdf'
        );
    }

    public function budayaExcel(Request $request)
    {
        $data = $this->queryBudaya($request)->get();

        extract(
            $this->getBudayaStatistik($data)
        );

        return Excel::download(
            new BudayaExport(
                $data,
                $request,
                $totalKebudayaan,
                $perKategori,
                $perJenis
            ),
            'laporan-kebudayaan.xlsx'
        );
    }
}