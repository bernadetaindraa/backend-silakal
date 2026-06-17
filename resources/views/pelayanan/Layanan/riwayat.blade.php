@extends('layouts.admin')

@section('content')
<div class="p-4 md:p-6 space-y-6 max-w-7xl mx-auto">

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
        <h1 class="text-2xl font-bold text-[#1D2059]">Riwayat Layanan</h1>
        <p class="text-sm text-gray-500 mt-1">Data layanan yang telah diarsipkan.</p>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <div class="relative max-w-md">
                <input
                    type="text"
                    id="search-input"
                    value="{{ request('search') }}"
                    placeholder="Cari nama pemohon atau jenis layanan..."
                    class="w-full pl-11 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D2059] focus:border-transparent outline-none transition-all"
                >
                <div class="absolute left-3.5 top-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- JAVASCRIPT AKAN MENG-UPDATE ISI DI DALAM KONTAINER INI --}}
        <div id="table-container">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-100 text-gray-600">
                        <tr>
                            <th class="px-6 py-4 font-semibold">No</th>
                            <th class="px-6 py-4 font-semibold">Pemohon</th>
                            <th class="px-6 py-4 font-semibold">Jenis Layanan</th>
                            <th class="px-6 py-4 font-semibold">Status Terakhir</th>
                            <th class="px-6 py-4 font-semibold">Tanggal Arsip</th>
                            <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($layanan as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $layanan->firstItem() + $loop->index }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $item->user->nama_lengkap ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $item->jenis_layanan_label ?? $item->jenis_layanan }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $item->status_badge ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $item->status_label ?? $item->status_layanan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ optional($item->deleted_at)->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="{{ route('pelayanan.layanan.restore', $item->layanan_id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-medium rounded-lg hover:bg-emerald-100 transition-colors" onclick="return confirm('Apakah Anda yakin ingin memulihkan data ini?')">
                                                Restore
                                            </button>
                                        </form>
                                        <a href="{{ route('pelayanan.layanan.show', $item->layanan_id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-medium rounded-lg hover:bg-blue-100 transition-colors">
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-400">
                                    Tidak ada data arsip layanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($layanan->hasPages())
                <div class="p-6 border-t border-gray-100 bg-white pagination-ajax">
                    {{ $layanan->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

{{-- LIVE SEARCH JAVASCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const tableContainer = document.getElementById('table-container');
        let debounceTimer;

        function fetchLayanan(searchQuery = '', pageUrl = null) {
            let url = pageUrl ? new URL(pageUrl) : new URL("{{ route('pelayanan.layanan.riwayat') }}");
            
            if (!pageUrl && searchQuery) {
                url.searchParams.set('search', searchQuery);
            }

            tableContainer.style.opacity = '0.5';

            fetch(url)
            .then(response => response.text())
            .then(html => {
                // Trik DOMParser: Mengubah string HTML penuh menjadi objek DOM sementara
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                // Ambil hanya konten di dalam #table-container milik halaman baru
                const newTableContent = doc.getElementById('table-container').innerHTML;
                
                // Masukkan konten baru ke tabel lama tanpa refresh halaman
                tableContainer.innerHTML = newTableContent;
                tableContainer.style.opacity = '1';
                
                bindPagination();
            })
            .catch(error => {
                console.error('Error:', error);
                tableContainer.style.opacity = '1';
            });
        }

        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                fetchLayanan(this.value);
            }, 500);
        });

        function bindPagination() {
            const paginationLinks = tableContainer.querySelectorAll('.pagination-ajax a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const url = this.getAttribute('href');
                    fetchLayanan(searchInput.value, url);
                });
            });
        }

        bindPagination();
    });
</script>
@endsection