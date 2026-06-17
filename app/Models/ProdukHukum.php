<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukHukum extends Model
{
    use SoftDeletes;
    protected $table = 'produk_hukum';
    protected $primaryKey = 'produk_hukum_id';

    protected $fillable = [
        'nama_dokumen',
        'nomor_dokumen',
        'tanggal_ditetapkan',
        'kategori_dokumen',
        'tipe_dokumen',
        'url_dokumen',
    ];
}
