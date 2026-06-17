<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PertanyaanSurvey extends Model
{
    use SoftDeletes;

    protected $table = 'pertanyaan_survey';

    protected $primaryKey = 'pertanyaan_survey_id';

    protected $fillable = [
        'pertanyaan_survey',
    ];

    /**
     * Pertanyaan memiliki banyak detail jawaban
     */
    public function detailJawaban()
    {
        return $this->hasMany(
            DetailJawaban::class,
            'pertanyaan_survey_id'
        );
    }

    /**
     * Pertanyaan memiliki banyak opsi jawaban
     */
    public function opsiJawaban()
    {
        return $this->hasMany(
            OpsiJawabanSurvey::class,
            'pertanyaan_survey_id'
        );
    }
}