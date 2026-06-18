<?php

namespace App\Http\Controllers\Admin;

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
     * =========================================================
     * MANAJEMEN PERIODE SURVEY
     * =========================================================
     */

    /**
     * LIST PERIODE SURVEY
     */
    public function periode()
    {
        $periode = PeriodeSurvey::latest()->get();

        return view(
            'admin.survey.periode.index',
            compact('periode')
        );
    }

    /**
     * BUKA PERIODE SURVEY
     */
    public function bukaPeriode(Request $request)
    {
        $validated = $request->validate([

            'nama_periode' =>
                'required|string|max:255',

            'tanggal_mulai' =>
                'required|date',

            'tanggal_selesai' =>
                'required|date|after_or_equal:tanggal_mulai',
        ]);

        DB::beginTransaction();

        try {

            /**
             * TUTUP SEMUA PERIODE AKTIF
             */
            PeriodeSurvey::where(
                    'status_periode',
                    'Buka'
                )
                ->update([
                    'status_periode' => 'Tutup'
                ]);

            /**
             * BUAT PERIODE BARU
             */
            PeriodeSurvey::create([

                'nama_periode' =>
                    $validated['nama_periode'],

                'tanggal_mulai' =>
                    $validated['tanggal_mulai'],

                'tanggal_selesai' =>
                    $validated['tanggal_selesai'],

                'status_periode' =>
                    'Buka',
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Periode survey berhasil dibuka'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * UBAH STATUS PERIODE SURVEY
     */
    public function updateStatusPeriode(
        Request $request,
        string $id
    ) {
        $periode = PeriodeSurvey::findOrFail($id);

        $validated = $request->validate([

            'status_periode' =>
                'required|in:Buka,Tutup',
        ]);

        DB::beginTransaction();

        try {

            /**
             * JIKA MEMBUKA PERIODE,
             * TUTUP YANG LAIN
             */
            if (
                $validated['status_periode']
                == 'Buka'
            ) {

                PeriodeSurvey::where(
                        'status_periode',
                        'Buka'
                    )
                    ->where(
                        'periode_survey_id',
                        '!=',
                        $periode->periode_survey_id
                    )
                    ->update([
                        'status_periode' => 'Tutup'
                    ]);
            }

            $periode->update([

                'status_periode' =>
                    $validated['status_periode'],
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Status periode survey berhasil diperbarui'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * UPDATE PERIODE SURVEY
     */
    public function updatePeriode(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        DB::beginTransaction();

        try {
            $periode = PeriodeSurvey::findOrFail($id);

            $periode->update([
                'nama_periode' => $validated['nama_periode'],
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Periode survey berhasil diperbarui'
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * =========================================================
     * DATA HASIL SURVEY
     * =========================================================
     */
    public function hasil(Request $request)
    {
        $bulan = $request->bulan ?? date('n');
        $tahun = $request->tahun ?? date('Y');

        $surveys = JawabanSurvey::with(['periodeSurvey'])
            ->whereMonth('tanggal_survey', $bulan)
            ->whereYear('tanggal_survey', $tahun)
            ->latest('tanggal_survey')
            ->get();

        $totalResponden = $surveys->count();

        $countGender = [
            'laki_laki' => $surveys->where('jenis_kelamin_responden', 'Laki-laki')->count(),
            'perempuan' => $surveys->where('jenis_kelamin_responden', 'Perempuan')->count(),
        ];

        $countPendidikan = [
            'tidak_sekolah' => JawabanSurvey::where('pendidikan_responden', 'Tidak Sekolah')->count(),
            'tidak_tamat_sd' => JawabanSurvey::where('pendidikan_responden', 'Tidak Tamat SD/Sederajat')->count(),
            'tamat_sd' => JawabanSurvey::where('pendidikan_responden', 'Tamat SD/Sederajat')->count(),
            'tidak_tamat_smp' => JawabanSurvey::where('pendidikan_responden', 'Tidak Tamat SMP/Sederajat')->count(),
            'tamat_smp' => JawabanSurvey::where('pendidikan_responden', 'Tamat SMP/Sederajat')->count(),
            'tidak_tamat_sma' => JawabanSurvey::where('pendidikan_responden', 'Tidak Tamat SMA/Sederajat')->count(),
            'tamat_sma' => JawabanSurvey::where('pendidikan_responden', 'Tamat SMA/Sederajat')->count(),
            'diploma' => JawabanSurvey::where('pendidikan_responden', 'Tamat D1/D2/D3')->count(),
            'sarjana' => JawabanSurvey::where('pendidikan_responden', 'Tamat S1/S2/S3')->count(),
        ];

        $jumlahUnsur = PertanyaanSurvey::count();
        $nilaiIkm = 0;
        $mutu = '-';
        $kinerja = '-';
        $hasilUnsur = [];

        if ($jumlahUnsur > 0) {
            $bobotUnsur = 1 / $jumlahUnsur;
            $pertanyaan = PertanyaanSurvey::with(['detailJawaban.opsiJawaban'])->get();
            $totalNilai = 0;

            foreach ($pertanyaan as $item) {
                $detailJawaban = $item->detailJawaban;
                $jumlahRespondenUnsur = $detailJawaban->count();

                $totalPersepsi = $detailJawaban->sum(function ($detail) {
                    return $detail->opsiJawaban->nilai_jawaban ?? 0;
                });

                $rataRata = $jumlahRespondenUnsur > 0 ? $totalPersepsi / $jumlahRespondenUnsur : 0;
                $nilaiTertimbang = $rataRata * $bobotUnsur;
                $totalNilai += $nilaiTertimbang;

                $hasilUnsur[] = [
                    'pertanyaan' => $item->pertanyaan_survey,
                    'rata_rata'  => round($rataRata, 2),
                ];
            }

            $nilaiIkm = round($totalNilai * 25, 2);

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

        return view('admin.survey.hasil.index', compact(
            'surveys', 'nilaiIkm', 'mutu', 'kinerja', 'hasilUnsur',
            'countGender', 'countPendidikan', 'totalResponden', 'bulan', 'tahun'
        ));
    }

    /**
     * DETAIL SURVEY
     */
    public function show(string $id)
    {
        $survey = JawabanSurvey::with([
                'detailJawaban.pertanyaanSurvey',
                'detailJawaban.opsiJawaban',
                'periodeSurvey'
            ])
            ->findOrFail($id);

        return view(
            'admin.survey.hasil.show',
            compact('survey')
        );
    }

    public static function hitungIkmGlobal()
    {
        $jumlahUnsur = PertanyaanSurvey::count();

        if ($jumlahUnsur == 0) {
            return 0;
        }

        $bobotUnsur = 1 / $jumlahUnsur;

        $pertanyaan = PertanyaanSurvey::with('detailJawaban.opsiJawaban')->get();

        $totalNilai = 0;

        foreach ($pertanyaan as $item) {

            $detailJawaban = $item->detailJawaban;

            $jumlahResponden = $detailJawaban->count();

            $totalPersepsi = $detailJawaban->sum(function ($d) {
                return $d->opsiJawaban->nilai_jawaban ?? 0;
            });

            $rataRata = $jumlahResponden > 0
                ? $totalPersepsi / $jumlahResponden
                : 0;

            $totalNilai += ($rataRata * $bobotUnsur);
        }

        return round($totalNilai * 25, 2);
    }
}