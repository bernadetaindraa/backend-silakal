<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    protected $table = 'riwayat_jabatan';
    protected $primaryKey = 'riwayat_jabatan_id';

    protected $fillable = [
        'aparatur_id',
        'nama_jabatan',
        'nomor_sk',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    // Aparatur yang memiliki riwayat jabatan ini
    public function aparatur()
    {
        return $this->belongsTo(Aparatur::class, 'aparatur_id', 'aparatur_id');
    }
}
