<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PotensiProduk;
use App\Models\PotensiProdukFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PotensiProdukController extends Controller
{
    /**
     * Menampilkan semua data potensi produk (PUBLIC)
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'potensi');

        if ($tab === 'produk') {

            $kategori = 'Produk Usaha Daerah';
            $title = 'Produk Usaha Kalurahan';

        } else {

            $kategori = 'Potensi Daerah';
            $title = 'Potensi Kalurahan';
        }

        $items = PotensiProduk::with('gambarPotensiProduk')
                    ->where('kategori_potensi_produk', $kategori)
                    ->latest()
                    ->get();

        return view('public.potensi-produk.index', [
            'items' => $items,
            'activeTab' => $tab,
            'title' => $title,
        ]);
    }

    /**
     * Detail potensi produk (PUBLIC)
     */
    public function show($id)
    {
        $detail = PotensiProduk::with('gambarPotensiProduk')
                    ->findOrFail($id);

        $related = PotensiProduk::with('gambarPotensiProduk')
                    ->where(
                        'kategori_potensi_produk',
                        $detail->kategori_potensi_produk
                    )
                    ->where(
                        'potensi_produk_id',
                        '!=',
                        $id
                    )
                    ->latest('tanggal_potensi_produk')
                    ->take(4)
                    ->get();

        return view('public.potensi-produk.detail', compact(
            'detail',
            'related'
        ));
    }

   
}