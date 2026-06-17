<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BpkalAnggota;
use App\Models\Dusun;
use App\Models\User;
use App\Models\BpkalKegiatan;

class BpkalAnggotaController extends Controller
{
    public function index(Request $request)
    {
        $anggotaQuery = BpkalAnggota::with([
            'user',
            'dusun'
        ]);

        if ($request->search) {

            $anggotaQuery->where('jabatan', 'like', '%' . $request->search . '%')
                        ->orWhereHas('user', function ($q) use ($request) {

                            $q->where(
                                'nama_lengkap',
                                'like',
                                '%' . $request->search . '%'
                            );
                        });
        }

        $anggota = $anggotaQuery->latest()->get();

        return view('admin.bpka.index', compact('anggota'));
    }
    
    public function create()
    {
        $users = User::all();
        $dusun = Dusun::all();

        return view('admin.bpka.create', compact('users', 'dusun'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'jabatan' => 'required|string|max:255',

            'dusun_id' => 'required|array|min:1',
            'dusun_id.*' => 'exists:dusun,dusun_id',
        ]);

        $anggota = BpkalAnggota::create([
            'user_id' => $validated['user_id'],
            'jabatan' => $validated['jabatan'],
        ]);

        $anggota->dusun()->sync($validated['dusun_id']);

        return redirect('/admin/bpka')
            ->with('success', 'Anggota BPKAL berhasil ditambahkan');
    }

    public function show($id)
    {
        $anggota = BpkalAnggota::with([
            'user',
            'dusun'
        ])->findOrFail($id);

        return view('admin.bpka.detail', compact('anggota'));
    }

    public function edit($id)
    {
        $anggota = BpkalAnggota::with('dusun')->findOrFail($id);

        $users = User::all();
        $dusun = Dusun::all();

        return view('admin.bpka.edit', compact(
            'anggota',
            'users',
            'dusun'
        ));
    }

    public function update(Request $request, $id)
    {
        $anggota = BpkalAnggota::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'jabatan' => 'required|string|max:255',

            'dusun_id' => 'required|array|min:1',
            'dusun_id.*' => 'exists:dusun,dusun_id',
        ]);

        $anggota->update([
            'user_id' => $validated['user_id'],
            'jabatan' => $validated['jabatan'],
        ]);

        $anggota->dusun()->sync($validated['dusun_id']);

        return redirect('/admin/bpkal')
            ->with('success', 'Anggota BPKAL berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggota = BpkalAnggota::findOrFail($id);

        $anggota->delete();

        return redirect()->back()
            ->with('success', 'Anggota BPKAL berhasil dihapus');
    }

    public function trashed()
    {
        $anggota = BpkalAnggota::with([
            'user',
            'dusun'
        ])
        ->onlyTrashed()
        ->latest('deleted_at')
        ->get();

        return view('admin.bpka.trashed', compact('anggota'));
    }

    public function restore($id)
    {
        $anggota = BpkalAnggota::onlyTrashed()
            ->findOrFail($id);

        $anggota->restore();

        return redirect()->back()
            ->with('success', 'Anggota BPKAL berhasil direstore');
    }

    public function forceDelete($id)
    {
        $anggota = BpkalAnggota::onlyTrashed()
            ->findOrFail($id);

        $anggota->dusun()->detach();

        $anggota->forceDelete();

        return redirect()->back()
            ->with('success', 'Anggota BPKAL berhasil dihapus permanen');
    }
}
