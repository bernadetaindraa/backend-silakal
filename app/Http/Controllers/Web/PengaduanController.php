<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\PengaduanFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('fotoPengaduan');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pengadu', 'like', '%' . $request->search . '%')
                  ->orWhere('judul_pengaduan', 'like', '%' . $request->search . '%')
                  ->orWhere('jenis_pengaduan', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi_kejadian', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status_pengaduan) {
            $query->where('status_pengaduan', $request->status_pengaduan);
        }

        $data = $query->latest('tanggal_pengaduan')->get();

        return view('public.pengaduan.index', compact('data'));
    }

    public function create()
    {
        return view('public.pengaduan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'tanggal_pengaduan' => 'required|date',
            'nama_pengadu' => 'required|string|max:255',
            'kontak_pengadu' => 'required|string|max:255',
            'jenis_pengaduan' => 'required|string|max:255',
            'judul_pengaduan' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'lokasi_kejadian' => 'required|string|max:255',
            'status_pengaduan' => 'nullable|in:Menunggu,Diproses,Selesai,Ditolak',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $pengaduan = Pengaduan::create([
                'user_id' => $validated['user_id'],
                'tanggal_pengaduan' => $validated['tanggal_pengaduan'],
                'nama_pengadu' => $validated['nama_pengadu'],
                'kontak_pengadu' => $validated['kontak_pengadu'],
                'jenis_pengaduan' => $validated['jenis_pengaduan'],
                'judul_pengaduan' => $validated['judul_pengaduan'],
                'isi_pengaduan' => $validated['isi_pengaduan'],
                'lokasi_kejadian' => $validated['lokasi_kejadian'],
                'status_pengaduan' => $validated['status_pengaduan'] ?? 'Menunggu',
            ]);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('pengaduan', 'public');

                    PengaduanFile::create([
                        'pengaduan_id' => $pengaduan->pengaduan_id,
                        'url_file_pengaduan' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('pengaduan')
                ->with('success', 'Pengaduan berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $pengaduan = Pengaduan::with('fotoPengaduan')
            ->findOrFail($id);

        return view(
            'public.pengaduan.show',
            compact('pengaduan')
        );
    }

    public function edit(string $id)
    {
        $pengaduan = Pengaduan::with('fotoPengaduan')->findOrFail($id);

        return view('public.pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, string $id)
    {
        $pengaduan = Pengaduan::with('fotoPengaduan')->findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'tanggal_pengaduan' => 'required|date',
            'nama_pengadu' => 'required|string|max:255',
            'kontak_pengadu' => 'required|string|max:255',
            'jenis_pengaduan' => 'required|string|max:255',
            'judul_pengaduan' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'lokasi_kejadian' => 'required|string|max:255',
            'status_pengaduan' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $pengaduan->update([
                'user_id' => $validated['user_id'],
                'tanggal_pengaduan' => $validated['tanggal_pengaduan'],
                'nama_pengadu' => $validated['nama_pengadu'],
                'kontak_pengadu' => $validated['kontak_pengadu'],
                'jenis_pengaduan' => $validated['jenis_pengaduan'],
                'judul_pengaduan' => $validated['judul_pengaduan'],
                'isi_pengaduan' => $validated['isi_pengaduan'],
                'lokasi_kejadian' => $validated['lokasi_kejadian'],
                'status_pengaduan' => $validated['status_pengaduan'],
            ]);

            foreach ($pengaduan->fotoPengaduan as $foto) {
                Storage::disk('public')->delete($foto->url_file_pengaduan);
                $foto->forceDelete();
            }

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('pengaduan', 'public');

                    PengaduanFile::create([
                        'pengaduan_id' => $pengaduan->pengaduan_id,
                        'url_file_pengaduan' => $path,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('pengaduan.index')
                ->with('success', 'Pengaduan berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function updateStatus(Request $request, string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $validated = $request->validate([
            'status_pengaduan' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
        ]);

        $pengaduan->update([
            'status_pengaduan' => $validated['status_pengaduan']
        ]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::with('fotoPengaduan')->findOrFail($id);

        $pengaduan->fotoPengaduan()->delete();
        $pengaduan->delete();

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }

    public function trashed()
    {
        $data = Pengaduan::with('fotoPengaduan')
            ->onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('public.pengaduan.trashed', compact('data'));
    }

    public function restore(string $id)
    {
        $pengaduan = Pengaduan::onlyTrashed()->findOrFail($id);

        $pengaduan->restore();
        $pengaduan->fotoPengaduan()->restore();

        return back()->with('success', 'Pengaduan berhasil direstore');
    }

    public function forceDelete(string $id)
    {
        $pengaduan = Pengaduan::withTrashed()
            ->with('fotoPengaduan')
            ->findOrFail($id);

        foreach ($pengaduan->fotoPengaduan as $foto) {
            Storage::disk('public')->delete($foto->url_file_pengaduan);
            $foto->forceDelete();
        }

        $pengaduan->forceDelete();

        return back()->with('success', 'Pengaduan berhasil dihapus permanen');
    }

    public function laporan(Request $request)
    {
        $query = Pengaduan::with('fotoPengaduan');

        if ($request->status_pengaduan) {
            $query->where('status_pengaduan', $request->status_pengaduan);
        }

        if ($request->jenis_pengaduan) {
            $query->where('jenis_pengaduan', $request->jenis_pengaduan);
        }

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal_pengaduan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->latest('tanggal_pengaduan')->get();

        return view('public.pengaduan.laporan', compact('data'));
    }
}