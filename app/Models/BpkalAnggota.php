<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BpkalAnggota extends Model
{
    use SoftDeletes;

    protected $table = 'bpkal_anggota';

    protected $primaryKey = 'bpkal_anggota_id';

    protected $fillable = [
        'user_id',
        'jabatan',
    ];

    protected $appends = [
        'wilayah_musyawarah',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'user_id');
    }

    public function dusun()
    {
        return $this->belongsToMany(Dusun::class,'bpkal_anggota_dusun','bpkal_anggota_id','dusun_id')->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getWilayahMusyawarahAttribute()
    {
        return $this->dusun
                    ->pluck('nama_dusun')
                    ->implode(', ');
    }
}