<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKebudayaan extends Model
{
    protected $table = 'jenis_kebudayaan';

    protected $primaryKey = 'jenis_kebudayaan_id';

    protected $fillable = [
        'kategori_kebudayaan_id',
        'nama_jenis',
    ];

    public function kategoriKebudayaan()
    {
        return $this->belongsTo(
            KategoriKebudayaan::class,
            'kategori_kebudayaan_id'
        );
    }

    public function kebudayaan()
    {
        return $this->hasMany(
            Kebudayaan::class,
            'jenis_kebudayaan_id'
        );
    }
}