<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgendaItem extends Model
{
    use SoftDeletes;

    protected $table = 'agenda_item';

    protected $primaryKey = 'agenda_item_id';

    protected $fillable = [
        'agenda_id',
        'user_id',
        'kategori_agenda',
        'waktu_agenda',
        'nama_agenda',
        'tempat_agenda',
        'penyelenggara_agenda',
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