@extends('layouts.public')

@section('content')
<div class="font-['Montserrat'] bg-[#F4F7FB]">
    
    <!-- HERO SECTION -->
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
                <a href="{{ url('/pengaduan') }}" class="text-blue-400 font-semibold hover:text-blue-300 flex items-center text-sm w-max">
                    Ajukan Pengaduan 
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            <div class="bg-white text-[#1D2059] p-8 lg:p-12 flex flex-col justify-center transition hover:bg-gray-50">
                <h2 class="text-xl lg:text-2xl font-bold mb-3 uppercase tracking-wide">Layanan Administrasi Publik</h2>
                <p class="text-gray-600 mb-6 text-sm leading-relaxed">Ajukan pembuatan surat dan layanan administrasi secara online dengan mudah dan cepat.</p>
                <a href="{{ url('/layanan/pengajuan') }}" class="text-blue-600 font-semibold hover:text-blue-800 flex items-center text-sm w-max">
                    Ajukan Layanan 
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 mb-24 text-center relative z-0">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Panduan Layanan</h2>
        <p class="text-indigo-500 font-medium text-sm mb-10">Pilih jenis layanan untuk melihat berkas dan persyaratan yang diperlukan</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl mb-4">👶</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Persyaratan Akta Kelahiran</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">Pengurusan dokumen pencatatan kelahiran baru.</p>
                </div>
                <button type="button" onclick="openModal('akta-kelahiran')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-blue-50 hover:text-blue-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-xl mb-4">👨‍👩‍👧‍👦</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Syarat Pengajuan Kartu Keluarga</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">Pembaruan data, pencoretan, atau pembuatan KK baru.</p>
                </div>
                <button type="button" onclick="openModal('kartu-keluarga')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-green-50 hover:text-green-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl mb-4">🪪</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Syarat Pengajuan E-KTP</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">Perekaman baru maupun pengajuan KTP hilang/rusak.</p>
                </div>
                <button type="button" onclick="openModal('e-ktp')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-purple-50 hover:text-purple-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl mb-4">🔄</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Pindah Antar Kapanewon/Kalurahan</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">Mutasi penduduk antar lingkup lokal / padukuhan.</p>
                </div>
                <button type="button" onclick="openModal('pindah-lokal')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-orange-50 hover:text-orange-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl mb-4">🚛</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Pindah Antar Kabupaten/Provinsi</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">Mutasi keluar atau masuk dari luar daerah regional.</p>
                </div>
                <button type="button" onclick="openModal('pindah-luar')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-red-50 hover:text-red-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl mb-4">📄</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Surat Keterangan Kalurahan</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">Syarat pembuatan pengantar SKCK, SKTM, serta SKU.</p>
                </div>
                <button type="button" onclick="openModal('surat-keterangan')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-teal-50 hover:text-teal-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

        </div>

        {{-- Struktur Modal Global --}}
        <div id="guidanceModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex-col items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[85vh] flex flex-col shadow-xl transform scale-95 opacity-0 transition-all duration-300" id="modalContainer">
                
                {{-- Header Modal --}}
                <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-white rounded-t-2xl">
                    <div class="text-left">
                        <span class="inline-block px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 rounded-full mb-2">Layanan Kalurahan</span>
                        <h2 id="modalTitle" class="text-xl font-bold text-[#1D2059] leading-tight">Judul Panduan</h2>
                    </div>
                    <button onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 hover:text-gray-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- Isi Persyaratan --}}
                <div class="p-6 text-sm text-gray-700 leading-relaxed overflow-y-auto text-left" id="modalContent">
                    </div>

                {{-- Footer Modal --}}
                <div class="p-5 border-t border-gray-100 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                    <button onclick="closeModal()" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-200 transition">
                        Tutup
                    </button>
                    <a href="{{ route('user.layanan.pengajuan') }}" class="px-6 py-2.5 bg-[#1D2059] hover:bg-blue-800 text-white text-sm font-semibold rounded-xl transition shadow-md flex items-center">
                        Ajukan Layanan Ini
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- AGENDA KALURAHAN -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 mb-24 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Agenda Kalurahan</h2>
        <p class="text-indigo-500 font-medium text-sm mb-10">Pantau kegiatan dan jadwal terbaru di lingkungan kalurahan secara mudah</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            @forelse ($agendas as $agenda)
            @php
                // Parsing tanggal sekali untuk digunakan di beberapa tempat
                $date = \Carbon\Carbon::parse($agenda->tanggal ?? $agenda->created_at);
            @endphp
            <!-- Menggunakan route agenda.show dengan parameter agenda_id -->
            <a href="{{ route('agenda.show', $agenda->agenda_id) }}" class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden text-left flex flex-col group h-full cursor-pointer block">
                
                <!-- PENGGANTI FOTO: Header Berwarna dengan Ikon/Tanggal -->
                <div class="h-32 bg-gradient-to-br from-[#1D2059] to-blue-700 relative flex items-center justify-center overflow-hidden">
                    <!-- Ornamen Pattern Background -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <pattern id="grid-{{ $loop->index }}" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                            </pattern>
                            <rect width="100" height="100" fill="url(#grid-{{ $loop->index }})" />
                        </svg>
                    </div>
                    
                    <!-- Date Badge (Efek Kaca / Glassmorphism) -->
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-xl px-6 py-2 text-center transform group-hover:scale-110 transition-transform duration-300 shadow-xl z-10">
                        <span class="block text-xs font-semibold opacity-90 uppercase tracking-widest mb-1">
                            {{ $date->translatedFormat('M Y') }}
                        </span>
                        <span class="block text-4xl font-black leading-none">
                            {{ $date->translatedFormat('d') }}
                        </span>
                    </div>
                </div>

                <!-- Konten Agenda -->
                <div class="p-6 flex flex-col flex-grow">
                    <!-- Indikator Tanggal Lengkap -->
                    <div class="flex items-center text-xs font-medium text-blue-600 mb-3 bg-blue-50 w-max px-3 py-1 rounded-full">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $date->translatedFormat('l, d F Y') }}
                    </div>
                    
                    <h3 class="font-bold text-gray-800 text-lg leading-snug line-clamp-3 group-hover:text-blue-700 transition-colors">
                        {{ $agenda->judul_agenda ?? $agenda->nama_agenda }}
                    </h3>
                </div>
            </a>
            @empty
                <div class="col-span-full text-gray-500 text-sm py-10 bg-white border border-dashed border-gray-300 rounded-2xl">
                    Belum ada agenda terdekat.
                </div>
            @endforelse
        </div>
        <a href="{{ url('/agenda') }}" class="inline-block bg-[#1D2059] hover:bg-blue-900 text-white text-sm font-semibold px-8 py-3 rounded-full transition-colors shadow-md">
            Selengkapnya
        </a>
    </section>

    <!-- BERITA KALURAHAN -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 mb-24 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Berita Kalurahan</h2>
        <p class="text-indigo-500 font-medium text-sm mb-10">Dapatkan informasi terkini seputar kegiatan dan perkembangan kalurahan</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            @forelse ($beritas as $berita)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow border border-gray-100 overflow-hidden text-left flex flex-col relative group">
                <div class="overflow-hidden relative">
                    <img 
                        src="{{ $berita->foto->first()?->url_file_berita
                                ? asset('storage/' . $berita->foto->first()->url_file_berita)
                                : 'https://via.placeholder.com/500x300' }}" 
                        alt="{{ $berita->judul_berita }}" 
                        class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                </div>
                <div class="p-6 relative pt-8 flex-grow flex flex-col">
                    <div class="absolute -top-5 left-6 bg-[#1D2059] text-white text-xs font-bold px-4 py-2 rounded shadow-md flex items-center">
                        {{ \Carbon\Carbon::parse($berita->tanggal_berita)->translatedFormat('d F Y') }}
                    </div>
                    
                    <!-- Menggunakan route berita.show dengan parameter berita_id pada judul -->
                    <a href="{{ route('berita.show', $berita->berita_id) }}" class="block">
                        <h3 class="font-bold text-lg text-gray-900 mb-3 leading-snug line-clamp-2 hover:text-blue-600 cursor-pointer transition">
                            {{ $berita->judul_berita }}
                        </h3>
                    </a>
                    
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4 flex-grow">
                        {{ Str::limit(strip_tags($berita->isi_berita), 120) }}
                    </p>
                    
                    <div class="flex justify-end border-t border-gray-100 pt-4 mt-auto">
                        <!-- Menggunakan route berita.show dengan parameter berita_id pada ikon detail -->
                        <a href="{{ route('berita.show', $berita->berita_id) }}" class="text-gray-400 hover:text-[#1D2059] transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-5.368m0 5.368l5.657 5.657m-5.657-5.657l5.657-5.657m0 0a3 3 0 115.657 5.657m-5.657-5.657a3 3 0 01-5.657 5.657m0 0a3 3 0 115.657 5.657m-5.657-5.657l-5.657 5.657m5.657-5.657l-5.657-5.657"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-full text-gray-500 text-sm py-10 bg-white border border-dashed border-gray-300 rounded-2xl">
                    Belum ada berita terbaru.
                </div>
            @endforelse
        </div>
        <a href="{{ url('/berita') }}" class="inline-block bg-[#1D2059] hover:bg-blue-900 text-white text-sm font-semibold px-8 py-3 rounded-full transition-colors shadow-md">
            Selengkapnya
        </a>
    </section>

