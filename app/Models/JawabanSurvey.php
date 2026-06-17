<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanSurvey extends Model
{
    protected $table = 'jawaban_survey';

    protected $primaryKey = 'jawaban_survey_id';

    protected $fillable = [
        'periode_survey_id',
        'umur_responden',
        'jenis_kelamin_responden',
        'pekerjaan_responden',
        'pendidikan_responden',
        'tanggal_survey',
        'jenis_layanan',
        'saran_masukan'
    ];

    /**
     * Jawaban survey memiliki banyak detail jawaban
     */
    public function detailJawaban()
    {
        return $this->hasMany(
            DetailJawaban::class,
            'jawaban_survey_id'
        );
    }

    /**
     * Jawaban survey belongs to periode survey
     */
    public function periodeSurvey()
    {
        return $this->belongsTo(
            PeriodeSurvey::class,
            'periode_survey_id'
        );
    }
}