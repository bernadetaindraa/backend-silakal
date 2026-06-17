<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'role_id',
        'dusun_id',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'pendidikan_terakhir',
        'status_perkawinan',
        'agama',
        'nomor_telepon',
        'email',
        'password',
        'url_foto_profil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function dusun()
    {
        return $this->belongsTo(Dusun::class, 'dusun_id', 'dusun_id');
    }

    public function berita()
    {
        return $this->hasMany(Berita::class, 'created_by');
    }

    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'user_id');
    }
}