</div>

{{-- Script Logika Pengganti Isi Konten Modal --}}
<script>
    const dataPersyaratan = {
        'akta-kelahiran': `
            <p class="font-semibold text-gray-900 mb-2">Syarat pencatatan kelahiran :</p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Surat keterangan lahir dari dokter/bidan/penolong kelahiran</li>
                <li>Fotokopi Akta Nikah/Kutipan Akta Perkawinan orangtua (dilegalisir)</li>
                <li>Fotokopi KK dan KTP-el orangtua</li>
                <li>Fotokopi KTP-el 2 (dua) orang saksi</li>
                <li>Surat kuasa di atas materai cukup bagi yang dikuasakan, dilampiri fotokopi KTP-el penerima kuasa</li>
            </ul>
            <p class="mt-4 font-semibold text-gray-900 mb-2">Untuk warga negara asing (WNA), ditambah :</p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Fotokopi Surat Keterangan Tempat Tinggal (SKTT) orangtua bagi pemegang Izin Tinggal Terbatas (ITAS)</li>
                <li>Fotokopi paspor (dilegalisir)</li>
            </ul>
            <div class="mt-4 p-3 bg-green-50 text-green-800 rounded-xl font-medium text-xs">
                💡 Pencatatan kelahiran tidak dipungut biaya (Gratis).
            </div>
        `,
        'kartu-keluarga': `
            <ul class="list-disc pl-5 space-y-2">
                <li>Kartu Keluarga Asli & Fotocopy Kartu Keluarga</li>
                <li>Akta Kelahiran</li>
                <li>Akta Kematian <span class="text-xs text-gray-400">(jika akan mencoret anggota keluarga yang sudah meninggal)</span></li>
                <li>Foto Copy Buku Nikah/Akta Perkawinan</li>
                <li>Melampirkan berkas Pindah penduduk (SKP WNI) jika ada keluarga yang Pindah</li>
                <li>Melampirkan berkas Masuk Penduduk (SKD WNI) bagi anggota keluarga yang akan masuk</li>
                <li>Untuk kehilangan Kartu Keluarga harap melampirkan <strong>Surat Kehilangan dari Kepolisian</strong></li>
                <li>Untuk setiap Perubahan Status di KK harap melampirkan data pendukung perubahan (cerai, nikah, pekerjaan, agama, dll)</li>
            </ul>
        `,
        'e-ktp': `
            <ul class="list-disc pl-5 space-y-2">
                <li>Foto Copy Kartu Keluarga</li>
                <li>Pas Foto 4×6 dua lembar</li>
                <li>Jika terdapat kesalahan/perubahan data nama/tanggal lahir, mohon data di Kepala Keluarga diperbaharui terlebih dahulu dengan melampirkan data pendukung</li>
                <li>Untuk pengajuan kehilangan E-KTP mohon melampirkan <strong>Surat Kehilangan dari Kepolisian</strong></li>
            </ul>
            <div class="mt-4 p-3 bg-blue-50 text-blue-800 rounded-xl font-medium text-xs">
                ⚠️ Syarat wajib: Pemohon harus sudah berusia minimal 17 Tahun.
            </div>
        `,
        'pindah-lokal': `
            <ol class="list-decimal pl-5 space-y-2">
                <li>Kartu Keluarga Asli & Foto Copy Kartu Keluarga</li>
                <li>Foto Copy E-KTP</li>
                <li>Foto Copy Buku Nikah/Akta Perkawinan Kepala Keluarga</li>
                <li>Foto Copy Buku Nikah/Akta Perkawinan bagi penduduk yang pindah tapi sudah menikah</li>
                <li>Surat Keterangan kehilangan KK/E-KTP dari Kepolisian jika dokumen fisik pemohon hilang</li>
            </ol>
        `,
        'pindah-luar': `
            <ul class="list-disc pl-5 space-y-2">
                <li>Kartu Keluarga Asli & Foto Copy Kartu Keluarga</li>
                <li>Foto Copy E-KTP</li>
                <li>Foto Copy Buku Nikah/Akta Perkawinan Kepala Keluarga</li>
                <li>Foto Copy Buku Nikah/Akta Perkawinan bagi penduduk yang pindah tapi sudah menikah</li>
                <li>Surat Keterangan kehilangan KK/E-KTP jika berkas pemohon Hilang</li>
                <li>Pas Foto 4×6 empat lembar berwarna</li>
                <li>Foto Copy Akta Lahir anak jika sudah mempunyai anak</li>
            </ul>
        `,
        'surat-keterangan': `
            <p class="font-semibold text-gray-900 mb-2">Persyaratan Utama (Wajib):</p>
            <ul class="list-disc pl-5 space-y-2 mb-4">
                <li>Surat Pengantar dari RT / RW / Dukuh</li>
                <li>Fotokopi Kartu Keluarga (FC KK) & KTP-el</li>
            </ul>

            <p class="font-semibold text-gray-900 mb-3 border-t border-gray-100 pt-3">Ketentuan Tambahan Sesuai Jenis Pengajuan :</p>
            <div class="space-y-3">
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <strong class="text-blue-700 font-bold block text-xs uppercase mb-1">1. Pengantar SKCK</strong>
                    <p class="text-xs text-gray-600 leading-relaxed">Wajib menyebutkan target tingkatan Kepolisian tujuan (ke <strong>POLSEK, POLRES, atau POLDA</strong>) beserta kegunaannya secara detail.</p>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <strong class="text-blue-700 font-bold block text-xs uppercase mb-1">2. Surat Keterangan Usaha (SKU)</strong>
                    <p class="text-xs text-gray-600 leading-relaxed">Wajib mencantumkan informasi detail berupa: <strong>Nama usaha, lama usaha berjalan, alamat lengkap lokasi tempat usaha</strong>, dan <strong>nama Bank yang dituju</strong>.</p>
                </div>
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <strong class="text-blue-700 font-bold block text-xs uppercase mb-1">3. Surat Keterangan Tidak Mampu (SKTM)</strong>
                    <p class="text-xs text-gray-600 leading-relaxed">Wajib menyebutkan nominal <strong>jumlah penghasilan per bulan</strong>, beserta target instansi tujuan dan kegunaan pengajuannya.</p>
                </div>
            </div>
        `
    };

    function openModal(key) {
        const modal = document.getElementById('guidanceModal');
        const container = document.getElementById('modalContainer');
        const titles = {
            'akta-kelahiran': 'Persyaratan Akta Kelahiran',
            'kartu-keluarga': 'Syarat Pengajuan Kartu Keluarga',
            'e-ktp': 'Syarat Pengajuan E-KTP',
            'pindah-lokal': 'Pindah Penduduk Antar Kapanewon/Kalurahan',
            'pindah-luar': 'Pindah Penduduk Antar Kabupaten/Provinsi',
            'surat-keterangan': 'Surat Keterangan Kalurahan'
        };

        document.getElementById('modalTitle').innerText = titles[key];
        document.getElementById('modalContent').innerHTML = dataPersyaratan[key];
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            container.classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('guidanceModal');
        const container = document.getElementById('modalContainer');
        container.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection