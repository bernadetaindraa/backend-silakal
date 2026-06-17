<?php

namespace App\Http\Controllers\Dukuh;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Carbon\Carbon; // <-- Pastikan ini ada untuk manipulasi tanggal

class DashboardDukuhController extends Controller
{
    public function index()
    {
        // Ambil dusun_id milik Dukuh yang sedang login
        $dusunId = auth()->user()->dusun_id;

        // 1. Ambil Statistik Permohonan yang khusus dari Dusun ini
        $statistik = [
            'menunggu' => Layanan::whereHas('user', function($query) use ($dusunId) {
                $query->where('dusun_id', $dusunId);
            })->where('status_layanan', 'menunggu')->count(),

            'diverifikasi' => Layanan::whereHas('user', function($query) use ($dusunId) {
                $query->where('dusun_id', $dusunId);
            })->where('status_layanan', 'diverifikasi')->count(),

            'ditolak' => Layanan::whereHas('user', function($query) use ($dusunId) {
                $query->where('dusun_id', $dusunId);
            })->where('status_layanan', 'ditolak')->count(),
        ];

        // 2. Ambil 5 Permohonan Terbaru dari dusun ini yang butuh tindakan cepat
        $layananTerbaru = Layanan::with('user')
            ->whereHas('user', function($query) use ($dusunId) {
                $query->where('dusun_id', $dusunId);
            })
            ->where('status_layanan', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Hitung tren pengajuan layanan 7 hari terakhir (Untuk Grafik ApexCharts)
        $grafikHari = [];
        $grafikJumlah = [];

        for ($i = 6; $i >= 0; $i--) {
            // Mundur dari 6 hari yang lalu sampai hari ini (0)
            $tanggal = Carbon::now()->subDays($i);
            
            // Simpan nama hari ke array (Contoh: Senin, Selasa)
            // isoFormat('dddd') otomatis mengambil nama hari lengkap
            $grafikHari[] = $tanggal->isoFormat('dddd'); 
            
            // Hitung jumlah layanan yang masuk pada tanggal tersebut khusus di dusun ini
            $jumlah = Layanan::whereHas('user', function($q) use ($dusunId) {
                    $q->where('dusun_id', $dusunId);
                })
                ->whereDate('created_at', $tanggal->format('Y-m-d'))
                ->count();

            $grafikJumlah[] = $jumlah;
        }

        return view('dukuh.dashboard', compact(
            'statistik',
            'layananTerbaru',
            'grafikHari',
            'grafikJumlah'
        ));
    }
}