<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kebudayaan extends Model
{
    use SoftDeletes;

    protected $table = 'kebudayaan';

    protected $primaryKey = 'kebudayaan_id';

    protected $fillable = [
        'jenis_kebudayaan_id',
        'judul_kebudayaan',
        'deskripsi_kebudayaan',
        'tahun_ditetapkan',
        'lokasi_kebudayaan',
    ];
    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // Kebudayaan memiliki banyak foto
    public function fotoKebudayaan()
    {
        return $this->hasMany(
            KebudayaanFoto::class,
            'kebudayaan_id'
        );
    }

    // Kebudayaan memiliki satu jenis
    public function jenisKebudayaan()
    {
        return $this->belongsTo(
            JenisKebudayaan::class,
            'jenis_kebudayaan_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SOFT DELETE CASCADE
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kebudayaan) {

            // soft delete foto
            if (!$kebudayaan->isForceDeleting()) {

                $kebudayaan->fotoKebudayaan()->delete();
            }

            // force delete foto
            if ($kebudayaan->isForceDeleting()) {

                $kebudayaan->fotoKebudayaan()->forceDelete();
            }
        });
    }
}