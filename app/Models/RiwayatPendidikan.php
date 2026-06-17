<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    protected $table = 'riwayat_pendidikan';
    protected $primaryKey = 'riwayat_pendidikan_id';

    protected $fillable = [
        'aparatur_id',
        'tingkat_pendidikan',
        'jurusan',
        'nama_instansi',
        'tahun_masuk',
        'tahun_selesai',
    ];

    //Riwayat Pendidikan milik satu aparatur
    public function aparatur()
    {
        return $this->belongsTo(Aparatur::class,  'aparatur_id', 'aparatur_id');
    }
}
