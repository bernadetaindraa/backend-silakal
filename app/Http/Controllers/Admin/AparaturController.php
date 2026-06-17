<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aparatur;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatPendidikan;

class AparaturController extends Controller
{
    // ADMIN - Form Create
    public function create()
    {
        return view('admin.aparatur.create');
    }

    // ADMIN - Store
    public function store(Request $request)
    {
        $validated = $request->validate([

            'user_id' => 'required|exists:users,user_id',
            'nama_jabatan' => 'required|string|max:255',

            'pendidikan' => 'nullable|array',
            'pendidikan.*.tingkat_pendidikan' => 'required|string|max:255',
            'pendidikan.*.jurusan' => 'nullable|string|max:255',
            'pendidikan.*.nama_instansi' => 'required|string|max:255',
            'pendidikan.*.tahun_masuk' => 'required|digits:4',
            'pendidikan.*.tahun_selesai' => 'required|digits:4',

            'riwayat_jabatan' => 'nullable|array',
            'riwayat_jabatan.*.nama_jabatan' => 'required|string|max:255',
            'riwayat_jabatan.*.nomor_sk' => 'required|string|max:255',
            'riwayat_jabatan.*.tanggal_mulai' => 'required|date',
            'riwayat_jabatan.*.tanggal_selesai' => 'nullable|date',
        ]);

        $aparatur = Aparatur::create([
            'user_id' => $validated['user_id'],
            'nama_jabatan' => $validated['nama_jabatan'],
        ]);

        if (!empty($validated['pendidikan'])) {

            foreach ($validated['pendidikan'] as $pendidikan) {

                $aparatur->riwayatPendidikan()->create([
                    'tingkat_pendidikan' => $pendidikan['tingkat_pendidikan'],
                    'jurusan' => $pendidikan['jurusan'] ?? null,
                    'nama_instansi' => $pendidikan['nama_instansi'],
                    'tahun_masuk' => $pendidikan['tahun_masuk'],
                    'tahun_selesai' => $pendidikan['tahun_selesai'],
                ]);
            }
        }

        if (!empty($validated['riwayat_jabatan'])) {

            foreach ($validated['riwayat_jabatan'] as $jabatan) {

                $aparatur->riwayatJabatan()->create([
                    'nama_jabatan' => $jabatan['nama_jabatan'],
                    'nomor_sk' => $jabatan['nomor_sk'],
                    'tanggal_mulai' => $jabatan['tanggal_mulai'],
                    'tanggal_selesai' => $jabatan['tanggal_selesai'] ?? null,
                ]);
            }
        }

        return redirect()
                ->route('admin.aparatur.index')
                ->with('success', 'Data aparatur berhasil ditambahkan');
    }

    // ADMIN - Form Edit
    public function edit($id)
    {
        $aparatur = Aparatur::with([
                        'user',
                        'riwayatPendidikan',
                        'riwayatJabatan'
                    ])
                    ->findOrFail($id);

        return view('admin.aparatur.edit', compact('aparatur'));
    }

    // ADMIN - Update
    public function update(Request $request, $id)
    {
        $aparatur = Aparatur::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'nama_jabatan' => 'required|string|max:255',
        ]);

        $aparatur->update($validated);

        $aparatur->riwayatPendidikan()->delete();
        $aparatur->riwayatJabatan()->delete();

        if ($request->pendidikan) {

            foreach ($request->pendidikan as $pendidikan) {

                $aparatur->riwayatPendidikan()->create($pendidikan);
            }
        }

        if ($request->riwayat_jabatan) {

            foreach ($request->riwayat_jabatan as $jabatan) {

                $aparatur->riwayatJabatan()->create($jabatan);
            }
        }

        return redirect()
                ->route('admin.aparatur.index')
                ->with('success', 'Data aparatur berhasil diperbarui');
    }

    // ADMIN - Delete
    public function destroy($id)
    {
        $aparatur = Aparatur::findOrFail($id);

        $aparatur->delete();

        return redirect()
                ->back()
                ->with('success', 'Data aparatur berhasil dihapus');
    }

    // ADMIN - Trash
    public function trashed()
    {
        $aparatur = Aparatur::onlyTrashed()
                        ->latest('deleted_at')
                        ->get();

        return view('admin.aparatur.trashed', compact('aparatur'));
    }

    // ADMIN - Restore
    public function restore($id)
    {
        Aparatur::onlyTrashed()
                ->findOrFail($id)
                ->restore();

        return redirect()
                ->back()
                ->with('success', 'Data aparatur berhasil direstore');
    }

    // ADMIN - Force Delete
    public function forceDelete($id)
    {
        $aparatur = Aparatur::onlyTrashed()
                        ->findOrFail($id);

        $aparatur->riwayatPendidikan()->forceDelete();
        $aparatur->riwayatJabatan()->forceDelete();

        $aparatur->forceDelete();

        return redirect()
                ->back()
                ->with('success', 'Data aparatur berhasil dihapus permanen');
    }
}
