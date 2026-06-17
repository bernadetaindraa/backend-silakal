<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BpkalAnggota;
use App\Models\Dusun;
use App\Models\User;
use App\Models\BpkalKegiatan;
use Illuminate\Http\Request;

class BpkalAnggotaController extends Controller
{
    public function anggota(Request $request)
    {
        // ANGGOTA
        $anggotaQuery = BpkalAnggota::with([
            'user',
            'dusun'
        ]);

        if ($request->search_anggota) {

            $anggotaQuery->where('jabatan', 'like', '%' . $request->search_anggota . '%')
                        ->orWhereHas('user', function ($q) use ($request) {

                            $q->where(
                                'nama_lengkap',
                                'like',
                                '%' . $request->search_anggota . '%'
                            );
                        });
        }

        $anggota = $anggotaQuery->latest()->get();

        // KEGIATAN
        $kegiatanQuery = BpkalKegiatan::query();

        if ($request->search_kegiatan) {

            $kegiatanQuery->where('judul_kegiatan', 'like', '%' . $request->search_kegiatan . '%')
                        ->orWhere('deskripsi_kegiatan', 'like', '%' . $request->search_kegiatan . '%')
                        ->orWhere('tahun_kegiatan', 'like', '%' . $request->search_kegiatan . '%');
        }

        $kegiatan = $kegiatanQuery->latest()->get();

        return view('public.bpkal.index', compact(
            'anggota',
            'kegiatan'
        ));
    }

    public function detailAnggota($id)
    {
        $anggota = BpkalAnggota::with([
            'user',
            'dusun'
        ])->findOrFail($id);

        return view('public.bpkal.detail', compact('anggota'));
    }
}