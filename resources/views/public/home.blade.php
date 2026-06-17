@extends('layouts.public')

@section('content')
<div class="font-['Montserrat'] bg-[#F4F7FB]">
    
    <section class="relative h-[550px] lg:h-[650px] flex flex-col items-center justify-center text-center px-4" 
             style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1655861467672-215aaeb119ff?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center;">
        <h1 class="text-white text-3xl md:text-5xl font-bold max-w-4xl leading-tight drop-shadow-lg">
            Selamat Datang di Website Resmi Kalurahan Hargobinangun
        </h1>
        <p class="text-white text-xl md:text-3xl mt-4 font-serif opacity-90 drop-shadow-md">
            ꦱꦼꦭꦩꦠ꧀ꦢꦠꦁꦢꦶꦮꦺꦧ꧀ꦱꦶꦠ꧀ꦉꦱ꧀ꦩꦶ
        </p>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 relative -mt-20 lg:-mt-28 z-10 mb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 shadow-2xl rounded-2xl overflow-hidden">
            <div class="bg-[#1D2059] text-white p-8 lg:p-12 flex flex-col justify-center transition hover:bg-[#151740]">
                <h2 class="text-xl lg:text-2xl font-bold mb-3 uppercase tracking-wide">Pengaduan Masyarakat</h2>
                <p class="text-gray-300 mb-6 text-sm leading-relaxed">Sampaikan keluhan, aspirasi, atau laporan terkait pelayanan dan kondisi di kalurahan.</p>
                <a href="/pengaduan" class="text-blue-400 font-semibold hover:text-blue-300 flex items-center text-sm w-max">
                    Ajukan Pengaduan 
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            <div class="bg-white text-[#1D2059] p-8 lg:p-12 flex flex-col justify-center transition hover:bg-gray-50">
                <h2 class="text-xl lg:text-2xl font-bold mb-3 uppercase tracking-wide">Layanan Administrasi Publik</h2>
                <p class="text-gray-600 mb-6 text-sm leading-relaxed">Ajukan pembuatan surat dan layanan administrasi secara online dengan mudah dan cepat.</p>
                <a href="/layanan/pengajuan" class="text-blue-600 font-semibold hover:text-blue-800 flex items-center text-sm w-max">
                    Ajukan Layanan 
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 mb-24 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Layanan Masyarakat</h2>
        <p class="text-indigo-500 font-medium text-sm mb-10">Kini Pengajuan Berkas Penting jadi lebih mudah</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $layanan = [
                    ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Pembuatan Akta Kelahiran'],
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'title' => 'Pembuatan Kartu Keluarga'],
                    ['icon' => 'M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2', 'title' => 'Pembuatan KTP Elektronik'],
                    ['icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'title' => 'Permohonan Surat Pindah Domisili Dusun/Kecamatan'],
                    ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'title' => 'Permohonan Surat Pindah Domisili Kabupaten'],
                    ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'title' => 'Permohonan Surat Keterangan'],
                ];
            @endphp

            @foreach($layanan as $item)
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col items-center text-center group cursor-pointer">
                <div class="w-16 h-16 bg-blue-50 text-[#1D2059] rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"></path></svg>
                </div>
                <h3 class="font-bold text-sm text-gray-900 uppercase tracking-wide group-hover:text-blue-600 transition-colors">{{ $item['title'] }}</h3>
            </div>
            @endforeach
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 mb-24 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Agenda Kalurahan</h2>
        <p class="text-indigo-500 font-medium text-sm mb-10">Pantau kegiatan dan jadwal terbaru di lingkungan kalurahan secara mudah</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 overflow-hidden text-left flex flex-col group">
                <div class="overflow-hidden">
                    <img src="https://via.placeholder.com/600x400?text=Dokumen+Agenda" alt="Agenda" class="w-full h-48 object-cover border-b group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <span class="text-[#1D2059] font-extrabold text-lg block mb-2">26 Maret 2026</span>
                    <h3 class="font-semibold text-gray-800 leading-snug">Agenda Kegiatan Kalurahan Hargobinangun {{ $i+1 }}</h3>
                </div>
            </div>
            @endfor
        </div>
        <a href="/agenda" class="inline-block bg-[#1D2059] hover:bg-blue-900 text-white text-sm font-semibold px-8 py-3 rounded-full transition-colors shadow-md">
            Selengkapnya
        </a>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 mb-24 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Berita Kalurahan</h2>
        <p class="text-indigo-500 font-medium text-sm mb-10">Dapatkan informasi terkini seputar kegiatan dan perkembangan kalurahan</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow border border-gray-100 overflow-hidden text-left flex flex-col relative group">
                <div class="overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=600&q=80" alt="Berita" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 relative pt-8">
                    <div class="absolute -top-5 left-6 bg-[#1D2059] text-white text-xs font-bold px-4 py-2 rounded shadow-md flex items-center">
                        26 Maret 2026
                    </div>
                    
                    <h3 class="font-bold text-lg text-gray-900 mb-3 leading-snug line-clamp-2 hover:text-blue-600 cursor-pointer">
                        Penanaman Bersama Tanaman Konservasi
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">
                        Kegiatan ini dilaksanakan oleh Forum Koordinasi Pengelolaan Daerah Aliran Sungai (FKPDAS) DIY dalam rangka mendukung upaya pelestarian lingkungan dan penguatan peran masyarakat.
                    </p>
                    
                    <div class="flex justify-end border-t border-gray-100 pt-4">
                        <button class="text-gray-400 hover:text-[#1D2059] transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-5.368m0 5.368l5.657 5.657m-5.657-5.657l5.657-5.657m0 0a3 3 0 115.657 5.657m-5.657-5.657a3 3 0 01-5.657 5.657m0 0a3 3 0 115.657 5.657m-5.657-5.657l-5.657 5.657m5.657-5.657l-5.657-5.657"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <a href="/berita" class="inline-block bg-[#1D2059] hover:bg-blue-900 text-white text-sm font-semibold px-8 py-3 rounded-full transition-colors shadow-md">
            Selengkapnya
        </a>
    </section>

</div>
@endsection