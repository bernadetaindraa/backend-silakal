@extends('layouts.public')

@section('content')
<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-6xl mx-auto">

        <nav class="text-xs text-gray-500 space-x-1 mb-6 flex flex-wrap items-center">
            <a href="/" class="hover:underline">Beranda</a>
            <span>&gt;</span>

            <a href="{{ route('potensi-produk.index') }}" class="hover:underline">
                Potensi dan Produk
            </a>

            <span>&gt;</span>

            <span class="text-blue-600 line-clamp-1">
                {{ $detail->judul_potensi_produk }}
            </span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- CONTENT --}}
            <div class="lg:col-span-2">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                    {{-- IMAGE --}}
                    <div class="w-full">

                        @if($detail->gambarPotensiProduk->first())
                            <img
                                src="{{ asset('storage/' . $detail->gambarPotensiProduk->first()->url_foto_potensi_produk) }}"
                                alt="{{ $detail->judul_potensi_produk }}"
                                class="w-full h-[260px] md:h-[420px] object-cover"
                            >
                        @else
                            <img
                                src="{{ asset('images/default-image.jpg') }}"
                                alt="Default Image"
                                class="w-full h-[260px] md:h-[420px] object-cover"
                            >
                        @endif

                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6 md:p-8">

                        <div class="mb-6">

                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-[11px] font-semibold uppercase tracking-wide mb-4">
                                {{ $detail->kategori_potensi_produk }}
                            </span>

                            <h1 class="text-2xl md:text-3xl font-bold text-[#1D2059] leading-snug mb-4 uppercase">
                                {{ $detail->judul_potensi_produk }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                                <span>
                                    {{ \Carbon\Carbon::parse($detail->tanggal_potensi_produk)->translatedFormat('d F Y') }}
                                </span>

                                <span>•</span>

                                <span>
                                    {{ $detail->nama_potensi_produk }}
                                </span>
                            </div>

                        </div>

                        <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed text-justify">
                            {!! $detail->artikel_potensi_produk !!}
                        </div>

                    </div>

                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="lg:col-span-1 space-y-6">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                    <h3 class="text-sm font-bold text-[#1D2059] border-b border-gray-200 pb-3 mb-4 uppercase tracking-wide">
                        Artikel Terbaru
                    </h3>

                    <div class="space-y-4">

                        @forelse($related as $recent)

                            <a
                                href="{{ route('potensi-produk.show', $recent->potensi_produk_id) }}"
                                class="flex gap-3 group"
                            >

                                <div class="w-24 h-20 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">

                                    @if($recent->gambarPotensiProduk->first())
                                        <img
                                            src="{{ asset('storage/' . $recent->gambarPotensiProduk->first()->url_foto_potensi_produk) }}"
                                            alt="{{ $recent->judul_potensi_produk }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                        >
                                    @else
                                        <img
                                            src="{{ asset('images/default-image.jpg') }}"
                                            alt="Default Image"
                                            class="w-full h-full object-cover"
                                        >
                                    @endif

                                </div>

                                <div class="flex-1">

                                    <h4 class="text-xs font-bold text-gray-800 group-hover:text-blue-700 transition uppercase leading-tight line-clamp-3 mb-2">
                                        {{ $recent->judul_potensi_produk }}
                                    </h4>

                                    <span class="text-[11px] text-gray-400">
                                        {{ \Carbon\Carbon::parse($recent->tanggal_potensi_produk)->translatedFormat('d F Y') }}
                                    </span>

                                </div>

                            </a>

                        @empty

                            <p class="text-sm text-gray-500">
                                Belum ada artikel terbaru.
                            </p>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection