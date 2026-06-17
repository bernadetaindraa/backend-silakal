<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aparatur extends Model
{
    use SoftDeletes;
    protected $table = 'aparatur';
    protected $primaryKey = 'aparatur_id';

    protected $fillable = [
       'user_id',
       'nama_jabatan',
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Aparatur memiliki riwayat pendidikan
    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'aparatur_id', 'aparatur_id');
    }

    // Aparatur memiliki riwayat jabatan
    public function riwayatJabatan()
    {
        return $this->hasMany(RiwayatJabatan::class, 'aparatur_id', 'aparatur_id');
    }
}
