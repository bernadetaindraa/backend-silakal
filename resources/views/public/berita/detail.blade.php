@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-6xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2">

                <nav class="text-xs text-gray-500 space-x-1 mb-4">

                    <a href="{{ route('home') }}" class="hover:underline">
                        Beranda
                    </a>

                    <span>&gt;</span>

                    <a href="{{ route('berita') }}"
                       class="text-blue-600 hover:underline">
                        Berita Kalurahan
                    </a>

                </nav>

                <h1 class="text-2xl md:text-3xl font-extrabold text-blue-950 uppercase leading-snug mb-4">
                    {{ $berita->judul_berita }}
                </h1>

                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 mb-6">

                    <span>
                        {{ \Carbon\Carbon::parse($berita->tanggal_berita)->translatedFormat('d F Y') }}
                    </span>

                    @if($berita->kategori && $berita->kategori->count())
                        @foreach($berita->kategori as $kategori)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $kategori->nama_kategori }}
                            </span>
                        @endforeach
                    @endif
                </div>

                @if($berita->foto && $berita->foto->count())

                <div class=" grid gap-4 mb-8 {{ $berita->foto->count() == 1 ? 'grid-cols-1' : 'grid-cols-1 md:grid-cols-2'}}">

                    @foreach($berita->foto as $foto)

                        <div class="rounded-2xl overflow-hidden shadow-sm bg-white">

                            <img
                                src="{{ asset('storage/' . $foto->url_file_berita) }}"
                                alt="{{ $berita->judul_berita }}"
                                class="
                                    w-full
                                    {{ $berita->foto->count() == 1 ? 'h-auto max-h-[500px]' : 'h-[300px]' }}
                                    object-cover
                                    hover:scale-105
                                    transition
                                    duration-300
                                "
                            >

                        </div>

                    @endforeach

                </div>

            @endif

                <div class="text-gray-700 leading-8 text-[15px] text-justify">
                    {!! $berita->isi_berita !!}
                </div>

            </div>

            <div class="lg:col-span-1">

                <h3 class="text-sm font-bold text-blue-900 border-b-2 border-blue-900 pb-2 tracking-wide mb-4">
                    Berita Terbaru
                </h3>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-100">

                    @foreach($beritaTerbaru as $item)

                        <a
                            href="{{ route('berita.show', $item->berita_id) }}"
                            class="block p-4 hover:bg-gray-50 transition group"
                        >

                            <div class="flex gap-3">

                                <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">

                                        <img
                                            src="{{ $item->foto->first()?->url_file_berita
                                                ? asset('storage/' . $item->foto->first()->url_file_berita)
                                                : 'https://via.placeholder.com/300x300' }}"
                                            alt="{{ $item->judul_berita }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                        >

                                </div>

                                <div class="flex-1">

                                    <p class="text-[10px] text-gray-400 mb-1">
                                        {{ \Carbon\Carbon::parse($item->tanggal_berita)->translatedFormat('d M Y') }}
                                    </p>

                                    <h4 class="text-xs font-bold text-blue-950 uppercase leading-snug line-clamp-3 group-hover:text-blue-700 transition">
                                        {{ $item->judul_berita }}
                                    </h4>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>
@endsection