@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-blue-950">Berita Terbaru</h1>
                <p class="text-sm text-gray-500">
                    Informasi dan kabar kegiatan paling gres di Kalurahan Hargobinangun
                </p>
            </div>

            <a href="{{ route('berita.semua') }}"
               class="text-blue-900 hover:text-blue-700 transition flex items-center gap-2 font-semibold text-sm group">
                <span>Semua Berita</span>

                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($berita as $item)

                <a href="{{ route('berita.show', $item->berita_id) }}"
                   class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition group">

                    <div class="h-44 bg-gray-200 overflow-hidden relative">

                        <img
                            src="{{ $item->foto->first()?->url_file_berita
                                ? asset('storage/' . $item->foto->first()->url_file_berita)
                                : 'https://via.placeholder.com/500x300' }}"
                            alt="{{ $item->judul_berita }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        >

                        <div class="absolute bottom-3 left-3 bg-blue-950 text-white text-[10px] font-bold px-3 py-1 rounded-md shadow-sm">
                            {{ \Carbon\Carbon::parse($item->tanggal_berita)->translatedFormat('d F Y') }}
                        </div>

                    </div>

                    <div class="p-5 flex flex-col justify-between flex-grow">

                        <div>

                            @if($item->kategori)
                                <span class="inline-block text-[10px] font-semibold text-blue-700 bg-blue-50 px-2 py-1 rounded mb-3 uppercase">
                                    {{ $item->kategori->pluck('nama_kategori')->implode(', ') }}
                                </span>
                            @endif

                            <h3 class="text-sm font-bold text-blue-950 uppercase tracking-tight line-clamp-2 leading-snug group-hover:text-blue-800 transition">
                                {{ $item->judul_berita }}
                            </h3>

                            <p class="text-xs text-gray-500 line-clamp-3 mt-2 leading-relaxed">
                                {{ Str::limit(strip_tags($item->isi_berita), 120) }}
                            </p>

                        </div>

                        <span class="text-[11px] font-bold text-blue-600 group-hover:underline inline-block pt-4">
                            Baca Selengkapnya →
                        </span>

                    </div>

                </a>

            @endforeach
        </div>

        <div class="mt-10">
            {{ $berita->links() }}
        </div>

    </div>
</div>
@endsection