@extends('layouts.public')

@section('content')
<style>
    [x-cloak] { display: none !important; }
</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'Produk Hukum Kalurahan Hargobinangun',
        'subtitle' => 'ꦥꦿꦺꦴꦢꦸꦏ꧀ ꦲꦸꦏꦸꦩ꧀ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

            <div class="mb-8 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-blue-950 leading-snug">
                        {{ $dokumen->nama_dokumen }}
                    </h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-8 text-sm text-gray-600 mt-5">

                        <div>
                            <span class="font-semibold text-gray-800 inline-block w-32">
                                Nomor Dokumen
                            </span>
                            : {{ $dokumen->nomor_dokumen }}
                        </div>

                        <div>
                            <span class="font-semibold text-gray-800 inline-block w-32">
                                Tahun
                            </span>
                            : {{ \Carbon\Carbon::parse($dokumen->tanggal_ditetapkan)->format('Y') }}
                        </div>

                        <div>
                            <span class="font-semibold text-gray-800 inline-block w-32">
                                Kategori
                            </span>
                            : {{ $dokumen->kategori_dokumen }}
                        </div>

                        <div>
                            <span class="font-semibold text-gray-800 inline-block w-32">
                                Tipe File
                            </span>
                            : {{ $dokumen->tipe_dokumen }}
                        </div>

                        <div class="sm:col-span-2">
                            <span class="font-semibold text-gray-800 inline-block w-32">
                                Tanggal Ditetapkan
                            </span>
                            : {{ \Carbon\Carbon::parse($dokumen->tanggal_ditetapkan)->translatedFormat('d F Y') }}
                        </div>

                    </div>

                </div>

                <div class="flex-shrink-0">
                    {{-- FIX: Langsung panggil variabel URL dokumen tanpa asset() --}}
                    <a
                        href="{{ $dokumen->url_dokumen }}"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-5 py-3 border border-gray-300 text-sm font-semibold text-gray-700 rounded-xl bg-white hover:bg-gray-50 transition shadow-sm"
                    >
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>

                        <span>{{ $dokumen->tipe_dokumen === 'Link' ? 'Buka Tautan' : 'Unduh Dokumen' }}</span>
                    </a>
                </div>

            </div>

            {{-- PRATINJAU / PREVIEW AREA --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden bg-gray-50 shadow-inner">
                
                @if($dokumen->tipe_dokumen === 'PDF')
                    {{-- 1. Jika PDF --}}
                    <iframe src="{{ $dokumen->url_dokumen }}" class="w-full h-[750px]"></iframe>

                @elseif(in_array($dokumen->tipe_dokumen, ['JPG', 'JPEG', 'PNG']))
                    <div class="p-4 flex justify-center items-center bg-white min-h-[400px]">
                        <img 
                            src="{{ $dokumen->url_dokumen }}" 
                            alt="{{ $dokumen->nama_dokumen }}" 
                            class="max-w-full h-auto rounded-xl shadow-sm max-h-[750px] object-contain"
                        >
                    </div>

                @elseif($dokumen->tipe_dokumen === 'Docx' || $dokumen->tipe_dokumen === 'Excel')
                    <iframe 
                        src="https://docs.google.com/gview?url={{ urlencode($dokumen->url_dokumen) }}&embedded=true" 
                        class="w-full h-[750px]" 
                        frameborder="0">
                    </iframe>

                @else
                    {{-- 4. Jika berupa Tautan Luar / Eksternal --}}
                    <div class="p-12 text-center flex flex-col items-center justify-center space-y-4">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>
                        <div class="max-w-sm">
                            <h3 class="text-base font-bold text-gray-800">Dokumen Tautan Eksternal</h3>
                            <p class="text-sm text-gray-500 mt-1">Silakan klik tombol di bawah untuk membuka tautan.</p>
                        </div>
                        <a href="{{ $dokumen->url_dokumen }}" target="_blank" class="mt-2 px-6 py-2.5 bg-blue-950 text-white rounded-xl text-sm font-semibold hover:bg-blue-900 transition shadow-sm">
                            Buka Tautan Sekarang
                        </a>
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>
@endsection