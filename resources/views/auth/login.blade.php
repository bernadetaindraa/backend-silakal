@extends('layouts.public')

@section('content')
<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen py-10 px-4 sm:px-6 lg:px-8 flex justify-center items-center">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

        <div class="bg-[#1D2059] px-8 py-9 text-white text-center relative overflow-hidden">

            <div class="absolute -left-10 -top-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>

            <div class="relative z-10 flex flex-col items-center">

                <div class="w-14 h-14 bg-white rounded-2xl p-2 shadow-lg mb-4">
                    <img 
                        src="{{ asset('images/logo-kabupaten.png') }}"
                        alt="Logo Kabupaten"
                        class="w-full h-full object-contain"
                    >
                </div>

                <p class="text-[11px] uppercase tracking-[0.3em] text-blue-100 font-medium">
                    Sistem Informasi Layanan
                </p>

                <h1 class="text-2xl font-bold mt-2 tracking-wide">
                    Kalurahan Hargobinangun
                </h1>

                <p class="text-[11px] text-blue-200 mt-2 italic tracking-widest">
                    ꦏꦭꦸꦫꦃꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀
                </p>

            </div>
        </div>

        <div class="px-8 py-8 sm:px-10">

            <div class="mb-7">
                <h2 class="text-2xl font-bold text-[#1D2059]">
                    Selamat Datang
                </h2>

                <p class="text-sm text-gray-400 mt-1 leading-relaxed">
                    Silakan masuk menggunakan akun warga yang telah terverifikasi.
                </p>
            </div>

            {{-- GLOBAL ERROR --}}
            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-100 rounded-2xl p-4">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-xs text-red-600">
                                • {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="mb-5 bg-green-50 border border-green-100 rounded-2xl p-4">
                    <p class="text-xs text-green-700">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <form action="{{ route('login.post') }}"
                  method="POST"
                  autocomplete="off"
                  class="space-y-5">

                @csrf

                <div>
                    <label 
                        for="email"
                        class="block text-[11px] font-semibold uppercase tracking-wider text-gray-700 mb-1.5"
                    >
                        Email
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email Anda"
                            required
                            autofocus
                            class="w-full pl-11 pr-4 py-3 text-sm bg-gray-50 border rounded-2xl
                            @error('email') border-red-400 @else border-gray-200 @enderror
                            focus:outline-none focus:ring-2 focus:ring-[#1D2059]/20
                            focus:border-[#1D2059]
                            hover:border-gray-300
                            transition duration-200"
                        >

                    </div>

                    @error('email')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>

                    <div class="flex justify-between items-center mb-1.5">
                        <label
                            for="password"
                            class="block text-[11px] font-semibold uppercase tracking-wider text-gray-700"
                        >
                            Password
                            <span class="text-red-500">*</span>
                        </label>
                    </div>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            class="w-full pl-11 pr-12 py-3 text-sm bg-gray-50 border rounded-2xl
                            @error('password') border-red-400 @else border-gray-200 @enderror
                            focus:outline-none focus:ring-2 focus:ring-[#1D2059]/20
                            focus:border-[#1D2059]
                            hover:border-gray-300
                            transition duration-200"
                        >

                        <button 
                            type="button" 
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-[#1D2059] focus:outline-none transition-colors"
                        >
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eye-slash-icon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>

                    </div>

                    @error('password')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">

                    <label class="inline-flex items-center cursor-pointer">
                        <input
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-[#1D2059] focus:ring-[#1D2059]"
                        >

                        <span class="ml-2 text-xs text-gray-500">
                            Ingat saya
                        </span>
                    </label>

                </div>

                <div class="pt-2">

                    <button
                        type="submit"
                        class="w-full py-3 rounded-2xl bg-[#1D2059]
                        hover:bg-[#161847]
                        text-white text-sm font-semibold uppercase tracking-wide
                        shadow-lg shadow-blue-900/10
                        hover:shadow-xl
                        transition duration-300"
                    >
                        Masuk Sistem
                    </button>

                </div>

            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">

                <p class="text-xs text-gray-500">
                    Belum memiliki akun warga?
                </p>

                <a
                    href="{{ route('register') }}"
                    class="mt-2 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700 transition"
                >
                    Buat Akun Baru →
                </a>

            </div>

        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeSlashIcon = document.getElementById('eye-slash-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeSlashIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeSlashIcon.classList.add('hidden');
        }
    }
</script>
@endsection