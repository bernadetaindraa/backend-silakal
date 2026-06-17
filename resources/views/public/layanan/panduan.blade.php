@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'Panduan Layanan Kalurahan Hargobinangun',
        'subtitle' => 'ꦏꦼꦧꦸꦢꦪꦪꦤ꧀ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
    
        {{-- BREADCRUMB COMPONENT --}}
        <nav class="flex mb-4 text-xs md:text-sm text-gray-500 font-medium" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-blue-600 transition flex items-center gap-1">
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-gray-400">Layanan</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-gray-600 font-semibold">Panduan Layanan</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-[#1D2059]">Panduan Layanan</h1>
            <p class="text-sm text-gray-500 mt-1">Pilih jenis layanan untuk melihat berkas dan persyaratan yang diperlukan.</p>
        </div>

        {{-- Grid Card Layanan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl mb-4">👶</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Persyaratan Akta Kelahiran</h3>
                    <p class="text-xs text-gray-400">Pengurusan dokumen pencatatan kelahiran baru.</p>
                </div>
                <button onclick="openModal('akta-kelahiran')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-blue-50 hover:text-blue-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-xl mb-4">👨‍👩‍👧‍👦</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Syarat Pengajuan Kartu Keluarga</h3>
                    <p class="text-xs text-gray-400">Pembaruan data, pencoretan, atau pembuatan KK baru.</p>
                </div>
                <button onclick="openModal('kartu-keluarga')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-green-50 hover:text-green-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl mb-4">🪪</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Syarat Pengajuan E-KTP</h3>
                    <p class="text-xs text-gray-400">Perekaman baru maupun pengajuan KTP hilang/rusak.</p>
                </div>
                <button onclick="openModal('e-ktp')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-purple-50 hover:text-purple-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl mb-4">🔄</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Pindah Antar Kapanewon/Kalurahan</h3>
                    <p class="text-xs text-gray-400">Mutasi penduduk antar lingkup lokal / padukuhan.</p>
                </div>
                <button onclick="openModal('pindah-lokal')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-orange-50 hover:text-orange-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl mb-4">🚛</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Pindah Antar Kabupaten/Provinsi</h3>
                    <p class="text-xs text-gray-400">Mutasi keluar atau masuk dari luar daerah regional.</p>
                </div>
                <button onclick="openModal('pindah-luar')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-red-50 hover:text-red-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl mb-4">📄</div>
                    <h3 class="font-bold text-lg text-[#1D2059] mb-2">Surat Keterangan Kalurahan</h3>
                    <p class="text-xs text-gray-400">Syarat pembuatan pengantar SKCK, SKTM, serta SKU.</p>
                </div>
                <button onclick="openModal('surat-keterangan')" class="mt-6 w-full py-2.5 bg-gray-50 hover:bg-teal-50 hover:text-teal-600 text-gray-700 rounded-xl font-semibold text-sm transition">
                    Lihat Panduan
                </button>
            </div>

        </div>

        {{-- Struktur Modal Global --}}
        <div id="guidanceModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[85vh] overflow-y-auto shadow-xl transform scale-95 opacity-0 transition-all duration-300" id="modalContainer">
                
                {{-- Header Modal --}}
                <div class="p-6 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white z-10">
                    <div>
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold bg-blue-50 text-blue-700 rounded-full mb-1">Layanan Kalurahan</span>
                        <h2 id="modalTitle" class="text-xl font-bold text-[#1D2059]">Judul Panduan</h2>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 font-bold text-xl">&times;</button>
                </div>

                {{-- Isi Persyaratan --}}
                <div class="p-6 text-sm text-gray-700 leading-relaxed" id="modalContent">
                </div>

                {{-- Footer Modal --}}
                <div class="p-6 border-t border-gray-100 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                    <button onclick="closeModal()" class="px-5 py-2 rounded-full text-sm font-medium text-gray-600 hover:bg-gray-200 transition">
                        Tutup
                    </button>
                    <a href="{{ route('user.layanan.pengajuan') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-full transition shadow-md shadow-blue-500/20">
                        Ajukan Layanan Ini
                    </a>
                </div>

            </div>
        </div>
    </div>
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