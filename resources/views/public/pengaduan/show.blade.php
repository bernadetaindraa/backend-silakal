@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    {{-- BANNER --}}
    @include('public.partials.banner', [
        'title' => 'Detail Pengaduan Masyarakat',
        'subtitle' => 'Pantau detail dan status tindak lanjut laporan Anda',
    ])

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- BREADCRUMB --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

            <nav class="text-sm text-gray-500">
                <a href="/" class="hover:text-blue-600 transition">
                    Beranda
                </a>

                &gt;

                <span class="text-gray-400">
                    Survey dan Pengaduan
                </span>

                &gt;

                <a href="{{ route('pengaduan') }}"
                   class="hover:text-blue-600 transition">
                    Daftar Pengaduan
                </a>

                &gt;

                <span class="text-blue-600 font-medium">
                    Detail
                </span>
            </nav>

            <a href="{{ route('pengaduan') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-[#1D2059] hover:text-blue-900 transition">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>

                Kembali ke Daftar

            </a>

        </div>

        {{-- CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- LEFT --}}
            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">

                    {{-- JENIS --}}
                    <span class="px-3 py-1 bg-purple-50 text-purple-700 rounded-md border border-purple-100 font-bold text-xs uppercase tracking-wider">

                        {{ $pengaduan->jenis_pengaduan }}

                    </span>

                    {{-- JUDUL --}}
                    <h1 class="text-2xl font-extrabold text-[#1D2059] mt-3 mb-6 leading-tight">

                        {{ $pengaduan->judul_pengaduan }}

                    </h1>

                    <hr class="border-gray-100 my-4">

                    {{-- ISI --}}
                    <div class="mb-6">

                        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">
                            Isi Pengaduan / Kronologi
                        </h3>

                        <p class="text-gray-700 leading-relaxed whitespace-pre-line text-sm sm:text-base">

                            {{ $pengaduan->isi_pengaduan }}

                        </p>

                    </div>

                    {{-- LOKASI --}}
                    <div class="mb-6 bg-gray-50 rounded-xl p-4 border border-gray-100">

                        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-1 flex items-center gap-1">

                            <svg class="w-3.5 h-3.5 text-gray-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>

                            </svg>

                            Lokasi Kejadian

                        </h3>

                        <p class="text-gray-700 text-sm font-medium">

                            {{ $pengaduan->lokasi_kejadian }}

                        </p>

                    </div>

                    {{-- FILE --}}
                    <div>

                        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">
                            Bukti Lampiran
                        </h3>

                        @if($pengaduan->fotoPengaduan->count() > 0)

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                @foreach($pengaduan->fotoPengaduan as $foto)

                                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-gray-50">

                                        @php
                                            $extension = pathinfo($foto->url_file_pengaduan, PATHINFO_EXTENSION);
                                        @endphp

                                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))

                                            <img
                                                src="{{ asset('storage/' . $foto->url_file_pengaduan) }}"
                                                class="w-full h-72 object-cover"
                                            >

                                        @elseif(strtolower($extension) == 'pdf')

                                            <div class="p-6 text-center">

                                                <p class="text-sm text-gray-600 mb-3">
                                                    File PDF
                                                </p>

                                                <a
                                                    href="{{ asset('storage/' . $foto->url_file_pengaduan) }}"
                                                    target="_blank"
                                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm transition"
                                                >
                                                    Lihat PDF
                                                </a>

                                            </div>

                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="flex items-center gap-2 p-4 bg-gray-50 rounded-xl text-gray-400 italic text-xs border border-gray-100">

                                Tidak ada lampiran bukti.

                            </div>

                        @endif

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-6">

                {{-- STATUS --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                    <h2 class="text-sm font-bold text-[#1D2059] mb-4 uppercase tracking-wider border-b border-gray-100 pb-2">

                        Status Penanganan

                    </h2>

                    {{-- BADGE --}}
                    <div class="mb-6 text-center py-4 bg-gray-50 rounded-xl border border-gray-100">

                        @switch(strtolower($pengaduan->status_pengaduan ?? 'menunggu'))

                            @case('menunggu')

                                <span class="inline-flex px-4 py-2 rounded-full text-sm font-extrabold bg-gray-100 text-gray-700 border border-gray-300">
                                    MENUNGGU
                                </span>

                            @break

                            @case('diproses')

                                <span class="inline-flex px-4 py-2 rounded-full text-sm font-extrabold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                    SEDANG DIPROSES
                                </span>

                            @break

                            @case('selesai')

                                <span class="inline-flex px-4 py-2 rounded-full text-sm font-extrabold bg-green-50 text-green-700 border border-green-200">
                                    SELESAI
                                </span>

                            @break

                            @case('ditolak')

                                <span class="inline-flex px-4 py-2 rounded-full text-sm font-extrabold bg-red-50 text-red-700 border border-red-200">
                                    DITOLAK
                                </span>

                            @break

                            @default

                                <span class="inline-flex px-4 py-2 rounded-full text-sm font-extrabold bg-gray-50 text-gray-600">

                                    {{ $pengaduan->status_pengaduan }}

                                </span>

                        @endswitch

                    </div>

                    {{-- DETAIL --}}
                    <div class="space-y-4 text-xs sm:text-sm">

                        <div class="flex justify-between items-start border-b border-gray-50 pb-2">

                            <span class="text-gray-400">
                                Tanggal Pengaduan
                            </span>

                            <span class="font-semibold text-gray-700">

                                {{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}

                            </span>

                        </div>

                        <div class="flex justify-between items-start border-b border-gray-50 pb-2">

                            <span class="text-gray-400">
                                Nama Pengadu
                            </span>

                            <span class="font-semibold text-gray-700">

                                {{ $pengaduan->nama_pengadu }}

                            </span>

                        </div>

                        <div class="flex justify-between items-start border-b border-gray-50 pb-2">

                            <span class="text-gray-400">
                                Kontak Pengadu
                            </span>

                            <span class="font-semibold text-blue-600">

                                {{ $pengaduan->kontak_pengadu }}

                            </span>

                        </div>

                        <div class="flex justify-between items-start">

                            <span class="text-gray-400">
                                Dibuat Pada
                            </span>

                            <span class="font-semibold text-gray-700">

                                {{ $pengaduan->created_at ? $pengaduan->created_at->format('d M Y H:i') : '-' }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection