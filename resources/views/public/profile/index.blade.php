@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-[#F4F7FB] py-10 font-['Montserrat']">

    <div class="max-w-6xl mx-auto px-4">

        {{-- HEADER PROFILE --}}
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#1D2059] via-[#28306F] to-[#3949AB] shadow-2xl">

            {{-- BACKGROUND DECOR --}}
            <div class="absolute -top-20 -right-20 w-72 h-72 bg-white/10 rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-56 h-56 bg-white/5 rounded-full"></div>

            <div class="relative z-10 p-8 md:p-10">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                    {{-- PROFILE --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-6">

                        {{-- FOTO --}}
                        <div class="relative">

                            @if(Auth::user()->url_foto_profil)

                                <img
                                    src="{{ asset('storage/' . Auth::user()->url_foto_profil) }}"
                                    class="w-32 h-32 rounded-3xl object-cover border-4 border-white shadow-xl"
                                >

                            @else

                                <div class="w-32 h-32 rounded-3xl bg-white/20 backdrop-blur flex items-center justify-center text-5xl font-bold text-white border border-white/20 shadow-xl">
                                    {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}
                                </div>

                            @endif

                            <div class="absolute -bottom-2 -right-2 bg-green-500 border-4 border-white w-8 h-8 rounded-full"></div>

                        </div>

                        {{-- INFO --}}
                        <div>

                            <div class="flex flex-wrap items-center gap-3">

                                <h1 class="text-3xl md:text-4xl font-extrabold text-white">
                                    {{ Auth::user()->nama_lengkap }}
                                </h1>

                                <span class="px-4 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-bold text-white backdrop-blur">
                                    {{ Auth::user()->role->nama_role ?? 'User' }}
                                </span>

                            </div>

                            <p class="text-blue-100 mt-3 text-sm md:text-base">
                                {{ Auth::user()->email }}
                            </p>

                            <div class="flex flex-wrap gap-3 mt-5">

                                <div class="px-4 py-2 rounded-2xl bg-white/10 backdrop-blur border border-white/10">
                                    <p class="text-[11px] uppercase tracking-wider text-blue-100">
                                        NIK
                                    </p>

                                    <p class="font-semibold text-white text-sm mt-1">
                                        {{ Auth::user()->nik ?? '-' }}
                                    </p>
                                </div>

                                <div class="px-4 py-2 rounded-2xl bg-white/10 backdrop-blur border border-white/10">
                                    <p class="text-[11px] uppercase tracking-wider text-blue-100">
                                        Dusun
                                    </p>

                                    <p class="font-semibold text-white text-sm mt-1">
                                        {{ Auth::user()->dusun->nama_dusun ?? '-' }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div>

                        <a href="{{ route('profile.edit') }}"
                            class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-white text-[#1D2059] font-bold shadow-lg hover:scale-[1.02] hover:bg-blue-50 transition duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5h2m-1 0v14m-7-7h14"/>
                            </svg>

                            Edit Profil

                        </a>

                    </div>

                </div>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">

            {{-- BIODATA --}}
            <div class="lg:col-span-2">

                <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 p-8">

                    <div class="flex items-center justify-between mb-8">

                        <div>

                            <h2 class="text-2xl font-bold text-[#1D2059]">
                                Biodata Pengguna
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Informasi lengkap akun pengguna
                            </p>

                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        @php
                            $user = Auth::user();
                        @endphp

                        @foreach([
                            'Nama Lengkap' => $user->nama_lengkap,
                            'Email' => $user->email,
                            'NIK' => $user->nik,
                            'Nomor Telepon' => $user->nomor_telepon,
                            'Tempat Lahir' => $user->tempat_lahir,
                            'Tanggal Lahir' => optional($user->tanggal_lahir)->format('d F Y'),
                            'Jenis Kelamin' => $user->jenis_kelamin,
                            'Agama' => $user->agama,
                            'Pekerjaan' => $user->pekerjaan,
                            'Pendidikan Terakhir' => $user->pendidikan_terakhir,
                            'Status Perkawinan' => $user->status_perkawinan,
                            'Dusun' => $user->dusun->nama_dusun ?? '-',
                            'Role' => $user->role->nama_role ?? '-',
                        ] as $label => $value)

                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">

                                <p class="text-xs uppercase tracking-wider text-gray-400 font-semibold">
                                    {{ $label }}
                                </p>

                                <p class="mt-2 text-sm font-bold text-gray-700">
                                    {{ $value ?: '-' }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

            {{-- SIDE INFO --}}
            <div class="space-y-6">

                {{-- ACCOUNT STATUS --}}
                <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 p-6">

                    <h3 class="text-lg font-bold text-[#1D2059] mb-5">
                        Status Akun
                    </h3>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-gray-500">
                                Status
                            </span>

                            <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold border border-green-100">
                                Aktif
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-gray-500">
                                Bergabung
                            </span>

                            <span class="text-sm font-semibold text-gray-700">
                                {{ Auth::user()->created_at->format('d M Y') }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- SECURITY --}}
                <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 p-6">

                    <h3 class="text-lg font-bold text-[#1D2059] mb-5">
                        Keamanan
                    </h3>

                    <div class="space-y-3">

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center justify-center w-full py-3 rounded-2xl border border-gray-200 hover:border-[#1D2059] hover:bg-[#1D2059]/5 transition text-sm font-semibold text-gray-700">
                            Ubah Password
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button
                                type="submit"
                                class="w-full py-3 rounded-2xl border border-red-200 hover:bg-red-50 transition text-sm font-semibold text-red-600"
                            >
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection