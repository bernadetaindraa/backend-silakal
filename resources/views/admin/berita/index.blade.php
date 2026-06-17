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
                Manajemen Berita
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola publikasi berita dan informasi Kalurahan Hargobinangun
            </p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">

            <a href="{{ url('admin/berita/trashed') }}"
               class="px-4 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-medium hover:bg-red-100 transition">
                Sampah
            </a>

            <a href="{{ url('admin/berita/create') }}"
               class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">
                Tambah Berita
            </a>

        </div>
    </div>

    {{-- TABLE --}}
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
                           placeholder="Cari judul atau isi berita..."
                           autocomplete="off"
                           class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">

                </div>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1150px]">

                <thead>

                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4 w-[70px]">
                            No
                        </th>

                        <th class="px-6 py-4 w-[120px]">
                            Foto
                        </th>

                        <th class="px-6 py-4 min-w-[250px]">
                            Judul
                        </th>

                        <th class="px-6 py-4 min-w-[220px]">
                            Kategori
                        </th>

                        <th class="px-6 py-4 w-[140px]">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 w-[140px]">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center w-[260px]">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($berita as $index => $item)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- NO --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ $berita->firstItem() + $index }}
                        </td>

                        {{-- FOTO --}}
                        <td class="px-6 py-4">

                            <div class="w-16 h-12 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">

                                @if($item->foto->count() > 0)

                                    <img
                                        src="{{ asset('storage/' . $item->foto->first()->url_file_berita) }}"
                                        class="w-full h-full object-cover"
                                        alt="Foto Berita"
                                    >

                                @else

                                    <div class="w-full h-full flex items-center justify-center text-gray-400">

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
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"
                                            />

                                        </svg>

                                    </div>

                                @endif

                            </div>

                        </td>

                        {{-- JUDUL --}}
                        <td class="px-6 py-4">

                            <h4 class="font-semibold text-[#1D2059] line-clamp-1">
                                {{ $item->judul_berita }}
                            </h4>

                            <p class="text-xs text-gray-400 mt-1">
                                Oleh {{ $item->user->name ?? 'Admin' }}
                            </p>

                        </td>

                        {{-- KATEGORI --}}
                        <td class="px-6 py-4">

                            <div class="flex flex-wrap gap-2">

                                @forelse($item->kategori as $kategori)

                                    <span class="px-2.5 py-1 rounded-lg bg-gray-100 text-xs text-gray-700">
                                        {{ $kategori->nama_kategori }}
                                    </span>

                                @empty

                                    <span class="text-xs text-gray-400">
                                        Tanpa Kategori
                                    </span>

                                @endforelse

                            </div>

                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->tanggal_berita)->translatedFormat('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4">

                            @if(strtolower($item->status_berita) == 'published')

                                <span class="px-3 py-1 rounded-xl bg-emerald-50 text-emerald-600 text-xs font-semibold">
                                    Published
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-xl bg-amber-50 text-amber-600 text-xs font-semibold">
                                    Draft
                                </span>

                            @endif

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                {{-- STATUS --}}
                                <form
                                    action="{{ route('admin.berita.toggle-status', $item->berita_id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        title="{{ strtolower($item->status_berita) == 'published' ? 'Ubah ke Draft' : 'Publish Berita' }}"
                                        class="
                                            w-10 h-10
                                            rounded-xl
                                            flex items-center justify-center
                                            transition
                                            border

                                            {{ strtolower($item->status_berita) == 'published'
                                                ? 'bg-emerald-50 text-emerald-600 border-emerald-100 hover:bg-emerald-100'
                                                : 'bg-amber-50 text-amber-600 border-amber-100 hover:bg-amber-100'
                                            }}
                                        "
                                    >

                                        @if(strtolower($item->status_berita) == 'published')

                                            {{-- EYE --}}
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
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                    c4.478 0 8.268 2.943 9.542 7
                                                    -1.274 4.057-5.064 7-9.542 7
                                                    -4.477 0-8.268-2.943-9.542-7z"
                                                />
                                            </svg>

                                        @else

                                            {{-- EYE OFF --}}
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
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19
                                                    c-4.478 0-8.268-2.943-9.542-7
                                                    a9.956 9.956 0 012.042-3.368
                                                    m2.153-2.153A9.953 9.953 0 0112 5
                                                    c4.478 0 8.268 2.943 9.542 7
                                                    a9.97 9.97 0 01-4.132 5.411
                                                    M15 12a3 3 0 11-6 0
                                                    3 3 0 016 0z"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 3l18 18"
                                                />

                                            </svg>

                                        @endif

                                    </button>

                                </form>

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('admin.berita.edit', $item->berita_id) }}"
                                    title="Edit Berita"
                                    class="
                                        w-10 h-10
                                        rounded-xl
                                        border border-gray-200
                                        flex items-center justify-center
                                        text-gray-500
                                        hover:text-primary
                                        hover:border-primary
                                        hover:bg-primary/5
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
                                    action="{{ route('admin.berita.destroy', $item->berita_id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Pindahkan berita ke tong sampah?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Hapus Berita"
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

                        <td colspan="7" class="py-14 text-center text-gray-400">

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
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />

                                </svg>

                                <p class="font-medium">
                                    Belum ada data berita
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($berita->hasPages())

        <div class="p-5 border-t border-gray-100">

            {{ $berita->appends(['search' => request('search')])->links('pagination::tailwind') }}

        </div>

        @endif

    </div>

</div>

{{-- AUTO SEARCH --}}
<script>

    let timeout = null;

    document
        .getElementById('searchInput')
        .addEventListener('keyup', function () {

            clearTimeout(timeout);

            timeout = setTimeout(() => {

                document
                    .getElementById('searchForm')
                    .submit();

            }, 500);

        });

</script>

@endsection