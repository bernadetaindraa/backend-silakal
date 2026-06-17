<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IzinCuti extends Model
{
    use SoftDeletes;

    protected $table = 'izin_cuti';

    protected $primaryKey = 'izin_cuti_id';

    protected $fillable = [
        'agenda_id',
        'user_id',
        'tanggal_mulai_izin_cuti',
        'tanggal_selesai_izin_cuti',
        'alasan_izin_cuti',
    ];

    protected $casts = [
        'tanggal_mulai_izin_cuti' => 'date',
        'tanggal_selesai_izin_cuti' => 'date',
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id', 'agenda_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}