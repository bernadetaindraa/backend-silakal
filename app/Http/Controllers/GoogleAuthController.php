<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // CEK USER SUDAH ADA ATAU BELUM
        $user = User::where('email', $googleUser->email)->first();

        // ❌ JIKA BELUM ADA → TOLAK (tidak boleh register via Google)
        if (!$user) {
            return redirect('/login')->with('error', 'Akun belum terdaftar. Silakan daftar manual.');
        }

        // update google id
        $user->update([
            'google_id' => $googleUser->id
        ]);

        Auth::login($user); // SESSION LOGIN

        return redirect('/user/dashboard');
    }
}