@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- BREADCRUMB -->
        <nav class="text-sm text-gray-500 mb-10">
            <a href="/" class="hover:text-blue-600 transition">Beranda</a> &gt;
            <span class="text-gray-400">Survey dan Pengaduan</span> &gt;
            <span class="text-blue-600 font-medium">Hasil Survey IKM</span>
        </nav>

        <!-- HEADER -->
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-[#1D2059] tracking-tight">
                Hasil Survei IKM
            </h1>

            <p class="text-base text-gray-500 mt-2">
                Rekapitulasi hasil survei kepuasan masyarakat
            </p>
        </div>

        <!-- FILTER -->
        <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap gap-4 mb-10">

            {{-- BULAN --}}
            <div class="relative">
                <select
                    name="bulan"
                    onchange="this.form.submit()"
                    class="appearance-none bg-white text-gray-600 pl-4 pr-10 py-2.5 rounded-full shadow-sm border border-gray-200 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer"
                >
                    <option value="">Pilih Bulan</option>

                    @foreach(range(1,12) as $m)
                        <option
                            value="{{ $m }}"
                            {{ request('bulan', date('n')) == $m ? 'selected' : '' }}
                        >
                            {{ Carbon\Carbon::createFromDate(null, $m, 1)->isoFormat('MMMM') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TAHUN --}}
            <div class="relative">
                <select
                    name="tahun"
                    onchange="this.form.submit()"
                    class="appearance-none bg-white text-gray-600 pl-4 pr-10 py-2.5 rounded-full shadow-sm border border-gray-200 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer"
                >
                    <option value="">Pilih Tahun</option>

                    @foreach(range(date('Y'), date('Y') - 5) as $y)
                        <option
                            value="{{ $y }}"
                            {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}
                        >
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>

        </form>

        <!-- CHART -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

            {{-- PENDIDIKAN --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-10 flex flex-col items-center">

                <h2 class="text-xl font-bold text-[#1D2059] text-center">
                    Data Responden
                </h2>

                <p class="text-sm text-indigo-500 font-medium mt-1 mb-8 text-center">
                    berdasarkan pendidikan terakhir
                </p>

                <div class="w-full relative h-72">
                    <canvas id="chartPendidikan"></canvas>
                </div>
            </div>

            {{-- GENDER --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-10 flex flex-col items-center">

                <h2 class="text-xl font-bold text-[#1D2059] text-center">
                    Data Responden
                </h2>

                <p class="text-sm text-indigo-500 font-medium mt-1 mb-8 text-center">
                    berdasarkan jenis kelamin
                </p>

                <div class="w-full max-w-[280px] relative h-72">
                    <canvas id="chartGender"></canvas>
                </div>
            </div>

        </div>

        <!-- IKM -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sm:p-12">

            <h2 class="text-2xl font-extrabold text-[#1D2059]">
                Indeks Kepuasan Masyarakat (IKM)
            </h2>

            <p class="text-sm text-gray-500 mt-1 font-medium">
                Periode :
                {{ Carbon\Carbon::createFromDate(null, (int) request('bulan', date('n')), 1)->isoFormat('MMMM') }}
                {{ request('tahun', date('Y')) }}
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 items-center">

                {{-- TOTAL RESPONDEN --}}
                <div class="bg-[#D9D4FF] rounded-2xl py-12 px-6 flex items-center justify-center shadow-sm">

                    <span class="text-3xl sm:text-4xl font-extrabold text-[#1D2059] text-center">
                        {{ $totalResponden }} Responden
                    </span>

                </div>

                {{-- NILAI IKM --}}
                <div class="text-center md:text-left md:pl-12 flex flex-col justify-center">

                    <h3 class="text-2xl font-black text-[#1D2059] tracking-wider uppercase">
                        NILAI IKM
                    </h3>

                    <span class="text-6xl sm:text-7xl font-black text-[#7D66FF] mt-2 tracking-tight">
                        {{ number_format($nilaiIkm, 2) }}
                    </span>

                    <p class="mt-3 text-lg font-semibold text-gray-700">
                        Mutu {{ $mutu }} - {{ $kinerja }}
                    </p>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    /**
     * CHART PENDIDIKAN
     */
    const ctxPendidikan =
        document.getElementById('chartPendidikan');

    new Chart(ctxPendidikan, {

        type: 'bar',

        data: {

            labels: [
                'Tidak Sekolah',
                'SD',
                'SMP',
                'SMA',
                'Sarjana'
            ],

            datasets: [{

                data: [

                    {{ $countPendidikan['tidak_sekolah'] }},
                    {{ $countPendidikan['sd'] }},
                    {{ $countPendidikan['smp'] }},
                    {{ $countPendidikan['sma'] }},
                    {{ $countPendidikan['sarjana'] }}

                ],

                backgroundColor: '#8266FF',
                borderRadius: 4,
                barThickness: 24,

            }]
        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {

                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                },

                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    /**
     * CHART GENDER
     */
    const ctxGender =
        document.getElementById('chartGender');

    new Chart(ctxGender, {

        type: 'pie',

        data: {

            labels: [
                'Perempuan',
                'Laki-laki'
            ],

            datasets: [{

                data: [

                    {{ $countGender['perempuan'] }},
                    {{ $countGender['laki_laki'] }}

                ],

                backgroundColor: [
                    '#C6427D',
                    '#469CB9'
                ],

                borderWidth: 0
            }]
        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            plugins: {

                legend: {

                    position: 'bottom',

                    labels: {

                        boxWidth: 12,
                        padding: 20,
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });

});

</script>
@endpush