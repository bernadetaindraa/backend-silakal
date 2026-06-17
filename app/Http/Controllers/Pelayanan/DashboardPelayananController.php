<?php

namespace App\Http\Controllers\Pelayanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan;

class DashboardPelayananController extends Controller
{
    public function index()
    {
        $stats = [
            'menunggu'      => Layanan::where('status_layanan', 'menunggu')->count(),
            'diverifikasi'  => Layanan::where('status_layanan', 'diverifikasi')->count(),
            'ditolak'       => Layanan::where('status_layanan', 'ditolak')->count(),
            'diproses'      => Layanan::where('status_layanan', 'diproses')->count(),
            'siap_diambil'  => Layanan::where('status_layanan', 'siap_diambil')->count(),
            'selesai'       => Layanan::where('status_layanan', 'selesai')->count(),
        ];

        $stats['total_aktif'] =
            $stats['diverifikasi'] +
            $stats['diproses'] +
            $stats['siap_diambil'];

        return view('pelayanan.dashboard', compact('stats'));
    }
}