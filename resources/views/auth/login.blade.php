@extends('layouts.public')

@section('content')
<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen py-10 px-4 sm:px-6 lg:px-8 flex justify-center items-center">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

        <!-- HEADER -->
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

        <!-- BODY -->
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

                <!-- EMAIL -->
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

                <!-- PASSWORD -->
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
                            class="w-full pl-11 pr-4 py-3 text-sm bg-gray-50 border rounded-2xl
                            @error('password') border-red-400 @else border-gray-200 @enderror
                            focus:outline-none focus:ring-2 focus:ring-[#1D2059]/20
                            focus:border-[#1D2059]
                            hover:border-gray-300
                            transition duration-200"
                        >

                    </div>

                    @error('password')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- REMEMBER -->
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

                <!-- BUTTON -->
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

            <!-- REGISTER -->
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
@endsection