<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotensiProdukFoto extends Model
{
    protected $table = 'potensi_produk_foto';
    protected $primaryKey = 'potensi_produk_foto_id';

    protected $fillable = [
        'potensi_produk_id',
        'url_foto_potensi_produk',
    ];

    // PotensiProdukFoto milik satu potensi produk
    public function potensiProduk()
    {
        return $this->belongsTo(PotensiProduk::class, 'potensi_produk_id', 'potensi_produk_id');
    }
}
