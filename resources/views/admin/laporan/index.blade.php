@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">

        <h1 class="text-2xl font-bold text-[#1D2059]">
            Laporan & Dokumen
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Pilih jenis laporan yang ingin dicetak atau ditampilkan
        </p>

    </div>

    {{-- GRID MENU LAPORAN --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- LAPORAN PENGADUAN --}}
        <a href="{{ route('admin.laporan.pengaduan') }}"
           class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#1D2059]/30 transition">

            <div class="w-14 h-14 rounded-xl bg-red-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-8 h-8 text-red-500">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-[#1D2059]">
                Laporan Pengaduan
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Rekap semua pengaduan masyarakat berdasarkan status, jenis, dan tanggal.
            </p>

        </a>

        {{-- LAPORAN SURVEY IKM --}}
        <a href="{{ route('admin.laporan.survey') }}"
           class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#1D2059]/30 transition">

            <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-8 h-8 text-blue-500">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 13.125C3 12.5037 3.50368 12 4.125 12H8.25c.62132 0 1.125.5037 1.125 1.125V20.25H3v-7.125zM14.25 7.125C14.25 6.50368 14.7537 6 15.375 6H19.5c.6213 0 1.125.50368 1.125 1.125V20.25H14.25V7.125zM8.625 4.875C8.625 4.25368 9.12868 3.75 9.75 3.75H13.875C14.4963 3.75 15 4.25368 15 4.875V20.25H8.625V4.875z"/>
                </svg>
            </div>

            <h3 class="text-lg font-bold text-[#1D2059]">
                Laporan Survey IKM
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Hasil survei kepuasan masyarakat dan analisis nilai indeks.
            </p>

        </a>

        {{-- LAPORAN SURAT --}}
        <a href="{{ route('admin.laporan.layanan') }}"
           class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#1D2059]/30 transition">

            <div class="w-14 h-14 rounded-xl bg-emerald-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-8 h-8 text-emerald-500">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 14.25v-8.25a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6v12a2.25 2.25 0 002.25 2.25h10.5A2.25 2.25 0 0019.5 18v-3.75z"/>
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 7.5h7.5M8.25 11.25h7.5M8.25 15h4.5"/>
                </svg>
            </div>

            <h3 class="text-lg font-bold text-[#1D2059]">
                Laporan Pengajuan Surat
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Statistik pengajuan surat berdasarkan jenis layanan.
            </p>

        </a>

        {{-- LAPORAN UMKM --}}
        <a href="{{ route('admin.laporan.potensi-produk') }}"
           class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#1D2059]/30 transition">

            <div class="w-14 h-14 rounded-xl bg-yellow-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-8 h-8 text-yellow-500">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 7.5V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v1.5m18 0v10.5A2.25 2.25 0 0118.75 20.25H5.25A2.25 2.25 0 013 18V7.5m18 0H3"/>
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12h6"/>
                </svg>
            </div>

            <h3 class="text-lg font-bold text-[#1D2059]">
                Laporan Potensi dan Produk Kalurahan
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Data potensi desa dan produk usaha masyarakat.
            </p>

        </a>

        {{-- LAPORAN BUDAYA --}}
        <a href="{{ route('admin.laporan.kebudayaan') }}"
           class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-[#1D2059]/30 transition">

            <div class="w-14 h-14 rounded-xl bg-pink-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 25 26"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-8 h-8 text-pink-500">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9.813 15.904L9 18.75l-2.846.813a.75.75 0 000 1.437L9 21.75l.813 2.846a.75.75 0 001.437 0L12 21.75l2.846-.813a.75.75 0 000-1.437L12 18.75l-.813-2.846a.75.75 0 00-1.437 0z"/>
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M18.259 8.715L18 9.75l-1.035.259a.75.75 0 000 1.482L18 11.75l.259 1.035a.75.75 0 001.482 0L20 11.75l1.035-.259a.75.75 0 000-1.482L20 9.75l-.259-1.035a.75.75 0 00-1.482 0z"/>
                </svg>
            </div>

            <h3 class="text-lg font-bold text-[#1D2059]">
                Laporan Data Kebudayaan Kalurahan
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Dokumentasi dan data kegiatan budaya desa.
            </p>

        </a>

    </div>

</div>

@endsection