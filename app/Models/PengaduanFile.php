<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengaduanFile extends Model
{
    use SoftDeletes;

    protected $table = 'pengaduan_file';

    protected $primaryKey = 'pengaduan_file_id';

    protected $fillable = [
        'pengaduan_id',
        'url_file_pengaduan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE PENGADUAN
    |--------------------------------------------------------------------------
    */

    public function pengaduan()
    {
        return $this->belongsTo(
            Pengaduan::class, 'pengaduan_id', 'pengaduan_id'
        );
    }
}