@extends('layouts.public')

@section('content')

<div class="bg-[#F4F7FF] min-h-screen py-10 font-['Montserrat']">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    @if(session('success'))

    <div id="successAlert"
        class="mb-6 rounded-3xl border border-green-200 bg-green-50 px-6 py-5 shadow-sm animate-[fadeIn_.3s_ease]">

        <div class="flex items-start gap-4">

            <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center flex-shrink-0">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6 text-green-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"/>
                </svg>

            </div>

            <div class="flex-1">

                <h4 class="font-bold text-green-800 text-lg">
                    Pengajuan Berhasil
                </h4>

                <p class="text-sm text-green-700 mt-1 leading-relaxed">
                    {{ session('success') }}
                </p>

            </div>

            <button onclick="closeSuccessAlert()"
                class="text-green-500 hover:text-green-700 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>

    </div>

    @endif

        {{-- HEADER --}}
        <div class="mb-10">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <a href="/" class="hover:text-[#1D2059] transition">
                    Beranda
                </a>

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7" />
                </svg>

                <span class="font-medium text-[#1D2059]">
                    Formulir Pengajuan Layanan
                </span>
            </div>

            {{-- Title --}}
            <div class="space-y-2">
                <h1 class="text-3xl md:text-4xl font-extrabold text-[#1D2059] tracking-tight">
                    Formulir Pengajuan Layanan
                </h1>

                <p class="text-sm md:text-base text-gray-500 leading-relaxed max-w-2xl">
                    Lengkapi data berikut untuk memproses pengajuan layanan administrasi kalurahan dengan cepat dan mudah.
                </p>
            </div>

        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

            {{-- TOP HEADER --}}
            <div class="bg-[#1D2059] px-8 py-6 text-white flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold">Pengajuan Layanan Mandiri</h2>
                    <p class="text-sm text-blue-100 mt-1">Kalurahan Hargobinangun</p>
                </div>
                <div class="bg-white/10 rounded-xl px-4 py-3 text-sm flex items-center gap-2 border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pastikan seluruh data dan dokumen telah sesuai.
                </div>
            </div>

            {{-- FORM --}}
            <form id="layananForm" action="{{ route('user.layanan.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" class="p-6 md:p-10 space-y-10">
                @csrf

                {{-- SECTION: INFORMASI LAYANAN --}}
                <section class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <div class="flex items-start gap-4 mb-6 border-b border-gray-100 pb-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#1D2059]/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1D2059]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-[#1D2059]">Informasi Layanan</h3>
                            <p class="text-sm text-gray-500 mt-1">Pilih jenis layanan administrasi yang ingin diajukan.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="jenis_layanan" class="block text-sm font-semibold text-gray-700">
                                Jenis Layanan <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">
                                <select id="jenis_layanan" name="jenis_layanan" required
                                    class="w-full appearance-none rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                                    
                                    <option value="">-- Pilih Jenis Layanan --</option>

                                    <optgroup label="Layanan Kependudukan">
                                        <option value="ktp_baru">Pengajuan E-KTP</option>
                                        <option value="kk_baru">Pengajuan Kartu Keluarga</option>
                                        <option value="pindah_domisili">Surat Keterangan Pindah Domisili</option>
                                        <option value="akta_kelahiran">Pengajuan Akta Kelahiran</option>
                                        <option value="akta_kematian">Pengajuan Akta Kematian</option>
                                    </optgroup>

                                    <optgroup label="Surat Keterangan">
                                        <option value="sktm">Surat Keterangan Tidak Mampu (SKTM)</option>
                                        <option value="sku">Surat Keterangan Usaha (SKU)</option>
                                        <option value="kehilangan_kk">Surat Ket. Kehilangan KK</option>
                                        <option value="janda">Surat Keterangan Janda</option>
                                        <option value="beda_nama">Surat Keterangan Beda Nama</option>
                                        <option value="domisili_instansi">Surat Ket. Domisili Instansi</option>
                                        <option value="domisili_usaha">Surat Ket. Domisili Usaha</option>
                                        <option value="domisili_pribadi">Surat Ket. Domisili Pribadi</option>
                                    </optgroup>
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>

                            <p class="text-xs text-gray-400">Pastikan memilih layanan sesuai kebutuhan administrasi Anda.</p>
                        </div>
                    </div>
                </section>

                {{-- SECTION: DATA AKUN PENGAJU --}}
                <section class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <div class="flex items-start gap-4 mb-6 border-b border-gray-100 pb-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#1D2059]/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1D2059]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.364 4.56a9 9 0 01-13.243 13.243z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-[#1D2059]">Data Akun Pengaju</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Data otomatis diambil dari akun yang sedang login.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">NIK</label>
                            <input type="text" readonly
                                value="{{ auth()->user()->nik ?? '-' }}"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-100 px-5 py-4 text-sm text-gray-700 shadow-sm cursor-not-allowed focus:outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                            <input type="text" readonly
                                value="{{ auth()->user()->nama_lengkap ?? '-' }}"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-100 px-5 py-4 text-sm text-gray-700 shadow-sm cursor-not-allowed focus:outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                            <input type="text" readonly
                                value="{{ auth()->user()->nomor_telepon ?? '-' }}"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-100 px-5 py-4 text-sm text-gray-700 shadow-sm cursor-not-allowed focus:outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Email</label>
                            <input type="text" readonly
                                value="{{ auth()->user()->email ?? '-' }}"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-100 px-5 py-4 text-sm text-gray-700 shadow-sm cursor-not-allowed focus:outline-none">
                        </div>

                    </div>
                </section>

                {{-- SECTION: DATA YANG DIAJUKAN --}}
                <section id="section_pengajuan" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <div class="flex items-start gap-4 mb-6 border-b border-gray-100 pb-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#1D2059]/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1D2059]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4m10 0H7"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-[#1D2059]">Identitas Pemohon Surat</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Isi data warga yang akan dibuatkan surat.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                Jenis Pengajuan <span class="text-red-500">*</span>
                            </label>

                            <div class="relative md:w-1/2">
                                <select id="jenis_pengajuan" name="jenis_pengajuan" required
                                    class="w-full appearance-none rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">

                                    <option value="">Pilih Pengajuan</option>
                                    <option value="sendiri">Diri Sendiri</option>
                                    <option value="orang_lain">Orang Lain</option>
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div id="hubungan_wrapper" class="md:col-span-2 space-y-2 hidden">
                            <label class="block text-sm font-semibold text-gray-700">
                                Hubungan Dengan Pengaju <span class="text-red-500">*</span>
                            </label>

                            <div class="relative md:w-1/2">
                                <select id="hubungan_pengaju" name="hubungan_pengaju" class="w-full appearance-none rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                                    <option value="">Pilih Hubungan</option>
                                    <option value="Orang Tua">Orang Tua</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Saudara">Saudara</option>
                                    <option value="Pasangan">Pasangan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                NIK Pemohon <span class="text-red-500">*</span>
                            </label>

                            <input type="text"
                                id="nik_pengajuan"
                                name="nik_pengajuan"
                                required
                                maxlength="16"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                Nama Lengkap Pemohon <span class="text-red-500">*</span>
                            </label>

                            <input type="text"
                                id="nama_pengajuan"
                                name="nama_pengajuan"
                                required
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                Nomor Telepon
                            </label>

                            <input type="text"
                                id="telepon_pengajuan"
                                name="telepon_pengajuan"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                Tempat Lahir
                            </label>

                            <input type="text"
                                id="tempat_lahir_pengajuan"
                                name="tempat_lahir_pengajuan"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                Tanggal Lahir
                            </label>

                            <input type="date"
                                id="tanggal_lahir_pengajuan"
                                name="tanggal_lahir_pengajuan"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                        </div>

                    </div>

                    {{-- FIELD DINAMIS --}}
                    <div id="dynamic_fields" class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5 empty:mt-0"></div>

                </section>

                {{-- SECTION: KEPERLUAN LAYANAN --}}
                <section class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">

                    <div class="flex items-start gap-4 mb-6 border-b border-gray-100 pb-4">

                        <div class="w-12 h-12 rounded-2xl bg-[#1D2059]/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-[#1D2059]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-[#1D2059]">
                                Keperluan Layanan
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Jelaskan keperluan pengajuan layanan Anda secara singkat.
                            </p>
                        </div>

                    </div>

                    <div class="space-y-2">

                        <label class="block text-sm font-semibold text-gray-700">
                            Keperluan Pengajuan <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            name="keperluan_layanan"
                            rows="4"
                            required
                            placeholder="Contoh: Digunakan untuk pengajuan beasiswa kuliah"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 resize-none shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">{{ old('keperluan_layanan') }}</textarea>

                    </div>

                </section>

                {{-- SECTION: DOKUMEN PENDUKUNG --}}
                <section class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">

                    <div class="flex items-start gap-4 mb-6 border-b border-gray-100 pb-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#1D2059]/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-[#1D2059]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16V4m0 0L3 8m4-4l4 4m6 8v4m0 0l4-4m-4 4l-4-4"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-[#1D2059]">
                                Dokumen Pendukung
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Unggah dokumen persyaratan dalam format JPG, PNG, atau PDF.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                        {{-- ====================== --}}
                        {{-- UPLOAD KTP --}}
                        {{-- ====================== --}}
                        <div class="space-y-2">

                            <label class="block text-sm font-semibold text-gray-700">
                                KTP <span class="text-red-500">*</span>
                            </label>

                            <label class="group flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-5 cursor-pointer transition-all duration-200 hover:border-[#1D2059] hover:bg-[#1D2059]/5 min-h-[260px]">

                                <input
                                    type="file"
                                    name="file_ktp"
                                    hidden
                                    required
                                    accept=".jpg,.jpeg,.png,.pdf"
                                    onchange="previewFile(this)"
                                >

                                {{-- PREVIEW --}}
                                <div class="preview-container hidden w-full">

                                    {{-- PREVIEW IMAGE --}}
                                    <img class="preview-image hidden w-full h-40 object-cover rounded-2xl border border-gray-200 shadow-sm">

                                    {{-- PREVIEW PDF --}}
                                    <div class="preview-pdf hidden items-center gap-3 bg-white border border-gray-200 rounded-2xl px-4 py-4">

                                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6 text-red-500"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 7h10M7 11h10M7 15h6"/>
                                            </svg>
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <p class="pdf-name text-sm font-semibold text-gray-700 truncate"></p>
                                            <p class="text-xs text-gray-400">
                                                File PDF berhasil dipilih
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                {{-- DEFAULT --}}
                                <div class="upload-default flex flex-col items-center justify-center gap-3 text-center">

                                    <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center group-hover:scale-105 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-7 w-7 text-[#1D2059]"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">
                                            Upload File KTP
                                        </p>

                                        <p class="text-xs text-gray-400 mt-1">
                                            JPG, PNG, PDF
                                        </p>
                                    </div>

                                </div>

                            </label>

                        </div>

                        {{-- ====================== --}}
                        {{-- UPLOAD KK --}}
                        {{-- ====================== --}}
                        <div class="space-y-2">

                            <label class="block text-sm font-semibold text-gray-700">
                                Kartu Keluarga <span class="text-red-500">*</span>
                            </label>

                            <label class="group flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-5 cursor-pointer transition-all duration-200 hover:border-[#1D2059] hover:bg-[#1D2059]/5 min-h-[260px]">

                                <input
                                    type="file"
                                    name="file_kk"
                                    hidden
                                    required
                                    accept=".jpg,.jpeg,.png,.pdf"
                                    onchange="previewFile(this)"
                                >

                                {{-- PREVIEW --}}
                                <div class="preview-container hidden w-full">

                                    <img class="preview-image hidden w-full h-40 object-cover rounded-2xl border border-gray-200 shadow-sm">

                                    <div class="preview-pdf hidden items-center gap-3 bg-white border border-gray-200 rounded-2xl px-4 py-4">

                                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6 text-red-500"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 7h10M7 11h10M7 15h6"/>
                                            </svg>
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <p class="pdf-name text-sm font-semibold text-gray-700 truncate"></p>
                                            <p class="text-xs text-gray-400">
                                                File PDF berhasil dipilih
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                {{-- DEFAULT --}}
                                <div class="upload-default flex flex-col items-center justify-center gap-3 text-center">

                                    <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center group-hover:scale-105 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-7 w-7 text-[#1D2059]"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">
                                            Upload File KK
                                        </p>

                                        <p class="text-xs text-gray-400 mt-1">
                                            JPG, PNG, PDF
                                        </p>
                                    </div>

                                </div>

                            </label>

                        </div>

                        {{-- ====================== --}}
                        {{-- UPLOAD DOKUMEN PENDUKUNG --}}
                        {{-- ====================== --}}
                        <div class="space-y-2">

                            <label class="block text-sm font-semibold text-gray-700">
                                Dokumen Lainnya
                                <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>

                            <label class="group flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 p-5 cursor-pointer transition-all duration-200 hover:border-[#1D2059] hover:bg-[#1D2059]/5 min-h-[260px]">

                                <input
                                    type="file"
                                    name="file_pendukung"
                                    hidden
                                    accept=".jpg,.jpeg,.png,.pdf"
                                    onchange="previewFile(this)"
                                >

                                {{-- PREVIEW --}}
                                <div class="preview-container hidden w-full">

                                    <img class="preview-image hidden w-full h-40 object-cover rounded-2xl border border-gray-200 shadow-sm">

                                    <div class="preview-pdf hidden items-center gap-3 bg-white border border-gray-200 rounded-2xl px-4 py-4">

                                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6 text-red-500"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 7h10M7 11h10M7 15h6"/>
                                            </svg>
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <p class="pdf-name text-sm font-semibold text-gray-700 truncate"></p>
                                            <p class="text-xs text-gray-400">
                                                File PDF berhasil dipilih
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                {{-- DEFAULT --}}
                                <div class="upload-default flex flex-col items-center justify-center gap-3 text-center">

                                    <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center group-hover:scale-105 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-7 w-7 text-[#1D2059]"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">
                                            Lampiran Tambahan
                                        </p>

                                        <p class="text-xs text-gray-400 mt-1">
                                            Opsional
                                        </p>
                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                </section>

                {{-- SCRIPT PREVIEW --}}
                <script>
                function previewFile(input) {

                    const file = input.files[0];

                    if (!file) return;

                    const label = input.closest('label');

                    const previewContainer = label.querySelector('.preview-container');
                    const previewImage = label.querySelector('.preview-image');
                    const previewPdf = label.querySelector('.preview-pdf');
                    const pdfName = label.querySelector('.pdf-name');
                    const uploadDefault = label.querySelector('.upload-default');

                    previewContainer.classList.remove('hidden');
                    uploadDefault.classList.add('hidden');

                    // RESET
                    previewImage.classList.add('hidden');
                    previewPdf.classList.add('hidden');

                    // IMAGE PREVIEW
                    if (file.type.startsWith('image/')) {

                        const reader = new FileReader();

                        reader.onload = function(e) {

                            previewImage.src = e.target.result;
                            previewImage.classList.remove('hidden');

                        };

                        reader.readAsDataURL(file);
                    }

                    // PDF PREVIEW
                    else if (file.type === 'application/pdf') {

                        previewPdf.classList.remove('hidden');
                        previewPdf.classList.add('flex');

                        pdfName.textContent = file.name;
                    }
                }
                </script>

                {{-- SECTION: METODE PENERIMAAN --}}
                <section class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">

                    <div class="flex items-start gap-4 mb-6 border-b border-gray-100 pb-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#1D2059]/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1D2059]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-[#1D2059]">Metode Penerimaan</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Pilih metode penerimaan dokumen layanan Anda.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <label class="group relative border-2 border-gray-100 rounded-2xl p-5 cursor-pointer transition-all duration-200 hover:border-[#1D2059]/40 has-[:checked]:border-[#1D2059] has-[:checked]:bg-[#1D2059]/5">
                            
                            <div class="flex items-start gap-4">
                                <input type="radio"
                                    name="pengiriman_layanan"
                                    value="ambil"
                                    checked
                                    class="mt-1 w-5 h-5 text-[#1D2059] focus:ring-[#1D2059]">

                                <div>
                                    <h4 class="font-bold text-gray-800">
                                        Ambil di Kantor Kalurahan
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                        Dokumen fisik diambil langsung setelah mendapat notifikasi selesai.
                                    </p>
                                </div>
                            </div>
                        </label>

                        <label class="group relative border-2 border-gray-100 rounded-2xl p-5 cursor-pointer transition-all duration-200 hover:border-[#1D2059]/40 has-[:checked]:border-[#1D2059] has-[:checked]:bg-[#1D2059]/5">
                            
                            <div class="flex items-start gap-4">
                                <input type="radio"
                                    name="pengiriman_layanan"
                                    value="email"
                                    class="mt-1 w-5 h-5 text-[#1D2059] focus:ring-[#1D2059]">

                                <div>
                                    <h4 class="font-bold text-gray-800">
                                        Kirim Digital via Email
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                        Dokumen bertanda tangan elektronik dikirim ke email akun Anda.
                                    </p>
                                </div>
                            </div>
                        </label>

                    </div>
                </section>

                {{-- SECTION: PERSETUJUAN --}}
                <section class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-3xl border border-blue-100 p-5">

                    <label class="flex items-start gap-4 cursor-pointer">

                        <input type="checkbox"
                            required
                            class="mt-1 w-5 h-5 rounded border-gray-300 text-[#1D2059] focus:ring-[#1D2059]">

                        <div>
                            <p class="text-sm text-gray-700 leading-relaxed">
                                Saya menyatakan bahwa seluruh data dan dokumen yang saya unggah adalah 
                                <span class="font-bold text-[#1D2059]">benar dan sah</span>. 
                                Apabila di kemudian hari ditemukan ketidaksesuaian, saya bersedia mempertanggungjawabkannya sesuai ketentuan yang berlaku.
                            </p>
                        </div>

                    </label>
                </section>

                {{-- SUBMIT BUTTON --}}
                <div class="flex justify-end pt-2">
                    <button type="button"
                        onclick="openSubmitModal()"
                        class="w-full md:w-auto px-8 py-4 rounded-2xl bg-[#1D2059] hover:bg-[#161847] text-white text-sm font-bold shadow-lg shadow-[#1D2059]/30 transition-all duration-300 hover:scale-[1.02] flex items-center justify-center gap-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>

                        Kirim Pengajuan

                    </button>

                </div>

            </form>
        </div>
    </div>
</div>

{{-- ========================= --}}
{{-- MODAL KONFIRMASI --}}
{{-- ========================= --}}
<div id="submitModal"
    class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4">

    <div class="w-full max-w-md rounded-3xl bg-white p-7 shadow-2xl animate-[fadeIn_.2s_ease]">

        <div class="flex justify-center mb-5">

            <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-yellow-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                </svg>

            </div>

        </div>

        <div class="text-center">

            <h3 class="text-2xl font-bold text-[#1D2059]">
                Konfirmasi Pengajuan
            </h3>

            <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                Pastikan seluruh data dan dokumen sudah benar sebelum dikirim.
            </p>

        </div>

        <div class="flex gap-3 mt-8">

            <button type="button"
                onclick="closeSubmitModal()"
                class="flex-1 rounded-2xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all">

                Batal

            </button>

            <button type="button"
                onclick="submitForm()"
                class="flex-1 rounded-2xl bg-[#1D2059] px-5 py-3 text-sm font-semibold text-white hover:bg-[#161847] transition-all shadow-lg shadow-[#1D2059]/20">

                Ya, Kirim

            </button>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- MODAL LOADING --}}
{{-- ========================= --}}
<div id="loadingModal"
    class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4">

    <div class="w-full max-w-sm rounded-3xl bg-white p-8 text-center shadow-2xl">

        <div class="flex justify-center mb-5">

            <div class="w-16 h-16 border-4 border-[#1D2059]/20 border-t-[#1D2059] rounded-full animate-spin"></div>

        </div>

        <h3 class="text-xl font-bold text-[#1D2059]">
            Mengirim Pengajuan...
        </h3>

        <p class="text-sm text-gray-500 mt-2">
            Mohon tunggu sebentar
        </p>

    </div>

</div>

{{-- STYLE --}}
<style>
.form-label {
    @apply block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2;
}
.form-input {
    @apply w-full px-4 py-2.5 text-sm border-2 border-gray-200 rounded-xl bg-white
    focus:ring-0 focus:border-[#1D2059]
    outline-none transition-all duration-200 text-gray-800;
}
.form-readonly {
    @apply w-full px-4 py-2.5 text-sm border-2 border-gray-100 rounded-xl
    bg-gray-100 text-gray-500 cursor-not-allowed outline-none;
}
.upload-box {
    @apply border-2 border-dashed border-gray-300 rounded-xl
    px-4 py-8 flex justify-center items-center w-full
    hover:border-[#1D2059] hover:bg-blue-50/30
    transition-all cursor-pointer;
}
.upload-text {
    @apply text-sm text-gray-500 font-medium;
}
</style>

{{-- SCRIPT --}}
<script>
const userAuthData = {
    nik: "{{ auth()->user()->nik ?? '' }}",
    nama_lengkap: "{{ auth()->user()->nama_lengkap ?? '' }}",
    nomor_telepon: "{{ auth()->user()->nomor_telepon ?? '' }}",
    tempat_lahir: "{{ auth()->user()->tempat_lahir ?? '' }}",
    tanggal_lahir: "{{ optional(auth()->user()->tanggal_lahir)->format('Y-m-d') }}"
};

// Fungsi update teks input file
function updateFileName(input) {
    if (input.files && input.files[0]) {
        const fileName = input.files[0].name;
        const container = input.parentElement.querySelector('div');
        container.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            <span class="text-xs text-green-600 font-bold text-center break-all">${fileName}</span>
        `;
    }
}

const hubunganPengaju = document.getElementById('hubungan_pengaju');
const nikPengajuan = document.getElementById('nik_pengajuan');
const namaPengajuan = document.getElementById('nama_pengajuan');
const teleponPengajuan = document.getElementById('telepon_pengajuan');
const tempatLahirPengajuan = document.getElementById('tempat_lahir_pengajuan');
const tanggalLahirPengajuan = document.getElementById('tanggal_lahir_pengajuan');

const jenisLayanan = document.getElementById('jenis_layanan');
const dynamicFields = document.getElementById('dynamic_fields');

// Fungsi merubah state input (Readonly vs Input biasa)
function setFieldState(element, isReadonly, value = '') {
    element.value = value;
    if (isReadonly) {
        element.readOnly = true;
        element.classList.remove('form-input');
        element.classList.add('form-readonly');
    } else {
        element.readOnly = false;
        element.classList.remove('form-readonly');
        element.classList.add('form-input');
    }
}

const jenisPengajuan = document.getElementById('jenis_pengajuan');
const hubunganWrapper = document.getElementById('hubungan_wrapper');

jenisPengajuan.addEventListener('change', function () {

    if (this.value === 'sendiri') {

        hubunganWrapper.classList.add('hidden');

        setFieldState(nikPengajuan, true, userAuthData.nik);
        setFieldState(namaPengajuan, true, userAuthData.nama_lengkap);
        setFieldState(teleponPengajuan, true, userAuthData.nomor_telepon);
        setFieldState(tempatLahirPengajuan, true, userAuthData.tempat_lahir);
        setFieldState(tanggalLahirPengajuan, true, userAuthData.tanggal_lahir);

    } else {

        hubunganWrapper.classList.remove('hidden');

        setFieldState(nikPengajuan, false, '');
        setFieldState(namaPengajuan, false, '');
        setFieldState(teleponPengajuan, false, '');
        setFieldState(tempatLahirPengajuan, false, '');
        setFieldState(tanggalLahirPengajuan, false, '');
    }
});

// Logika ketika memilih "Diri Sendiri" atau lainnya
hubunganPengaju.addEventListener('change', function() {
    if (this.value === 'Diri Sendiri') {
        setFieldState(nikPengajuan, true, userAuthData.nik);
        setFieldState(namaPengajuan, true, userAuthData.nama_lengkap);
        setFieldState(teleponPengajuan, true, userAuthData.nomor_telepon);
        setFieldState(tempatLahirPengajuan, true, userAuthData.tempat_lahir);
        setFieldState(tanggalLahirPengajuan, true, userAuthData.tanggal_lahir);
    } else {
        setFieldState(nikPengajuan, false, '');
        setFieldState(namaPengajuan, false, '');
        setFieldState(teleponPengajuan, false, '');
        setFieldState(tempatLahirPengajuan, false, '');
        setFieldState(tanggalLahirPengajuan, false, '');
    }
});

// Logika Render Field Dinamis Berdasarkan Layanan yang Dipilih
jenisLayanan.addEventListener('change', function() {
    let html = '';
    
    // Reset wrapper class (agar padding/margin hilang jika kosong)
    dynamicFields.className = "grid grid-cols-1 md:grid-cols-2 gap-5 mt-5 border-t border-gray-200 pt-5 empty:border-none empty:pt-0 empty:mt-0";

    switch(this.value) {
        case 'sku':
            html = `
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Nama Usaha <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="nama_usaha"
                        required
                        placeholder="Contoh: Warung Berkah"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Jenis Usaha <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="jenis_usaha"
                        required
                        placeholder="Contoh: Kuliner / Dagang"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Alamat Usaha <span class="text-red-500">*</span>
                    </label>

                    <textarea name="alamat_usaha"
                        rows="3"
                        required
                        placeholder="Tuliskan alamat lengkap tempat usaha..."
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 resize-none shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none"></textarea>
                </div>
            `;
            break;

        case 'sktm':
            html = `
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Tujuan Penggunaan <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="tujuan_sktm"
                        required
                        placeholder="Contoh: Keringanan Biaya Sekolah"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Instansi Tujuan <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="instansi_sktm"
                        required
                        placeholder="Contoh: SMP Negeri 1"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>
            `;
            break;

        case 'pindah_domisili':
            html = `
                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Alamat Tujuan Pindah <span class="text-red-500">*</span>
                    </label>

                    <textarea name="alamat_pindah"
                        rows="3"
                        required
                        placeholder="Tuliskan alamat lengkap tujuan pindah..."
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 resize-none shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none"></textarea>
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Alasan Pindah <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="alasan_pindah"
                        required
                        placeholder="Contoh: Pindah Tugas / Mengikuti Suami"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>
            `;
            break;

        case 'domisili_usaha':
            html = `
                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Nama Usaha / Perusahaan <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="nama_usaha"
                        required
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Alamat Usaha <span class="text-red-500">*</span>
                    </label>

                    <textarea name="alamat_usaha"
                        rows="3"
                        required
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 resize-none shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none"></textarea>
                </div>
            `;
            break;

        case 'domisili_instansi':
            html = `
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Nama Instansi/Lembaga <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="nama_instansi"
                        required
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Jabatan Pemohon
                    </label>

                    <input type="text"
                        name="jabatan_instansi"
                        placeholder="Opsional"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Alamat Instansi <span class="text-red-500">*</span>
                    </label>

                    <textarea name="alamat_instansi"
                        rows="3"
                        required
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 resize-none shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none"></textarea>
                </div>
            `;
            break;

        case 'beda_nama':
            html = `
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Nama Pada Dokumen Lama <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="nama_lama"
                        required
                        placeholder="Nama yang salah/lama"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Nama Pada Dokumen Baru/KTP <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="nama_baru"
                        required
                        placeholder="Nama yang benar"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Keterangan / Dokumen Referensi <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="keterangan_beda_nama"
                        required
                        placeholder="Contoh: Terdapat perbedaan nama di Ijazah SD"
                        class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-700 shadow-sm transition-all duration-200 focus:border-[#1D2059] focus:bg-white focus:ring-4 focus:ring-[#1D2059]/10 focus:outline-none">
                </div>
            `;
            break;

        default:
            html = ``;
            break;
    }
    
    // Inject HTML ke dalam container
    dynamicFields.innerHTML = html;
});
</script>

<script>

// =========================
// OPEN MODAL SUBMIT
// =========================
function openSubmitModal() {

    const form = document.getElementById('layananForm');

    // VALIDASI DULU
    if (!form.checkValidity()) {

        form.reportValidity();
        return;
    }

    document.getElementById('submitModal').classList.remove('hidden');
    document.getElementById('submitModal').classList.add('flex');
}

// =========================
// CLOSE MODAL
// =========================
function closeSubmitModal() {

    document.getElementById('submitModal').classList.add('hidden');
    document.getElementById('submitModal').classList.remove('flex');
}

// =========================
// SUBMIT FORM
// =========================
function submitForm() {

    closeSubmitModal();

    document.getElementById('loadingModal').classList.remove('hidden');
    document.getElementById('loadingModal').classList.add('flex');

    document.getElementById('layananForm').submit();
}

// =========================
// CLOSE SUCCESS ALERT
// =========================
function closeSuccessAlert() {

    const alert = document.getElementById('successAlert');

    if (alert) {
        alert.style.display = 'none';
    }
}

// =========================
// AUTO CLOSE SUCCESS ALERT
// =========================
setTimeout(() => {

    const alert = document.getElementById('successAlert');

    if (alert) {
        alert.style.opacity = '0';

        setTimeout(() => {
            alert.remove();
        }, 300);
    }

}, 5000);

// =========================
// CLOSE CLICK OUTSIDE
// =========================
window.addEventListener('click', function(e) {

    const submitModal = document.getElementById('submitModal');

    if (e.target === submitModal) {

        closeSubmitModal();
    }
});

</script>

@endsection