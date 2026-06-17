<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Models\Dusun;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        $dusun = Dusun::all();

        return view('auth.register', compact('dusun'));
    }

    /**
     * Proses register user
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'dusun_id' => 'required|exists:dusun,dusun_id',
            'nik' => 'required|string|unique:users,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'pekerjaan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'status_perkawinan' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);

        // default role warga
        $validated['role_id'] = 3;

        // hash password
        $validated['password'] = Hash::make($validated['password']);

        // simpan user
        $user = User::create($validated);

        // login otomatis
        Auth::login($user);

        return redirect('/')
            ->with('success', 'Registrasi berhasil');
    }

    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($credentials)) {

            throw ValidationException::withMessages([
                'email' => 'Email atau password salah'
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // ROLE ADMIN
        if ($user->role_id == 1) {

            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login Admin berhasil');
        }

        // ROLE PELAYANAN
        if ($user->role_id == 2) {

            return redirect()
                ->route('pelayanan.dashboard')
                ->with('success', 'Login Pelayanan berhasil');
        }

        // ROLE DUKUH
        if ($user->role_id == 3) {

            return redirect()
                ->route('dukuh.dashboard')
                ->with('success', 'Login Dukuh berhasil');
        }

        // ROLE WARGA
        return redirect('/')
            ->with('success', 'Login berhasil');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Logout berhasil');
    }
}