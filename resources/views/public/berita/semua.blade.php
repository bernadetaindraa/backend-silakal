@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-5xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <h1 class="text-3xl font-bold text-blue-950">Semua Berita</h1>
                <p class="text-sm text-gray-500">
                    Update kegiatan dan informasi resmi terbaru Kalurahan
                </p>
            </div>

            <form method="GET" class="relative w-full md:w-80">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                        </path>
                    </svg>
                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari Berita"
                    class="w-full pl-9 pr-4 py-2 bg-white border border-gray-300 rounded-full text-sm focus:outline-none focus:border-blue-500 shadow-sm"
                >

            </form>

        </div>

        <div class="space-y-6">

            @foreach($berita as $item)

                <a href="{{ route('berita.show', $item->berita_id) }}"
                   class="block bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition group">

                    <div class="flex flex-col sm:flex-row gap-5">

                        <div class="w-full sm:w-48 h-32 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden">

                            <img
                                src="{{ $item->foto->first()?->url_file_berita
                                    ? asset('storage/' . $item->foto->first()->url_file_berita)
                                    : 'https://via.placeholder.com/500x300' }}"
                                alt="{{ $item->judul_berita }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                            >

                        </div>

                        <div class="flex flex-col justify-between">

                            <div>

                                <span class="text-xs font-semibold text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->tanggal_berita)->translatedFormat('d F Y') }}
                                </span>

                                <h2 class="text-base font-bold text-blue-900 group-hover:text-blue-700 transition line-clamp-2 mt-1 uppercase">
                                    {{ $item->judul_berita }}
                                </h2>

                                <p class="text-xs text-gray-600 line-clamp-3 mt-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($item->isi_berita), 180) }}
                                </p>

                            </div>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</div>
@endsection