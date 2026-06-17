<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaFoto extends Model
{
    protected $table = 'berita_foto';
    protected $primaryKey = 'berita_foto_id';

    protected $fillable = [
        'berita_id',
        'url_file_berita',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id', 'berita_id');
    }
}