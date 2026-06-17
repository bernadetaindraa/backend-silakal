<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kebudayaan;
use App\Models\KebudayaanFoto;
use App\Models\KategoriKebudayaan;
use App\Models\JenisKebudayaan;
use Illuminate\Http\Request;

class KebudayaanController extends Controller
{
    public function benda()
    {
        $jenis = JenisKebudayaan::where(
            'kategori_kebudayaan_id',
            1
        )->get();

        $judul = 'Kebudayaan Benda';

        return view(
            'public.kebudayaan.index',
            compact('jenis', 'judul')
        );
    }

    public function nonBenda()
    {
        $jenis = JenisKebudayaan::where(
            'kategori_kebudayaan_id',
            2
        )->get();

        $judul = 'Kebudayaan Non Benda';

        return view(
            'public.kebudayaan.index',
            compact('jenis', 'judul')
        );
    }

    public function index($jenis)
    {
        $jenisData = JenisKebudayaan::with('kategoriKebudayaan')
            ->findOrFail($jenis);

        $kebudayaan = Kebudayaan::with([
                'jenisKebudayaan',
                'fotoKebudayaan'
            ])
            ->where(
                'jenis_kebudayaan_id',
                $jenisData->jenis_kebudayaan_id
            )
            ->latest()
            ->get();

        return view(
            'public.kebudayaan.list',
            compact('jenisData', 'kebudayaan')
        );
    }

    public function show($id)
    {
        $kebudayaan = Kebudayaan::with([
                'jenisKebudayaan.kategoriKebudayaan',
                'fotoKebudayaan'
            ])
            ->findOrFail($id);

        return view(
            'public.kebudayaan.detail',
            compact('kebudayaan')
        );
    }

    public function adminIndex()
    {
        $data = Kebudayaan::with([
                'jenisKebudayaan.kategoriKebudayaan',
                'fotoKebudayaan'
            ])
            ->latest()
            ->get();

        return view('admin.kebudayaan.index', compact('data'));
    }

    public function create()
    {
        $jenisKebudayaan = JenisKebudayaan::with('kategoriKebudayaan')
            ->get();

        return view('admin.kebudayaan.create', compact('jenisKebudayaan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kebudayaan_id' => 'required|exists:jenis_kebudayaan,jenis_kebudayaan_id',
            'judul_kebudayaan' => 'required|string|max:255',
            'deskripsi_kebudayaan' => 'required|string',
            'tahun_ditetapkan' => 'required|integer|min:1900|max:' . date('Y'),
            'lokasi_kebudayaan' => 'required|string|max:255',
            'foto_kebudayaan' => 'nullable|array',
            'foto_kebudayaan.*' => 'nullable|string',
        ]);

        $kebudayaan = Kebudayaan::create($validated);

        if (!empty($validated['foto_kebudayaan'])) {

            foreach ($validated['foto_kebudayaan'] as $foto) {

                KebudayaanFoto::create([
                    'kebudayaan_id' => $kebudayaan->kebudayaan_id,
                    'url_foto_kebudayaan' => $foto,
                ]);
            }
        }

        return redirect()
            ->route('admin.kebudayaan.index')
            ->with('success', 'Data kebudayaan berhasil ditambahkan');
    }

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

    public function update(Request $request, $id)
    {
        $kebudayaan = Kebudayaan::findOrFail($id);

        $validated = $request->validate([
            'jenis_kebudayaan_id' => 'required|exists:jenis_kebudayaan,jenis_kebudayaan_id',
            'judul_kebudayaan' => 'required|string|max:255',
            'deskripsi_kebudayaan' => 'required|string',
            'tahun_ditetapkan' => 'required|integer|min:1900|max:' . date('Y'),
            'lokasi_kebudayaan' => 'required|string|max:255',
            'foto_kebudayaan' => 'nullable|array',
            'foto_kebudayaan.*' => 'nullable|string',
        ]);

        $kebudayaan->update($validated);

        $kebudayaan->fotoKebudayaan()->delete();

        if (!empty($validated['foto_kebudayaan'])) {

            foreach ($validated['foto_kebudayaan'] as $foto) {

                KebudayaanFoto::create([
                    'kebudayaan_id' => $kebudayaan->kebudayaan_id,
                    'url_foto_kebudayaan' => $foto,
                ]);
            }
        }

        return redirect()
            ->route('admin.kebudayaan.index')
            ->with('success', 'Data kebudayaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kebudayaan = Kebudayaan::findOrFail($id);

        $kebudayaan->delete();

        return redirect()
            ->route('admin.kebudayaan.index')
            ->with('success', 'Data kebudayaan berhasil dihapus');
    }
}