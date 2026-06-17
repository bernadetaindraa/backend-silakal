<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PiketDukuh extends Model
{
    use SoftDeletes;

    protected $table = 'piket_dukuh';

    protected $primaryKey = 'piket_dukuh_id';

    protected $fillable = [
        'agenda_id',
        'user_id',
        'waktu_piket',
        'keterangan_piket',
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