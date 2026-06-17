<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    use SoftDeletes;

    protected $table = 'berita';

    protected $primaryKey = 'berita_id';

    protected $fillable = [
        'user_id',
        'judul_berita',
        'isi_berita',
        'tanggal_berita',
        'status_berita',
        'kategori_berita_id',
    ];

    protected $casts = [
        'tanggal_berita' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // berita dibuat oleh user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // berita punya banyak foto
    public function foto()
    {
        return $this->hasMany(BeritaFoto::class, 'berita_id', 'berita_id')->orderBy('created_at', 'asc');
    }

    // berita punya banyak komentar
    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'berita_id', 'berita_id');
    }

    // kategori berita
    public function kategori()
    {
        return $this->belongsToMany(KategoriBerita::class,'berita_kategori', 'berita_id', 'kategori_berita_id'
    );
}

    /*
    |--------------------------------------------------------------------------
    | SOFT DELETE CASCADE
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($berita) {

            // soft delete foto
            if (!$berita->isForceDeleting()) {
                $berita->foto()->delete();
            }

            // force delete foto
            if ($berita->isForceDeleting()) {
                $berita->foto()->forceDelete();
            }
        });
    }
}