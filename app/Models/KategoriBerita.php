<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    protected $primaryKey = 'kategori_berita_id';

    protected $fillable = [
        'nama_kategori',
    ];

    public function berita()
    {
        return $this->belongsToMany(Berita::class,'berita_kategori','kategori_berita_id','berita_id');
    }
}