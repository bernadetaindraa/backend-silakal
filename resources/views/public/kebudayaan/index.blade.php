@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'Kebudayaan Kalurahan Hargobinangun',
        'subtitle' => 'ꦏꦼꦧꦸꦢꦪꦪꦤ꧀ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">

                <nav class="text-xs text-gray-500 space-x-1 mb-2">
                    <a href="/" class="hover:underline">Beranda</a>
                    <span>&gt;</span>
                    <span class="text-blue-600">{{ $judul}}</span>
                </nav>
                
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-bold text-[#1D2059] mb-3">
                    {{ $judul }}
                </h1>

                <p class="text-sm text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Inventarisasi dan pelestarian kebudayaan Kalurahan Hargobinangun sebagai bagian dari warisan budaya masyarakat yang terus dijaga dan dilestarikan.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($jenis as $item)

                    <a 
                        href="{{ route('kebudayaan.jenis', $item->jenis_kebudayaan_id) }}"
                        class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-300 p-8 flex flex-col items-center justify-center text-center min-h-[170px]"
                    >

                        <div class="w-14 h-14 rounded-full bg-[#1D2059]/10 flex items-center justify-center mb-5 group-hover:bg-[#1D2059] transition">
                            <svg class="w-7 h-7 text-[#1D2059] group-hover:text-white transition"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 21h18M4 18h16M5 10l7-4 7 4M6 10v8m4-8v8m4-8v8m4-8v8">
                                </path>
                            </svg>
                        </div>

                        <h3 class="text-sm md:text-base font-bold text-[#1D2059] uppercase tracking-wide group-hover:text-blue-700 transition">
                            {{ $item->nama_jenis }}
                        </h3>

                    </a>

                @endforeach

            </div>

        </div>
    </div>
</div>
@endsection