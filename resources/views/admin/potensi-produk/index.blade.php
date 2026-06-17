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
                Manajemen Potensi Produk
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola data potensi daerah dan produk usaha daerah Kalurahan
            </p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">

            <a href="{{ route('admin.potensi-produk.trashed') }}"
               class="px-4 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-medium hover:bg-red-100 transition">
                Sampah
            </a>

            <a href="{{ route('admin.potensi-produk.create') }}"
               class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">
                Tambah Potensi Produk
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
                           placeholder="Cari potensi atau produk..."
                           autocomplete="off"
                           class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">

                </div>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px]">

                <thead>

                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4 w-[70px]">
                            No
                        </th>

                        <th class="px-6 py-4 min-w-[200px]">
                            Informasi Utama
                        </th>

                        <th class="px-6 py-4 min-w-[200px]">
                            Kategori
                        </th>

                        <th class="px-6 py-4 w-[180px]">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-center w-[180px]">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($potensi as $index => $item)

                    <tr class="hover:bg-gray-50 transition align-top">

                        {{-- NO --}}
                        <td class="px-6 py-5 text-gray-500">
                            {{-- Jika di controller menggunakan paginate(), gunakan: $potensi->firstItem() + $index --}}
                            {{-- Karena di controller menggunakan get(), kita pakai loop iteration --}}
                            {{ $loop->iteration }}
                        </td>

                        {{-- JUDUL & NAMA --}}
                        <td class="px-6 py-5">

                            <h4 class="font-semibold text-[#1D2059] line-clamp-2">
                                {{ $item->judul_potensi_produk }}
                            </h4>

                            <div class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                <span class="text-gray-400">Nama:</span> 
                                <span class="font-medium">{{ $item->nama_potensi_produk }}</span>
                            </div>

                        </td>

                        {{-- KATEGORI --}}
                        <td class="px-6 py-5">
                            @if($item->kategori_potensi_produk === 'Potensi Daerah')
                                <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    {{ $item->kategori_potensi_produk }}
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                    {{ $item->kategori_potensi_produk }}
                                </span>
                            @endif
                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-5 whitespace-nowrap">

                            <div class="font-medium text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_potensi_produk)->translatedFormat('d F Y') }}
                            </div>

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('admin.potensi-produk.edit', $item->potensi_produk_id) }}"
                                    title="Edit Potensi Produk"
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
                                <form
                                    action="{{ route('admin.potensi-produk.destroy', $item->potensi_produk_id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Pindahkan data ini ke tong sampah?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Hapus Potensi Produk"
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

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

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
                                    Belum ada data potensi produk
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        {{-- Aktifkan block dibawah ini jika di Controller (fungsi index) kamu mengubah ->get() menjadi ->paginate(10) --}}
        {{-- 
        @if(method_exists($potensi, 'hasPages') && $potensi->hasPages())
        <div class="p-5 border-t border-gray-100">
            {{ $potensi->appends(['search' => request('search')])->links('pagination::tailwind') }}
        </div>
        @endif 
        --}}

    </div>

</div>

{{-- AUTO SEARCH --}}
<script>
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    let timeout = null;

    // Menjaga fokus kursor agar tetap di akhir teks setelah halaman ter-reload
    if(searchInput.value !== '') {
        searchInput.focus();
        // Pindahkan kursor ke karakter paling belakang
        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    }

    searchInput.addEventListener('keyup', function (e) {
        // Jangan trigger submit kalau yang ditekan adalah tombol arah, shift, ctrl, dll
        const ignoredKeys = ['ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown', 'Shift', 'Control', 'Alt', 'Tab'];
        if (ignoredKeys.includes(e.key)) return;

        clearTimeout(timeout);

        timeout = setTimeout(() => {
            searchForm.submit();
        }, 500); // Tunggu 0.5 detik setelah berhenti mengetik
    });
</script>

@endsection