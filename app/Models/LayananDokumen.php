<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananDokumen extends Model
{
    protected $table = 'layanan_dokumen';
    protected $primaryKey = 'layanan_dokumen_id';

    protected $fillable = [
        'layanan_id',
        'jenis_dokumen',
        'url_file_dokumen',
    ];

    // Layanan Dokumen milik satu layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }
}
