<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Agenda;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 Agenda terbaru beserta relasinya
        $agendas = Agenda::with([
                'agendaItems.user',
                'piketDukuh.user',
                'izinCuti.user'
            ])
            ->latest()
            ->take(3)
            ->get();

        // Ambil 3 Berita terbaru yang statusnya 'Published'
        $beritas = Berita::with(['user', 'foto', 'kategori'])
            ->where('status_berita', 'Published')
            ->latest('tanggal_berita')
            ->take(3)
            ->get();

        // Tidak perlu memanggil model Layanan, langsung lempar agenda & berita
        return view('public.home', compact('agendas', 'beritas'));
    }
}