@extends('layouts.admin')

@section('content')
<div class="p-4 md:p-6 space-y-6 md:space-y-8 max-w-7xl mx-auto">

    {{-- HEADER SECTION --}}
    <div class="relative bg-white p-6 md:p-8 rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-gradient-to-br from-[#1D2059]/5 to-transparent rounded-full blur-2xl"></div>

        <div class="relative flex items-center gap-4">
            <div class="w-14 h-14 bg-[#1D2059]/10 text-[#1D2059] rounded-2xl flex items-center justify-center shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Dashboard Dukuh</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Monitoring data layanan warga wilayah 
                    <span class="font-semibold text-[#1D2059] px-2 py-0.5 bg-[#1D2059]/5 rounded-md ml-1">
                        {{ auth()->user()->dusun->nama_dusun ?? '-' }}
                    </span>
                </p>
            </div>
        </div>

        <div class="relative">
            <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#1D2059] text-white text-xs font-semibold rounded-xl uppercase tracking-wider shadow-md shadow-[#1D2059]/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Akses Dukuh
            </span>
        </div>
    </div>

    {{-- STATISTIK CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 md:gap-6">
        {{-- Card: Menunggu --}}
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex items-center gap-5 group">
            <div class="w-14 h-14 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Menunggu</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $statistik['menunggu'] ?? 0 }}</h3>
            </div>
        </div>

        {{-- Card: Diverifikasi --}}
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex items-center gap-5 group">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Diverifikasi</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $statistik['diverifikasi'] ?? 0 }}</h3>
            </div>
        </div>

        {{-- Card: Ditolak --}}
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex items-center gap-5 group">
            <div class="w-14 h-14 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">Ditolak</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $statistik['ditolak'] ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- GRAFIK SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 md:gap-6">
        {{-- Grafik Area (Tren Layanan) --}}
        <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-bold text-gray-900 text-lg tracking-tight mb-4">Tren Pengajuan Layanan</h2>
            <div id="chartTren" class="w-full h-72"></div>
        </div>

        {{-- Grafik Donut (Distribusi Status) --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 flex flex-col">
            <h2 class="font-bold text-gray-900 text-lg tracking-tight mb-4">Distribusi Status</h2>
            <div id="chartStatus" class="w-full flex-grow flex items-center justify-center"></div>
        </div>
    </div>

    {{-- CARD LAYANAN TERBARU --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-[#1D2059]/5 rounded-lg text-[#1D2059]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h2 class="font-bold text-gray-900 text-lg tracking-tight">Layanan Terbaru</h2>
                    <p class="text-xs text-gray-500">Memantau 5 pengajuan terakhir dari warga</p>
                </div>
            </div>
            <a href="{{ route('dukuh.layanan.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#1D2059] hover:text-[#1D2059]/80 transition-colors group">
                Lihat Semua <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left whitespace-nowrap">
                <thead class="bg-gray-50/80 text-xs text-gray-500 uppercase font-semibold tracking-wider">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-lg">Tanggal</th>
                        <th class="px-6 py-4">Informasi Warga</th>
                        <th class="px-6 py-4">Jenis Layanan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($layananTerbaru as $item)
                    <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                        <td class="px-6 py-4"><span class="text-gray-500 font-medium">{{ optional($item->created_at)->format('d M Y') }}</span></td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800">{{ $item->user->nama_lengkap ?? '-' }}</span>
                                <span class="text-xs text-gray-500 font-mono mt-0.5">NIK: {{ $item->user->nik ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4"><span class="inline-flex items-center gap-1.5 text-gray-700 font-medium">{{ $item->jenis_layanan }}</span></td>
                        <td class="px-6 py-4">
                            @if($item->status_layanan === 'menunggu')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-200/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>Menunggu
                                </span>
                            @elseif($item->status_layanan === 'diverifikasi')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-200/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>Diverifikasi
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-600 border border-rose-200/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('dukuh.layanan.show', $item->layanan_id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-200 text-gray-700 hover:text-[#1D2059] hover:border-[#1D2059] hover:bg-gray-50 text-xs font-semibold rounded-xl transition-all shadow-sm">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <h3 class="text-sm font-bold text-gray-900">Belum ada pengajuan</h3>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SCRIPT UNTUK RENDER GRAFIK APEXCHARTS --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // 1. Konfigurasi Grafik Tren (Area Chart)
        var optionsTren = {
            series: [{
                name: 'Pengajuan Masuk',
                data: @json($grafikJumlah) // <-- UBAH DI SINI (Mengambil data asli jumlah)
            }],
            chart: {
                height: 280,
                type: 'area',
                fontFamily: 'inherit',
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            colors: ['#1D2059'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: {
                categories: @json($grafikHari), // <-- UBAH DI SINI (Mengambil data asli nama hari)
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#9ca3af' } }
            },
            yaxis: {
                labels: { style: { colors: '#9ca3af' } }
            },
            grid: {
                borderColor: '#f3f4f6',
                strokeDashArray: 4,
                yaxis: { lines: { show: true } }
            }
        };

        // 2. Konfigurasi Grafik Status (Donut Chart) -> Pakai data asli
        var dataMenunggu = {{ $statistik['menunggu'] ?? 0 }};
        var dataDiverifikasi = {{ $statistik['diverifikasi'] ?? 0 }};
        var dataDitolak = {{ $statistik['ditolak'] ?? 0 }};

        var optionsStatus = {
            series: [dataMenunggu, dataDiverifikasi, dataDitolak],
            labels: ['Menunggu', 'Diverifikasi', 'Ditolak'],
            chart: {
                type: 'donut',
                height: 280,
                fontFamily: 'inherit',
            },
            colors: ['#f59e0b', '#10b981', '#f43f5e'], // Amber, Emerald, Rose (Sesuai warna Tailwind)
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            name: { fontSize: '12px', color: '#9ca3af' },
                            value: {
                                fontSize: '24px',
                                fontWeight: 700,
                                color: '#111827',
                                formatter: function (val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                color: '#9ca3af',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            stroke: { show: true, colors: ['#ffffff'], width: 3 },
            legend: {
                position: 'bottom',
                markers: { radius: 12 },
                itemMargin: { horizontal: 10, vertical: 0 }
            }
        };

        // Render Grafik
        var chartTren = new ApexCharts(document.querySelector("#chartTren"), optionsTren);
        chartTren.render();

        var chartStatus = new ApexCharts(document.querySelector("#chartStatus"), optionsStatus);
        chartStatus.render();
    });
</script>
@endsection