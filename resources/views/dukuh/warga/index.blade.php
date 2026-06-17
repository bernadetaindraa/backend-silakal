@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6 max-w-7xl mx-auto">

    {{-- HEADER & SEARCH --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1D2059] tracking-tight">Data Warga</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola dan pantau daftar warga di dusun Anda</p>
        </div>

        <div class="w-full md:w-auto">
            {{-- ID form ditambahkan untuk target JavaScript --}}
            <form method="GET" id="search-form" class="relative flex items-center">
                {{-- Tetap pertahankan parameter sort yang aktif saat melakukan pencarian --}}
                <input type="hidden" name="sort" value="{{ request('sort', 'nama_lengkap') }}">
                <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">

                <svg class="w-5 h-5 absolute left-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>

                {{-- ID input ditambahkan untuk target JavaScript --}}
                <input
                    type="text"
                    name="search"
                    id="search-input"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau NIK..."
                    autocomplete="off"
                    class="w-full md:w-80 pl-10 pr-10 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] transition-all shadow-sm"
                >

                @if(request('search'))
                    <a href="{{ request()->url() . '?' . http_build_query(request()->except('search')) }}" class="absolute right-3 text-gray-400 hover:text-red-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left whitespace-nowrap">
                <thead class="bg-gray-50/80 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider text-xs w-16">No</th>
                        
                        {{-- Kolom Nama (Bisa di-sort) --}}
                        <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider text-xs">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama_lengkap', 'direction' => request('sort') == 'nama_lengkap' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-1 hover:text-[#1D2059] transition-colors">
                                Profil Warga
                                @if(request('sort', 'nama_lengkap') == 'nama_lengkap')
                                    {!! request('direction', 'asc') == 'asc' ? '↑' : '↓' !!}
                                @endif
                            </a>
                        </th>

                        {{-- Kolom NIK (Bisa di-sort) --}}
                        <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider text-xs">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'nik', 'direction' => request('sort') == 'nik' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-1 hover:text-[#1D2059] transition-colors">
                                NIK
                                @if(request('sort') == 'nik')
                                    {!! request('direction') == 'asc' ? '↑' : '↓' !!}
                                @endif
                            </a>
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider text-xs">Kontak</th>
                        <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider text-xs text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($warga as $item)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-200">
                        <td class="px-6 py-4 text-gray-500">
                            {{ $warga->firstItem() + $loop->index }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#1D2059]/10 flex items-center justify-center text-[#1D2059] font-bold shrink-0">
                                    {{ strtoupper(substr($item->nama_lengkap, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-medium text-[#1D2059]">{{ $item->nama_lengkap }}</div>
                                    <div class="text-xs text-gray-400">{{ $item->role->role_name ?? 'Belum ada role' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono text-gray-600 bg-gray-100 px-2.5 py-1 rounded-md text-xs border border-gray-200">
                                {{ $item->nik }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->nomor_telepon)
                                <div class="flex items-center gap-1.5 text-gray-600">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    {{ $item->nomor_telepon }}
                                </div>
                            @else
                                <span class="text-gray-400 italic text-xs">Belum ada no HP</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('dukuh.warga.show', $item->user_id) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-2 bg-white border border-gray-200 hover:border-[#1D2059] hover:text-[#1D2059] text-gray-600 text-xs font-medium rounded-lg shadow-sm transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-gray-900 font-medium mb-1">Tidak ada data warga</h3>
                                <p class="text-sm text-gray-500">Coba gunakan kata kunci pencarian yang lain.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if($warga->hasPages())
    <div class="bg-white px-5 py-4 border border-gray-200 rounded-2xl shadow-sm">
        {{ $warga->links() }}
    </div>
    @endif

</div>

{{-- JAVASCRIPT LIVE SEARCH (DEBOUNCE) --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const searchForm = document.getElementById('search-form');
        let timeout = null;

        searchInput.addEventListener('input', function () {
            // Bersihkan timeout sebelumnya setiap kali user mengetik huruf baru
            clearTimeout(timeout);

            // Berikan jeda (delay) 500ms setelah user selesai mengetik sebelum submit otomatis.
            // Ini agar server tidak kelelahan menerima request di setiap ketikan.
            timeout = setTimeout(function () {
                searchForm.submit();
            }, 500); 
        });

        // Menempatkan kursor di akhir teks input pencarian setelah reload halaman
        const val = searchInput.value;
        searchInput.value = '';
        searchInput.focus();
        searchInput.value = val;
    });
</script>
@endsection