<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKebudayaan extends Model
{
    protected $table = 'kategori_kebudayaan';

    protected $primaryKey = 'kategori_kebudayaan_id';

    protected $fillable = [
        'nama_kategori',
    ];

    public function jenisKebudayaan()
    {
        return $this->hasMany(
            JenisKebudayaan::class,
            'kategori_kebudayaan_id'
        );
    }
}