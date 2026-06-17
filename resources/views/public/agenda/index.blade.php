@extends('layouts.public')

@section('content')
<div class="bg-gradient-to-b from-[#F4F7FB] to-[#EEF2FF] min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-6xl mx-auto">

        <div class="mb-8">

            <nav class="text-xs text-gray-500 space-x-1 mb-2">
                <a href="/" class="hover:text-[#1D2059] transition">
                    Beranda
                </a>

                <span>&gt;</span>

                <span class="text-[#1D2059] font-semibold">
                    Agenda Kalurahan
                </span>
            </nav>

            <h1 class="text-3xl font-bold text-[#1D2059]">
                Agenda Terbaru
            </h1>

            <p class="text-sm text-gray-600 mt-1">
                Daftar agenda kegiatan, piket, dan izin cuti pamong Kalurahan Hargobinangun
            </p>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            @foreach($agenda as $item)

                <a
                    href="{{ route('agenda.show', $item->agenda_id) }}"
                    class="group bg-white rounded-2xl border border-[#E3E8F2] overflow-hidden shadow-sm hover:shadow-lg hover:border-[#1D2059]/20 transition duration-300"
                >

                    <div class="relative bg-gradient-to-r from-[#1D2059] to-[#2F3A8F] p-4">

                        <div class="grid grid-cols-3 gap-2">

                            @foreach($item->agendaItems->take(3) as $agendaItem)


                            @endforeach

                        </div>

                        <div class="mt-4">

                            <span class="bg-white text-[#1D2059] text-[10px] font-bold px-3 py-1 rounded-md shadow-sm">
                                {{ $item->tanggal_agenda->translatedFormat('d F Y') }}
                            </span>

                        </div>

                    </div>

                    <div class="p-5">

                        <h3 class="text-sm font-bold text-[#1D2059] uppercase tracking-tight leading-normal group-hover:text-[#2F3A8F] transition">
                            {{ $item->judul_agenda }}
                        </h3>

                        <div class="mt-3 flex flex-wrap gap-2 text-[11px]">

                            <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full font-semibold">
                                {{ $item->agendaItems->count() }} Agenda
                            </span>

                            <span class="bg-yellow-50 text-yellow-700 px-2.5 py-1 rounded-full font-semibold">
                                {{ $item->piketDukuh->count() }} Piket
                            </span>

                            <span class="bg-red-50 text-red-700 px-2.5 py-1 rounded-full font-semibold">
                                {{ $item->izinCuti->count() }} Izin
                            </span>

                        </div>

                        <div class="mt-4 flex items-center justify-between">

                            <p class="text-xs text-gray-400">
                                Klik untuk melihat detail agenda
                            </p>

                            <div class="w-7 h-7 rounded-full bg-[#EEF2FF] flex items-center justify-center text-[#1D2059] text-sm group-hover:bg-[#1D2059] group-hover:text-white transition">
                                →
                            </div>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

        <div class="mt-10">
            {{ $agenda->links() }}
        </div>

    </div>

</div>
@endsection