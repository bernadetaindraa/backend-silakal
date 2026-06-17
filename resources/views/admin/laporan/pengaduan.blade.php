@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Laporan Pengaduan Masyarakat
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Rekap dan filter data pengaduan masyarakat
            </p>
        </div>

        {{-- EXPORT --}}
        <div class="flex gap-2">

            <a href="{{ route('admin.laporan.pengaduan.pdf', request()->query()) }}"
            class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold">
                Export PDF
            </a>

            <a href="{{ route('admin.laporan.pengaduan.excel', request()->query()) }}"
            class="px-4 py-2 rounded-xl bg-green-600 text-white text-sm font-semibold">
                Export Excel
            </a>

        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">

            {{-- SEARCH --}}
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari judul / pengadu..."
                   class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

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

            {{-- STATUS --}}
            <select name="status_pengaduan"
                    class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

                <option value="">Semua Status</option>

                @foreach(['Menunggu','Diproses','Selesai','Ditolak'] as $status)
                    <option value="{{ $status }}"
                        {{ request('status_pengaduan') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach

            </select>

            {{-- JENIS --}}
            <select name="jenis_pengaduan"
                    class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

                <option value="">Semua Jenis</option>

                @foreach($jenisPengaduan as $jenis)
                    <option value="{{ $jenis }}"
                        {{ request('jenis_pengaduan') == $jenis ? 'selected' : '' }}>
                        {{ $jenis }}
                    </option>
                @endforeach

            </select>

            {{-- BUTTON --}}
            <button class="bg-[#1D2059] text-white rounded-xl px-4 py-3 text-sm font-semibold">
                Filter
            </button>

        </form>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-x-auto">

        <table class="w-full min-w-[1100px]">

            <thead>
                <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">

                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Judul</th>
                    <th class="px-6 py-4">Pengadu</th>
                    <th class="px-6 py-4">Jenis</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Status</th>

                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 text-sm">

                @forelse($data as $item)

                <tr class="hover:bg-gray-50 transition">

                    {{-- NO --}}
                    <td class="px-6 py-4 text-gray-500">
                        {{ $loop->iteration }}
                    </td>

                    {{-- JUDUL --}}
                    <td class="px-6 py-4 font-semibold text-[#1D2059]">
                        {{ $item->judul_pengaduan }}

                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($item->isi_pengaduan, 80) }}
                        </p>
                    </td>

                    {{-- PENGADU --}}
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-700">
                            {{ $item->nama_pengadu }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $item->kontak_pengadu }}
                        </div>
                    </td>

                    {{-- JENIS --}}
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-lg bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $item->jenis_pengaduan }}
                        </span>
                    </td>

                    {{-- TANGGAL --}}
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('d M Y') }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-4">

                        @if($item->status_pengaduan == 'Menunggu')
                            <span class="px-3 py-1 text-xs rounded-lg bg-yellow-50 text-yellow-700 border border-yellow-100">
                                Menunggu
                            </span>

                        @elseif($item->status_pengaduan == 'Diproses')
                            <span class="px-3 py-1 text-xs rounded-lg bg-blue-50 text-blue-700 border border-blue-100">
                                Diproses
                            </span>

                        @elseif($item->status_pengaduan == 'Selesai')
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
                    <td colspan="6" class="text-center py-10 text-gray-400">
                        Tidak ada data laporan
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection