@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

@php
    $user = auth()->user();
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 md:p-8 transition-all hover:shadow-md">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-2 h-2 rounded-full bg-[#A68549]"></span>
                    <p class="text-xs text-[#A68549] font-bold tracking-wider uppercase">
                        Dashboard Administrator
                    </p>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#1D2059]">
                    Selamat Datang, {{ $user->nama_lengkap ?? $user->name ?? 'Admin' }}
                </h1>
                <p class="text-gray-500 text-sm mt-1">Berikut adalah ringkasan sistem Anda hari ini.</p>
            </div>

            <div class="bg-slate-50 border border-slate-100 px-6 py-4 rounded-xl text-right flex items-center gap-4">
                <div class="p-3 bg-indigo-100 text-indigo-600 rounded-lg">
                    {{-- Icon Users --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-400">Total User</p>
                    <h3 class="text-2xl font-bold text-[#1D2059]">{{ number_format($totalUser ?? 0) }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- STATISTIK UTAMA --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        
        <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-2xl flex items-center justify-between hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Berita & Agenda</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format(($totalBerita ?? 0) + ($totalAgenda ?? 0)) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14" /></svg>
            </div>
        </div>

        <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-2xl flex items-center justify-between hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Pengaduan</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalPengaduan ?? 0) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center text-rose-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </div>
        </div>

        <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-2xl flex items-center justify-between hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Layanan</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalLayanan ?? 0) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>

        <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-2xl flex items-center justify-between hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Potensi & Budaya</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format(($totalPotensi ?? 0) + ($totalKebudayaan ?? 0)) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- STATUS LAYANAN (Kolom Kiri) --}}
        <div class="lg:col-span-1 bg-white p-6 border border-gray-100 shadow-sm rounded-2xl">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" /><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" /></svg>
                Status Layanan
            </h3>

            <div class="flex flex-col gap-3">
                <div class="flex justify-between items-center bg-yellow-50/50 border border-yellow-100 p-4 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <p class="font-medium text-yellow-800">Menunggu</p>
                    </div>
                    <h3 class="text-xl font-bold text-yellow-900">{{ number_format($menunggu ?? 0) }}</h3>
                </div>

                <div class="flex justify-between items-center bg-blue-50/50 border border-blue-100 p-4 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-blue-400"></div>
                        <p class="font-medium text-blue-800">Diproses</p>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900">{{ number_format($diproses ?? 0) }}</h3>
                </div>

                <div class="flex justify-between items-center bg-emerald-50/50 border border-emerald-100 p-4 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                        <p class="font-medium text-emerald-800">Selesai</p>
                    </div>
                    <h3 class="text-xl font-bold text-emerald-900">{{ number_format($selesai ?? 0) }}</h3>
                </div>

                <div class="flex justify-between items-center bg-red-50/50 border border-red-100 p-4 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <p class="font-medium text-red-800">Ditolak</p>
                    </div>
                    <h3 class="text-xl font-bold text-red-900">{{ number_format($ditolak ?? 0) }}</h3>
                </div>
            </div>
        </div>

        {{-- SURVEY IKM (Kolom Kanan) --}}
        <div class="lg:col-span-2 bg-white p-6 border border-gray-100 shadow-sm rounded-2xl flex flex-col">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" /></svg>
                Survey IKM & Grafik
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white p-4 rounded-xl shadow-sm">
                    <p class="text-emerald-50 text-sm font-medium">Nilai IKM Rata-rata</p>
                    <h3 class="text-3xl font-bold mt-1">{{ number_format($nilaiIkm ?? 0, 2) }}</h3>
                </div>
                <div class="bg-gray-50 border border-gray-100 p-4 rounded-xl">
                    <p class="text-gray-500 text-sm font-medium">Total Responden</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalJawabanSurvey ?? 0) }}</h3>
                </div>
                <div class="bg-gray-50 border border-gray-100 p-4 rounded-xl">
                    <p class="text-gray-500 text-sm font-medium">Layanan Dinilai</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ number_format($totalLayanan ?? 0) }}</h3>
                </div>
            </div>

            {{-- GRAFIK IKM --}}
            <div class="flex-grow relative h-48 md:h-64 w-full">
                <canvas id="chartIkm"></canvas>
            </div>
        </div>

    </div>

    {{-- GRAFIK LAYANAN --}}
    <div class="bg-white p-6 border border-gray-100 shadow-sm rounded-2xl">
        <h3 class="font-bold text-gray-800 text-lg mb-4">Statistik Layanan Per Bulan</h3>
        <div class="relative h-64 md:h-80 w-full">
            <canvas id="chartLayanan"></canvas>
        </div>
    </div>

</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Konfigurasi Global Chart.js untuk tampilan modern
    Chart.defaults.font.family = "'Inter', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif";
    Chart.defaults.color = '#6b7280';
    Chart.defaults.scale.grid.color = '#f3f4f6';

    // 1. Grafik IKM (Line/Area Chart dengan kurva yang mulus)
    const ctxIkm = document.getElementById('chartIkm').getContext('2d');
    
    // Membuat gradient untuk area di bawah garis
    let gradientIkm = ctxIkm.createLinearGradient(0, 0, 0, 300);
    gradientIkm.addColorStop(0, 'rgba(16, 185, 129, 0.4)'); // Emerald transparan
    gradientIkm.addColorStop(1, 'rgba(16, 185, 129, 0.0)'); 

    new Chart(ctxIkm, {
        type: 'line',
        data: {
            labels: {!! json_encode($ikmPerTahun->pluck('tahun') ?? []) !!},
            datasets: [{
                label: 'Nilai IKM',
                data: {!! json_encode($ikmPerTahun->pluck('nilai') ?? []) !!},
                borderColor: '#10b981',
                backgroundColor: gradientIkm,
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#10b981',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4 // Membuat kurva menjadi melengkung (modern)
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false,
                }
            },
            scales: {
                x: { grid: { display: false } },
                y: { 
                    beginAtZero: true,
                    border: { display: false }
                }
            }
        }
    });

    // 2. Grafik Layanan (Bar Chart dengan rounded corners)
    const ctxLayanan = document.getElementById('chartLayanan').getContext('2d');
    
    new Chart(ctxLayanan, {
        type: 'bar',
        data: {
            labels: {!! json_encode($layananPerBulan->pluck('bulan') ?? []) !!},
            datasets: [{
                label: 'Total Layanan',
                data: {!! json_encode($layananPerBulan->pluck('total') ?? []) !!},
                backgroundColor: '#3b82f6',
                hoverBackgroundColor: '#2563eb',
                borderRadius: 6, // Ujung bar membulat
                borderSkipped: false,
                barThickness: 'flex',
                maxBarThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: { 
                    grid: { display: false } 
                },
                y: { 
                    beginAtZero: true,
                    border: { display: false }
                }
            }
        }
    });
</script>

@endsection