<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DetailJawaban;
use App\Models\JawabanSurvey;
use App\Models\PeriodeSurvey;
use App\Models\PertanyaanSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * FORM SURVEY
     */
    public function index()
    {
        $pertanyaanList = PertanyaanSurvey::with(
                'opsiJawaban'
            )
            ->orderBy('pertanyaan_survey_id')
            ->get();

        return view(
            'public.survey.form',
            compact('pertanyaanList')
        );
    }

    /**
     * SIMPAN SURVEY
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'umur_responden' =>'required|integer|min:1',
            'jenis_kelamin_responden' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan_responden' => 'required|string|max:255',
            'pendidikan_responden' => 'required|string|max:255',
            'tanggal_survey' => 'required|date',
            'jenis_layanan' => 'required|string|max:255',
            'saran_masukan' => 'nullable|string',
            'detail_jawaban' => 'required|array|min:1',
            'detail_jawaban.*.pertanyaan_survey_id'  => 'required|integer|exists:pertanyaan_survey,pertanyaan_survey_id',
            'detail_jawaban.*.opsi_jawaban_survey_id'=> 'required|integer|exists:opsi_jawaban_survey,opsi_jawaban_survey_id',
        ]);

        /**
         * CEK PERIODE AKTIF
         */
        $today = now()->toDateString();

        $periode = PeriodeSurvey::where(
                            'status_periode',
                            'Buka'
                        )
                        ->whereDate(
                            'tanggal_mulai',
                            '<=',
                            $today
                        )
                        ->whereDate(
                            'tanggal_selesai',
                            '>=',
                            $today
                        )
                        ->first();

        if (!$periode) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Survey sedang ditutup'
                );
        }

        DB::beginTransaction();

        try {

            /**
             * SIMPAN SURVEY
             */
            $survey = JawabanSurvey::create([

                'periode_survey_id' =>
                    $periode->periode_survey_id,

                'umur_responden' =>
                    $validated['umur_responden'],

                'jenis_kelamin_responden' =>
                    $validated['jenis_kelamin_responden'],

                'pekerjaan_responden' =>
                    $validated['pekerjaan_responden'],

                'pendidikan_responden' =>
                    $validated['pendidikan_responden'],

                'tanggal_survey' =>
                    $validated['tanggal_survey'],

                'jenis_layanan' =>
                    $validated['jenis_layanan'],

                'saran_masukan' =>
                    $validated['saran_masukan'] ?? null,
            ]);

            /**
             * SIMPAN DETAIL JAWABAN
             */
            foreach ($request->detail_jawaban as $item) {

                // Pastikan data lengkap
                if (empty($item['pertanyaan_survey_id']) || empty($item['opsi_jawaban_survey_id'])) {
                    continue;
                }

                DetailJawaban::create([
                    'jawaban_survey_id'     => $survey->jawaban_survey_id,
                    'pertanyaan_survey_id'  => $item['pertanyaan_survey_id'],
                    'opsi_jawaban_survey_id'=> $item['opsi_jawaban_survey_id'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('survey-ikm')
                ->with(
                    'success',
                    'Survey berhasil dikirim'
                );

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /**
     * HASIL IKM
     */
    public function hasil(Request $request)
    {
        $bulan = $request->bulan ?? date('n');
        $tahun = $request->tahun ?? date('Y');

        /**
         * FILTER SURVEY
         */
        $surveyQuery = JawabanSurvey::query()
            ->whereMonth(
                'tanggal_survey',
                $bulan
            )
            ->whereYear(
                'tanggal_survey',
                $tahun
            );

        $surveys = $surveyQuery->get();

        /**
         * TOTAL RESPONDEN
         */
        $totalResponden = $surveys->count();

        /**
         * DATA GENDER
         */
        $countGender = [

            'laki_laki' =>
                $surveys
                    ->where(
                        'jenis_kelamin_responden',
                        'Laki-laki'
                    )
                    ->count(),

            'perempuan' =>
                $surveys
                    ->where(
                        'jenis_kelamin_responden',
                        'Perempuan'
                    )
                    ->count(),
        ];

        /**
         * DATA PENDIDIKAN
         */
        $countPendidikan = [

            'sd' =>
                $surveys
                    ->where(
                        'pendidikan_responden',
                        'SD'
                    )
                    ->count(),

            'smp' =>
                $surveys
                    ->where(
                        'pendidikan_responden',
                        'SMP'
                    )
                    ->count(),

            'sma' =>
                $surveys
                    ->where(
                        'pendidikan_responden',
                        'SMA'
                    )
                    ->count(),

            'sarjana' =>
                $surveys
                    ->whereIn(
                        'pendidikan_responden',
                        ['D3', 'S1', 'S2']
                    )
                    ->count(),

            'tidak_sekolah' => 0,
        ];

        /**
         * HITUNG IKM
         */
        $jumlahUnsur = PertanyaanSurvey::count();

        $nilaiIkm = 0;

        $mutu = '-';

        $kinerja = '-';

        $hasilUnsur = [];

        if ($jumlahUnsur > 0) {

            $bobotUnsur =
                1 / $jumlahUnsur;

            $pertanyaan =
                PertanyaanSurvey::with([
                    'detailJawaban.opsiJawaban'
                ])->get();

            $totalNilai = 0;

            foreach ($pertanyaan as $item) {

                $detailJawaban =
                    $item->detailJawaban;

                $jumlahRespondenUnsur =
                    $detailJawaban->count();

                $totalPersepsi =
                    $detailJawaban->sum(function ($detail) {

                        return $detail
                            ->opsiJawaban
                            ->nilai_jawaban ?? 0;
                    });

                $rataRata =
                    $jumlahRespondenUnsur > 0
                        ? $totalPersepsi / $jumlahRespondenUnsur
                        : 0;

                $nilaiTertimbang =
                    $rataRata * $bobotUnsur;

                $totalNilai +=
                    $nilaiTertimbang;

                $hasilUnsur[] = [

                    'pertanyaan' =>
                        $item->pertanyaan_survey,

                    'rata_rata' =>
                        round($rataRata, 2),
                ];
            }

            $nilaiIkm =
                round($totalNilai * 25, 2);

            if ($nilaiIkm >= 88.31) {

                $mutu = 'A';
                $kinerja = 'Sangat Baik';

            } elseif ($nilaiIkm >= 76.61) {

                $mutu = 'B';
                $kinerja = 'Baik';

            } elseif ($nilaiIkm >= 65.00) {

                $mutu = 'C';
                $kinerja = 'Kurang Baik';

            } else {

                $mutu = 'D';
                $kinerja = 'Tidak Baik';
            }
        }

        return view(
            'public.survey.hasil',
            compact(
                'nilaiIkm',
                'mutu',
                'kinerja',
                'hasilUnsur',
                'countGender',
                'countPendidikan',
                'totalResponden'
            )
        );
    }
}