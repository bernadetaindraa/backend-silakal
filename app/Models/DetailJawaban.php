<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailJawaban extends Model
{
    protected $table = 'detail_jawaban';

    protected $primaryKey = 'detail_jawaban_id';

    protected $fillable = [
        'jawaban_survey_id',
        'pertanyaan_survey_id',
        'opsi_jawaban_survey_id',
    ];
    /**
     * Detail jawaban milik satu jawaban survey
     */
    public function jawabanSurvey()
    {
        return $this->belongsTo(
            JawabanSurvey::class,
            'jawaban_survey_id'
        );
    }

    /**
     * Detail jawaban milik satu pertanyaan survey
     */
    public function pertanyaanSurvey()
    {
        return $this->belongsTo(
            PertanyaanSurvey::class,
            'pertanyaan_survey_id'
        );
    }

    /**
     * Detail jawaban milik satu opsi jawaban survey
     */
    public function opsiJawaban()
    {
        return $this->belongsTo(
            OpsiJawabanSurvey::class,
            'opsi_jawaban_survey_id'
        );
    }
}