<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KebudayaanFoto extends Model
{
    use SoftDeletes;

    protected $table = 'kebudayaan_foto';

    protected $primaryKey = 'kebudayaan_foto_id';

    protected $fillable = [
        'kebudayaan_id',
        'url_foto_kebudayaan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function kebudayaan()
    {
        return $this->belongsTo(
            Kebudayaan::class,
            'kebudayaan_id'
        );
    }
}