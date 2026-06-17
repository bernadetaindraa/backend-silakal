@extends('layouts.public')

@section('content')
<style> [x-cloak] { display: none !important; } </style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">
    
    @include('public.partials.banner', [
        'title' => 'Aparatur Kalurahan Hargobinangun',
        'subtitle' => 'ꦄꦥꦫꦠꦸꦂ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦁꦒꦸꦤ꧀',
    ])

<div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        
        <div class="mb-8">
            <h5 class="text-3xl font-bold text-blue-900">Data Pamong dan Aparatur</h5>
            <p class="text-gray-600">Struktur Organisasi dan Data Aparatur Kalurahan</p>
        </div>

        <div x-data="{ visible: 12, search: '' }">

        {{-- FILTER + SEARCH --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">

            {{-- FILTER --}}
            <div class="flex flex-wrap gap-2">
                
                {{-- SEMUA --}}
                <a
                    href="{{ route('aparatur.index') }}"
                    class="px-5 py-2 rounded-full text-sm font-semibold transition
                    {{ !request('kategori')
                        ? 'bg-blue-900 text-white'
                        : 'bg-white text-gray-700 hover:bg-gray-100 border shadow-sm' }}"
                >
                    Semua
                </a>

                {{-- PAMONG --}}
                <a
                    href="{{ route('aparatur.index', [
                        'kategori' => 'pamong',
                        'search' => request('search')
                    ]) }}"
                    class="px-5 py-2 rounded-full text-sm font-semibold transition
                    {{ request('kategori') == 'pamong'
                        ? 'bg-blue-900 text-white'
                        : 'bg-white text-gray-700 hover:bg-gray-100 border shadow-sm' }}"
                >
                    Pamong
                </a>

                {{-- DUKUH --}}
                <a
                    href="{{ route('aparatur.index', [
                        'kategori' => 'dukuh',
                        'search' => request('search')
                    ]) }}"
                    class="px-5 py-2 rounded-full text-sm font-semibold transition
                    {{ request('kategori') == 'dukuh'
                        ? 'bg-blue-900 text-white'
                        : 'bg-white text-gray-700 hover:bg-gray-100 border shadow-sm' }}"
                >
                    Dukuh
                </a>

                {{-- STAFF --}}
                <a
                    href="{{ route('aparatur.index', [
                        'kategori' => 'staff',
                        'search' => request('search')
                    ]) }}"
                    class="px-5 py-2 rounded-full text-sm font-semibold transition
                    {{ request('kategori') == 'staff'
                        ? 'bg-blue-900 text-white'
                        : 'bg-white text-gray-700 hover:bg-gray-100 border shadow-sm' }}"
                >
                    Staff
                </a>
            </div>

            {{-- SEARCH --}}
            <div class="relative w-full lg:w-80">
                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nama atau jabatan..."
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 pl-11 text-sm shadow-sm focus:border-blue-800 focus:ring focus:ring-blue-100 outline-none"
                >

                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </div>
            </div>

        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($aparatur as $index => $item)
                <div x-show=" {{ $index }} < visible && ( '{{ strtolower($item->user->nama_lengkap) }}'.includes(search.toLowerCase()) || '{{ strtolower($item->nama_jabatan) }}'.includes(search.toLowerCase()))" class="h-full">
                    <a
                        href="{{ route('aparatur.show', $item->aparatur_id) }}"
                        class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 h-[200px] p-6 flex flex-col justify-between text-center"
                    >
                        <div class="flex-1 flex flex-col justify-center">
                            <h3 class="text-base font-bold text-blue-950 uppercase leading-snug mb-3 line-clamp-2">
                                {{ $item->user->nama_lengkap }}
                            </h3>

                            <p class="text-sm text-gray-500 leading-relaxed line-clamp-2">
                                {{ $item->nama_jabatan }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-gray-100">
                            <span class="text-xs font-semibold tracking-wide text-blue-700 group-hover:text-blue-900 transition">
                                Detail →
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @if(count($aparatur) > 12)
            <div class="text-center mt-12">
                <button
                    x-show="visible < {{ count($aparatur) }}"
                    @click="visible += 8"
                    class="bg-blue-950 text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-blue-900 transition"
                >
                    Selengkapnya
                </button>
            </div>
        @endif
    </div>
</div>
@endsection