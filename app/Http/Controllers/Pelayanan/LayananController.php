<?php

namespace App\Http\Controllers\Pelayanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\LayananDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuratLayananSelesai;

class LayananController extends Controller
{
    /**
     * Daftar layanan
     */
    public function index(Request $request)
    {
        $query = Layanan::with([
            'user',
            'lampiranLayanan'
        ])->whereIn('status_layanan', [
            'diverifikasi',
            'diproses',
            'siap_diambil',
            'selesai'
        ]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
            $q->where('jenis_layanan', 'like', "%{$search}%")
            ->orWhereHas('user', function ($user) use ($search) {
                    $user->where('nama_lengkap', 'like', "%{$search}%");
            });

        });
        }

        if ($request->filled('status')) {
            $query->where('status_layanan', $request->status);
        }

        $layanan = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pelayanan.layanan.index', compact('layanan'));
    }

    /**
     * Detail layanan
     */
    public function show($id)
    {
        $layanan = Layanan::withTrashed([
            'user',
            'lampiranLayanan'
        ])->findOrFail($id);

        return view('pelayanan.layanan.show', compact('layanan'));
    }

    /**
     * Mulai proses layanan
     */
    public function proses($id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->status_layanan !== 'diverifikasi') {
            return back()->with('error', 'Layanan belum siap diproses.');
        }

        $layanan->update([
            'status_layanan' => 'diproses'
        ]);

        return redirect()->route('pelayanan.layanan.proses', $layanan->layanan_id)
            ->with('success', 'Layanan berhasil diproses. Silakan unggah surat.');
    }

    /**
     * Halaman pembuatan surat
     */
    public function pembuatanSurat($id)
    {
        $layanan = Layanan::with([
            'user',
            'lampiranLayanan'
        ])->findOrFail($id);

        return view('pelayanan.layanan.proses', compact('layanan'));
    }

    /**
     * Generate Surat Otomatis
     */
    public function generateSurat(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        
        // TODO: Tambahkan logika untuk generate PDF/Docx disini
        
        return back()->with('success', 'Surat berhasil digenerate.');
    }

    /**
     * Upload Surat
     */
    public function uploadSurat(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'nomor_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'nama_penandatangan' => 'required|string',
            'jabatan_penandatangan' => 'required|string',
            'isi_surat' => 'nullable|string',
        ]);

        $layanan = Layanan::findOrFail($id);

        $dataUpdate = $request->except(['_token', '_method', 'file_surat']);
        $dataUpdate['status_layanan'] = 'siap_diambil';

        if ($request->hasFile('file_surat')) {

            if (
                $layanan->file_surat &&
                Storage::disk('public')->exists($layanan->file_surat)
            ) {
                Storage::disk('public')->delete($layanan->file_surat);
            }

            $dataUpdate['file_surat'] = $request
                ->file('file_surat')
                ->store('surat-layanan', 'public');
        }

        $layanan->update($dataUpdate);

        $layanan->refresh();

        if (
            $layanan->pengiriman_layanan === 'email' &&
            $layanan->user &&
            !empty($layanan->user->email)
        ) {
            Mail::to($layanan->user->email)
                ->send(new SuratLayananSelesai($layanan));
        }

        return redirect()
            ->route('pelayanan.layanan.index')
            ->with('success', 'Surat berhasil diproses dan siap diambil.');
    }

    /**
     * Tolak layanan
     */
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan_penolakan' => 'required|string|max:1000'
        ]);

        $layanan = Layanan::findOrFail($id);

        // Pastikan hanya status tertentu yang bisa ditolak
        if (!in_array($layanan->status_layanan, ['menunggu_verifikasi', 'diverifikasi', 'diproses'])) {
            return back()->with('error', 'Layanan tidak dapat ditolak pada status saat ini.');
        }

        $layanan->update([
            'status_layanan' => 'ditolak',
            'catatan_penolakan' => $request->catatan_penolakan // Pastikan kolom ini sudah ada di migration table layanan
        ]);

        return back()->with('success', 'Layanan berhasil ditolak dan catatan telah dikirim ke pemohon.');
    }

    /**
     * Tandai selesai
     */
    public function selesai($id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->status_layanan !== 'siap_diambil') {
            return back()->with('error', 'Surat belum siap diselesaikan.');
        }

        $layanan->update([
            'status_layanan' => 'selesai'
        ]);

        return back()->with('success', 'Layanan berhasil diselesaikan.');
    }

    /**
     * Halaman Ubah/Edit Layanan
     */
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('pelayanan.layanan.edit', compact('layanan'));
    }

    /**
     * Proses Update Layanan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_layanan'         => 'nullable|string|max:255',
            'status_layanan'        => 'nullable',
            'pengiriman_layanan'    => 'nullable',
            'nomor_surat'           => 'nullable|string',
            'tanggal_surat'         => 'nullable|date',
            'nama_penandatangan'    => 'nullable|string',
            'jabatan_penandatangan' => 'nullable|string',
            'isi_surat'             => 'nullable|string',
            'file_surat'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // Sesuaikan nama ke file_surat
        ]);

        $layanan = Layanan::findOrFail($id);

        $data = $request->except(['_token', '_method', 'file_surat']);

        if ($request->hasFile('file_surat')) {
            if ($layanan->file_surat && Storage::disk('public')->exists($layanan->file_surat)) {
                Storage::disk('public')->delete($layanan->file_surat);
            }

            $path = $request->file('file_surat')->store('surat-layanan', 'public');
            $data['file_surat'] = $path;
        }

        $layanan->update($data);

        return redirect()->route('pelayanan.layanan.index')
            ->with('success', 'Data layanan berhasil diperbarui.');
    }

    /**
     * Hapus Layanan
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        if (
            !empty($layanan->file_surat) &&
            Storage::disk('public')->exists($layanan->file_surat)
        ) {
            Storage::disk('public')->delete($layanan->file_surat);
        }

        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus.');
    }

    public function riwayat(Request $request)
    {
        $query = Layanan::onlyTrashed()
            ->with('user');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('jenis_layanan', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('nama_lengkap', 'like', "%{$search}%");
                    });
            });
        }

        $layanan = $query
            ->latest('deleted_at')
            ->paginate(10)
            ->withQueryString();

        return view(
            'pelayanan.layanan.riwayat',
            compact('layanan')
        );
    }

    public function restore($id)
    {
        $layanan = Layanan::onlyTrashed()
            ->findOrFail($id);

        $layanan->restore();

        return back()->with(
            'success',
            'Layanan berhasil dipulihkan.'
        );
    }
}