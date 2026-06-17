<?php

namespace App\Http\Controllers\Dukuh;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LayananNotification;

class LayananController extends Controller
{
    private function notif($userId, $judul, $pesan)
    {
        $user = User::find($userId);

        if ($user) {
            Notification::send($user, new LayananNotification($judul, $pesan));
        }
    }

    public function index(Request $request)
    {
        $dusunId = auth()->user()->dusun_id;

        $query = Layanan::with('user')
            ->whereHas('user', function ($q) use ($dusunId) {
                $q->where('dusun_id', $dusunId);
            });

        // filter status
        if ($request->filled('status')) {
            $query->where('status_layanan', $request->status);
        } else {
            $query->where('status_layanan', 'menunggu');
        }

        $layanan = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('dukuh.layanan.index', compact('layanan'));
    }

    public function show($id)
    {
        $dusunId = auth()->user()->dusun_id;

        $layanan = Layanan::with([
                'user',
                'lampiranLayanan'
            ])
            ->whereHas('user', function ($q) use ($dusunId) {
                $q->where('dusun_id', $dusunId);
            })
            ->findOrFail($id);

        return view('dukuh.layanan.show', compact('layanan'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status_layanan' => 'required|in:diverifikasi,ditolak',
            'catatan_penolakan' => 'nullable|string|max:255'
        ]);

        $layanan = Layanan::findOrFail($id);

        $layanan->update([
            'status_layanan' => $request->status_layanan,
            'catatan_penolakan' => $request->catatan_penolakan
        ]);

        // notif beda isi
        if ($request->status_layanan === 'diverifikasi') {
            $judul = 'Permohonan Diverifikasi Dukuh';
            $pesan = "Permohonan {$layanan->nomor_layanan} telah diverifikasi.";
        } else {
            $judul = 'Permohonan Ditolak Dukuh';
            $pesan = "Permohonan {$layanan->nomor_layanan} ditolak. Alasan: {$request->catatan_penolakan}";
        }

        $this->notif($layanan->user_id, $judul, $pesan);

        return redirect()->back()->with(
            $request->status_layanan === 'diverifikasi' ? 'success' : 'error',
            'Status layanan berhasil diperbarui.'
        );
    }
}