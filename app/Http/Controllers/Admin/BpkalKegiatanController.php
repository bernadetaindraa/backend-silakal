<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BpkalKegiatan;

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

        return view('admin.bpka.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.bpka.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'status_kegiatan' => 'required|string|max:100',
            'tahun_kegiatan' => 'required|digits:4',
            'deskripsi_kegiatan' => 'required|string',
        ]);

        BpkalKegiatan::create($validated);

        return redirect('/admin/bpka/kegiatan')
            ->with('success', 'Kegiatan BPKAL berhasil ditambahkan');
    }

    public function show($id)
    {
        $kegiatan = BpkalKegiatan::findOrFail($id);

        return view('admin.bpka.kegiatan.detail', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = BpkalKegiatan::findOrFail($id);

        return view('admin.bpka.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = BpkalKegiatan::findOrFail($id);

        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'status_kegiatan' => 'required|string|max:100',
            'tahun_kegiatan' => 'required|digits:4',
            'deskripsi_kegiatan' => 'required|string',
        ]);

        $kegiatan->update($validated);

        return redirect('/admin/bpka/kegiatan')
            ->with('success', 'Kegiatan BPKAL berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kegiatan = BpkalKegiatan::findOrFail($id);

        $kegiatan->delete();

        return redirect()->back()
            ->with('success', 'Kegiatan BPKAL berhasil dihapus');
    }

    public function trashed()
    {
        $kegiatan = BpkalKegiatan::onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('admin.bpka.kegiatan.trashed', compact('kegiatan'));
    }

    public function restore($id)
    {
        $kegiatan = BpkalKegiatan::onlyTrashed()
            ->findOrFail($id);

        $kegiatan->restore();

        return redirect()->back()
            ->with('success', 'Kegiatan BPKAL berhasil direstore');
    }

    public function forceDelete($id)
    {
        $kegiatan = BpkalKegiatan::onlyTrashed()
            ->findOrFail($id);

        $kegiatan->forceDelete();

        return redirect()->back()
            ->with('success', 'Kegiatan BPKAL berhasil dihapus permanen');
    }
}
