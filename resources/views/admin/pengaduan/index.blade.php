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
                Manajemen Pengaduan
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola seluruh data pengaduan masyarakat Kalurahan
            </p>

        </div>

    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- FILTER --}}
        <div class="p-5 border-b border-gray-100">

            <form
                method="GET"
                action="{{ url()->current() }}"
                id="searchForm"
                class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between"
            >

                {{-- SEARCH --}}
                <div class="relative w-full max-w-md">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">

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
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />

                        </svg>

                    </span>

                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        value="{{ request('search') }}"
                        placeholder="Cari pengaduan..."
                        autocomplete="off"
                        class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none"
                    >

                </div>

                {{-- FILTER STATUS --}}
                <div>

                    <select
                        name="status_pengaduan"
                        onchange="document.getElementById('searchForm').submit()"
                        class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none"
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="Menunggu"
                            {{ request('status_pengaduan') == 'Menunggu' ? 'selected' : '' }}
                        >
                            Menunggu
                        </option>

                        <option
                            value="Diproses"
                            {{ request('status_pengaduan') == 'Diproses' ? 'selected' : '' }}
                        >
                            Diproses
                        </option>

                        <option
                            value="Selesai"
                            {{ request('status_pengaduan') == 'Selesai' ? 'selected' : '' }}
                        >
                            Selesai
                        </option>

                        <option
                            value="Ditolak"
                            {{ request('status_pengaduan') == 'Ditolak' ? 'selected' : '' }}
                        >
                            Ditolak
                        </option>

                    </select>

                </div>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1250px]">

                <thead>

                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4 w-[70px]">
                            No
                        </th>

                        <th class="px-6 py-4 min-w-[280px]">
                            Pengaduan
                        </th>

                        <th class="px-6 py-4 min-w-[200px]">
                            Pengadu
                        </th>

                        <th class="px-6 py-4 min-w-[180px]">
                            Jenis
                        </th>

                        <th class="px-6 py-4 min-w-[180px]">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 min-w-[140px]">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center min-w-[320px]">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($data as $item)

                    <tr class="hover:bg-gray-50 transition align-top">

                        {{-- NO --}}
                        <td class="px-6 py-5 text-gray-500">
                            {{ $loop->iteration }}
                        </td>

                        {{-- PENGADUAN --}}
                        <td class="px-6 py-5">

                            <h4 class="font-semibold text-[#1D2059] line-clamp-2">
                                {{ $item->judul_pengaduan }}
                            </h4>

                            <div class="text-xs text-gray-500 mt-1 line-clamp-2">
                                {{ Str::limit($item->isi_pengaduan, 100) }}
                            </div>

                            <div class="text-xs text-gray-400 mt-2">
                                Lokasi: {{ $item->lokasi_kejadian }}
                            </div>

                        </td>

                        {{-- PENGADU --}}
                        <td class="px-6 py-5">

                            <div class="font-medium text-gray-700">
                                {{ $item->nama_pengadu }}
                            </div>

                            <div class="text-xs text-gray-500 mt-1">
                                {{ $item->kontak_pengadu }}
                            </div>

                        </td>

                        {{-- JENIS --}}
                        <td class="px-6 py-5">

                            <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-100">

                                {{ $item->jenis_pengaduan }}

                            </span>

                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-5 whitespace-nowrap">

                            <div class="font-medium text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->translatedFormat('d F Y') }}
                            </div>

                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($item->status_pengaduan == 'Menunggu')

                                <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                    Menunggu
                                </span>

                            @elseif($item->status_pengaduan == 'Diproses')

                                <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    Diproses
                                </span>

                            @elseif($item->status_pengaduan == 'Selesai')

                                <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    Selesai
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-red-50 text-red-700 border border-red-200">
                                    Ditolak
                                </span>

                            @endif

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2 flex-wrap">

                                {{-- DETAIL --}}
                                <a
                                    href="{{ route('admin.pengaduan.show', $item->pengaduan_id) }}"
                                    title="Detail Pengaduan"
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
                                            d="M15 12H9m12 0A9 9 0 1112 3a9 9 0 019 9z"
                                        />

                                    </svg>

                                </a>

                                {{-- UPDATE STATUS --}}
                                <form
                                    action="{{ route('admin.pengaduan.update-status', $item->pengaduan_id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status_pengaduan"
                                        onchange="this.form.submit()"
                                        class="
                                            h-10
                                            rounded-xl
                                            border border-gray-200
                                            text-xs
                                            px-3
                                            outline-none
                                            focus:ring-2
                                            focus:ring-[#1D2059]/20
                                            focus:border-[#1D2059]
                                        "
                                    >

                                        <option
                                            value="Menunggu"
                                            {{ $item->status_pengaduan == 'Menunggu' ? 'selected' : '' }}
                                        >
                                            Menunggu
                                        </option>

                                        <option
                                            value="Diproses"
                                            {{ $item->status_pengaduan == 'Diproses' ? 'selected' : '' }}
                                        >
                                            Diproses
                                        </option>

                                        <option
                                            value="Selesai"
                                            {{ $item->status_pengaduan == 'Selesai' ? 'selected' : '' }}
                                        >
                                            Selesai
                                        </option>

                                        <option
                                            value="Ditolak"
                                            {{ $item->status_pengaduan == 'Ditolak' ? 'selected' : '' }}
                                        >
                                            Ditolak
                                        </option>

                                    </select>

                                </form>

                                {{-- DELETE --}}
                                <div x-data="{ openDelete: false }">

                                    {{-- BUTTON --}}
                                    <button
                                        type="button"
                                        @click="openDelete = true"
                                        title="Hapus Pengaduan"
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

                                    {{-- MODAL --}}
                                    <div
                                        x-show="openDelete"
                                        x-cloak
                                        class="fixed inset-0 z-[9999] flex items-center justify-center"
                                    >

                                        {{-- BACKDROP --}}
                                        <div
                                            @click="openDelete = false"
                                            class="absolute inset-0 bg-black/40 backdrop-blur-sm"
                                        ></div>

                                        {{-- CONTENT --}}
                                        <div
                                            x-transition
                                            class="relative bg-white w-full max-w-md rounded-2xl shadow-2xl p-6 mx-4"
                                        >

                                            {{-- ICON --}}
                                            <div class="w-14 h-14 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">

                                                <svg
                                                    class="w-7 h-7 text-red-500"
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

                                            </div>

                                            {{-- TITLE --}}
                                            <h3 class="text-lg font-bold text-center text-[#1D2059]">
                                                Hapus Pengaduan?
                                            </h3>

                                            {{-- DESC --}}
                                            <p class="text-sm text-gray-500 text-center mt-2 leading-relaxed">

                                                Data pengaduan akan dipindahkan ke tong sampah dan masih dapat direstore kembali.

                                            </p>

                                            {{-- ACTION --}}
                                            <div class="flex items-center gap-3 mt-6">

                                                <button
                                                    type="button"
                                                    @click="openDelete = false"
                                                    class="
                                                        flex-1
                                                        px-4 py-3
                                                        rounded-xl
                                                        border border-gray-200
                                                        text-sm
                                                        font-medium
                                                        hover:bg-gray-50
                                                        transition
                                                    "
                                                >

                                                    Batal

                                                </button>

                                                <form
                                                    action="{{ route('admin.pengaduan.destroy', $item->pengaduan_id) }}"
                                                    method="POST"
                                                    class="flex-1"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="
                                                            w-full
                                                            px-4 py-3
                                                            rounded-xl
                                                            bg-red-600
                                                            hover:bg-red-700
                                                            text-white
                                                            text-sm
                                                            font-semibold
                                                            transition
                                                        "
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
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5
                                        a2 2 0 012-2h5.586a1 1 0 01.707.293
                                        l5.414 5.414a1 1 0 01.293.707V19
                                        a2 2 0 01-2 2z"
                                    />

                                </svg>

                                <p class="font-medium">
                                    Belum ada data pengaduan
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- AUTO SEARCH --}}
<script>

    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    let timeout = null;

    if(searchInput.value !== '') {

        searchInput.focus();

        searchInput.setSelectionRange(
            searchInput.value.length,
            searchInput.value.length
        );
    }

    searchInput.addEventListener('keyup', function (e) {

        const ignoredKeys = [
            'ArrowLeft',
            'ArrowRight',
            'ArrowUp',
            'ArrowDown',
            'Shift',
            'Control',
            'Alt',
            'Tab'
        ];

        if (ignoredKeys.includes(e.key)) return;

        clearTimeout(timeout);

        timeout = setTimeout(() => {
            searchForm.submit();
        }, 500);

    });

</script>

@endsection