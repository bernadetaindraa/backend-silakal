<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BpkalAnggotaDusun extends Model
{
    use SoftDeletes;

    protected $table = 'bpkal_anggota_dusun';

    protected $fillable = [
        'bpkal_anggota_id',
        'dusun_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function bpkalAnggota()
    {
        return $this->belongsTo(BpkalAnggota::class,'bpkal_anggota_id', 'bpkal_anggota_id');
    }
}