<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RtRw;
use Illuminate\Http\Request;

class RtRwController extends Controller
{
    // Ambil semua RT/RW
    public function index()
    {
        $data = RtRw::with('dusun')
                    ->latest()
                    ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data RT/RW berhasil diambil',
            'data' => $data
        ]);
    }

    // Ambil RT/RW berdasarkan dusun
    public function byDusun($dusun_id)
    {
        $data = RtRw::where('dusun_id', $dusun_id)
                    ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data RT/RW berdasarkan dusun',
            'data' => $data
        ]);
    }

    // Tambah RT/RW
    public function store(Request $request)
    {
        $request->validate([
            'dusun_id' => 'required|exists:dusun,dusun_id',
            'nama_rt' => 'required|string|max:10',
            'nama_rw' => 'required|string|max:10',
        ]);

        $data = RtRw::create([
            'dusun_id' => $request->dusun_id,
            'nama_rt' => $request->nama_rt,
            'nama_rw' => $request->nama_rw,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'RT/RW berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    // Detail RT/RW
    public function show($id)
    {
        $data = RtRw::with('dusun')
                    ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail RT/RW',
            'data' => $data
        ]);
    }

    // Update RT/RW
    public function update(Request $request, $id)
    {
        $data = RtRw::findOrFail($id);

        $request->validate([
            'dusun_id' => 'required|exists:dusun,dusun_id',
            'nama_rt' => 'required|string|max:10',
            'nama_rw' => 'required|string|max:10',
        ]);

        $data->update([
            'dusun_id' => $request->dusun_id,
            'nama_rt' => $request->nama_rt,
            'nama_rw' => $request->nama_rw,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'RT/RW berhasil diperbarui',
            'data' => $data
        ]);
    }

    // Soft delete
    public function destroy($id)
    {
        $data = RtRw::findOrFail($id);

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'RT/RW berhasil dihapus'
        ]);
    }

    // Menampilkan data terhapus
    public function trashed()
    {
        $data = RtRw::onlyTrashed()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data RT/RW terhapus',
            'data' => $data
        ]);
    }

    // Restore
    public function restore($id)
    {
        $data = RtRw::onlyTrashed()
                    ->findOrFail($id);

        $data->restore();

        return response()->json([
            'success' => true,
            'message' => 'RT/RW berhasil direstore'
        ]);
    }

    // Force delete
    public function forceDelete($id)
    {
        $data = RtRw::onlyTrashed()
                    ->findOrFail($id);

        $data->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'RT/RW berhasil dihapus permanen'
        ]);
    }
}