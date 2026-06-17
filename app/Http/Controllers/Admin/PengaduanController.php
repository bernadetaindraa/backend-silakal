<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Pengaduan;
use App\Models\PengaduanFile;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('fotoPengaduan');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pengadu', 'like', '%' . $request->search . '%')
                    ->orWhere('judul_pengaduan', 'like', '%' . $request->search . '%')
                    ->orWhere('jenis_pengaduan', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi_kejadian', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status_pengaduan')) {
            $query->where('status_pengaduan', $request->status_pengaduan);
        }

        $data = $query->latest('tanggal_pengaduan')->get();

        return view('admin.pengaduan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pengaduan.create');
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
                ->route('admin.pengaduan.index')
                ->with('success', 'Pengaduan berhasil ditambahkan');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $pengaduan = Pengaduan::with('fotoPengaduan')
            ->findOrFail($id);

        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function edit(string $id)
    {
        $pengaduan = Pengaduan::with('fotoPengaduan')
            ->findOrFail($id);

        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, string $id)
    {
        $pengaduan = Pengaduan::with('fotoPengaduan')
            ->findOrFail($id);

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

            // hapus file lama jika upload file baru
            if ($request->hasFile('files')) {

                foreach ($pengaduan->fotoPengaduan as $foto) {

                    if (
                        $foto->url_file_pengaduan &&
                        Storage::disk('public')->exists($foto->url_file_pengaduan)
                    ) {
                        Storage::disk('public')->delete($foto->url_file_pengaduan);
                    }

                    $foto->forceDelete();
                }

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
                ->route('admin.pengaduan.index')
                ->with('success', 'Pengaduan berhasil diperbarui');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function updateStatus(Request $request, string $id)
    {
        $validated = $request->validate([
            'status_pengaduan' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->update([
            'status_pengaduan' => $validated['status_pengaduan'],
        ]);

        return back()->with(
            'success',
            'Status pengaduan berhasil diperbarui'
        );
    }

    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::with('fotoPengaduan')
            ->findOrFail($id);

        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }

    public function trashed()
    {
        $data = Pengaduan::with([
                'fotoPengaduan' => function ($query) {
                    $query->withTrashed();
                }
            ])
            ->onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('admin.pengaduan.trashed', compact('data'));
    }

    public function restore(string $id)
    {
        $pengaduan = Pengaduan::onlyTrashed()
            ->findOrFail($id);

        $pengaduan->restore();

        return back()->with(
            'success',
            'Pengaduan berhasil direstore'
        );
    }

    public function forceDelete(string $id)
    {
        $pengaduan = Pengaduan::withTrashed()
            ->with([
                'fotoPengaduan' => function ($query) {
                    $query->withTrashed();
                }
            ])
            ->findOrFail($id);

        foreach ($pengaduan->fotoPengaduan as $foto) {

            if (
                $foto->url_file_pengaduan &&
                Storage::disk('public')->exists($foto->url_file_pengaduan)
            ) {
                Storage::disk('public')->delete($foto->url_file_pengaduan);
            }

            $foto->forceDelete();
        }

        $pengaduan->forceDelete();

        return back()->with(
            'success',
            'Pengaduan berhasil dihapus permanen'
        );
    }

    public function laporan(Request $request)
    {
        $query = Pengaduan::with('fotoPengaduan');

        if ($request->filled('status_pengaduan')) {
            $query->where(
                'status_pengaduan',
                $request->status_pengaduan
            );
        }

        if ($request->filled('jenis_pengaduan')) {
            $query->where(
                'jenis_pengaduan',
                $request->jenis_pengaduan
            );
        }

        if (
            $request->filled('tanggal_awal') &&
            $request->filled('tanggal_akhir')
        ) {
            $query->whereBetween('tanggal_pengaduan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->latest('tanggal_pengaduan')->get();

        return view('admin.pengaduan.laporan', compact('data'));
    }
}