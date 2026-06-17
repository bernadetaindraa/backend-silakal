@extends('layouts.public')

@section('content')

<style>[x-cloak] { display: none !important; }</style>

<div x-data="{ tab: 'anggota' }" class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'BPKal Kalurahan Hargobinangun',
        'subtitle' => 'ꦧꦥꦺꦏꦭ꧀ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦁꦒꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

        {{-- TAB --}}
        <div class="flex justify-center space-x-4 mb-16">
            <button
                @click="tab = 'anggota'"
                :class="tab === 'anggota'
                    ? 'bg-[#1D2059] text-white'
                    : 'bg-transparent text-[#1D2059] border border-[#1D2059] hover:bg-gray-100'"
                class="px-8 py-2 rounded-full font-semibold transition text-sm"
            >
                Anggota
            </button>

            <button
                @click="tab = 'kegiatan'"
                :class="tab === 'kegiatan'
                    ? 'bg-[#1D2059] text-white'
                    : 'bg-transparent text-[#1D2059] border border-[#1D2059] hover:bg-gray-100'"
                class="px-8 py-2 rounded-full font-semibold transition text-sm"
            >
                Kegiatan
            </button>
        </div>

        {{-- ANGGOTA --}}
        <div x-show="tab === 'anggota'" x-transition.opacity.duration.500ms x-cloak>
            <div class="max-w-6xl mx-auto">

                <div class="mb-8">
                    <h5 class="text-3xl font-bold text-blue-900">
                        Data Anggota BPKal
                    </h5>

                    <p class="text-gray-600">
                        Badan Permusyawaratan Kalurahan Hargobinangun
                    </p>
                </div>

                {{-- SEARCH --}}
                <form method="GET" class="mb-8">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <input
                            type="text"
                            name="search_anggota"
                            value="{{ request('search_anggota') }}"
                            placeholder="Cari nama atau jabatan..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >

                        <button
                            type="submit"
                            class="bg-blue-950 text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-blue-900 transition"
                        >
                            Cari
                        </button>
                    </div>
                </form>

                <div x-data="{ visible: 12 }">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                        @foreach($anggota as $index => $item)

                            <div x-show="{{ $index }} < visible" class="h-full">
                                <a
                                    href="{{ route('bpkal.anggota.show', $item->bpkal_anggota_id) }}"
                                    class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-blue-200 transition-all duration-300 h-[220px] p-6 flex flex-col justify-between text-center"
                                >

                                    <div class="flex-1 flex flex-col justify-center">
                                        <h3 class="text-base font-bold text-blue-950 uppercase leading-snug mb-3 line-clamp-2">
                                            {{ $item->user->nama_lengkap }}
                                        </h3>

                                        <p class="text-sm text-gray-500 leading-relaxed mb-2">
                                            {{ $item->jabatan }}
                                        </p>

                                        @if($item->wilayah_musyawarah)
                                            <p class="text-xs text-gray-400">
                                                {{ $item->wilayah_musyawarah }}
                                            </p>
                                        @endif
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

                    @if(count($anggota) > 12)
                        <div class="text-center mt-12">
                            <button
                                x-show="visible < {{ count($anggota) }}"
                                @click="visible += 8"
                                class="bg-blue-950 text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-blue-900 transition"
                            >
                                Selengkapnya
                            </button>
                        </div>
                    @endif

                </div>

            </div>
        </div>

        {{-- KEGIATAN --}}
        <div x-show="tab === 'kegiatan'" x-transition.opacity.duration.500ms x-cloak>
            <div class="max-w-6xl mx-auto">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

                    <div>
                        <h5 class="text-3xl font-bold text-blue-900">
                            Data Kegiatan BPKal
                        </h5>

                        <p class="text-gray-600">
                            Informasi kegiatan Badan Permusyawaratan Kalurahan
                        </p>
                    </div>

                    {{-- SEARCH --}}
                    <form method="GET" class="w-full md:w-80">
                        <div class="relative">
                            <input
                                type="text"
                                name="search_kegiatan"
                                value="{{ request('search_kegiatan') }}"
                                placeholder="Cari kegiatan..."
                                class="w-full pl-4 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200"
                            >
                        </div>
                    </form>

                </div>

                <div class="space-y-4">

                    @foreach($kegiatan as $item)

                        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">

                            <div>
                                <h3 class="text-base font-bold text-gray-900 mb-1">
                                    {{ $item->judul_kegiatan }}
                                </h3>

                                <p class="text-sm text-gray-500 mb-2">
                                    {{ Str::limit($item->deskripsi_kegiatan, 100) }}

                                <p class="text-xs text-gray-500">
                                    Tahun : {{ $item->tahun_kegiatan }}
                                </p>
                            </div>

                            <div>

                                @if($item->status_kegiatan == 'Selesai')
                                    <span class="px-5 py-1.5 bg-green-500 text-white text-xs font-semibold rounded-full inline-block text-center">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-5 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded-full inline-block text-center">
                                        Berjalan
                                    </span>
                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>
        </div>

    </div>

</div>

@endsection