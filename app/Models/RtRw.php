<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RtRw extends Model
{
    use SoftDeletes;

    protected $table = 'rt_rw';
    protected $primaryKey = 'rt_rw_id';

    protected $fillable = [
        'dusun_id',
        'nama_rt',
        'nama_rw',
    ];

    // Relasi ke dusun
    public function dusun()
    {
        return $this->belongsTo(Dusun::class, 'dusun_id', 'dusun_id');
    }
}