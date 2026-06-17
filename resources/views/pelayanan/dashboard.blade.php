@extends('layouts.admin')

@section('content')
<div class="p-4 md:p-6 space-y-6 md:space-y-8 max-w-7xl mx-auto">

    {{-- HEADER SECTION --}}
    <div class="relative bg-white p-6 md:p-8 rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-gradient-to-br from-[#1D2059]/5 to-transparent rounded-full blur-2xl"></div>

        <div class="relative flex items-center gap-4">
            <div class="w-14 h-14 bg-[#1D2059]/10 text-[#1D2059] rounded-2xl flex items-center justify-center shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <h1 class="font-montserrat text-2xl md:text-3xl font-bold text-[#1D2059] tracking-tight">
                    Dashboard Pelayanan
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Monitoring proses pelayanan administrasi dan pembuatan surat warga desa.
                </p>
            </div>
        </div>

        <div class="relative">
            <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#A68549]/10 text-[#A68549] text-xs font-bold rounded-xl uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-[#A68549] animate-pulse"></span>
                Akses: Pelayanan Desa
            </span>
        </div>
    </div>

    {{-- HIGHLIGHT & MAIN STATS GRID --}}
    <div class="grid grid-cols-1 xl:grid-cols-4 gap-5 md:gap-6">
        
        {{-- HERO CARD: TOTAL PEKERJAAN AKTIF --}}
        <div class="xl:col-span-1 relative bg-gradient-to-br from-[#1D2059] to-[#2A2E7A] p-6 rounded-3xl shadow-lg shadow-[#1D2059]/20 text-white flex flex-col justify-between overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/5 rounded-full blur-xl group-hover:scale-120 transition-transform duration-500"></div>
            <div>
                <p class="text-xs uppercase tracking-wider text-white/70 font-medium">Total Pekerjaan Aktif</p>
                <h3 class="text-5xl font-black mt-2 tracking-tight">
                    {{ $stats['total_aktif'] }}
                </h3>
            </div>
            <p class="text-xs text-white/60 mt-6 pt-4 border-t border-white/10">
                Surat berjalan yang membutuhkan tindakan cepat petugas pelayanan.
            </p>
        </div>

        {{-- SUB-STATS GRID (4 UTAMA) --}}
        <div class="xl:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            {{-- MENUNGGU --}}
            <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Menunggu Dukuh</p>
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mt-4">{{ $stats['menunggu'] }}</h3>
            </div>

            {{-- DIVERIFIKASI --}}
            <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Siap Diproses</p>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"></path></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mt-4">{{ $stats['diverifikasi'] }}</h3>
            </div>

            {{-- DIPROSES --}}
            <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Sedang Diproses</p>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mt-4">{{ $stats['diproses'] }}</h3>
            </div>

            {{-- SIAP DIAMBIL --}}
            <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Siap Diambil</p>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mt-4">{{ $stats['siap_diambil'] }}</h3>
            </div>
        </div>

    </div>

    {{-- ARCHIVE & OUTCOME TRACKERS (SELESAI & DITOLAK) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">
        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Arsip Layanan Selesai</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $stats['selesai'] }}</h4>
                </div>
            </div>
            <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg">Sukses</span>
        </div>

        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Permohonan Ditolak</p>
                    <h4 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $stats['ditolak'] }}</h4>
                </div>
            </div>
            <span class="text-xs font-medium text-rose-600 bg-rose-50 px-2.5 py-1 rounded-lg">Gagal/Batal</span>
        </div>
    </div>

    {{-- LOWER VISUAL LAYOUT --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        {{-- ALUR PELAYANAN (TIMELINE STYLE) --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:col-span-1">
            <h3 class="font-bold text-lg text-gray-900 tracking-tight mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Alur Kerja Pelayanan
            </h3>

            <div class="relative pl-6 space-y-6 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100">
                
                {{-- STEP 1 --}}
                <div class="relative group">
                    <div class="absolute -left-[21px] mt-1 w-3 h-3 rounded-full bg-orange-400 ring-4 ring-orange-50 group-hover:scale-110 transition-transform"></div>
                    <p class="text-xs font-bold uppercase tracking-wider text-orange-500">Langkah 1</p>
                    <p class="text-sm font-semibold text-gray-800 mt-0.5">Verifikasi Wilayah</p>
                    <p class="text-xs text-gray-500 mt-0.5">Dukuh meninjau & memverifikasi pengajuan awal warga.</p>
                </div>

                {{-- STEP 2 --}}
                <div class="relative group">
                    <div class="absolute -left-[21px] mt-1 w-3 h-3 rounded-full bg-blue-400 ring-4 ring-blue-50 group-hover:scale-110 transition-transform"></div>
                    <p class="text-xs font-bold uppercase tracking-wider text-blue-500">Langkah 2</p>
                    <p class="text-sm font-semibold text-gray-800 mt-0.5">Validasi Berkas Kantor</p>
                    <p class="text-xs text-gray-500 mt-0.5">Petugas pelayanan memeriksa kecocokan data administrasi.</p>
                </div>

                {{-- STEP 3 --}}
                <div class="relative group">
                    <div class="absolute -left-[21px] mt-1 w-3 h-3 rounded-full bg-amber-400 ring-4 ring-amber-50 group-hover:scale-110 transition-transform"></div>
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-500">Langkah 3</p>
                    <p class="text-sm font-semibold text-gray-800 mt-0.5">Penerbitan Surat</p>
                    <p class="text-xs text-gray-500 mt-0.5">Surat resmi di-generate oleh sistem desa dan ditandatangani.</p>
                </div>

                {{-- STEP 4 --}}
                <div class="relative group">
                    <div class="absolute -left-[21px] mt-1 w-3 h-3 rounded-full bg-indigo-400 ring-4 ring-indigo-50 group-hover:scale-110 transition-transform"></div>
                    <p class="text-xs font-bold uppercase tracking-wider text-indigo-500">Langkah 4</p>
                    <p class="text-sm font-semibold text-gray-800 mt-0.5">Penyerahan Dokumen</p>
                    <p class="text-xs text-gray-500 mt-0.5">Surat dikirim otomatis ke email warga atau siap diambil di loket.</p>
                </div>

            </div>
        </div>

        {{-- VISUALISASI CHART (DISTRIBUSI STATUS) --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:col-span-2 flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-lg text-gray-900 tracking-tight mb-1 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                    Proporsi Beban Kerja
                </h3>
                <p class="text-xs text-gray-400">Rasio sebaran status dokumen pelayanan di sistem saat ini.</p>
            </div>
            
            <div class="py-4 flex items-center justify-center">
                <div id="chartPelayanan" class="w-full max-w-[340px]"></div>
            </div>
        </div>

    </div>

</div>

{{-- APEXCHARTS INTEGRATION --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tarik data asli dari variabel $stats controller
        var mng = {{ $stats['menunggu'] }};
        var vrf = {{ $stats['diverifikasi'] }};
        var prs = {{ $stats['diproses'] }};
        var smb = {{ $stats['siap_diambil'] }};
        var sls = {{ $stats['selesai'] }};
        var tlk = {{ $stats['ditolak'] }};

        var options = {
            series: [mng, vrf, prs, smb, sls, tlk],
            labels: ['Menunggu', 'Siap Diproses', 'Sedang Diproses', 'Siap Diambil', 'Selesai', 'Ditolak'],
            chart: {
                type: 'donut',
                height: 300,
                fontFamily: 'inherit'
            },
            colors: ['#f97316', '#3b82f6', '#f59e0b', '#6366f1', '#10b981', '#f43f5e'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '72%',
                        labels: {
                            show: true,
                            name: { fontSize: '13px', color: '#9ca3af' },
                            value: {
                                fontSize: '24px',
                                fontWeight: 800,
                                color: '#111827',
                                formatter: function (val) { return val }
                            },
                            total: {
                                show: true,
                                label: 'Total Berkas',
                                color: '#9ca3af',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
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
                fontSize: '12px',
                markers: { radius: 12 },
                itemMargin: { horizontal: 8, vertical: 4 }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartPelayanan"), options);
        chart.render();
    });
</script>
@endsection