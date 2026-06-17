@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-[#F4F7FB] py-10 font-['Montserrat']">

@php
    $user = Auth::user();
@endphp

<div class="max-w-6xl mx-auto px-4">

    {{-- HEADER PROFILE --}}
    <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#1D2059] via-[#28306F] to-[#3949AB] shadow-2xl">

        <div class="absolute -top-20 -right-20 w-72 h-72 bg-white/10 rounded-full"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 bg-white/5 rounded-full"></div>

        <div class="relative z-10 p-8 md:p-10">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                {{-- PROFILE --}}
                <div class="flex flex-col sm:flex-row sm:items-center gap-6">

                    {{-- FOTO --}}
                    <div class="relative">

                        @if($user->url_foto_profil)
                            <img src="{{ asset('storage/' . $user->url_foto_profil) }}"
                                 class="w-32 h-32 rounded-3xl object-cover border-4 border-white shadow-xl">
                        @else
                            <div class="w-32 h-32 rounded-3xl bg-white/20 backdrop-blur flex items-center justify-center text-5xl font-bold text-white border border-white/20 shadow-xl">
                                {{ strtoupper(substr($user->nama_lengkap ?? 'A', 0, 1)) }}
                            </div>
                        @endif

                        <div class="absolute -bottom-2 -right-2 bg-green-500 border-4 border-white w-8 h-8 rounded-full"></div>

                    </div>

                    {{-- INFO --}}
                    <div>

                        <div class="flex flex-wrap items-center gap-3">

                            <h1 class="text-3xl md:text-4xl font-extrabold text-white">
                                {{ $user->nama_lengkap }}
                            </h1>

                            <span class="px-4 py-1 rounded-full bg-white/15 border border-white/20 text-xs font-bold text-white backdrop-blur">
                                {{ $user->role->role_name ?? 'Admin' }}
                            </span>

                        </div>

                        <p class="text-blue-100 mt-3 text-sm md:text-base">
                            {{ $user->email }}
                        </p>

                        <div class="flex flex-wrap gap-3 mt-5">

                            <div class="px-4 py-2 rounded-2xl bg-white/10 backdrop-blur border border-white/10">
                                <p class="text-[11px] uppercase tracking-wider text-blue-100">NIK</p>
                                <p class="font-semibold text-white text-sm mt-1">
                                    {{ $user->nik ?? '-' }}
                                </p>
                            </div>

                            <div class="px-4 py-2 rounded-2xl bg-white/10 backdrop-blur border border-white/10">
                                <p class="text-[11px] uppercase tracking-wider text-blue-100">Dusun</p>
                                <p class="font-semibold text-white text-sm mt-1">
                                    {{ $user->dusun->nama_dusun ?? '-' }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">

        {{-- BIODATA --}}
        <div class="lg:col-span-2">

            <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 p-8">

                <h2 class="text-2xl font-bold text-[#1D2059] mb-8">
                    Biodata Pengguna
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    @php
                        $tanggalLahir = $user->tanggal_lahir
                            ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y')
                            : '-';
                    @endphp

                    @foreach([
                        'Nama Lengkap' => $user->nama_lengkap,
                        'Email' => $user->email,
                        'NIK' => $user->nik,
                        'Nomor Telepon' => $user->nomor_telepon,
                        'Tempat Lahir' => $user->tempat_lahir,
                        'Tanggal Lahir' => $tanggalLahir,
                        'Jenis Kelamin' => $user->jenis_kelamin,
                        'Agama' => $user->agama,
                        'Pekerjaan' => $user->pekerjaan,
                        'Pendidikan' => $user->pendidikan_terakhir,
                        'Status Perkawinan' => $user->status_perkawinan,
                        'Dusun' => $user->dusun->nama_dusun ?? '-',
                        'Role' => $user->role->role_name ?? '-',
                    ] as $label => $value)

                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">

                            <p class="text-xs uppercase tracking-wider text-gray-400 font-semibold">
                                {{ $label }}
                            </p>

                            <p class="mt-2 text-sm font-bold text-gray-700">
                                {{ $value ?? '-' }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

        {{-- SIDE --}}
        <div class="space-y-6">

            {{-- STATUS --}}
            <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 p-6">

                <h3 class="text-lg font-bold text-[#1D2059] mb-5">
                    Status Akun
                </h3>

                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">Status</span>
                    <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold">
                        Aktif
                    </span>
                </div>

                <div class="flex justify-between mt-3">
                    <span class="text-sm text-gray-500">Bergabung</span>
                    <span class="text-sm font-semibold text-gray-700">
                        {{ $user->created_at?->format('d M Y') }}
                    </span>
                </div>

            </div>

            {{-- SECURITY --}}
            <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 p-6">

                <h3 class="text-lg font-bold text-[#1D2059] mb-5">
                    Keamanan
                </h3>

                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit"
                            class="w-full py-3 rounded-2xl border border-red-200 hover:bg-red-50 text-sm font-semibold text-red-600">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

</div>

@endsection