@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

{{-- HEADER --}}
<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

    <div>
        <h1 class="text-2xl font-bold text-[#1D2059]">
            Laporan Potensi & Produk UMKM
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Rekap dan filter data potensi daerah serta produk usaha Kalurahan Hargobinangun
        </p>
    </div>

    <div class="flex gap-2">

        <a href="{{ route('admin.laporan.potensi-produk.pdf', request()->query()) }}"
            class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold">
            Export PDF
        </a>

        <a href="{{ route('admin.laporan.potensi-produk.excel', request()->query()) }}"
            class="px-4 py-2 rounded-xl bg-green-600 text-white text-sm font-semibold">
            Export Excel
        </a>

    </div>

</div>

{{-- FILTER --}}
<div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari judul atau nama..."
            class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

        <select
            name="kategori_potensi_produk"
            class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

            <option value="">
                Semua Kategori
            </option>

            @foreach($kategori as $item)

                <option
                    value="{{ $item }}"
                    {{ request('kategori_potensi_produk') == $item ? 'selected' : '' }}>

                    {{ $item }}

                </option>

            @endforeach

        </select>

        <input
            type="date"
            name="tanggal_awal"
            value="{{ request('tanggal_awal') }}"
            class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

        <input
            type="date"
            name="tanggal_akhir"
            value="{{ request('tanggal_akhir') }}"
            class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

        <button
            class="bg-[#1D2059] text-white rounded-xl px-4 py-3 text-sm font-semibold">
            Filter
        </button>

    </form>

</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

        <p class="text-sm text-gray-500">
            Total Data
        </p>

        <h3 class="text-3xl font-bold text-[#1D2059] mt-2">
            {{ $totalPotensiProduk }}
        </h3>

    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

        <p class="font-semibold text-[#1D2059] mb-3">
            Statistik Utama
        </p>

        <div class="flex justify-between text-sm py-1">
            <span>Potensi Daerah</span>
            <span class="font-semibold">
                {{ $potensiDaerah }}
            </span>
        </div>

        <div class="flex justify-between text-sm py-1">
            <span>Produk Usaha Daerah</span>
            <span class="font-semibold">
                {{ $produkUsaha }}
            </span>
        </div>

    </div>

    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

        <p class="font-semibold text-[#1D2059] mb-3">
            Per Kategori
        </p>

        @forelse($perKategori as $nama => $jumlah)

            <div class="flex justify-between text-sm py-1">

                <span>{{ $nama }}</span>

                <span class="font-semibold">
                    {{ $jumlah }}
                </span>

            </div>

        @empty

            <p class="text-sm text-gray-400">
                Tidak ada data
            </p>

        @endforelse

    </div>

</div>

{{-- TABLE --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-x-auto">

    <table class="w-full min-w-[1200px]">

        <thead>

            <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">

                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Judul</th>
                <th class="px-6 py-4">Nama Potensi / Produk</th>
                <th class="px-6 py-4">Kategori</th>
                <th class="px-6 py-4">Tanggal</th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-100 text-sm">

            @forelse($data as $item)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 text-gray-500">
                        {{ $data->firstItem() + $loop->index }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-[#1D2059]">
                        {{ $item->judul_potensi_produk }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->nama_potensi_produk }}
                    </td>

                    <td class="px-6 py-4">

                        <span class="px-3 py-1 text-xs rounded-lg bg-blue-50 text-blue-700 border border-blue-100">

                            {{ $item->kategori_potensi_produk }}

                        </span>

                    </td>

                    <td class="px-6 py-4">
                       {{ \Carbon\Carbon::parse($item->tanggal_potensi_produk)->format('d/m/Y') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center py-10 text-gray-400">
                        Tidak ada data potensi produk
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="p-5 border-t border-gray-100">
        {{ $data->links() }}
    </div>

</div>

</div>

@endsection