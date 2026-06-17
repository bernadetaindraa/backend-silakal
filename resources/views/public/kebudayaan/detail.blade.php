@extends('layouts.public')

@section('content')

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    {{-- Banner --}}
    @include('public.partials.banner', [
        'title' => $kebudayaan->judul_kebudayaan,
        'subtitle' => 'ꦏꦼꦧꦸꦢꦪꦴꦤ꧀ ꦏꦭꦸꦫꦲꦤ꧀',
    ])

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Breadcrumb dipisah dengan / --}}
        <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2 flex-wrap">
            <a href="/" class="hover:text-blue-600 transition">Beranda</a>
            <span>/</span>
            <a href="javascript:history.back()" class="hover:text-blue-600 transition">Kembali ke Daftar</a>
            <span>/</span>
            <span class="text-gray-800 font-medium truncate">{{ $kebudayaan->judul_kebudayaan }}</span>
        </nav>

        {{-- Card Konten Utama --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            {{-- Gambar Utama (Paling Atas) --}}
            @if($kebudayaan->fotoKebudayaan->count())
                <img 
                    src="{{ asset('storage/' . $kebudayaan->fotoKebudayaan->first()->url_foto_kebudayaan) }}" 
                    alt="{{ $kebudayaan->judul_kebudayaan }}" 
                    class="w-full h-[300px] md:h-[450px] object-cover"
                >
            @endif

            <div class="p-6 md:p-10">
                
                {{-- Header Judul --}}
                <div class="mb-8 border-b border-gray-100 pb-6">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 mb-3">
                        {{ $kebudayaan->jenisKebudayaan->kategoriKebudayaan->nama_kategori }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1D2059] mb-3">
                        {{ $kebudayaan->judul_kebudayaan }}
                    </h1>
                    <p class="text-gray-500 text-sm">
                        Lokasi :  {{ $kebudayaan->lokasi_kebudayaan }} &nbsp;|&nbsp; Tahun: {{ $kebudayaan->tahun_ditetapkan }}
                    </p>
                </div>

                {{-- Grid Informasi & Sejarah --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                    
                    {{-- Kolom Kiri: Tabel Detail Singkat --}}
                    <div class="md:col-span-1">
                        <h3 class="font-bold text-lg text-[#1D2059] mb-4">Detail Data</h3>
                        <ul class="text-sm text-gray-800 space-y-3">
                            <li class="border-b border-gray-100 pb-2">
                                <span class="block text-gray-400 text-xs mb-1">Nama Kebudayaan</span> 
                                <span class="font-medium">{{ $kebudayaan->judul_kebudayaan }}</span>
                            </li>
                            <li class="border-b border-gray-100 pb-2">
                                <span class="block text-gray-400 text-xs mb-1">Jenis</span> 
                                {{ $kebudayaan->jenisKebudayaan->nama_jenis }}
                            </li>
                            <li class="border-b border-gray-100 pb-2">
                                <span class="block text-gray-400 text-xs mb-1">Kategori</span> 
                                {{ $kebudayaan->jenisKebudayaan->kategoriKebudayaan->nama_kategori }}
                            </li>
                        </ul>
                    </div>

                    {{-- Kolom Kanan: Sejarah / Deskripsi --}}
                    <div class="md:col-span-2 text-gray-700 text-sm leading-relaxed text-justify">
                        <h3 class="font-bold text-lg text-[#1D2059] mb-4">Sejarah Kebudayaan</h3>
                        <div class="prose max-w-none">
                            {!! $kebudayaan->deskripsi_kebudayaan !!}
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- Galeri Dokumentasi Tambahan --}}
        @if($kebudayaan->fotoKebudayaan->count() > 1)
            <div class="mt-10">
                <h3 class="font-bold text-xl text-[#1D2059] mb-5">Galeri Dokumentasi</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    {{-- .skip(1) digunakan agar gambar sampul utama tidak ikut ditampilkan lagi di galeri bawah --}}
                    @foreach($kebudayaan->fotoKebudayaan->skip(1) as $foto)
                        <img 
                            src="{{ asset('storage/' . $foto->url_foto_kebudayaan) }}" 
                            alt="Dokumentasi Tambahan" 
                            class="w-full h-40 object-cover rounded-xl border border-gray-200 shadow-sm hover:opacity-90 transition cursor-pointer hover:scale-[1.02]"
                        >
                    @endforeach
                </div>
            </div>
        @endif

    </div>

</div>

@endsection