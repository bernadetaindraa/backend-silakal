<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berita;
use App\Models\Agenda;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Layanan;
use App\Models\ProdukHukum;
use App\Models\PotensiProduk;
use App\Models\Kebudayaan;
use App\Models\JawabanSurvey;
use App\Models\PertanyaanSurvey;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\SurveyController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // =====================
        // STATISTIK
        // =====================
        $totalBerita = Berita::count();
        $totalAgenda = Agenda::count();
        $totalPengaduan = Pengaduan::count();
        $totalJawabanSurvey = JawabanSurvey::count();
        $totalUser = User::count();
        $totalLayanan = Layanan::count();
        $totalPotensi = PotensiProduk::count();
        $totalKebudayaan = Kebudayaan::count();

        // =====================
        // STATUS LAYANAN
        // =====================
        $menunggu = Layanan::where('status_layanan', 'Menunggu')->count();
        $diproses = Layanan::where('status_layanan', 'Diproses')->count();
        $selesai = Layanan::where('status_layanan', 'Selesai')->count();
        $ditolak = Layanan::where('status_layanan', 'Ditolak')->count();

        // =====================
        // IKM TOTAL (FIX REAL)
        // =====================
        $nilaiIkm = SurveyController::hitungIkmGlobal();

        // =====================
        // IKM PER TAHUN (REAL)
        // =====================
        $ikmPerTahun = JawabanSurvey::selectRaw('YEAR(tanggal_survey) as tahun')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get()
            ->map(function ($item) {
                $item->nilai = SurveyController::hitungIkmGlobal(); 
                return $item;
            });

        // =====================
        // LAYANAN PER BULAN
        // =====================
        $layananPerBulan = Layanan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // =====================
        // TERBARU
        // =====================
        $layananTerbaru = Layanan::latest()->take(5)->get();
        $pengaduanTerbaru = Pengaduan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalAgenda',
            'totalPengaduan',
            'totalJawabanSurvey',
            'totalUser',
            'totalLayanan',
            'totalPotensi',
            'totalKebudayaan',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak',
            'nilaiIkm',
            'ikmPerTahun',
            'layananPerBulan',
            'layananTerbaru',
            'pengaduanTerbaru'
        ));
    }

    public function profile()
    {
        return view('admin.profile.index');
    }
}