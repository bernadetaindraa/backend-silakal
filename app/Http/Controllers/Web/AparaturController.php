<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Aparatur;
use Illuminate\Http\Request;

class AparaturController extends Controller
{
    // PUBLIC - List Aparatur
    public function index(Request $request)
    {
        $query = Aparatur::with([
            'user',
            'riwayatJabatan',
            'riwayatPendidikan'
        ]);

        // SEARCH
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'nama_jabatan',
                    'like',
                    '%' . $request->search . '%'
                )

                ->orWhereHas('user', function ($user) use ($request) {

                    $user->where(
                        'nama_lengkap',
                        'like',
                        '%' . $request->search . '%'
                    );
                });
            });
        }

        // FILTER KATEGORI
        if ($request->kategori) {

            switch ($request->kategori) {

                case 'pamong':
                    $query->whereIn('nama_jabatan', [
                        'Lurah',
                        'Carik',
                        'Jagabaya',
                        'Ulu-Ulu',
                        'Danarta',
                        'Kamituwa',
                        'Kaur Pangripta',
                        'Kaur Tata Laksana',
                    ]);
                    break;

                case 'dukuh':
                    $query->where('nama_jabatan', 'like', '%Dukuh%');
                    break;

                case 'staff':
                    $query->where('nama_jabatan', 'like', '%Staff%');
                    break;
            }
        }

        $aparatur = $query->latest()->get();

        return view('public.aparatur.index', compact('aparatur'));
    }

    // PUBLIC - Detail Aparatur
    public function show($id)
    {
        $aparatur = Aparatur::with([
                        'user',
                        'riwayatPendidikan',
                        'riwayatJabatan'
                    ])
                    ->findOrFail($id);

        return view('public.aparatur.detail', compact('aparatur'));
    }

    
}