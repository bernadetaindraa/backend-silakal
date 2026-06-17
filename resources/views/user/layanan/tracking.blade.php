@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    {{-- 1. Banner Utama: Disesuaikan dengan Halaman Layanan Administrasi --}}
    @include('public.partials.banner', [
        'title' => 'Layanan Administrasi Kalurahan Hargobinangun',
        'subtitle' => 'ꦭꦪꦤꦤ꧀ ꦲꦢ꧀ꦩꦶꦱ꧀ꦠꦿꦱꦶ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        {{-- 2. Breadcrumbs --}}
        <nav class="text-sm text-gray-500 mb-10">
            <a href="/" class="hover:text-blue-600 transition">Beranda</a> &gt; 
            <a href="#" class="hover:text-blue-600 transition">Layanan</a> &gt; 
            <span class="text-blue-600 font-medium">Tracking Layanan</span>
        </nav>

        {{-- 3. Judul Utama (Centered) --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-[#1D2059] tracking-tight">Tracking Pengajuan Layanan Administrasi</h1>
            <p class="text-base text-gray-500 mt-2">Pantau status dan perkembangan pengajuan Anda</p>
        </div>

        {{-- 4. Form Pencarian Nomor Layanan --}}
        <form action="{{ route('user.layanan.tracking') }}" method="GET" class="max-w-4xl mx-auto mb-12">
            <label for="nomor_layanan" class="block text-sm text-gray-600 mb-2 pl-1 lowercase">masukan nomor layanan</label>
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1">
                    <input type="text" id="nomor_layanan" name="nomor_layanan" 
                           value="{{ request('nomor_layanan') ?? ($layanan->nomor_layanan ?? '') }}" 
                           placeholder="Masukkan nomor layanan Anda" 
                           class="w-full px-6 py-3 bg-white border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400"
                           required>
                </div>
                <button type="submit" class="px-8 py-3 bg-[#1D2059] hover:bg-blue-900 text-white font-semibold rounded-full text-sm transition shadow-md whitespace-nowrap">
                    Cari
                </button>
            </div>
        </form>

        {{-- 5. Horizontal Stepper (Timeline Alur Berkas) --}}
        @php
            // Default step dimulai dari 0 (jika belum cari data atau data tidak ditemukan)
            $currentStep = 0; 
            $isDitolak = false;

            if (isset($layanan) && $layanan) {
                // DISESUAIKAN: Menggunakan kolom 'status_layanan' sesuai skema database Anda
                $status = strtolower($layanan->status_layanan); 

                switch ($status) {
                    case 'menunggu':
                        $currentStep = 1;
                        break;
                    case 'diverifikasi':
                        $currentStep = 2;
                        break;
                    case 'diproses':
                        $currentStep = 3;
                        break;
                    case 'siap_diambil':
                    case 'selesai':
                        $currentStep = 4;
                        break;
                    case 'ditolak':
                        $currentStep = 1; // Macet di step 1 jika ditolak
                        $isDitolak = true;
                        break;
                    default:
                        $currentStep = 1;
                }
            }
        @endphp

        <div class="max-w-5xl mx-auto mb-16 px-2 sm:px-4">
            <div class="relative">
                
                {{-- GARIS DASAR --}}
                <div class="absolute top-10 left-0 right-0 h-1 bg-gray-200 rounded-full"></div>

                {{-- GARIS AKTIF --}}
                <div
                    class="absolute top-10 left-0 h-1 rounded-full transition-all duration-700 ease-in-out
                    {{ $isDitolak ? 'bg-red-500' : 'bg-blue-600' }}"
                    style="
                        width:
                        @if($currentStep == 1)
                            0%
                        @elseif($currentStep == 2)
                            33%
                        @elseif($currentStep == 3)
                            66%
                        @elseif($currentStep >= 4)
                            100%
                        @else
                            0%
                        @endif
                    "
                ></div>

                {{-- STEP ITEMS --}}
                <div class="grid grid-cols-4 relative z-10">

                    {{-- STEP 1 --}}
                    <div class="flex flex-col items-center text-center">
                        <span class="text-[10px] sm:text-xs text-gray-500 mb-3 italic">
                            {{ $layanan?->created_at?->format('d M Y') ?? 'tanggal pengajuan' }}
                        </span>

                        <div class="w-5 h-5 rounded-full border-4 border-white shadow
                            {{ $currentStep >= 1
                                ? ($isDitolak
                                    ? 'bg-red-600'
                                    : 'bg-blue-600')
                                : 'bg-gray-300'
                            }}">
                        </div>

                        <p class="mt-3 text-[11px] sm:text-sm font-semibold px-2
                            {{ $currentStep >= 1
                                ? ($isDitolak
                                    ? 'text-red-600'
                                    : 'text-[#1D2059]')
                                : 'text-gray-400'
                            }}">
                            {{ $isDitolak ? 'Pengajuan Ditolak' : 'Pengajuan Layanan' }}
                        </p>
                    </div>

                    {{-- STEP 2 --}}
                    <div class="flex flex-col items-center text-center">
                        <span class="text-[10px] sm:text-xs text-gray-500 mb-3 italic">
                            tanggal verifikasi
                        </span>

                        <div class="w-5 h-5 rounded-full border-4 border-white shadow
                            {{ $currentStep >= 2 ? 'bg-blue-600' : 'bg-gray-300' }}">
                        </div>

                        <p class="mt-3 text-[11px] sm:text-sm font-semibold px-2
                            {{ $currentStep >= 2 ? 'text-[#1D2059]' : 'text-gray-400' }}">
                            Diverifikasi
                        </p>
                    </div>

                    {{-- STEP 3 --}}
                    <div class="flex flex-col items-center text-center">
                        <span class="text-[10px] sm:text-xs text-gray-500 mb-3 italic">
                            tanggal proses
                        </span>

                        <div class="w-5 h-5 rounded-full border-4 border-white shadow
                            {{ $currentStep >= 3 ? 'bg-blue-600' : 'bg-gray-300' }}">
                        </div>

                        <p class="mt-3 text-[11px] sm:text-sm font-semibold px-2
                            {{ $currentStep >= 3 ? 'text-[#1D2059]' : 'text-gray-400' }}">
                            Diproses
                        </p>
                    </div>

                    {{-- STEP 4 --}}
                    <div class="flex flex-col items-center text-center">
                        <span class="text-[10px] sm:text-xs text-gray-500 mb-3 italic">
                            tanggal selesai
                        </span>

                        <div class="w-5 h-5 rounded-full border-4 border-white shadow
                            {{ $currentStep >= 4 ? 'bg-green-600' : 'bg-gray-300' }}">
                        </div>

                        <p class="mt-3 text-[11px] sm:text-sm font-semibold px-2
                            {{ $currentStep >= 4 ? 'text-green-700' : 'text-gray-400' }}">
                            Selesai
                        </p>
                    </div>

                </div>

            </div>

        </div>

        {{-- 6. Tabel Status Tracking --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-5xl mx-auto">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100/80 text-xs font-bold uppercase tracking-wider text-gray-700 border-b border-gray-200">
                            <th class="p-4 w-16 text-center border-r border-gray-200">NO</th>
                            <th class="p-4 border-r border-gray-200">NO PENGAJUAN</th>
                            <th class="p-4 border-r border-gray-200">NAMA LAYANAN</th>
                            <th class="p-4 text-center border-r border-gray-200">STATUS</th>
                            <th class="p-4 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                        @if(isset($layanan) && $layanan)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="p-4 text-center text-gray-500 border-r border-gray-100">1</td>
                                <td class="p-4 font-mono text-xs text-gray-600 border-r border-gray-100">
                                    {{ $layanan->nomor_layanan }}
                                </td>
                                <td class="p-4 font-semibold text-[#1D2059] border-r border-gray-100">
                                    {{-- Menggunakan 'jenis_layanan' dengan fallback readable text --}}
                                    {{ $layanan->jenis_layanan_label ?? ucwords(str_replace('_', ' ', $layanan->jenis_layanan)) }}
                                </td>
                                <td class="p-4 text-center border-r border-gray-100">
                                    {{-- DISESUAIKAN: Menggunakan Switch Case berdasarkan 'status_layanan' database --}}
                                    @switch(strtolower($layanan->status_layanan))
                                        @case('menunggu')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-300">
                                                Menunggu
                                            </span>
                                            @break
                                        @case('diverifikasi')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                                Diverifikasi
                                            </span>
                                            @break
                                        @case('diproses')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-200 animate-pulse">
                                                Sedang Diproses
                                            </span>
                                            @break
                                        @case('siap_diambil')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                                Siap Diambil
                                            </span>
                                            @break
                                        @case('selesai')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                                Selesai
                                            </span>
                                            @break
                                        @case('ditolak')
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                                Ditolak
                                            </span>
                                            @break
                                        @default
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-gray-50 text-gray-600">
                                                {{ $layanan->status_layanan }}
                                            </span>
                                    @endswitch
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    @if(in_array(strtolower($layanan->status_layanan), ['siap_diambil', 'selesai']))

                                        @if($layanan->file_surat)
                                            <a href="{{ route('user.layanan.download', $layanan->layanan_id) }}"
                                            class="inline-flex items-center justify-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-md transition shadow-sm">
                                                Download File
                                            </a>
                                        @else
                                            <span class="text-xs text-amber-500 font-medium">
                                                File Belum Tersedia
                                            </span>
                                        @endif

                                    @elseif(strtolower($layanan->status_layanan) == 'ditolak')
                                        <span class="text-xs text-red-500 font-medium">
                                            Berkas Ditolak
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400 italic">
                                            Belum Tersedia
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @else
                            {{-- State kosong jika data belum ditemukan atau belum di-search --}}
                            <tr>
                                <td colspan="5" class="p-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="font-bold text-base text-gray-700">Belum ada riwayat permohonan yang dilacak.</p>
                                    <p class="text-xs text-gray-400 mt-1">Masukkan nomor layanan yang sah di atas untuk memantau status secara langsung.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection