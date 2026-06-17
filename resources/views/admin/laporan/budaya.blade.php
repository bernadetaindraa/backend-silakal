@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Laporan Data Kebudayaan
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Rekap dan filter data kebudayaan Kalurahan Hargobinangun
            </p>
        </div>

        <div class="flex gap-2">

            <a href="{{ route('admin.laporan.budaya.pdf', request()->query()) }}"
                class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold">
                Export PDF
            </a>

            <a href="{{ route('admin.laporan.budaya.excel', request()->query()) }}"
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
                placeholder="Cari judul / lokasi..."
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

            <select
                name="jenis_kebudayaan_id"
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

                <option value="">
                    Semua Jenis Kebudayaan
                </option>

                @foreach($jenisKebudayaan as $id => $nama)

                    <option
                        value="{{ $id }}"
                        {{ request('jenis_kebudayaan_id') == $id ? 'selected' : '' }}>

                        {{ $nama }}

                    </option>

                @endforeach

            </select>

            <input
                type="number"
                name="tahun_awal"
                value="{{ request('tahun_awal') }}"
                placeholder="Tahun Awal"
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

            <input
                type="number"
                name="tahun_akhir"
                value="{{ request('tahun_akhir') }}"
                placeholder="Tahun Akhir"
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
                Total Data Kebudayaan
            </p>

            <h3 class="text-3xl font-bold text-[#1D2059] mt-2">
                {{ $totalKebudayaan }}
            </h3>

        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

            <p class="font-semibold text-[#1D2059] mb-3">
                Per Kategori
            </p>

            @forelse($perKategori as $nama => $jumlah)

                <div class="flex justify-between text-sm py-1">
                    <span>{{ $nama }}</span>
                    <span class="font-semibold">{{ $jumlah }}</span>
                </div>

            @empty

                <p class="text-sm text-gray-400">
                    Tidak ada data
                </p>

            @endforelse

        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

            <p class="font-semibold text-[#1D2059] mb-3">
                Per Jenis
            </p>

            @forelse($perJenis as $nama => $jumlah)

                <div class="flex justify-between text-sm py-1">
                    <span>{{ $nama }}</span>
                    <span class="font-semibold">{{ $jumlah }}</span>
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
                    <th class="px-6 py-4">Judul Kebudayaan</th>
                    <th class="px-6 py-4">Jenis</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Tahun</th>
                    <th class="px-6 py-4">Lokasi</th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-100 text-sm">

                @forelse($data as $item)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-gray-500">
                            {{ $data->firstItem() + $loop->index }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-[#1D2059]">
                            {{ $item->judul_kebudayaan }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 text-xs rounded-lg bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $item->jenisKebudayaan->nama_jenis_kebudayaan ?? '-' }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            {{ $item->jenisKebudayaan->kategoriKebudayaan->nama_kategori ?? '-' }}

                        </td>

                        <td class="px-6 py-4">
                            {{ $item->tahun_ditetapkan }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->lokasi_kebudayaan }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-10 text-gray-400">
                            Tidak ada data kebudayaan
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