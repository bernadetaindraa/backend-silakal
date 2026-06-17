<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsiJawabanSurvey extends Model
{
    protected $table = 'opsi_jawaban_survey';

    protected $primaryKey = 'opsi_jawaban_survey_id';

    protected $fillable = [
        'pertanyaan_survey_id',
        'opsi_jawaban',
        'nilai_jawaban',
    ];

    public function pertanyaanSurvey()
    {
        return $this->belongsTo(
            PertanyaanSurvey::class,
            'pertanyaan_survey_id'
        );
    }
}