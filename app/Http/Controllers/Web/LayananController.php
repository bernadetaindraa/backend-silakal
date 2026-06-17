<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\User;
use App\Models\LayananDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    /**
     * ========================
     * INDEX LAYANAN
     * ======================== 
     */
    public function index()
    {
        $layanan = Layanan::with('user')
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('user.layanan.create', compact('layanan'));
    }

    /**
     * ========================
     * RIWAYAT LAYANAN
     * ======================== 
     */
    public function riwayat()
    {
        $layanan = Layanan::with('user')
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('user.layanan.riwayat', compact('layanan'));
    }

    /**
     * ========================
     * PANDUAN LAYANAN
     * ========================
     */
    public function panduan()
    {
        return view('public.layanan.panduan');
    }

    /**
     * =========================
     * HELPER NOTIFIKASI
     * =========================
     */
    private function notif($userId, $judul, $pesan)
    {
        $user = \App\Models\User::find($userId);
        if (!$user) {
            return;
        }

        $user->notify(new \App\Notifications\LayananNotification($judul, $pesan));
    }

    /**
     * =========================
     * HELPER KATEGORI
     * =========================
     */
    private function getKategoriLayanan($jenis_layanan)
    {
        $kependudukan = ['ktp_baru', 'kk_baru', 'pindah_domisili', 'akta_kelahiran', 'akta_kematian'];

        return in_array($jenis_layanan, $kependudukan) ? 'kependudukan' : 'surat_keterangan';
    }

    /**
     * =========================
     * FORM CREATE
     * =========================
     */
    public function create()
    {
        return view('public.layanan.create');
    }

        /**
     * =========================
     * USER - BUAT PERMOHONAN
     * =========================
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI DASAR
        |--------------------------------------------------------------------------
        */
        $rules = [
            'jenis_layanan'      => 'required|string',
            'keperluan_layanan'  => 'required|string|max:500',
            'pengiriman_layanan' => 'required|in:ambil,email',

            'jenis_pengajuan'    => 'required|in:sendiri,orang_lain',

            'hubungan_pengaju'   => [
                'nullable',
                'string',
                Rule::requiredIf($request->jenis_pengajuan === 'orang_lain'),
            ],

            'nik_pengajuan'      => 'required|digits:16',
            'nama_pengajuan'     => 'required|string|max:255',
            'telepon_pengajuan'  => 'nullable|string|max:20',
            'tempat_lahir_pengajuan' => 'nullable|string|max:255',
            'tanggal_lahir_pengajuan' => 'nullable|date',

            'file_ktp'           => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_kk'            => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_pendukung'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ];

        /*
        |--------------------------------------------------------------------------
        | VALIDASI DINAMIS BERDASARKAN JENIS LAYANAN
        |--------------------------------------------------------------------------
        */
        switch ($request->jenis_layanan) {
            case 'sku':
                $rules['nama_usaha']   = 'required|string|max:255';
                $rules['jenis_usaha']  = 'required|string|max:255';
                $rules['alamat_usaha'] = 'required|string';
                break;

            case 'sktm':
                $rules['tujuan_sktm']   = 'required|string|max:255';
                $rules['instansi_sktm'] = 'required|string|max:255';
                break;

            case 'pindah_domisili':
                $rules['alamat_pindah'] = 'required|string';
                $rules['alasan_pindah'] = 'required|string|max:255';
                break;

            case 'domisili_usaha':
                $rules['nama_usaha']   = 'required|string|max:255';
                $rules['alamat_usaha'] = 'required|string';
                break;

            case 'domisili_instansi':
                $rules['nama_instansi']   = 'required|string|max:255';
                $rules['jabatan_instansi'] = 'nullable|string|max:255';
                $rules['alamat_instansi']  = 'required|string';
                break;

            case 'beda_nama':
                $rules['nama_lama']             = 'required|string|max:255';
                $rules['nama_baru']             = 'required|string|max:255';
                $rules['keterangan_beda_nama']  = 'required|string';
                break;
        }

        $validated = $request->validate($rules);

        DB::beginTransaction();

        try {
            /*
            |--------------------------------------------------------------------------
            | GENERATE NOMOR LAYANAN
            |--------------------------------------------------------------------------
            */
            $lastId = (Layanan::max('layanan_id') ?? 0) + 1;
            $nomor  = 'LY-' . date('Y') . '-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);

            /*
            |--------------------------------------------------------------------------
            | UPLOAD FILE
            |--------------------------------------------------------------------------
            */
            $fileKtp = $request->file('file_ktp')->store('layanan/ktp', 'public');
            $fileKk  = $request->file('file_kk')->store('layanan/kk', 'public');

            $filePendukung = null;
            if ($request->hasFile('file_pendukung')) {
                $filePendukung = $request->file('file_pendukung')->store('layanan/pendukung', 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | DATA TAMBAHAN (FIELD DINAMIS)
            |--------------------------------------------------------------------------
            */
            $exclude = [
                '_token', 'jenis_layanan', 'keperluan_layanan', 'pengiriman_layanan',
                'jenis_pengajuan', 'hubungan_pengaju', 'nik_pengajuan', 'nama_pengajuan',
                'telepon_pengajuan', 'tempat_lahir_pengajuan', 'tanggal_lahir_pengajuan',
                'file_ktp', 'file_kk', 'file_pendukung'
            ];

            $dataTambahan = $request->except($exclude);

            /*
            |--------------------------------------------------------------------------
            | CREATE LAYANAN
            |--------------------------------------------------------------------------
            */
            $layanan = Layanan::create([
                'user_id'                   => auth()->id(),
                'kategori_layanan'          => $this->getKategoriLayanan($validated['jenis_layanan']),
                'jenis_layanan'             => $validated['jenis_layanan'],
                'keperluan_layanan'         => $validated['keperluan_layanan'],
                'pengiriman_layanan'        => $validated['pengiriman_layanan'],

                'jenis_pengajuan'           => $validated['jenis_pengajuan'],
                'hubungan_pengaju'          => $validated['hubungan_pengaju'] ?? null,

                'nik_pengajuan'             => $validated['nik_pengajuan'],
                'nama_pengajuan'            => $validated['nama_pengajuan'],
                'telepon_pengajuan'         => $validated['telepon_pengajuan'],
                'tempat_lahir_pengajuan'    => $validated['tempat_lahir_pengajuan'],
                'tanggal_lahir_pengajuan'   => $validated['tanggal_lahir_pengajuan'],

                'data_tambahan'             => !empty($dataTambahan) ? $dataTambahan : null,

                'status_layanan'            => 'menunggu',
                'nomor_layanan'             => $nomor,
                'tanggal_layanan'           => now()->toDateString(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | SIMPAN DOKUMEN
            |--------------------------------------------------------------------------
            */
            LayananDokumen::create([
                'layanan_id'       => $layanan->layanan_id,
                'jenis_dokumen'    => 'ktp',
                'url_file_dokumen' => $fileKtp,
            ]);

            LayananDokumen::create([
                'layanan_id'       => $layanan->layanan_id,
                'jenis_dokumen'    => 'kk',
                'url_file_dokumen' => $fileKk,
            ]);

            if ($filePendukung) {
                LayananDokumen::create([
                    'layanan_id'       => $layanan->layanan_id,
                    'jenis_dokumen'    => 'pendukung',
                    'url_file_dokumen' => $filePendukung,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | NOTIFIKASI
            |--------------------------------------------------------------------------
            */
            $this->notif(
                $layanan->user_id, 
                'Pengajuan Diterima', 
                "Permohonan {$nomor} berhasil dibuat"
            );

            $dukuh = User::where('role_id', 2)->get();
            foreach ($dukuh as $d) {
                $this->notif(
                    $d->user_id, 
                    'Permohonan Baru Masuk', 
                    "Ada permohonan baru: {$nomor}"
                );
            }

            DB::commit();

            return redirect()
                ->route('user.layanan.riwayat')
                ->with('success', 'Permohonan berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Error Store Layanan: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat permohonan: ' . $e->getMessage());
        }
    }
    
    /**
     * =========================
     * DETAIL LAYANAN
     * =========================
     */
    public function show($id)
    {
        $data = Layanan::with([
                    'user',
                    'lampiranLayanan'
                ])
                ->findOrFail($id);

        return view('public.layanan.show', compact('data'));
    }

    /**
     * =========================
     * PELAYANAN - PROSES SURAT
     * =========================
     */
    public function proses($id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->status_layanan !== 'diverifikasi') {

            return back()->with(
                'error',
                'Belum diverifikasi dukuh'
            );
        }

        $layanan->update([
            'status_layanan' => 'diproses'
        ]);

        return back()->with(
            'success',
            'Surat sedang diproses'
        );
    }

    /**
     * =========================
     * FINAL - SELESAI
     * =========================
     */
    public function selesai($id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->status_layanan !== 'diproses') {

            return back()->with(
                'error',
                'Belum diproses'
            );
        }

        if ($layanan->pengiriman_layanan === 'email') {

            $layanan->update([
                'status_layanan' => 'selesai'
            ]);

            $this->notif(
                $layanan->user_id,
                'Surat Terkirim',
                'Surat sudah dikirim ke email kamu'
            );

        } else {

            $layanan->update([
                'status_layanan' => 'siap_diambil'
            ]);

            $this->notif(
                $layanan->user_id,
                'Surat Siap Diambil',
                'Surat kamu sudah bisa diambil di kantor'
            );
        }

        return back()->with(
            'success',
            'Proses selesai'
        );
    }

    /**
     * =========================
     * TRACKING LAYANAN
     * =========================
     */
    public function tracking(Request $request, $nomor = null)
    {
        $nomorLayanan = $nomor ?? $request->input('nomor_layanan');

        $layanan = null;

        if ($nomorLayanan) {
            $layanan = Layanan::with(['user', 'lampiranLayanan'])
                ->where('nomor_layanan', $nomorLayanan)
                ->first(); 
        }

        return view('user.layanan.tracking', compact('layanan'));
    }

    public function download($id)
    {
        $layanan = Layanan::findOrFail($id);

        if (!$layanan->file_surat) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $layanan->file_surat
        );
    }

    /**
     * =========================
     * HAPUS LAYANAN
     * =========================
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        $layanan->delete();

        return redirect()
                ->route('layanan.index')
                ->with(
                    'success',
                    'Layanan berhasil dihapus'
                );
    }
}