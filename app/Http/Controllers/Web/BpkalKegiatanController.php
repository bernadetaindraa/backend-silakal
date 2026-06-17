<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BpkalKegiatan;
use Illuminate\Http\Request;

class BpkalKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = BpkalKegiatan::query();

        if ($request->search) {

            $query->where('judul_kegiatan', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi_kegiatan', 'like', '%' . $request->search . '%')
                  ->orWhere('tahun_kegiatan', 'like', '%' . $request->search . '%');
        }

        $kegiatan = $query->latest()->paginate(10);

        return view('public.bpkal.kegiatan', compact('kegiatan'));
    }

    public function detailKegiatan($id)
    {
        $kegiatan = BpkalKegiatan::findOrFail($id);

        return view('public.bpka.detail-kegiatan', compact('kegiatan'));
    }
}