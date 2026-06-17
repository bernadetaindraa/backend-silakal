@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">

    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-blue-950 uppercase border-b-4 border-cyan-500 pb-2 inline-block">
                Agenda Kalurahan
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                Tanggal Agenda :
                <span class="font-semibold text-gray-700">
                    {{ $agenda->created_at->translatedFormat('l, d F Y') }}
                </span>
            </p>

        </div>

        <div class="space-y-8">

            @php
                $agendaDalam = $agenda->agendaItems->where('kategori_agenda', 'Di Dalam Kantor Kalurahan');
                $agendaLuar = $agenda->agendaItems->where('kategori_agenda', 'Di Luar Kantor Kalurahan');
            @endphp

            {{-- AGENDA DALAM KANTOR --}}
            <div>

                <div class="bg-cyan-600 text-white px-4 py-2 font-bold text-sm uppercase rounded-t-lg tracking-wider">
                    A. Agenda Di Dalam Kantor Kalurahan
                </div>

                <div class="overflow-x-auto border-x border-b border-gray-200 rounded-b-lg">

                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">

                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 border-r border-gray-200 w-16 text-center">No</th>
                                <th class="px-4 py-3 border-r border-gray-200 w-32">Jam</th>
                                <th class="px-4 py-3 border-r border-gray-200">Acara / Kegiatan</th>
                                <th class="px-4 py-3 border-r border-gray-200">Tempat</th>
                                <th class="px-4 py-3 border-r border-gray-200">Penyelenggara</th>
                                <th class="px-4 py-3">Peserta</th>
                            </tr>
                        </thead>

                        @php
                            $agendaDalamSorted = $agendaDalam->sortBy(function ($a) {
                                return \Carbon\Carbon::parse($a->waktu_agenda);
                            });
                            $agendaLuarSorted = $agendaLuar->sortBy(function ($a) {
                                return \Carbon\Carbon::parse($a->waktu_agenda);
                            });
                            $piketSorted = $agenda->piketDukuh->sortBy(function ($a) {
                                return \Carbon\Carbon::parse($a->waktu_piket);
                            });
                        @endphp

                        <tbody class="divide-y divide-gray-200 text-gray-700 bg-white">

                            @forelse($agendaDalamSorted as $index => $item)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-4 py-3 border-r border-gray-200 text-center">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $item->waktu_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200 font-semibold text-blue-950">
                                        {{ $item->nama_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $item->tempat_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $item->penyelenggara_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 italic text-gray-500">
                                        {{ $item->user->nama_lengkap ?? 'Umum' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">
                                        Tidak ada agenda dalam kantor.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- AGENDA LUAR KANTOR --}}
            <div class="mt-8">

                <div class="bg-indigo-600 text-white px-4 py-2 font-bold text-sm uppercase rounded-t-lg tracking-wider">
                    B. Agenda Di Luar Kantor Kalurahan
                </div>

                <div class="overflow-x-auto border-x border-b border-gray-200 rounded-b-lg">

                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">

                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 border-r border-gray-200 w-16 text-center">No</th>
                                <th class="px-4 py-3 border-r border-gray-200 w-32">Jam</th>
                                <th class="px-4 py-3 border-r border-gray-200">Acara / Kegiatan</th>
                                <th class="px-4 py-3 border-r border-gray-200">Tempat</th>
                                <th class="px-4 py-3 border-r border-gray-200">Penyelenggara</th>
                                <th class="px-4 py-3">Peserta</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 text-gray-700 bg-white">

                            @forelse($agendaLuarSorted as $index => $item)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-4 py-3 border-r border-gray-200 text-center">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $item->waktu_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200 font-semibold text-blue-950">
                                        {{ $item->nama_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $item->tempat_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $item->penyelenggara_agenda ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 italic text-gray-500">
                                        {{ $item->user->nama_lengkap ?? 'Umum' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">
                                        Tidak ada agenda luar kantor.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- PIKET DUKUH --}}
            <div>

                <div class="bg-yellow-500 text-white px-4 py-2 font-bold text-sm uppercase rounded-t-lg tracking-wider">
                    B. Piket Dukuh
                </div>

                <div class="overflow-x-auto border-x border-b border-gray-200 rounded-b-lg">

                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">

                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">

                            <tr>
                                <th class="px-4 py-3 border-r border-gray-200 w-16 text-center">No</th>
                                <th class="px-4 py-3 border-r border-gray-200">Nama Dukuh</th>
                                <th class="px-4 py-3 border-r border-gray-200">Waktu Piket</th>
                                <th class="px-4 py-3">Keterangan</th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 text-gray-700 bg-white">

                            @forelse($piketSorted as $index => $piket)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-4 py-3 border-r border-gray-200 text-center">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200 font-semibold">
                                        {{ $piket->user->nama_lengkap ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $piket->waktu_piket ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $piket->keterangan_piket ?? 'Bertugas' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-400 italic">
                                        Tidak ada jadwal piket dukuh.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- IZIN CUTI --}}
            <div>

                <div class="bg-red-500 text-white px-4 py-2 font-bold text-sm uppercase rounded-t-lg tracking-wider">
                    C. Pamong / Staff Izin Cuti
                </div>

                <div class="overflow-x-auto border-x border-b border-gray-200 rounded-b-lg">

                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">

                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">

                            <tr>
                                <th class="px-4 py-3 border-r border-gray-200 w-16 text-center">No</th>
                                <th class="px-4 py-3 border-r border-gray-200">Nama</th>
                                <th class="px-4 py-3 border-r border-gray-200">Jabatan</th>
                                <th class="px-4 py-3 border-r border-gray-200">Tanggal Mulai</th>
                                <th class="px-4 py-3 border-r border-gray-200">Tanggal Selesai</th>
                                <th class="px-4 py-3">Keterangan</th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 text-gray-700 bg-white">

                            @forelse($agenda->izinCuti as $index => $cuti)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-4 py-3 border-r border-gray-200 text-center">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200 font-semibold text-red-600">
                                        {{ $cuti->user->nama_lengkap ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $cuti->user->pekerjaan ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $cuti->tanggal_mulai_izin_cuti->translatedFormat('d F Y') ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 border-r border-gray-200">
                                        {{ $cuti->tanggal_selesai_izin_cuti->translatedFormat('d F Y') ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 italic text-gray-500">
                                        {{ $cuti->alasan_izin_cuti ?? 'Cuti' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-400 italic">
                                        Tidak ada data izin / cuti.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection