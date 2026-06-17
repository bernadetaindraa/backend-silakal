@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Laporan Pengajuan Layanan
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Rekap dan filter data pengajuan surat layanan masyarakat
            </p>
        </div>

        <div class="flex gap-2">

            <a href="{{ route('admin.laporan.layanan.pdf', request()->query()) }}"
                class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold">
                Export PDF
            </a>

            <a href="{{ route('admin.laporan.layanan.excel', request()->query()) }}"
                class="px-4 py-2 rounded-xl bg-green-600 text-white text-sm font-semibold">
                Export Excel
            </a>

        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">

            {{-- SEARCH --}}
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nomor layanan / nama pengaju..."
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

            {{-- TANGGAL AWAL --}}
            <input
                type="date"
                name="tanggal_awal"
                value="{{ request('tanggal_awal') }}"
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

            {{-- TANGGAL AKHIR --}}
            <input
                type="date"
                name="tanggal_akhir"
                value="{{ request('tanggal_akhir') }}"
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

            {{-- STATUS --}}
            <select
                name="status_layanan"
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

                <option value="">Semua Status</option>

                @foreach([
                    'menunggu',
                    'diverifikasi',
                    'diproses',
                    'siap_diambil',
                    'selesai',
                    'ditolak'
                ] as $status)

                    <option value="{{ $status }}"
                        {{ request('status_layanan') == $status ? 'selected' : '' }}>

                        {{ ucwords(str_replace('_',' ', $status)) }}

                    </option>

                @endforeach

            </select>

            {{-- JENIS LAYANAN --}}
            <select
                name="jenis_layanan"
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

                <option value="">Semua Jenis Layanan</option>

                @foreach($jenisLayanan as $value => $label)

                    <option
                        value="{{ $value }}"
                        {{ request('jenis_layanan') == $value ? 'selected' : '' }}>

                        {{ $label }}

                    </option>

                @endforeach

            </select>

            {{-- BUTTON --}}
            <button
                class="bg-[#1D2059] text-white rounded-xl px-4 py-3 text-sm font-semibold">
                Filter
            </button>

        </form>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-5">

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Total Pengajuan</p>
            <h3 class="text-3xl font-bold text-[#1D2059] mt-2">
                {{ $totalPengajuan }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Menunggu</p>
            <h3 class="text-3xl font-bold text-yellow-600 mt-2">
                {{ $menunggu }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Diverifikasi</p>
            <h3 class="text-3xl font-bold text-blue-600 mt-2">
                {{ $diverifikasi }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Diproses</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2">
                {{ $diproses }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Selesai</p>
            <h3 class="text-3xl font-bold text-green-600 mt-2">
                {{ $selesai }}
            </h3>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-x-auto">

        <table class="w-full min-w-[1300px]">

            <thead>
                <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">

                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nomor Layanan</th>
                    <th class="px-6 py-4">Nama Pengaju</th>
                    <th class="px-6 py-4">Jenis Layanan</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Pengiriman</th>
                    <th class="px-6 py-4">Status</th>

                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 text-sm">

                @forelse($data as $item)

                <tr class="hover:bg-gray-50 transition">

                    {{-- NO --}}
                    <td class="px-6 py-4 text-gray-500">
                        {{ $data->firstItem() + $loop->index }}
                    </td>

                    {{-- NOMOR --}}
                    <td class="px-6 py-4 font-semibold text-[#1D2059]">
                        {{ $item->nomor_layanan }}

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $item->nik_pengajuan }}
                        </p>
                    </td>

                    {{-- PENGAJU --}}
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-700">
                            {{ $item->nama_pengajuan }}
                        </div>

                        <div class="text-xs text-gray-500">
                            {{ $item->telepon_pengajuan ?? '-' }}
                        </div>
                    </td>

                    {{-- JENIS --}}
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-lg bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $item->jenis_layanan_label }}
                        </span>
                    </td>

                    {{-- KATEGORI --}}
                    <td class="px-6 py-4">
                        {{ ucfirst(str_replace('_',' ', $item->kategori_layanan)) }}
                    </td>

                    {{-- TANGGAL --}}
                    <td class="px-6 py-4">
                        {{\Carbon\Carbon::parse($item->tanggal_layanan)->format('d M Y') }}
                    </td>

                    {{-- PENGIRIMAN --}}
                    <td class="px-6 py-4">

                        @if($item->pengiriman_layanan == 'email')

                            <span class="px-3 py-1 text-xs rounded-lg bg-purple-50 text-purple-700 border border-purple-100">
                                Email
                            </span>

                        @else

                            <span class="px-3 py-1 text-xs rounded-lg bg-gray-50 text-gray-700 border border-gray-100">
                                Ambil Langsung
                            </span>

                        @endif

                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-4">

                        @if($item->status_layanan == 'menunggu')

                            <span class="px-3 py-1 text-xs rounded-lg bg-yellow-50 text-yellow-700 border border-yellow-100">
                                Menunggu
                            </span>

                        @elseif($item->status_layanan == 'diverifikasi')

                            <span class="px-3 py-1 text-xs rounded-lg bg-blue-50 text-blue-700 border border-blue-100">
                                Diverifikasi
                            </span>

                        @elseif($item->status_layanan == 'diproses')

                            <span class="px-3 py-1 text-xs rounded-lg bg-indigo-50 text-indigo-700 border border-indigo-100">
                                Diproses
                            </span>

                        @elseif($item->status_layanan == 'siap_diambil')

                            <span class="px-3 py-1 text-xs rounded-lg bg-cyan-50 text-cyan-700 border border-cyan-100">
                                Siap Diambil
                            </span>

                        @elseif($item->status_layanan == 'selesai')

                            <span class="px-3 py-1 text-xs rounded-lg bg-green-50 text-green-700 border border-green-100">
                                Selesai
                            </span>

                        @else

                            <span class="px-3 py-1 text-xs rounded-lg bg-red-50 text-red-700 border border-red-100">
                                Ditolak
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="8" class="text-center py-10 text-gray-400">
                        Tidak ada data layanan
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