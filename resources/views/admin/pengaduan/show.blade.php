@extends('layouts.admin')

@section('content')

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <div class="flex items-center gap-3 flex-wrap mb-3">

                    <a
                        href="{{ route('admin.pengaduan.index') }}"
                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-[#1D2059] transition"
                    >

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"
                            />

                        </svg>

                        Kembali

                    </a>

                    {{-- STATUS --}}
                    @if($pengaduan->status_pengaduan == 'Menunggu')

                        <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-yellow-50 text-yellow-700 border border-yellow-200">
                            Menunggu
                        </span>

                    @elseif($pengaduan->status_pengaduan == 'Diproses')

                        <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                            Diproses
                        </span>

                    @elseif($pengaduan->status_pengaduan == 'Selesai')

                        <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            Selesai
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-red-50 text-red-700 border border-red-200">
                            Ditolak
                        </span>

                    @endif

                </div>

                <h1 class="text-2xl font-bold text-[#1D2059] leading-tight">

                    {{ $pengaduan->judul_pengaduan }}

                </h1>

                <p class="text-sm text-gray-500 mt-2">

                    Detail laporan pengaduan masyarakat Kalurahan

                </p>

            </div>

            {{-- UPDATE STATUS --}}
            <div>

                <form
                    action="{{ route('admin.pengaduan.update-status', $pengaduan->pengaduan_id) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')

                    <div class="flex items-center gap-3 flex-wrap">

                        <select
                            name="status_pengaduan"
                            class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none"
                        >

                            <option
                                value="Menunggu"
                                {{ $pengaduan->status_pengaduan == 'Menunggu' ? 'selected' : '' }}
                            >
                                Menunggu
                            </option>

                            <option
                                value="Diproses"
                                {{ $pengaduan->status_pengaduan == 'Diproses' ? 'selected' : '' }}
                            >
                                Diproses
                            </option>

                            <option
                                value="Selesai"
                                {{ $pengaduan->status_pengaduan == 'Selesai' ? 'selected' : '' }}
                            >
                                Selesai
                            </option>

                            <option
                                value="Ditolak"
                                {{ $pengaduan->status_pengaduan == 'Ditolak' ? 'selected' : '' }}
                            >
                                Ditolak
                            </option>

                        </select>

                        <button
                            type="submit"
                            class="px-5 py-3 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition"
                        >

                            Update Status

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">

        {{-- LEFT --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- DETAIL PENGADUAN --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                {{-- JENIS --}}
                <div class="mb-5">

                    <span class="px-3 py-1 bg-purple-50 text-purple-700 rounded-lg border border-purple-100 font-semibold text-xs">

                        {{ $pengaduan->jenis_pengaduan }}

                    </span>

                </div>

                {{-- ISI --}}
                <div class="mb-8">

                    <h3 class="text-sm font-semibold text-[#1D2059] mb-3">
                        Isi Pengaduan
                    </h3>

                    <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">

                        {{ $pengaduan->isi_pengaduan }}

                    </div>

                </div>

                {{-- LOKASI --}}
                <div class="mb-8">

                    <h3 class="text-sm font-semibold text-[#1D2059] mb-3">
                        Lokasi Kejadian
                    </h3>

                    <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 text-sm text-gray-700">

                        {{ $pengaduan->lokasi_kejadian }}

                    </div>

                </div>

                {{-- LAMPIRAN --}}
                <div>

                    <h3 class="text-sm font-semibold text-[#1D2059] mb-4">
                        Lampiran Bukti
                    </h3>

                    @if($pengaduan->fotoPengaduan->count() > 0)

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            @foreach($pengaduan->fotoPengaduan as $foto)

                                @php
                                    $extension = pathinfo($foto->url_file_pengaduan, PATHINFO_EXTENSION);
                                @endphp

                                <div class="rounded-2xl overflow-hidden border border-gray-200 bg-white">

                                    @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))

                                        <img
                                            src="{{ asset('storage/' . $foto->url_file_pengaduan) }}"
                                            class="w-full h-72 object-cover"
                                        >

                                        <div class="p-4 border-t border-gray-100">

                                            <a
                                                href="{{ asset('storage/' . $foto->url_file_pengaduan) }}"
                                                target="_blank"
                                                class="text-sm font-medium text-[#1D2059] hover:underline"
                                            >

                                                Lihat Gambar

                                            </a>

                                        </div>

                                    @elseif(strtolower($extension) == 'pdf')

                                        <div class="h-72 flex flex-col items-center justify-center p-6 bg-gray-50">

                                            <svg
                                                class="w-14 h-14 text-red-500 mb-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 7V3h10v4m-9 4h8m-8 4h5m-9 4h14a2 2 0 002-2V7
                                                    a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                />

                                            </svg>

                                            <p class="text-sm text-gray-600 mb-4">
                                                Dokumen PDF
                                            </p>

                                            <a
                                                href="{{ asset('storage/' . $foto->url_file_pengaduan) }}"
                                                target="_blank"
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm transition"
                                            >

                                                Lihat PDF

                                            </a>

                                        </div>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="bg-gray-50 border border-gray-100 rounded-xl p-5 text-sm text-gray-400 italic">

                            Tidak ada lampiran bukti.

                        </div>

                    @endif

                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="space-y-6">

            {{-- INFORMASI PENGADU --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                <h2 class="text-sm font-bold text-[#1D2059] uppercase tracking-wider mb-5">
                    Informasi Pengadu
                </h2>

                <div class="space-y-5 text-sm">

                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Nama Pengadu
                        </p>

                        <p class="font-semibold text-gray-700">
                            {{ $pengaduan->nama_pengadu }}
                        </p>

                    </div>

                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Kontak Pengadu
                        </p>

                        <p class="font-semibold text-blue-600">
                            {{ $pengaduan->kontak_pengadu }}
                        </p>

                    </div>

                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Tanggal Pengaduan
                        </p>

                        <p class="font-semibold text-gray-700">
                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->translatedFormat('d F Y') }}
                        </p>

                    </div>

                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Dibuat Pada
                        </p>

                        <p class="font-semibold text-gray-700">
                            {{ $pengaduan->created_at ? $pengaduan->created_at->format('d M Y H:i') : '-' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-gray-400 text-xs mb-1">
                            Terakhir Diperbarui
                        </p>

                        <p class="font-semibold text-gray-700">
                            {{ $pengaduan->updated_at ? $pengaduan->updated_at->format('d M Y H:i') : '-' }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- AKSI --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                <h2 class="text-sm font-bold text-[#1D2059] uppercase tracking-wider mb-5">
                    Aksi
                </h2>

                <div class="space-y-3">

                    <form
                        action="{{ route('admin.pengaduan.destroy', $pengaduan->pengaduan_id) }}"
                        method="POST"
                        onsubmit="return confirm('Pindahkan pengaduan ke tong sampah?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full px-4 py-3 rounded-xl border border-red-100 bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition"
                        >

                            Hapus Pengaduan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection