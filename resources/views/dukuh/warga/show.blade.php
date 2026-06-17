@extends('layouts.admin')

@section('content')
<div class="p-4 md:p-6 space-y-6 max-w-6xl mx-auto">

    {{-- TOP BAR ACTIONS --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('dukuh.warga.index') }}" 
               class="p-2 bg-white border border-gray-200 rounded-xl text-gray-600 hover:text-[#1D2059] hover:border-[#1D2059] shadow-sm transition-all duration-200 group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen Warga</span>
                <h1 class="text-xl md:text-2xl font-bold text-[#1D2059] tracking-tight">Detail Informasi Warga</h1>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        {{-- SIDEBAR: PROFILE SUMMARY --}}
        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 flex flex-col items-center text-center">
            <div class="relative group">
                @if($warga->url_foto_profil)
                    <img src="{{ asset('storage/' . $warga->url_foto_profil) }}" alt="Foto {{ $warga->nama_lengkap }}" class="w-28 h-28 rounded-2xl object-cover ring-4 ring-gray-50 shadow-md">
                @else
                    <div class="w-28 h-28 rounded-2xl bg-[#1D2059]/10 flex items-center justify-center text-[#1D2059] text-3xl font-bold shadow-inner ring-4 ring-gray-50">
                        {{ strtoupper(substr($warga->nama_lengkap, 0, 1)) }}
                    </div>
                @endif
                <span class="absolute bottom-2 right-2 w-4 h-4 bg-green-500 border-2 border-white rounded-full title='Aktif'"></span>
            </div>

            <h2 class="text-xl font-bold text-[#1D2059] mt-4 tracking-tight">{{ $warga->nama_lengkap }}</h2>
            <span class="inline-flex items-center px-2.5 py-1 mt-1.5 rounded-full text-xs font-medium bg-[#1D2059]/10 text-[#1D2059]">
                {{ $warga->role?->role_name ?? 'Warga Dusun' }}
            </span>

            <hr class="w-full border-gray-100 my-5">

            <div class="w-full space-y-3 text-left">
                <div class="bg-gray-50 border border-gray-100 rounded-xl p-3.5">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Nomor Induk Kependudukan (NIK)</p>
                    <p class="font-mono text-gray-800 font-semibold tracking-wide text-base">{{ $warga->nik }}</p>
                </div>
            </div>
        </div>

        {{-- MAIN DATA CONTENT --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- DATA GROUP 1: INFORMASI PRIBADI --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-800">Biodata Pribadi</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-6">
                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</p>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ $warga->tempat_lahir ?? '-' }}, {{ $warga->tanggal_lahir ? $warga->tanggal_lahir->format('d M Y') : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Jenis Kelamin</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $warga->jenis_kelamin }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Agama</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $warga->agama }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Status Perkawinan</p>
                        <p class="text-sm font-semibold text-gray-800">
                            <span class="inline-flex px-2 py-0.5 bg-slate-100 rounded text-xs text-slate-700 font-medium">
                                {{ $warga->status_perkawinan }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- DATA GROUP 2: PEKERJAAN & PENDIDIKAN --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-800">Pekerjaan & Pendidikan</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-6">
                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Pekerjaan Utama</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $warga->pekerjaan ?? 'Tidak Bekerja / Belum Bekerja' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Pendidikan Terakhir</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $warga->pendidikan_terakhir ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- DATA GROUP 3: INFORMASI KONTAK --}}
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <h3 class="font-bold text-gray-800">Kontak Korespondensi</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-6">
                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Nomor Telepon / WA</p>
                        @if($warga->nomor_telepon)
                            <p class="text-sm font-semibold text-gray-800 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                {{ $warga->nomor_telepon }}
                            </p>
                        @else
                            <p class="text-sm text-gray-400 italic">Belum mengisi nomor telepon</p>
                        @endif
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Alamat Email</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $warga->email ?? '-' }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection