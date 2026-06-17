@extends('layouts.admin')

@section('content')

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

    <div class="p-6 space-y-6">

        {{-- HEADER --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            {{-- TITLE --}}
            <div>
                <h1 class="text-2xl font-bold text-[#1D2059]">
                    Hasil Survey Kepuasan Masyarakat
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Monitoring hasil survey dan indeks kepuasan masyarakat
                </p>
            </div>

            {{-- ACTION AREA --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full lg:w-auto">

                {{-- BUTTON PERIODE --}}
                <a
                    href="{{ route('admin.survey.periode.index') }}"
                    class="px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 transition text-center"
                >
                    Kelola Periode Survey
                </a>

                {{-- FILTER --}}
                <form
                    method="GET"
                    action="{{ route('admin.survey.index') }}"
                    class="grid grid-cols-1 sm:grid-cols-3 gap-3 w-full lg:w-auto"
                >

                    {{-- BULAN --}}
                    <select
                        name="bulan"
                        class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none w-full"
                    >
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>

                    {{-- TAHUN --}}
                    <select
                        name="tahun"
                        class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none w-full"
                    >
                        @for($year = date('Y'); $year >= 2020; $year--)
                            <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>

                    {{-- BUTTON FILTER --}}
                    <button
                        type="submit"
                        class="px-5 py-3 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition w-full sm:w-auto"
                    >
                        Filter
                    </button>

                </form>

            </div>

        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        {{-- TOTAL RESPONDEN --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500 mb-2">
                        Total Responden
                    </p>

                    <h2 class="text-3xl font-bold text-[#1D2059]">

                        {{ $totalResponden }}

                    </h2>

                </div>

                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5V4H2v16h5m10 0v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6m10 0H7"
                        />

                    </svg>

                </div>

            </div>

        </div>

        {{-- NILAI IKM --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500 mb-2">
                        Nilai IKM
                    </p>

                    <h2 class="text-3xl font-bold text-[#1D2059]">

                        {{ $nilaiIkm }}

                    </h2>

                </div>

                <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 17v-6h13M9 5v6h13M5 5h.01M5 12h.01M5 19h.01"
                        />

                    </svg>

                </div>

            </div>

        </div>

        {{-- MUTU --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500 mb-2">
                        Mutu Pelayanan
                    </p>

                    <h2 class="text-3xl font-bold text-[#1D2059]">

                        {{ $mutu }}

                    </h2>

                </div>

                <div class="w-12 h-12 rounded-2xl bg-yellow-50 flex items-center justify-center text-yellow-600">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0
                            l1.286 3.966a1 1 0 00.95.69h4.17c.969 0
                            1.371 1.24.588 1.81l-3.376 2.454a1
                            1 0 00-.364 1.118l1.287 3.966c.3.921-.755
                            1.688-1.54 1.118l-3.376-2.454a1 1 0
                            00-1.176 0l-3.376 2.454c-.784.57-1.838-.197-1.539-1.118
                            l1.287-3.966a1 1 0 00-.364-1.118L2.98
                            9.393c-.783-.57-.38-1.81.588-1.81h4.17a1
                            1 0 00.95-.69l1.286-3.966z"
                        />

                    </svg>

                </div>

            </div>

        </div>

        {{-- KINERJA --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500 mb-2">
                        Kinerja
                    </p>

                    <h2 class="text-xl font-bold text-[#1D2059]">

                        {{ $kinerja }}

                    </h2>

                </div>

                <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"
                        />

                    </svg>

                </div>

            </div>

        </div>

    </div>

    {{-- DETAIL STATISTIK --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- GENDER --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h2 class="text-lg font-bold text-[#1D2059] mb-6">

                Statistik Gender

            </h2>

            <div class="space-y-4">

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-600">
                        Laki-laki
                    </span>

                    <span class="font-bold text-[#1D2059]">
                        {{ $countGender['laki_laki'] }}
                    </span>

                </div>

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-600">
                        Perempuan
                    </span>

                    <span class="font-bold text-[#1D2059]">
                        {{ $countGender['perempuan'] }}
                    </span>

                </div>

            </div>

        </div>

        {{-- PENDIDIKAN --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <h2 class="text-lg font-bold text-[#1D2059] mb-6">
                Statistik Pendidikan
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Tidak Sekolah</span>
                    <span class="font-bold">{{ $countPendidikan['tidak_sekolah'] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Tidak Tamat SD</span>
                    <span class="font-bold">{{ $countPendidikan['tidak_tamat_sd'] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Tamat SD</span>
                    <span class="font-bold">{{ $countPendidikan['tamat_sd'] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Tidak Tamat SMP</span>
                    <span class="font-bold">{{ $countPendidikan['tidak_tamat_smp'] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Tamat SMP</span>
                    <span class="font-bold">{{ $countPendidikan['tamat_smp'] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Tidak Tamat SMA</span>
                    <span class="font-bold">{{ $countPendidikan['tidak_tamat_sma'] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Tamat SMA/SMK</span>
                    <span class="font-bold">{{ $countPendidikan['tamat_sma'] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Diploma (D1/D2/D3)</span>
                    <span class="font-bold">{{ $countPendidikan['diploma'] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Sarjana (S1/S2/S3)</span>
                    <span class="font-bold">{{ $countPendidikan['sarjana'] }}</span>
                </div>

            </div>
        </div>

    </div>

    {{-- UNSUR IKM --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-bold text-[#1D2059]">

                Nilai Unsur Pelayanan

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[700px]">

                <thead>

                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4 w-[80px]">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Unsur Pelayanan
                        </th>

                        <th class="px-6 py-4 w-[200px]">
                            Nilai Rata-rata
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($hasilUnsur as $item)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-5 text-gray-500">

                            {{ $loop->iteration }}

                        </td>

                        <td class="px-6 py-5 font-medium text-gray-700">

                            {{ $item['pertanyaan'] }}

                        </td>

                        <td class="px-6 py-5">

                            <span class="px-3 py-1 rounded-lg bg-blue-50 text-blue-700 border border-blue-100 text-xs font-semibold">

                                {{ $item['rata_rata'] }}

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3" class="py-16 text-center text-gray-400">

                            Belum ada data survey

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- DATA RESPONDEN --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-bold text-[#1D2059]">

                Data Responden Survey

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]">

                <thead>

                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4 w-[70px]">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Jenis Layanan
                        </th>

                        <th class="px-6 py-4 w-[150px]">
                            Gender
                        </th>

                        <th class="px-6 py-4 w-[150px]">
                            Umur
                        </th>

                        <th class="px-6 py-4 w-[180px]">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-center w-[140px]">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($surveys as $item)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-5 text-gray-500">

                            {{ $loop->iteration }}

                        </td>

                        <td class="px-6 py-5">

                            <div class="font-semibold text-[#1D2059]">

                                {{ $item->jenis_layanan }}

                            </div>

                        </td>

                        <td class="px-6 py-5">

                            {{ $item->jenis_kelamin_responden }}

                        </td>

                        <td class="px-6 py-5">

                            {{ $item->umur_responden }} Tahun

                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">

                            {{ \Carbon\Carbon::parse($item->tanggal_survey)->translatedFormat('d F Y') }}

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center">

                                <a
                                    href="{{ route('admin.survey.show', $item->jawaban_survey_id) }}"
                                    class="
                                        px-4 py-2
                                        rounded-xl
                                        bg-[#1D2059]
                                        text-white
                                        text-xs
                                        font-semibold
                                        hover:opacity-90
                                        transition
                                    "
                                >

                                    Detail

                                </a>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="py-16 text-center text-gray-400">

                            Belum ada hasil survey

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection