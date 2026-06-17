<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodeSurvey extends Model
{
    use SoftDeletes;
    protected $table = 'periode_survey';

    protected $primaryKey = 'periode_survey_id';

    protected $fillable = [
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_periode',
    ];

    public function jawabanSurvey()
    {
        return $this->hasMany(
            JawabanSurvey::class,
            'periode_survey_id'
        );
    }
}