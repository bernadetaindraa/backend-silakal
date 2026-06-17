<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use SoftDeletes;

    protected $table = 'agenda';

    protected $primaryKey = 'agenda_id';

    protected $fillable = [
        'judul_agenda',
        'tanggal_agenda',
    ];

    protected $casts = [
        'tanggal_agenda' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
    public function agendaItems()
    {
        return $this->hasMany(AgendaItem::class, 'agenda_id', 'agenda_id');
    }

    public function piketDukuh()
    {
        return $this->hasMany(PiketDukuh::class, 'agenda_id', 'agenda_id');
    }

    public function izinCuti()
    {
        return $this->hasMany(IzinCuti::class, 'agenda_id', 'agenda_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SOFT DELETE CASCADE
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($agenda) {

            // SOFT DELETE
            if (!$agenda->isForceDeleting()) {

                $agenda->agendaItems()->delete();

                $agenda->piketDukuh()->delete();

                $agenda->izinCuti()->delete();
            }

            // FORCE DELETE
            if ($agenda->isForceDeleting()) {

                $agenda->agendaItems()->forceDelete();

                $agenda->piketDukuh()->forceDelete();

                $agenda->izinCuti()->forceDelete();
            }
        });
    }
}