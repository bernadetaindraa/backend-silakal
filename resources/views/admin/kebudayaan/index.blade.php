@extends('layouts.admin')

@section('content')

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div class="p-6 space-y-6">

    {{-- SUCCESS ALERT --}}
    @if(session('success'))

    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-[9999]"
    >

        <div class="bg-emerald-500 text-white px-5 py-4 rounded-2xl shadow-2xl flex items-center gap-3">

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                />
            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>

    </div>

    @endif

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Manajemen Kebudayaan
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola data kebudayaan benda dan non-benda daerah Kalurahan
            </p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
            <a href="{{ route('admin.kebudayaan.create') }}"
               class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">
                Tambah Kebudayaan
            </a>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- SEARCH --}}
        <div class="p-5 border-b border-gray-100">

            <form method="GET"
                  action="{{ url()->current() }}"
                  id="searchForm">

                <div class="relative max-w-md">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>

                        </svg>

                    </span>

                    <input type="text"
                           name="search"
                           id="searchInput"
                           value="{{ request('search') }}"
                           placeholder="Cari kebudayaan..."
                           autocomplete="off"
                           class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">

                </div>

            </form>

        </div>

        {{-- TABLE (Disempurnakan) --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px]">

                <thead>

                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4 w-[70px]">
                            No
                        </th>

                        <th class="px-6 py-4 min-w-[250px]">
                            Informasi Kebudayaan
                        </th>

                        {{-- Kolom Kategori --}}
                        <th class="px-6 py-4 min-w-[150px]">
                            Kategori
                        </th>

                        {{-- Kolom Jenis --}}
                        <th class="px-6 py-4 min-w-[150px]">
                            Jenis
                        </th>

                        <th class="px-6 py-4 min-w-[150px]">
                            Tahun Ditetapkan
                        </th>

                        <th class="px-6 py-4 text-center w-[180px]">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($data as $index => $item)

                    <tr class="hover:bg-gray-50 transition align-top">

                        {{-- NO --}}
                        <td class="px-6 py-5 text-gray-500">
                            {{ $loop->iteration }}
                        </td>

                        {{-- JUDUL & LOKASI --}}
                        <td class="px-6 py-5">
                            <h4 class="font-semibold text-[#1D2059] line-clamp-2">
                                {{ $item->judul_kebudayaan }}
                            </h4>

                            <div class="text-xs text-gray-500 mt-1 flex flex-col gap-1">
                                <div>
                                    <span class="text-gray-400">Lokasi:</span> 
                                    <span class="font-medium text-gray-600">{{ $item->lokasi_kebudayaan }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- KATEGORI --}}
                        <td class="px-6 py-5">
                            @if($item->jenisKebudayaan && $item->jenisKebudayaan->kategoriKebudayaan)
                                <span class="text-sm text-gray-600 font-medium">
                                    {{ $item->jenisKebudayaan->kategoriKebudayaan->nama_kategori }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400 italic">-</span>
                            @endif
                        </td>

                        {{-- JENIS --}}
                        <td class="px-6 py-5">
                            @if($item->jenisKebudayaan)
                                <span class="inline-flex px-2 py-1 rounded-md text-[12px] font-semibold text-gray-600">
                                    {{ $item->jenisKebudayaan->nama_jenis ?? 'Tanpa Jenis' }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400 italic">Belum ada jenis</span>
                            @endif
                        </td>

                        {{-- TAHUN DITETAPKAN --}}
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="font-medium text-gray-700">
                                {{ $item->tahun_ditetapkan ?: '-' }}
                            </div>
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('admin.kebudayaan.edit', $item->kebudayaan_id) }}"
                                    title="Edit Kebudayaan"
                                    class="
                                        w-10 h-10
                                        rounded-xl
                                        border border-gray-200
                                        flex items-center justify-center
                                        text-gray-500
                                        hover:text-[#1D2059]
                                        hover:border-[#1D2059]
                                        hover:bg-[#1D2059]/5
                                        transition
                                    "
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
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                            m-1.414-9.414a2 2 0 112.828 2.828
                                            L11.828 15H9v-2.828l8.586-8.586z"
                                        />
                                    </svg>
                                </a>

                                {{-- DELETE --}}
                                <div x-data="{ openDelete: false }">

                                    {{-- BUTTON DELETE --}}
                                    <button
                                        type="button"
                                        @click="openDelete = true"
                                        title="Hapus Kebudayaan"
                                        class="
                                            w-10 h-10
                                            rounded-xl
                                            border border-red-100
                                            flex items-center justify-center
                                            text-red-500
                                            hover:bg-red-50
                                            hover:border-red-200
                                            transition
                                        "
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21
                                                H7.862a2 2 0 01-1.995-1.858L5 7
                                                m5 4v6m4-6v6"
                                            />
                                        </svg>
                                    </button>

                                    {{-- MODAL DELETE --}}
                                    <div
                                        x-show="openDelete"
                                        x-transition.opacity
                                        x-cloak
                                        class="fixed inset-0 z-[9999] flex items-center justify-center px-4"
                                    >

                                        {{-- BACKDROP --}}
                                        <div
                                            class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                                            @click="openDelete = false"
                                        ></div>

                                        {{-- CONTENT --}}
                                        <div
                                            x-show="openDelete"
                                            x-transition.scale
                                            class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl p-6"
                                        >

                                            {{-- ICON --}}
                                            <div class="flex items-center justify-center w-16 h-16 mx-auto rounded-full bg-red-100 mb-4">

                                                <svg
                                                    class="w-8 h-8 text-red-600"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"
                                                    />
                                                </svg>

                                            </div>

                                            {{-- TITLE --}}
                                            <h2 class="text-2xl font-bold text-center text-[#1D2059] mb-2">
                                                Hapus Kebudayaan?
                                            </h2>

                                            {{-- DESC --}}
                                            <p class="text-sm text-gray-500 text-center mb-6 leading-relaxed">
                                                Data kebudayaan
                                                <span class="font-semibold text-[#1D2059]">
                                                    "{{ $item->judul_kebudayaan }}"
                                                </span>
                                                akan dipindahkan ke sampah.
                                            </p>

                                            {{-- ACTION --}}
                                            <div class="flex justify-center gap-3">

                                                <button
                                                    type="button"
                                                    @click="openDelete = false"
                                                    class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition"
                                                >
                                                    Batal
                                                </button>

                                                <form
                                                    action="{{ route('admin.kebudayaan.destroy', $item->kebudayaan_id) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 transition"
                                                    >
                                                        Ya, Hapus
                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        {{-- Colspan diubah menjadi 6 karena sekarang ada 6 kolom (No, Informasi, Kategori, Jenis, Tahun, Aksi) --}}
                        <td colspan="6" class="py-14 text-center text-gray-400">

                            <div class="flex flex-col items-center">

                                <svg
                                    class="w-12 h-12 mb-3 text-gray-300"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7
                                        a2 2 0 00-2-2H6a2 2 0 00-2 2v11
                                        a2 2 0 002 2z"
                                    />
                                </svg>

                                <p class="font-medium">
                                    Belum ada data kebudayaan
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        {{-- 
        @if(method_exists($data, 'hasPages') && $data->hasPages())
        <div class="p-5 border-t border-gray-100">
            {{ $data->appends(['search' => request('search')])->links('pagination::tailwind') }}
        </div>
        @endif 
        --}}

    </div>

</div>

{{-- AUTO SEARCH --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let timeout = null;

        if (searchInput && searchForm) {
            // Kembalikan fokus ke input setelah halaman ter-reload (karena form submit)
            if(searchInput.value !== '') {
                searchInput.focus();
                // Set cursor di akhir teks
                const length = searchInput.value.length;
                searchInput.setSelectionRange(length, length);
            }

            // Gunakan event 'input' alih-alih 'keyup'
            searchInput.addEventListener('input', function (e) {
                clearTimeout(timeout);

                // Tunggu 500ms setelah user berhenti mengetik, baru jalankan pencarian
                timeout = setTimeout(() => {
                    searchForm.submit();
                }, 500); 
            });

            // Opsional: Mencegah form submit saat user tidak sengaja menekan Enter (karena sudah otomatis)
            searchForm.addEventListener('submit', function(e) {
                if (document.activeElement === searchInput && timeout) {
                    // Biarkan submit berjalan natural jika ditekan enter
                    clearTimeout(timeout);
                }
            });
        }
    });
</script>

@endsection