@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    {{-- 1. Banner Utama --}}
    @include('public.partials.banner', [
        'title' => 'Daftar Pengaduan Masyarakat',
        'subtitle' => 'Transparansi penanganan laporan dan aspirasi warga Kalurahan Hargobinangun',
    ])

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        {{-- 2. Breadcrumbs --}}
        <nav class="text-sm text-gray-500 mb-10">
            <a href="/" class="hover:text-blue-600 transition">Beranda</a> &gt; 
            <span class="text-gray-400">Survey dan Pengaduan</span> &gt; 
            <span class="text-blue-600 font-medium">Daftar Pengaduan</span>
        </nav>

        {{-- 3. Header Menu: Judul & Tombol Tambah --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-[#1D2059] tracking-tight">Riwayat Pengaduan</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar semua pengaduan yang masuk dari masyarakat</p>
            </div>
            
            {{-- Tombol Tambah Pengaduan --}}
            <div>
                <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#1D2059] hover:bg-blue-900 text-white font-bold rounded-full text-sm transition shadow-md whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Pengaduan
                </a>
            </div>
        </div>

        {{-- 4. Filter & Pencarian (Sesuai gaya mockup Riwayat) --}}
        <div class="flex justify-end mb-6">
            <form action="{{ route('pengaduan') }}" method="GET" class="w-full sm:w-80">
    
                <div class="relative">

                    <input
                        type="text"
                        name="search"
                        id="searchPengaduan"
                        value="{{ request('search') }}"
                        placeholder="Cari pengaduan..."
                        autocomplete="off"
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400"
                    >

                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
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
                    </div>

                </div>

            </form>
        </div>

        {{-- 5. Tabel Pengaduan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100/80 text-xs font-bold uppercase tracking-wider text-gray-700 border-b border-gray-200">
                            <th class="p-4 w-16 text-center border-r border-gray-200">NO</th>
                            <th class="p-4 border-r border-gray-200">TANGGAL</th>
                            <th class="p-4 border-r border-gray-200">NAMA PELAPOR</th>
                            <th class="p-4 border-r border-gray-200">JUDUL PENGADUAN</th>
                            <th class="p-4 border-r border-gray-200">JENIS LAPORAN</th>
                            <th class="p-4 text-center border-r border-gray-200">STATUS</th>
                            <th class="p-4 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                        @if($data->count() > 0)

                            @foreach($data as $pengaduan)

                                <tr class="hover:bg-gray-50/50 transition">

                                    <td class="p-4 text-center text-gray-500 border-r border-gray-100">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="p-4 text-xs text-gray-600 whitespace-nowrap border-r border-gray-100">
                                        {{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}
                                    </td>

                                    <td class="p-4 font-medium text-gray-800 border-r border-gray-100">
                                        {{ $pengaduan->nama_pengadu }}
                                    </td>

                                    <td class="p-4 font-semibold text-[#1D2059] border-r border-gray-100">
                                        {{ $pengaduan->judul_pengaduan }}
                                    </td>

                                    <td class="p-4 text-xs border-r border-gray-100">

                                        <span class="px-2 py-1 bg-purple-50 text-purple-700 rounded border border-purple-100 font-medium">
                                            {{ $pengaduan->jenis_pengaduan }}
                                        </span>

                                    </td>

                                    <td class="p-4 text-center border-r border-gray-100">

                                        @switch(strtolower($pengaduan->status_pengaduan))

                                            @case('menunggu')
                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-300">
                                                    Menunggu
                                                </span>
                                            @break

                                            @case('diproses')
                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                                    Diproses
                                                </span>
                                            @break

                                            @case('selesai')
                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                                    Selesai
                                                </span>
                                            @break

                                            @case('ditolak')
                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                                    Ditolak
                                                </span>
                                            @break

                                        @endswitch

                                    </td>

                                    <td class="p-4 text-center whitespace-nowrap">

                                        <a
                                            href="{{ route('pengaduan.show', $pengaduan->pengaduan_id) }}"
                                            class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-md transition shadow-sm"
                                        >
                                            Detail
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        @else

                            <tr>
                                <td colspan="7" class="p-16 text-center text-gray-500">

                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>

                                    <p class="font-bold text-lg text-gray-700">
                                        Belum ada data pengaduan.
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        Gunakan tombol "Tambah Pengaduan"
                                    </p>

                                </td>
                            </tr>

                        @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
const searchInput = document.getElementById('searchPengaduan');

let debounceTimer;

searchInput.addEventListener('input', function () {

    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {

        this.form.submit();

    }, 500);

});
</script>
@endsection