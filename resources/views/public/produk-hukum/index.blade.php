@extends('layouts.public')

@section('content')
<style>
    [x-cloak] { display: none !important; }
</style>

@php
    $deskripsi = match($kategori) {
        'perencanaan-penganggaran' => 'Dokumen perencanaan dan penganggaran Kalurahan Hargobinangun yang memuat rencana program kerja, pembangunan, serta alokasi anggaran sebagai dasar pelaksanaan kegiatan pemerintahan kalurahan.',
        'peraturan-kalurahan' => 'Dokumen peraturan yang ditetapkan oleh Kalurahan Hargobinangun sebagai pedoman penyelenggaraan pemerintahan, pembangunan, dan pelayanan masyarakat.',
        'peraturan-lurah' => 'Dokumen peraturan lurah yang digunakan sebagai dasar pelaksanaan kebijakan teknis dan tata kelola pemerintahan di Kalurahan Hargobinangun.',
        'laporan' => 'Dokumen laporan kegiatan dan pertanggungjawaban pelaksanaan program serta penggunaan anggaran di Kalurahan Hargobinangun.',
        default => 'Dokumen produk hukum Kalurahan Hargobinangun.'
    };

    $tahunList = $dokumen
        ->pluck('tanggal_ditetapkan')
        ->map(fn($tanggal) => \Carbon\Carbon::parse($tanggal)->format('Y'))
        ->unique()
        ->sortDesc();
@endphp

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'Produk Hukum Kalurahan Hargobinangun',
        'subtitle' => 'ꦥꦿꦺꦴꦢꦸꦏ꧀ ꦲꦸꦏꦸꦩ꧀ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

        <div class="max-w-5xl mx-auto">

            <div class="mb-8 text-center">
                <nav class="text-xs text-gray-500 space-x-1 mb-3">
                    <a href="/" class="hover:underline">Beranda</a>
                    <span>&gt;</span>
                    <span class="text-blue-600">Produk Hukum Kalurahan</span>
                </nav>

                <h1 class="text-3xl md:text-4xl font-bold text-blue-950">
                    {{ $title }}
                </h1>

                <p class="text-sm md:text-base text-gray-500 mt-4 leading-relaxed max-w-3xl mx-auto">
                    {{ $deskripsi }}
                </p>
            </div>

            <div class="flex justify-end mb-5">
                <div class="relative">
                    <select
                        onchange="window.location.href=this.value"
                        class="appearance-none bg-white border border-gray-300 rounded-full px-5 py-2 pr-10 text-xs font-medium text-gray-700 shadow-sm focus:outline-none focus:border-blue-500"
                    >
                        <option value="{{ route('produk-hukum.index', $kategori) }}">
                            Semua Tahun
                        </option>

                        @foreach($tahunList as $tahun)
                            <option
                                value="{{ route('produk-hukum.index', [
                                    'kategori' => $kategori,
                                    'tahun' => $tahun
                                ]) }}"
                                {{ request('tahun') == $tahun ? 'selected' : '' }}
                            >
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">

                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3.5 text-center w-16 border-r border-gray-100">No</th>
                                <th class="px-6 py-3.5 border-r border-gray-100 w-24 text-center">Tahun</th>
                                <th class="px-6 py-3.5 border-r border-gray-100 w-28 text-center">Tipe File</th>
                                <th class="px-6 py-3.5 border-r border-gray-100">Nama Dokumen</th>
                                <th class="px-6 py-3.5 text-center w-44">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 text-gray-700">

                            @forelse($dokumen as $index => $doc)

                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-6 py-4 text-center border-r border-gray-100 font-medium">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 text-center border-r border-gray-100">
                                        {{ \Carbon\Carbon::parse($doc->tanggal_ditetapkan)->format('Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-center border-r border-gray-100">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded bg-red-50 text-red-600">
                                            {{ $doc->tipe_dokumen }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 border-r border-gray-100 font-medium text-gray-900">
                                        {{ $doc->nama_dokumen }}
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap space-x-3 text-xs">
                                        <a href="{{ route('produk-hukum.show', $doc->produk_hukum_id) }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">
                                            Lihat
                                        </a>

                                        <span class="text-gray-300">|</span>

                                        <a href="{{ asset('storage/' . $doc->url_dokumen) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">
                                            Unduh
                                        </a>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        Belum ada dokumen tersedia.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection