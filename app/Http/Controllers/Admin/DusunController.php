<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Dusun;
use Illuminate\Http\Request;

class DusunController extends Controller
{
    public function index()
    {
        $dusun = Dusun::latest()->get();

        return view('admin.dusun.index', compact('dusun'));
    }

    public function create()
    {
        return view('admin.dusun.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:150|unique:dusun,nama_dusun',
        ]);

        Dusun::create($validated);

        return redirect()
            ->route('admin.dusun.index')
            ->with('success', 'Dusun berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $dusun = Dusun::findOrFail($id);

        return view('admin.dusun.detail', compact('dusun'));
    }

    public function edit(string $id)
    {
        $dusun = Dusun::findOrFail($id);

        return view('admin.dusun.edit', compact('dusun'));
    }

    public function update(Request $request, string $id)
    {
        $dusun = Dusun::findOrFail($id);

        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:150|unique:dusun,nama_dusun,' . $id . ',dusun_id',
        ]);

        $dusun->update($validated);

        return redirect()
            ->route('admin.dusun.index')
            ->with('success', 'Dusun berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $dusun = Dusun::findOrFail($id);

        $dusun->delete();

        return redirect()
            ->route('admin.dusun.index')
            ->with('success', 'Dusun berhasil dihapus');
    }
}