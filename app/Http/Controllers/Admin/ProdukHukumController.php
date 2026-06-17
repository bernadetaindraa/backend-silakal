<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdukHukum;
use Illuminate\Support\Facades\Storage; // Wajib ditambahkan untuk fitur hapus file

class ProdukHukumController extends Controller
{
    /**
     * LIST (ADMIN)
     */
    public function index(Request $request)
    {
        $query = ProdukHukum::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_dokumen', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_dokumen', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER TAHUN
        if ($request->tahun) {
            $query->whereYear('tanggal_ditetapkan', $request->tahun);
        }

        $dokumen = $query->latest()->paginate(10);

        return view('admin.produk-hukum.index', compact('dokumen'));
    }

    /**
     * CREATE FORM (ADMIN)
     */
    public function create()
    {
        return view('admin.produk-hukum.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_dokumen'       => 'required|string|max:255',
            'nomor_dokumen'      => 'required|string|max:255',
            'tanggal_ditetapkan' => 'required|date',
            'kategori_dokumen'   => 'required|string',
            'tipe_dokumen'       => 'required|string|max:100',
        ];

        if ($request->tipe_dokumen === 'Link') {
            $rules['url_dokumen'] = 'required|url';
        } else {
            $rules['file_dokumen'] = 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png,jpeg|max:10240'; // Maks 10MB
        }

        $request->validate($rules);

        $data = $request->only([
            'nama_dokumen',
            'nomor_dokumen',
            'tanggal_ditetapkan',
            'kategori_dokumen',
            'tipe_dokumen',
        ]);

        if ($request->tipe_dokumen === 'Link') {
            $data['url_dokumen'] = $request->url_dokumen;
        } else {
            if ($request->hasFile('file_dokumen')) {
                $file = $request->file('file_dokumen');
                $path = $file->store('produk-hukum', 'public');
                
                // PERBAIKAN: Hanya simpan path relatifnya saja
                $data['url_dokumen'] = $path; 
            }
        }

        ProdukHukum::create($data);

        return redirect()
            ->route('admin.produk-hukum.index', ['kategori_dokumen' => $request->kategori_dokumen])
            ->with('success', 'Produk hukum berhasil ditambahkan');
    }

    /**
     * EDIT FORM (ADMIN)
     */
    public function edit($id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);

        return view('admin.produk-hukum.edit', compact('produkHukum'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);

        $rules = [
            'nama_dokumen'       => 'required|string|max:255',
            'nomor_dokumen'      => 'required|string|max:255',
            'tanggal_ditetapkan' => 'required|date',
            'kategori_dokumen'   => 'required|string',
            'tipe_dokumen'       => 'required|string|max:100',
        ];

        if ($request->tipe_dokumen === 'Link') {
            $rules['url_dokumen'] = 'required|url';
        } else {
            $isPreviouslyLink = ($produkHukum->tipe_dokumen === 'Link');
            $rules['file_dokumen'] = ($isPreviouslyLink ? 'required' : 'nullable') . '|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png,jpeg|max:10240';
        }

        $request->validate($rules);

        $data = $request->only([
            'nama_dokumen',
            'nomor_dokumen',
            'tanggal_ditetapkan',
            'kategori_dokumen',
            'tipe_dokumen',
        ]);

        if ($request->tipe_dokumen === 'Link') {
            $data['url_dokumen'] = $request->url_dokumen;
            
            // Hapus file fisik lama jika sebelumnya berupa upload file
            if ($produkHukum->tipe_dokumen !== 'Link' && $produkHukum->url_dokumen) {
                Storage::disk('public')->delete($produkHukum->url_dokumen);
            }
        } else {
            if ($request->hasFile('file_dokumen')) {
                // Hapus file fisik lama sebelum diganti yang baru
                if ($produkHukum->tipe_dokumen !== 'Link' && $produkHukum->url_dokumen) {
                    Storage::disk('public')->delete($produkHukum->url_dokumen);
                }

                $file = $request->file('file_dokumen');
                $path = $file->store('produk-hukum', 'public');
                
                // PERBAIKAN: Hanya simpan path relatifnya saja
                $data['url_dokumen'] = $path;
            }
        }

        $produkHukum->update($data);

        return redirect()
            ->route('admin.produk-hukum.index')
            ->with('success', 'Produk hukum berhasil diperbarui');
    }

    /**
     * DELETE (ADMIN) - Memindahkan ke tong sampah (Soft Delete)
     */
    public function destroy($id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);
        $produkHukum->delete();

        return back()->with('success', 'Produk hukum berhasil dipindahkan ke tong sampah');
    }

    /**
     * TRASHED
     */
    public function trashed()
    {
        $data = ProdukHukum::onlyTrashed()->latest()->get();

        return view('admin.produk-hukum.trashed', compact('data'));
    }

    /**
     * RESTORE
     */
    public function restore($id)
    {
        $produkHukum = ProdukHukum::onlyTrashed()->findOrFail($id);
        $produkHukum->restore();

        return back()->with('success', 'Produk hukum berhasil dikembalikan');
    }

    /**
     * FORCE DELETE - Hapus permanen beserta file fisiknya
     */
    public function forceDelete($id)
    {
        $produkHukum = ProdukHukum::onlyTrashed()->findOrFail($id);

        // PERBAIKAN: Hapus file fisik di storage sebelum data di database dihapus
        if ($produkHukum->tipe_dokumen !== 'Link' && $produkHukum->url_dokumen) {
            Storage::disk('public')->delete($produkHukum->url_dokumen);
        }

        $produkHukum->forceDelete();

        return back()->with('success', 'Produk hukum beserta file fisiknya berhasil dihapus permanen');
    }
}