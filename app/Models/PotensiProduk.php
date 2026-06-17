<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PotensiProduk extends Model
{
    use SoftDeletes;
    protected $table = 'potensi_produk';
    protected $primaryKey = 'potensi_produk_id';

    protected $fillable = [
        'judul_potensi_produk',
        'artikel_potensi_produk',
        'nama_potensi_produk',
        'tanggal_potensi_produk',
        'kategori_potensi_produk',
    ];

    //PotensiProduk memiliki banyak gambar
    public function gambarPotensiProduk()
    {
        return $this->hasMany(PotensiProdukFoto::class, 'potensi_produk_id', 'potensi_produk_id');
    }
}
