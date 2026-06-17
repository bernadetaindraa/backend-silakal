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
                Manajemen Agenda
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Kelola agenda kegiatan, piket dukuh, dan izin cuti aparatur Kalurahan
            </p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">

            <a href="{{ route('admin.agenda.trashed') }}"
               class="px-4 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-medium hover:bg-red-100 transition">
                Sampah
            </a>

            <a href="{{ route('admin.agenda.create') }}"
               class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">
                Tambah Agenda
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
                           placeholder="Cari agenda..."
                           autocomplete="off"
                           class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">

                </div>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1300px]">

                <thead>

                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4 w-[70px]">
                            No
                        </th>

                        <th class="px-6 py-4 min-w-[220px]">
                            Agenda
                        </th>

                        <th class="px-6 py-4 w-[180px]">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 min-w-[320px]">
                            Kegiatan
                        </th>

                        <th class="px-6 py-4 min-w-[240px]">
                            Piket Dukuh
                        </th>

                        <th class="px-6 py-4 min-w-[240px]">
                            Izin / Cuti
                        </th>

                        <th class="px-6 py-4 text-center w-[180px]">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($agenda as $index => $item)

                    <tr class="hover:bg-gray-50 transition align-top">

                        {{-- NO --}}
                        <td class="px-6 py-5 text-gray-500">
                            {{ $agenda->firstItem() + $index }}
                        </td>

                        {{-- JUDUL --}}
                        <td class="px-6 py-5">

                            <h4 class="font-semibold text-[#1D2059] line-clamp-2">
                                {{ $item->judul_agenda }}
                            </h4>

                            <p class="text-xs text-gray-400 mt-1">
                                Dibuat:
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </p>

                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-5 whitespace-nowrap">

                            <div class="font-medium text-gray-700">
                                {{ $item->tanggal_agenda->translatedFormat('d F Y') }}
                            </div>

                            <div class="text-xs text-gray-400 mt-1">
                                {{ $item->tanggal_agenda->translatedFormat('l') }}
                            </div>

                        </td>

                        {{-- KEGIATAN --}}
                        <td class="px-6 py-5">

                            <div class="space-y-2">

                                @forelse($item->agendaItems->sortBy(function ($a) {
                                    return \Carbon\Carbon::parse($a->waktu_agenda);
                                })->take(3) as $agendaItem)

                                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-3">

                                        <div class="flex items-start justify-between gap-3">

                                            <div>
                                                <div class="font-semibold text-[#1D2059] text-xs">
                                                    {{ $agendaItem->nama_agenda }}
                                                </div>

                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ $agendaItem->tempat_agenda }}
                                                </div>
                                            </div>

                                            <span class="text-[11px] text-blue-700 font-semibold whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($agendaItem->waktu_agenda)->format('H:i') }}
                                            </span>

                                        </div>

                                    </div>

                                @empty

                                    <div class="text-xs text-gray-400">
                                        Tidak ada agenda
                                    </div>

                                @endforelse

                                @if($item->agendaItems->sortBy(function ($a) {
                                    return \Carbon\Carbon::parse($a->waktu_piket);
                                })->count() > 3)

                                    <div class="text-xs text-blue-600 font-medium">
                                        +{{ $item->agendaItems->count() - 3 }} agenda lainnya
                                    </div>

                                @endif

                            </div>

                        </td>

                        {{-- PIKET --}}
                        <td class="px-6 py-5">

                            <div class="space-y-2">

                                @forelse($item->piketDukuh->take(3) as $piket)

                                    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-3">

                                        <div class="font-semibold text-yellow-700 text-xs">
                                            {{ $piket->user->nama_lengkap ?? '-' }}
                                        </div>

                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $piket->keterangan_piket }}
                                        </div>

                                    </div>

                                @empty

                                    <div class="text-xs text-gray-400">
                                        Tidak ada piket
                                    </div>

                                @endforelse

                                @if($item->piketDukuh->count() > 3)

                                    <div class="text-xs text-yellow-700 font-medium">
                                        +{{ $item->piketDukuh->count() - 3 }} piket lainnya
                                    </div>

                                @endif

                            </div>

                        </td>

                        {{-- IZIN --}}
                        <td class="px-6 py-5">

                            <div class="space-y-2">

                                @forelse($item->izinCuti->take(3) as $izin)

                                    <div class="bg-red-50 border border-red-100 rounded-xl p-3">

                                        <div class="font-semibold text-red-700 text-xs">
                                            {{ $izin->user->nama_lengkap ?? '-' }}
                                        </div>

                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $izin->alasan_izin_cuti }}
                                        </div>

                                    </div>

                                @empty

                                    <div class="text-xs text-gray-400">
                                        Tidak ada izin
                                    </div>

                                @endforelse

                                @if($item->izinCuti->count() > 3)

                                    <div class="text-xs text-red-700 font-medium">
                                        +{{ $item->izinCuti->count() - 3 }} izin lainnya
                                    </div>

                                @endif

                            </div>

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('admin.agenda.edit', $item->agenda_id) }}"
                                    title="Edit Agenda"
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
                                    action="{{ route('admin.agenda.destroy', $item->agenda_id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Pindahkan agenda ke tong sampah?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Hapus Agenda"
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
                                        d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7
                                        a2 2 0 00-2-2H6a2 2 0 00-2 2v11
                                        a2 2 0 002 2z"
                                    />

                                </svg>

                                <p class="font-medium">
                                    Belum ada data agenda
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($agenda->hasPages())

        <div class="p-5 border-t border-gray-100">

            {{ $agenda->appends(['search' => request('search')])->links('pagination::tailwind') }}

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