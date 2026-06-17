<?php

namespace App\Http\Controllers\Dukuh;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $dusunId = auth()->user()->dusun_id;
        $query = User::with('role')->where('dusun_id', $dusunId);

        $sort = $request->get('sort', 'nama_lengkap');
        $direction = $request->get('direction', 'asc');
        
        $allowedSorts = ['nama_lengkap', 'nik'];
        $sort = in_array($sort, $allowedSorts) ? $sort : 'nama_lengkap';
        $direction = in_array(strtolower($direction), ['asc', 'desc']) ? $direction : 'asc';

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        $warga = $query->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('dukuh.warga.index', compact('warga'));
    }

    public function show($id)
    {
        $dusunId = auth()->user()->dusun_id;

        // Clean-up: Menggunakan User:: langsung karena namespace sudah di-import di atas
        $warga = User::where('dusun_id', $dusunId)->findOrFail($id);

        return view('dukuh.warga.show', compact('warga'));
    }
}