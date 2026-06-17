<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kebudayaan;
use App\Models\JenisKebudayaan;
use App\Models\KebudayaanFoto;
use Illuminate\Support\Facades\Storage;

class KebudayaanController extends Controller
{
    /**
     * INDEX ADMIN
     */
    public function index(Request $request)
    {
        $query = Kebudayaan::with([
            'jenisKebudayaan.kategoriKebudayaan',
            'fotoKebudayaan'
        ]);

        // SEARCH
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('judul_kebudayaan', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi_kebudayaan', 'like', '%' . $request->search . '%')
                  ->orWhere('tahun_ditetapkan', 'like', '%' . $request->search . '%');

            });

        }

        $data = $query
            ->latest('created_at')
            ->paginate(10);

        return view('admin.kebudayaan.index', compact('data'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        $jenisKebudayaan = JenisKebudayaan::with('kategoriKebudayaan')->get();

        return view('admin.kebudayaan.create', compact('jenisKebudayaan'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kebudayaan_id' => 'required|exists:jenis_kebudayaan,jenis_kebudayaan_id',
            'judul_kebudayaan' => 'required|string|max:255',
            'deskripsi_kebudayaan' => 'required|string',
            'tahun_ditetapkan' => 'required|integer|min:1900|max:' . date('Y'),
            'lokasi_kebudayaan' => 'required|string|max:255',

            'foto_kebudayaan' => 'nullable|array',
            'foto_kebudayaan.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataKebudayaan = collect($validated)
            ->except(['foto_kebudayaan'])
            ->toArray();

        $kebudayaan = Kebudayaan::create($dataKebudayaan);

        // UPLOAD FOTO
        if ($request->hasFile('foto_kebudayaan')) {

            foreach ($request->file('foto_kebudayaan') as $file) {

                $path = $file->store('kebudayaan', 'public');

                KebudayaanFoto::create([
                    'kebudayaan_id' => $kebudayaan->kebudayaan_id,
                    'url_foto_kebudayaan' => $path,
                ]);

            }

        }

        return redirect()
            ->route('admin.kebudayaan.index')
            ->with('success', 'Data kebudayaan berhasil ditambahkan');
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $kebudayaan = Kebudayaan::with('fotoKebudayaan')
            ->findOrFail($id);

        $jenisKebudayaan = JenisKebudayaan::with('kategoriKebudayaan')
            ->get();

        return view('admin.kebudayaan.edit', compact(
            'kebudayaan',
            'jenisKebudayaan'
        ));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $kebudayaan = Kebudayaan::with('fotoKebudayaan')
            ->findOrFail($id);

        $validated = $request->validate([
            'jenis_kebudayaan_id' => 'required|exists:jenis_kebudayaan,jenis_kebudayaan_id',
            'judul_kebudayaan' => 'required|string|max:255',
            'deskripsi_kebudayaan' => 'required|string',
            'tahun_ditetapkan' => 'required|integer|min:1900|max:' . date('Y'),
            'lokasi_kebudayaan' => 'required|string|max:255',

            'foto_kebudayaan' => 'nullable|array',
            'foto_kebudayaan.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dataKebudayaan = collect($validated)
            ->except(['foto_kebudayaan'])
            ->toArray();

        $kebudayaan->update($dataKebudayaan);

        // UPDATE FOTO
        if ($request->hasFile('foto_kebudayaan')) {

            // HAPUS FOTO LAMA
            foreach ($kebudayaan->fotoKebudayaan as $fotoLama) {

                if ($fotoLama->url_foto_kebudayaan) {

                    Storage::disk('public')
                        ->delete($fotoLama->url_foto_kebudayaan);

                }

            }

            $kebudayaan->fotoKebudayaan()->delete();

            // SIMPAN FOTO BARU
            foreach ($request->file('foto_kebudayaan') as $file) {

                $path = $file->store('kebudayaan', 'public');

                KebudayaanFoto::create([
                    'kebudayaan_id' => $kebudayaan->kebudayaan_id,
                    'url_foto_kebudayaan' => $path,
                ]);

            }

        }

        return redirect()
            ->route('admin.kebudayaan.index')
            ->with('success', 'Data kebudayaan berhasil diperbarui');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $kebudayaan = Kebudayaan::with('fotoKebudayaan')
            ->findOrFail($id);

        // HAPUS FILE FOTO
        foreach ($kebudayaan->fotoKebudayaan as $foto) {

            if ($foto->url_foto_kebudayaan) {

                Storage::disk('public')
                    ->delete($foto->url_foto_kebudayaan);

            }

        }

        // HAPUS RELASI FOTO
        $kebudayaan->fotoKebudayaan()->delete();

        // HAPUS DATA
        $kebudayaan->delete();

        return redirect()
            ->route('admin.kebudayaan.index')
            ->with('success', 'Data kebudayaan berhasil dihapus');
    }
}