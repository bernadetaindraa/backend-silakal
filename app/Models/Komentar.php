<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'komentar_id';

    protected $fillable = [
        'berita_id',
        'user_id',
        'parent_id',
        'isi_komentar',
        'nama_pengguna',
    ];

    // komentar milik satu berita
    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id', 'berita_id');
    }

    // komentar bisa punya parent (balasan komentar)
    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'parent_id', 'komentar_id');
    }

    // komentar bisa punya banyak balasan
    public function replies()
    {
        return $this->hasMany(Komentar::class, 'parent_id', 'komentar_id');
    }
}
