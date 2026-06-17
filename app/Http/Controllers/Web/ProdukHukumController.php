<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProdukHukum;
use Illuminate\Http\Request;

class ProdukHukumController extends Controller
{
    /**
     * Menampilkan semua produk hukum
     */
    public function index($kategori)
    {
        $mappingKategori = [
            'perencanaan-penganggaran' => 'Perencanaan Penganggaran',
            'peraturan-kalurahan' => 'Peraturan Kalurahan',
            'laporan' => 'Laporan',
            'peraturan-lurah' => 'Peraturan Lurah',
        ];

        $kategoriDatabase = $mappingKategori[$kategori] ?? null;

        $query = ProdukHukum::where('kategori_dokumen', $kategoriDatabase);

        if (request('tahun')) {
            $query->whereYear('tanggal_ditetapkan', request('tahun'));
        }

        $dokumen = $query->latest('created_at')->get();

        $title = match($kategori) {
            'perencanaan-penganggaran' => 'Perencanaan Penganggaran',
            'peraturan-kalurahan' => 'Peraturan Kalurahan',
            'laporan' => 'Laporan Kalurahan',
            'peraturan-lurah' => 'Peraturan Lurah',
            default => 'Peraturan Kalurahan',
        };

        return view('public.produk-hukum.index', compact(
            'dokumen',
            'title',
            'kategori'
        ));
    }

    /**
     * Detail produk hukum
     */
    public function show($id)
    {
        $dokumen = ProdukHukum::findOrFail($id);

        return view('public.produk-hukum.detail', compact('dokumen'));
    }
}