<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('public.profile.index');
    }

    public function edit()
    {
        return view('public.profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'nomor_telepon' => 'nullable|string|max:20',
            'nik' => 'nullable|digits:16',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string',
            'agama' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'url_foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto profile
        if ($request->hasFile('url_foto_profil')) {

            // hapus foto lama jika ada
            if ($user->url_foto_profil && Storage::disk('public')->exists($user->url_foto_profil)) {

                Storage::disk('public')->delete($user->url_foto_profil);
            }

            // simpan foto baru
            $path = $request->file('url_foto_profil')
                ->store('profile', 'public');

            $validated['url_foto_profil'] = $path;
        }

        $user->update($validated);

        return redirect()
            ->route('profile')
            ->with('success', 'Profile berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
            ]
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf, angka, dan simbol.',
        ]);

        $user = Auth::user();

        // cek password lama
        if (!Hash::check($request->current_password, $user->password)) {

            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai'
            ])->withInput();
        }

        // update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()
            ->route('profile')
            ->with('success', 'Password berhasil diubah');
    }
}