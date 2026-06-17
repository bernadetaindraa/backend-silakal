<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use App\Models\Berita;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    /**
     * Menampilkan semua komentar
     */
    public function index()
    {
        $komentar = Komentar::with([
                            'berita',
                            'parent',
                            'replies'
                        ])
                        ->latest()
                        ->get();

        return view('public.komentar.index', compact('komentar'));
    }

    /**
     * Form tambah komentar
     */
    public function create()
    {
        $berita = Berita::all();

        return view('public.komentar.create', compact('berita'));
    }

    /**
     * Menyimpan komentar baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'berita_id' =>
                'required|exists:berita,berita_id',

            'nama_pengguna' =>
                'required|string|max:150',

            'isi' =>
                'required|string',

            'parent_id' =>
                'nullable|exists:komentar,komentar_id',
        ]);

        Komentar::create([
            'berita_id' =>
                $validated['berita_id'],

            'nama_pengguna' =>
                $validated['nama_pengguna'],

            'isi' =>
                $validated['isi'],

            'parent_id' =>
                $validated['parent_id'] ?? null,
        ]);

        return redirect()
                ->route('komentar.index')
                ->with('success', 'Komentar berhasil ditambahkan');
    }

    /**
     * Detail komentar
     */
    public function show(string $id)
    {
        $komentar = Komentar::with([
                            'berita',
                            'parent',
                            'replies'
                        ])
                        ->findOrFail($id);

        return view('public.komentar.show', compact('komentar'));
    }

    /**
     * Form edit komentar
     */
    public function edit(string $id)
    {
        $komentar = Komentar::findOrFail($id);

        $berita = Berita::all();

        return view('public.komentar.edit', compact(
            'komentar',
            'berita'
        ));
    }

    /**
     * Update komentar
     */
    public function update(Request $request, string $id)
    {
        $komentar = Komentar::findOrFail($id);

        $validated = $request->validate([
            'nama_pengguna' =>
                'required|string|max:150',

            'isi' =>
                'required|string',
        ]);

        $komentar->update([
            'nama_pengguna' =>
                $validated['nama_pengguna'],

            'isi' =>
                $validated['isi'],
        ]);

        return redirect()
                ->route('komentar.index')
                ->with('success', 'Komentar berhasil diperbarui');
    }

    /**
     * Hapus komentar
     */
    public function destroy(string $id)
    {
        $komentar = Komentar::findOrFail($id);

        $komentar->delete();

        return redirect()
                ->route('komentar.index')
                ->with('success', 'Komentar berhasil dihapus');
    }
}