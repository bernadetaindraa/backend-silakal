<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengaduan extends Model
{
    use SoftDeletes;

    protected $table = 'pengaduan';

    protected $primaryKey = 'pengaduan_id';

    protected $fillable = [
        'user_id',
        'tanggal_pengaduan',
        'nama_pengadu',
        'kontak_pengadu',
        'jenis_pengaduan',
        'judul_pengaduan',
        'isi_pengaduan',
        'lokasi_kejadian',
        'status_pengaduan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI FILE
    |--------------------------------------------------------------------------
    */

    public function fotoPengaduan()
    {
        return $this->hasMany(
            PengaduanFile::class, 'pengaduan_id', 'pengaduan_id'
        );
    }
}