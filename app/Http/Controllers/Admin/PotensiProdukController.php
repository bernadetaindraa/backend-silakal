<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PotensiProduk;
use App\Models\PotensiProdukFoto;
use Illuminate\Support\Facades\DB;

class PotensiProdukController extends Controller
{
    /**
     * ADMIN - list potensi produk
     */
    public function index(Request $request) // Tambahkan Request $request
    {
        $search = $request->search;

        $potensi = PotensiProduk::with('gambarPotensiProduk')
            ->when($search, function ($query, $search) {
                return $query->where('judul_potensi_produk', 'like', '%' . $search . '%')
                             ->orWhere('nama_potensi_produk', 'like', '%' . $search . '%')
                             ->orWhere('kategori_potensi_produk', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get(); // Silakan ganti ke ->paginate(10) jika ingin pakai pagination

        return view('admin.potensi-produk.index', compact('potensi'));
    }

    /**
     * ADMIN - show detail (opsional)
     */
    public function show($id)
    {
        $potensi = PotensiProduk::with('gambarPotensiProduk')
                    ->findOrFail($id);

        return view('admin.potensi-produk.show', compact('potensi'));
    }

    /**
     * CREATE
     */
    public function create ()
    {
        return view ('admin.potensi-produk.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_potensi_produk' => 'required|string|max:255',
            'artikel_potensi_produk' => 'required',
            'nama_potensi_produk' => 'required|string|max:255',
            'tanggal_potensi_produk' => 'required|date',
            'kategori_potensi_produk' => 'required|in:Potensi Daerah,Produk Usaha Daerah',
            'foto' => 'nullable|array',
            'foto.*.url_foto_potensi_produk' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $potensi = PotensiProduk::create($request->only([
                'judul_potensi_produk',
                'artikel_potensi_produk',
                'nama_potensi_produk',
                'tanggal_potensi_produk',
                'kategori_potensi_produk',
            ]));

            if ($request->foto) {
                foreach ($request->file('foto') as $foto) {
                    $path = $foto->store('potensi', 'public');

                    PotensiProdukFoto::create([
                        'potensi_produk_id' => $potensi->potensi_produk_id,
                        'url_foto_potensi_produk' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.potensi-produk.index')
                ->with('success', 'Potensi produk berhasil ditambahkan');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $potensi = PotensiProduk::findOrFail($id);
        return view('admin.potensi-produk.edit', compact('potensi'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $potensi = PotensiProduk::findOrFail($id);

        $request->validate([
            'judul_potensi_produk' => 'required|string|max:255',
            'artikel_potensi_produk' => 'required',
            'nama_potensi_produk' => 'required|string|max:255',
            'tanggal_potensi_produk' => 'required|date',
            'kategori_potensi_produk' => 'required|in:Potensi Daerah,Produk Usaha Daerah',
            'foto' => 'nullable|array',
            'foto.*.url_foto_potensi_produk' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $potensi->update($request->only([
                'judul_potensi_produk',
                'artikel_potensi_produk',
                'nama_potensi_produk',
                'tanggal_potensi_produk',
                'kategori_potensi_produk',
            ]));

            PotensiProdukFoto::where('potensi_produk_id', $potensi->potensi_produk_id)->delete();

            if ($request->foto) {
                foreach ($request->foto as $foto) {
                    PotensiProdukFoto::create([
                        'potensi_produk_id' => $potensi->potensi_produk_id,
                        'url_foto_potensi_produk' => $foto['url_foto_potensi_produk'],
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.potensi-produk.index')
                ->with('success', 'Potensi produk berhasil diperbarui');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * DELETE (soft)
     */
    public function destroy($id)
    {
        PotensiProduk::findOrFail($id)->delete();

        return back()->with('success', 'Potensi produk berhasil dihapus');
    }

    /**
     * TRASH
     */
    public function trashed()
    {
        $potensi = PotensiProduk::onlyTrashed()
                    ->with('gambarPotensiProduk')
                    ->get();

        return view('admin.potensi-produk.trashed', compact('potensi'));
    }

    /**
     * RESTORE
     */
    public function restore($id)
    {
        PotensiProduk::onlyTrashed()->findOrFail($id)->restore();

        return back()->with('success', 'Data berhasil direstore');
    }

    /**
     * FORCE DELETE
     */
    public function forceDelete($id)
    {
        PotensiProduk::onlyTrashed()->findOrFail($id)->forceDelete();

        return back()->with('success', 'Data dihapus permanen');
    }
}