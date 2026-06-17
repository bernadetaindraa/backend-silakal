@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Laporan Survey Kepuasan Masyarakat
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Rekapitulasi hasil Survey Kepuasan Masyarakat (IKM)
            </p>
        </div>

        <div class="flex gap-2">

            <a href="{{ route('admin.laporan.survey.pdf', request()->query()) }}"
               class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm font-semibold hover:bg-red-700">
                Export PDF
            </a>

            <a href="{{ route('admin.laporan.survey.excel', request()->query()) }}"
               class="px-4 py-2 rounded-xl bg-green-600 text-white text-sm font-semibold hover:bg-green-700">
                Export Excel
            </a>

        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">

        <form method="GET"
              class="grid grid-cols-1 md:grid-cols-4 gap-3">

            <select
                name="bulan"
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

                <option value="">Semua Bulan</option>

                @for($i=1; $i<=12; $i++)

                    <option value="{{ $i }}"
                        {{ request('bulan') == $i ? 'selected' : '' }}>

                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}

                    </option>

                @endfor

            </select>

            <select
                name="tahun"
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

                <option value="">
                    Semua Tahun
                </option>

                @for($tahun = date('Y'); $tahun >= 2024; $tahun--)

                    <option value="{{ $tahun }}"
                        {{ request('tahun') == $tahun ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>

                @endfor

            </select>

            <input
                type="text"
                name="jenis_layanan"
                value="{{ request('jenis_layanan') }}"
                placeholder="Jenis layanan..."
                class="border border-gray-200 rounded-xl px-4 py-3 text-sm">

            <button
                class="bg-[#1D2059] text-white rounded-xl px-4 py-3 text-sm font-semibold">
                Filter
            </button>

        </form>

    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Total Responden</p>

            <h3 class="text-3xl font-bold text-[#1D2059] mt-2">
                {{ $totalResponden }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Nilai IKM</p>

            <h3 class="text-3xl font-bold text-blue-600 mt-2">
                {{ $nilaiIkm }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Mutu Pelayanan</p>

            <h3 class="text-3xl font-bold text-green-600 mt-2">
                {{ $mutu }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-sm text-gray-500">Kinerja</p>

            <h3 class="text-lg font-bold text-[#1D2059] mt-2">
                {{ $kinerja }}
            </h3>
        </div>

    </div>

    {{-- DEMOGRAFI --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            {{-- JENIS KELAMIN --}}
            <div>

                <h3 class="font-semibold text-[#1D2059] text-sm mb-3">
                    Jenis Kelamin Responden
                </h3>

                <div class="space-y-2">

                    <div class="flex items-center justify-between bg-gray-50 rounded-lg px-3 py-2">
                        <span class="text-sm text-gray-600">
                            Laki-laki
                        </span>

                        <span class="text-sm font-semibold text-[#1D2059]">
                            {{ $lakiLaki }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between bg-gray-50 rounded-lg px-3 py-2">
                        <span class="text-sm text-gray-600">
                            Perempuan
                        </span>

                        <span class="text-sm font-semibold text-[#1D2059]">
                            {{ $perempuan }}
                        </span>
                    </div>

                </div>

            </div>

            <div class="border-t border-gray-100 my-4"></div>

            {{-- PENDIDIKAN --}}
            <div>

                <h3 class="font-semibold text-[#1D2059] text-sm mb-3">
                    Pendidikan Terakhir Responden
                </h3>

                <div class="space-y-2">

                    @forelse($pendidikan as $nama => $jumlah)

                        <div class="flex items-center justify-between bg-gray-50 rounded-lg px-3 py-2">

                            <span class="text-sm text-gray-600">
                                {{ $nama }}
                            </span>

                            <span class="text-sm font-semibold text-[#1D2059]">
                                {{ $jumlah }}
                            </span>

                        </div>

                    @empty

                        <div class="text-xs text-center text-gray-400 py-3">
                            Belum ada data
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            <h3 class="font-bold text-[#1D2059] mb-4">
                Nilai Per Unsur
            </h3>

            <div class="space-y-2 max-h-[300px] overflow-y-auto">

                @foreach($hasilUnsur as $unsur)

                    <div class="flex justify-between border-b pb-2">

                        <span class="text-sm text-gray-600">
                            {{ $unsur['pertanyaan'] }}
                        </span>

                        <strong>
                            {{ $unsur['rata_rata'] }}
                        </strong>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

    {{-- TABEL RESPONDEN --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1200px]">

                <thead>

                    <tr class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Umur</th>
                        <th class="px-6 py-4">Jenis Kelamin</th>
                        <th class="px-6 py-4">Pendidikan</th>
                        <th class="px-6 py-4">Pekerjaan</th>
                        <th class="px-6 py-4">Jenis Layanan</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($data as $item)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($item->tanggal_survey)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->umur_responden }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->jenis_kelamin_responden }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->pendidikan_responden }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->pekerjaan_responden }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->jenis_layanan }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7"
                            class="text-center py-12 text-gray-400">
                            Belum ada data survey
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-5 border-t border-gray-100">
            {{ $data->links() }}
        </div>

    </div>

</div>

@endsection