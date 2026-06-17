<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\JawabanSurvey;
use App\Models\DetailJawaban;
use App\Models\PertanyaanSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function index()
    {
        $pertanyaan = PertanyaanSurvey::all();

        return view('public.survey.form', compact('pertanyaan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'umur_responden' => 'required|string|max:20',
            'jenis_kelamin_responden' => 'required|in:Laki-laki,Perempuan',
            'pendidikan_responden' => 'required|string',
            'pekerjaan_responden' => 'required|string',
            'tanggal_survey' => 'required|date',
            'jenis_layanan' => 'required|string|max:255',

            'detail_jawaban' => 'required|array|min:9',
            'detail_jawaban.*.pertanyaan_survey_id' => 'required|exists:pertanyaan_survey,pertanyaan_survey_id',
            'detail_jawaban.*.nilai_jawaban' => 'required|integer|min:1|max:4',
            'detail_jawaban.*.saran_masukan' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $survey = JawabanSurvey::create([
                'umur_responden' => $validated['umur_responden'],
                'jenis_kelamin_responden' => $validated['jenis_kelamin_responden'],
                'pendidikan_responden' => $validated['pendidikan_responden'],
                'pekerjaan_responden' => $validated['pekerjaan_responden'],
                'tanggal_survey' => $validated['tanggal_survey'],
                'jenis_layanan' => $validated['jenis_layanan'],
            ]);

            foreach ($validated['detail_jawaban'] as $item) {

                DetailJawaban::create([
                    'jawaban_survey_id' => $survey->jawaban_survey_id,
                    'pertanyaan_survey_id' => $item['pertanyaan_survey_id'],
                    'nilai_jawaban' => $item['nilai_jawaban'],
                    'saran_masukan' => $item['saran_masukan'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('survey.hasil')
                ->with('success', 'Survey berhasil dikirim');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function hasil()
    {
        $totalPertanyaan = PertanyaanSurvey::count();

        $rataPerUnsur = DetailJawaban::select(
                'pertanyaan_survey_id',
                DB::raw('AVG(nilai_jawaban) as rata_rata')
            )
            ->groupBy('pertanyaan_survey_id')
            ->get();

        $totalNilai = $rataPerUnsur->sum('rata_rata');

        $ikm = $totalPertanyaan > 0
            ? ($totalNilai / $totalPertanyaan) * 25
            : 0;

        $mutu = 'D (Tidak Baik)';

        if ($ikm >= 88.31) {
            $mutu = 'A (Sangat Baik)';
        } elseif ($ikm >= 76.61) {
            $mutu = 'B (Baik)';
        } elseif ($ikm >= 65.00) {
            $mutu = 'C (Kurang Baik)';
        }

        return view('public.survey.hasil', [
            'ikm' => round($ikm, 2),
            'mutu' => $mutu,
            'detailUnsur' => $rataPerUnsur
        ]);
    }
}