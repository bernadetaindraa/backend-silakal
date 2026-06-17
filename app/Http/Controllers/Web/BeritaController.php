<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaFoto;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with([
            'user',
            'foto',
            'kategori'
        ])
        ->where('status_berita', 'Published');

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('judul_berita', 'like', '%' . $request->search . '%')
                ->orWhere('isi_berita', 'like', '%' . $request->search . '%');
            });
        }

        $berita = $query
            ->latest('tanggal_berita')
            ->paginate(10);

        return view('public.berita.index', compact('berita'));
    }

    public function semua(Request $request)
    {
        $query = Berita::with([
            'user',
            'foto',
            'kategori'
        ]);

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('judul_berita', 'like', '%' . $request->search . '%')
                  ->orWhere('isi_berita', 'like', '%' . $request->search . '%');
            });
        }

        $berita = $query
            ->latest('tanggal_berita')
            ->get();

        return view('public.berita.semua', compact('berita'));
    }

    public function show($id)
    {
        $berita = Berita::with([
            'user',
            'foto',
            'kategori',
            'komentar.user',
            'komentar.replies.user'
        ])->findOrFail($id);

        $beritaTerbaru = Berita::with([
            'foto'
        ])
        ->where('berita_id', '!=', $id)
        ->latest('tanggal_berita')
        ->take(5)
        ->get();

        return view('public.berita.detail', compact('berita', 'beritaTerbaru'));
    }
}