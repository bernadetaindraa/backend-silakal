<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PertanyaanSurvey;

class PertanyaanSurveyController extends Controller
{
    public function index()
    {
        $data = PertanyaanSurvey::orderBy('pertanyaan_survey_id')->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}