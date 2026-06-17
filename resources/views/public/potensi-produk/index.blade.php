@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'Potensi dan Produk Kalurahan Hargobinangun',
        'subtitle' => 'ꦥꦺꦴꦠꦺꦤ꧀ꦱꦶ ꦢꦤ꧀ ꦥꦿꦺꦴꦢꦸꦏ꧀ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">

            <div class="mb-10 text-center">
                <nav class="text-xs text-gray-500 space-x-1 mb-2 flex justify-center">
                    <a href="/" class="hover:underline">Beranda</a>
                    <span>&gt;</span>
                    <span class="text-blue-600">Potensi dan Produk</span>
                </nav>

                <h1 class="text-3xl font-bold text-blue-950 mb-2">
                    {{ $title }}
                </h1>

                <p class="text-sm text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    Informasi mengenai potensi daerah serta produk usaha masyarakat Kalurahan Hargobinangun.
                </p>
            </div>

            <div class="flex justify-center gap-4 mb-10">
                <a href="{{ route('potensi-produk.index', ['tab' => 'potensi']) }}"
                   class="px-8 py-2 border rounded-full text-sm font-medium transition duration-200
                   {{ $activeTab === 'potensi'
                        ? 'bg-[#1D2059] text-white border-[#1D2059]'
                        : 'bg-white text-gray-700 border-gray-400 hover:bg-gray-50' }}">
                    Potensi
                </a>

                <a href="{{ route('potensi-produk.index', ['tab' => 'produk']) }}"
                   class="px-8 py-2 border rounded-full text-sm font-medium transition duration-200
                   {{ $activeTab === 'produk'
                        ? 'bg-[#1D2059] text-white border-[#1D2059]'
                        : 'bg-white text-gray-700 border-gray-400 hover:bg-gray-50' }}">
                    Produk
                </a>
            </div>

            <div class="space-y-6">
                @forelse($items as $item)

                    <a href="{{ route('potensi-produk.show', $item->potensi_produk_id) }}"
                       class="block group">

                        <div class="flex flex-col md:flex-row gap-6 items-start hover:bg-gray-100 p-2 -mx-2 rounded-xl transition duration-300">

                            <div class="w-full md:w-72 flex-shrink-0 bg-white p-1.5 shadow-sm border border-gray-200 rounded-md">

                                @if($item->gambarPotensiProduk->first())
                                    <img
                                        src="{{ asset('storage/' . $item->gambarPotensiProduk->first()->url_foto_potensi_produk) }}"
                                        alt="{{ $item->judul_potensi_produk }}"
                                        class="w-full h-44 object-cover rounded group-hover:opacity-90 transition"
                                    >
                                @else
                                    <img
                                        src="{{ asset('images/default-image.jpg') }}"
                                        alt="Default Image"
                                        class="w-full h-44 object-cover rounded"
                                    >
                                @endif

                            </div>

                            <div class="flex flex-col pt-2">

                                <span class="text-[11px] font-semibold text-gray-500 mb-2">
                                    {{ \Carbon\Carbon::parse($item->tanggal_potensi_produk)->translatedFormat('d F Y') }}
                                </span>

                                <h2 class="text-lg font-bold text-[#1D2059] uppercase group-hover:text-blue-700 transition leading-tight mb-2">
                                    {{ $item->judul_potensi_produk }}
                                </h2>

                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->artikel_potensi_produk), 180) }}
                                </p>

                            </div>

                        </div>

                    </a>

                @empty

                    <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-300">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">
                            Data Belum Tersedia
                        </h3>

                        <p class="text-sm text-gray-500">
                            Belum ada data potensi atau produk yang ditambahkan.
                        </p>
                    </div>

                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection