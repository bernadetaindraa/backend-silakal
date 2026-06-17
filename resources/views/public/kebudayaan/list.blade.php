{{-- resources/views/public/kebudayaan/list.blade.php --}}
@extends('layouts.public')

@section('content')

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    {{-- Banner menggunakan $jenisData --}}
    @include('public.partials.banner', [
        'title' => $jenisData->nama_jenis,
        'subtitle' => 'ꦏꦼꦧꦸꦢꦪꦪꦤ꧀ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

        <div class="max-w-6xl mx-auto" x-data="{ search: '' }">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

                <div>

                    <nav class="text-xs text-gray-500 space-x-1 mb-2">
                        <a href="/" class="hover:underline">Beranda</a>
                        <span>&gt;</span>
                        
                        {{-- Logika untuk kembali ke Menu Benda / Non Benda --}}
                        @if($jenisData->kategori_kebudayaan_id == 1)
                            <a href="{{ route('kebudayaan.benda') ?? '#' }}" class="hover:underline">
                                Kebudayaan Benda
                            </a>
                        @else
                            <a href="{{ route('kebudayaan.non-benda') ?? '#' }}" class="hover:underline">
                                Kebudayaan Non Benda
                            </a>
                        @endif

                        <span>&gt;</span>
                        <span class="text-blue-600">
                            {{ $jenisData->nama_jenis }}
                        </span>
                    </nav>

                    <h1 class="text-2xl md:text-3xl font-bold text-[#1D2059]">
                        {{ $jenisData->nama_jenis }}
                    </h1>

                </div>

                <div class="relative w-full md:w-72">

                    <input 
                        type="text"
                        x-model="search"
                        placeholder="Cari kebudayaan..."
                        class="w-full pl-11 pr-4 py-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm bg-white"
                    >

                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-3.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full text-left border-collapse">
                        <thead>

                            <tr class="bg-[#F8FAFC] text-sm font-bold text-[#1D2059] border-b border-gray-200">
                                <th class="px-6 py-4 text-center w-16">No</th>
                                <th class="px-6 py-4">Kebudayaan</th>
                                <th class="px-6 py-4">Jenis</th>
                                <th class="px-6 py-4 text-center">Tahun</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>

                        </thead>

                        <tbody class="text-sm text-gray-700 divide-y divide-gray-100 bg-white">

                            @forelse($kebudayaan as $index => $item)

                                <tr
                                    x-show="
                                        '{{ strtolower($item->judul_kebudayaan) }}'.includes(search.toLowerCase()) ||
                                        '{{ strtolower($jenisData->nama_jenis) }}'.includes(search.toLowerCase()) ||
                                        '{{ strtolower($item->lokasi_kebudayaan ?? 'hargobinangun') }}'.includes(search.toLowerCase()) ||
                                        '{{ strtolower($item->tahun_ditetapkan ?? '-') }}'.includes(search.toLowerCase())
                                    "
                                    class="hover:bg-blue-50/40 transition duration-200"
                                >

                                    {{-- Nomor --}}
                                    <td class="px-6 py-5 text-center text-gray-500 font-medium">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- Nama + Lokasi --}}
                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-[#1D2059] text-[15px] leading-snug">
                                            {{ $item->judul_kebudayaan }}
                                        </div>

                                        <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-3.5 h-3.5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 
                                                    0l-4.243-4.243a8 8 0 1111.313 0z" />
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>

                                            <span>
                                                {{ $item->lokasi_kebudayaan ?? 'Hargobinangun' }}
                                            </span>

                                        </div>

                                    </td>

                                    {{-- Jenis --}}
                                    <td class="px-6 py-5">

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $jenisData->nama_jenis }}
                                        </span>

                                    </td>

                                    {{-- Tahun --}}
                                    <td class="px-6 py-5 text-center font-medium text-gray-700">
                                        {{ $item->tahun_ditetapkan ?? '-' }}
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-5 text-center">

                                        <a 
                                            href="{{ route('kebudayaan.show', $item->kebudayaan_id) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#1D4ED8] text-white text-xs font-semibold hover:bg-blue-800 transition shadow-sm"
                                        >
                                            Detail

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-3.5 h-3.5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="py-14 text-center">

                                        <div class="flex flex-col items-center justify-center text-gray-400">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-12 h-12 mb-3"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M9 17v-6h13M9 5v6h13M5 5h.01M5 12h.01M5 19h.01" />
                                            </svg>

                                            <p class="font-medium">
                                                Belum ada data kebudayaan
                                            </p>

                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection