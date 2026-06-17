@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    {{-- 1. Banner --}}
    @include('public.partials.banner', [
        'title' => 'Layanan Administrasi Kalurahan Hargobinangun',
        'subtitle' => 'ꦭꦪꦤꦤ꧀ ꦲꦢ꧀ꦩꦶꦤꦶꦱ꧀ꦠꦿꦱꦶ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        {{-- 2. Breadcrumbs --}}
        <nav class="text-sm text-gray-500 mb-10">
            <a href="/" class="hover:text-blue-600 transition">Beranda</a> &gt; 
            <a href="#" class="hover:text-blue-600 transition">Layanan</a> &gt; 
            <span class="text-blue-600 font-medium">Riwayat Layanan</span>
        </nav>

        {{-- 3. Judul Utama --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-[#1D2059] tracking-tight">Riwayat Pengajuan Layanan</h1>
            <p class="text-base text-gray-500 mt-2">Daftar riwayat pengajuan layanan yang pernah dilakukan</p>
        </div>

        {{-- 4. Baris Aksi: Tombol Tambah & Kolom Pencarian --}}
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('user.layanan.pengajuan') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-full text-sm font-semibold transition shadow-md shadow-blue-500/20">
                    + Ajukan Layanan Baru
                </a>
            </div>
            
            {{-- Search Bar "Cari Riwayat" (Ditambahkan ID searchInput) --}}
            <div class="relative w-full sm:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" id="searchInput" placeholder="Cari Riwayat" class="w-full pl-11 pr-4 py-2.5 bg-white border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm placeholder-gray-400">
            </div>
        </div>

        {{-- 5. Tabel Riwayat --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100/80 text-xs font-bold uppercase tracking-wider text-gray-700 border-b border-gray-200">
                            <th class="p-4 w-16 text-center border-r border-gray-200">NO</th>
                            <th class="p-4 border-r border-gray-200">JENIS LAYANAN</th>
                            <th class="p-4 border-r border-gray-200">NOMOR PENGAJUAN</th>
                            <th class="p-4 border-r border-gray-200">TANGGAL PENGAJUAN</th>
                            <th class="p-4 border-r border-gray-200">TERAKHIR DIPERBAHARUI</th>
                            <th class="p-4 text-center border-r border-gray-200">STATUS</th>
                            <th class="p-4 text-center">AKSI</th>
                        </tr>
                    </thead>
                    {{-- Tambahkan ID tableBody pada tbody --}}
                    <tbody id="tableBody" class="text-sm text-gray-700 divide-y divide-gray-200">
                        @forelse ($layanan as $index => $item)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="p-4 text-center text-gray-500 border-r border-gray-100">{{ $index + 1 }}</td>
                                <td class="p-4 font-semibold text-[#1D2059] border-r border-gray-100">{{ $item->jenis_layanan_label }}</td>
                                <td class="p-4 font-mono text-xs text-gray-600 border-r border-gray-100">{{ $item->nomor_layanan ?? 'LAY-' . str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="p-4 text-gray-600 border-r border-gray-100">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                                <td class="p-4 text-gray-600 border-r border-gray-100">{{ \Carbon\Carbon::parse($item->updated_at)->translatedFormat('d F Y') }}</td>
                                <td class="p-4 text-center border-r border-gray-100">
                                    @if(strtolower($item->status_layanan) == 'selesai')
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">Selesai</span>
                                    @elseif(strtolower($item->status_layanan) == 'diproses' || strtolower($item->status_layanan) == 'proses')
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-200 animate-pulse">Diproses</span>
                                    @elseif(strtolower($item->status_layanan) == 'ditolak')
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">Ditolak</span>
                                    @else
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-gray-50 text-gray-700 border border-gray-200">{{ ucfirst($item->status_layanan) }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    @if(strtolower($item->status_layanan) == 'selesai')
                                        <a href="#" class="inline-flex items-center justify-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-md transition shadow-sm">Download File</a>
                                    @elseif(strtolower($item->status_layanan) == 'diproses' || strtolower($item->status_layanan) == 'proses')
                                        <a href="{{ route('user.layanan.tracking', ['id' => $item->id]) }}" class="inline-flex items-center justify-center px-3 py-1.5 bg-[#1D2059] hover:bg-blue-900 text-white text-xs font-semibold rounded-md transition shadow-sm">Pantau Proses</a>
                                    @elseif(strtolower($item->status_layanan) == 'ditolak')
                                        <a href="{{ route('user.layanan.pengajuan') }}" class="inline-flex items-center justify-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-md transition shadow-sm">Ajukan Ulang</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-state">
                                <td colspan="7" class="p-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="font-bold text-base text-gray-700">Belum ada riwayat permohonan.</p>
                                    <p class="text-xs text-gray-400 mt-1">Semua berkas administrasi yang Anda kirim akan tercatat di sini.</p>
                                    <a href="{{ route('user.layanan.pengajuan') }}" class="text-blue-600 hover:underline text-sm font-semibold mt-3 inline-block">Mulai Ajukan Layanan</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 6. Fitur Pagination Otomatis --}}
        @if(method_exists($layanan, 'links'))
            <div class="mt-6 pagination-container">
                {{ $layanan->links() }}
            </div>
        @endif

    </div>
</div>

{{-- Script untuk Live Search Table --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');
        const rows = tableBody.querySelectorAll('tr:not(.empty-state)');

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();

            rows.forEach(row => {
                // Mengambil seluruh teks di dalam baris (td)
                const text = row.textContent.toLowerCase();
                
                // Jika teks cocok dengan pencarian, tampilkan. Jika tidak, sembunyikan.
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

@endsection