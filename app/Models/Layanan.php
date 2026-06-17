<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use SoftDeletes;

    protected $table = 'layanan';

    protected $primaryKey = 'layanan_id';

    protected $fillable = [

        'user_id',

        'kategori_layanan',
        'jenis_layanan',
        'jenis_pengajuan',
        'hubungan_pengaju',

        'nik_pengajuan',
        'nama_pengajuan',
        'telepon_pengajuan',

        'tempat_lahir_pengajuan',
        'tanggal_lahir_pengajuan',

        'keperluan_layanan',

        'status_layanan',
        'catatan_penolakan',
        'nomor_layanan',
        'tanggal_layanan',
        'pengiriman_layanan',

        'data_tambahan',
        'nomor_surat',
        'jabatan_penandatangan',
        'nama_penandatangan',
        'isi_surat',
        'file_surat',
        'tanggal_surat',
    ];

    protected $casts = [
        'tanggal_layanan' => 'date',
        'data_tambahan' => 'array',
        'tanggal_surat' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function pengaju()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function lampiranLayanan()
    {
        return $this->hasMany(
            LayananDokumen::class,
            'layanan_id',
            'layanan_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getStatusBadgeAttribute()
    {
        return match($this->status_layanan){

            'menunggu' => 'bg-yellow-100 text-yellow-700',
            'diverifikasi' => 'bg-blue-100 text-blue-700',
            'diproses' => 'bg-indigo-100 text-indigo-700',
            'siap_diambil' => 'bg-cyan-100 text-cyan-700',
            'selesai' => 'bg-green-100 text-green-700',
            'ditolak' => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status_layanan) {

            'menunggu' => 'Menunggu Verifikasi',
            'diverifikasi' => 'Siap Diproses',
            'diproses' => 'Sedang Diproses',
            'siap_diambil' => 'Siap Diambil',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => '-',
        };
    }

    public function getJenisLayananLabelAttribute()
    {
        $labels = [
            'ktp_baru' => 'Pengajuan E-KTP',
            'kk_baru' => 'Pengajuan Kartu Keluarga',
            'pindah_domisili' => 'Surat Keterangan Pindah Domisili',
            'akta_kelahiran' => 'Pengajuan Akta Kelahiran',
            'akta_kematian' => 'Pengajuan Akta Kematian',
            'sktm' => 'Surat Keterangan Tidak Mampu (SKTM)',
            'sku' => 'Surat Keterangan Usaha (SKU)',
            'kehilangan_kk' => 'Surat Keterangan Kehilangan KK',
            'janda' => 'Surat Keterangan Janda',
            'beda_nama' => 'Surat Keterangan Beda Nama',
            'domisili_instansi' => 'Surat Keterangan Domisili Instansi',
            'domisili_usaha' => 'Surat Keterangan Domisili Usaha',
            'domisili_pribadi' => 'Surat Keterangan Domisili Pribadi',
        ];

        return $labels[$this->jenis_layanan]
            ?? ucwords(str_replace('_', ' ', $this->jenis_layanan));
    }

    public function getFormattedDataTambahanAttribute()
    {
        if (!$this->data_tambahan) {
            return [];
        }

        return collect($this->data_tambahan)
            ->mapWithKeys(function ($value, $key) {

                return [
                    ucwords(str_replace('_', ' ', $key)) => $value
                ];

            })
            ->toArray();
    }
}