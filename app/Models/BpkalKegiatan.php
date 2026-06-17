<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BpkalKegiatan extends Model
{
    use SoftDeletes;

    protected $table = 'bpkal_kegiatan';

    protected $primaryKey = 'bpkal_kegiatan_id';

    protected $fillable = [
        'judul_kegiatan',
        'status_kegiatan',
        'tahun_kegiatan',
        'deskripsi_kegiatan',
    ];

    protected $casts = [
        'tahun_kegiatan' => 'integer',
    ];
}