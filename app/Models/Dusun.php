<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    protected $table = 'dusun';
    protected $primaryKey = 'dusun_id';

    protected $fillable = [
        'nama_dusun',
    ];

    public function bpkalAnggota()
    {
        return $this->belongsToMany(BpkalAnggota::class,'bpkal_anggota_dusun','dusun_id','bpkal_anggota_id')->withTimestamps();
    }
}
