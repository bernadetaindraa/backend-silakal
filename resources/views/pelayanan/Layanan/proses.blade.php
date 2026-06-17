@extends('layouts.admin') 

@section('content')
<div class="p-4 md:p-6 space-y-6 max-w-7xl mx-auto">

    {{-- HEADER & AKSI ATAS --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 flex flex-col xl:flex-row justify-between xl:items-center gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ route('pelayanan.layanan.index') }}" 
                class="p-2 bg-gray-50 hover:bg-gray-100 text-gray-500 hover:text-gray-700 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-xl font-bold text-[#1D2059]">Proses Surat</h1>
            </div>
        </div>

        {{-- STATUS & AKSI (Compact) --}}
        <div class="flex flex-wrap items-center gap-2 ml-11 xl:ml-0">
            {{-- Status badge dibuat lebih ramping --}}
            <span class="px-3 py-1 rounded-lg text-[11px] font-bold uppercase tracking-widest mr-2 {{ $layanan->status_badge }}">
                {{ $layanan->status_layanan }}
            </span>

            {{-- Group Tombol (Aksi) --}}
            <div class="flex items-center gap-1.5 p-1 bg-gray-50 rounded-xl border border-gray-100">
                
                @if($layanan->status_layanan == 'diverifikasi')
                    <form action="{{ route('pelayanan.layanan.proses', $layanan->layanan_id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button title="Mulai Proses" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path></svg>
                        </button>
                    </form>
                @endif

                @if(in_array($layanan->status_layanan, ['diverifikasi', 'diproses']))
                    <button type="button" onclick="openModalSurat()" title="Upload Surat" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </button>
                @endif

                @if($layanan->status_layanan == 'siap_diambil')
                    <form action="{{ route('pelayanan.layanan.selesai', $layanan->layanan_id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button title="Tandai Selesai" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </form>
                @endif

                @if(in_array($layanan->status_layanan, ['menunggu_verifikasi', 'diverifikasi', 'diproses']))
                    <button type="button" onclick="openModalTolak()" title="Tolak Pengajuan" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                @endif
            </div>
        </div>
    </div>

    {{-- ALERT CATATAN PENOLAKAN --}}
    @if($layanan->status_layanan == 'ditolak' && $layanan->catatan_penolakan)
    <div class="bg-red-50 border border-red-200 p-5 rounded-3xl shadow-sm flex items-start gap-4">
        <div class="p-2 bg-red-100 text-red-600 rounded-xl shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <h3 class="font-bold text-red-800 mb-1">Pengajuan Ditolak</h3>
            <p class="text-sm text-red-700 leading-relaxed">
                <span class="font-semibold">Alasan/Catatan:</span> {{ $layanan->catatan_penolakan }}
            </p>
        </div>
    </div>
    @endif

    {{-- DATA UTAMA (Data Pemohon & Rincian Layanan) --}}
    <div class="grid lg:grid-cols-2 gap-6">
        {{-- INFORMASI PEMOHON --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-3 bg-gray-50/30">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h3 class="font-bold text-[#1D2059]">Data Akun Pemohon</h3>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-4">
                <div class="sm:col-span-2">
                    <p class="text-xs text-gray-400 mb-1">Nama Lengkap</p>
                    <p class="font-semibold text-gray-800">{{ $layanan->user->nama_lengkap ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-1">NIK</p>
                    <p class="font-mono text-sm font-semibold text-gray-800">{{ $layanan->user->nik ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-1">Tempat, Tanggal Lahir</p>
                    <p class="font-medium text-gray-800">
                        {{ $layanan->user->tempat_lahir ?? '-' }}, 
                        {{ $layanan->user->tanggal_lahir ? \Carbon\Carbon::parse($layanan->user->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- INFORMASI LAYANAN --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-3 bg-gray-50/30">
                <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="font-bold text-[#1D2059]">Rincian Layanan</h3>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-4">
                <div>
                    <p class="text-xs text-gray-400 mb-1">Nomor Layanan</p>
                    <p class="font-mono text-sm font-bold text-[#1D2059]">{{ $layanan->nomor_layanan }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-1">Jenis Layanan</p>
                    <p class="font-semibold text-gray-800">{{ $layanan->jenis_layanan_label ?? $layanan->jenis_layanan }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs text-gray-400 mb-1">Keperluan</p>
                    <p class="font-medium text-gray-800">{{ $layanan->keperluan_layanan ?: '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- LAMPIRAN DOKUMEN PERSYARATAN DARI WARGA --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-bold text-[#1D2059] mb-5">Lampiran Dokumen Pengajuan (Dari Warga)</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($layanan->lampiranLayanan as $lampiran)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-2xl bg-white hover:border-blue-300 hover:shadow-md transition-all group">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="p-2.5 bg-gray-50 text-gray-500 group-hover:bg-blue-50 group-hover:text-blue-600 rounded-xl transition-colors shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        </div>
                        <p class="font-semibold text-sm text-gray-700 truncate" title="{{ $lampiran->jenis_dokumen }}">
                            {{ $lampiran->jenis_dokumen }}
                        </p>
                    </div>
                    <a href="{{ asset('storage/' . $lampiran->url_file_dokumen) }}" target="_blank" class="ml-3 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg text-xs transition-colors shrink-0">Lihat</a>
                </div>
            @empty
                <div class="col-span-full py-8 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500 font-medium">Tidak ada dokumen lampiran dari warga.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- MODAL PROSES & UPLOAD SURAT --}}
<div id="modalProsesSurat" class="fixed inset-0 z-[99] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeModalSurat()"></div>
    
    <div class="bg-white rounded-3xl w-full max-w-2xl shadow-2xl relative z-10 transform scale-95 opacity-0 transition-all duration-300" id="modalContentSurat">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 rounded-t-3xl">
            <h3 class="font-bold text-lg text-[#1D2059] flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Formulir Proses Surat
            </h3>
            <button type="button" onclick="closeModalSurat()" class="text-gray-400 hover:text-red-500 transition-colors p-1 rounded-lg hover:bg-red-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('pelayanan.layanan.upload-surat', $layanan->layanan_id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf @method('POST')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Surat <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_surat" value="{{ $layanan->nomor_surat }}" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Contoh: 400/123/Desa/2026">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Surat <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_surat" value="{{ $layanan->tanggal_surat ? \Carbon\Carbon::parse($layanan->tanggal_surat)->format('Y-m-d') : date('Y-m-d') }}" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Penandatangan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_penandatangan" value="{{ $layanan->nama_penandatangan }}" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Nama Kepala Desa / Lurah">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jabatan Penandatangan <span class="text-red-500">*</span></label>
                    <input type="text" name="jabatan_penandatangan" value="{{ $layanan->jabatan_penandatangan }}" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Contoh: Kepala Desa">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Isi / Keterangan Surat</label>
                <textarea name="isi_surat" rows="3" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Catatan opsional atau intisari surat...">{{ $layanan->isi_surat }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Upload File Surat (.pdf, .doc, dsb)</label>
                <input type="file" name="file_surat" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer">
                <p class="mt-1.5 text-xs text-gray-500">Kosongkan jika hanya ingin memperbarui data tanpa mengubah file sebelumnya.</p>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                <button type="button" onclick="closeModalSurat()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition-all">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl text-sm transition-all shadow-sm shadow-indigo-600/20">Simpan & Upload</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL TOLAK PENGAJUAN --}}
<div id="modalTolak" class="fixed inset-0 z-[99] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeModalTolak()"></div>
    
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl relative z-10 transform scale-95 opacity-0 transition-all duration-300" id="modalContentTolak">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-red-50/50 rounded-t-3xl">
            <h3 class="font-bold text-lg text-red-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Tolak Pengajuan
            </h3>
            <button type="button" onclick="closeModalTolak()" class="text-gray-400 hover:text-red-500 transition-colors p-1 rounded-lg hover:bg-red-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('pelayanan.layanan.tolak', $layanan->layanan_id) }}" method="POST" class="p-6 space-y-5">
            @csrf @method('PATCH')
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alasan Penolakan <span class="text-red-500">*</span></label>
                <textarea name="catatan_penolakan" rows="4" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all" placeholder="Jelaskan alasan pengajuan ditolak (misal: dokumen KTP buram, tidak memenuhi syarat, dll)..."></textarea>
                <p class="mt-1.5 text-xs text-gray-500">Alasan ini akan dikirimkan kepada warga.</p>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                <button type="button" onclick="closeModalTolak()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl text-sm transition-all">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl text-sm transition-all shadow-sm shadow-red-600/20">Konfirmasi Penolakan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modalSurat = document.getElementById('modalProsesSurat');
    const contentSurat = document.getElementById('modalContentSurat');

    function openModalSurat() {
        modalSurat.classList.remove('hidden');
        modalSurat.classList.add('flex');
        setTimeout(() => {
            contentSurat.classList.remove('scale-95', 'opacity-0');
            contentSurat.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModalSurat() {
        contentSurat.classList.remove('scale-100', 'opacity-100');
        contentSurat.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modalSurat.classList.remove('flex');
            modalSurat.classList.add('hidden');
        }, 300);
    }

    const modalTolak = document.getElementById('modalTolak');
    const contentTolak = document.getElementById('modalContentTolak');

    function openModalTolak() {
        modalTolak.classList.remove('hidden');
        modalTolak.classList.add('flex');
        setTimeout(() => {
            contentTolak.classList.remove('scale-95', 'opacity-0');
            contentTolak.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModalTolak() {
        contentTolak.classList.remove('scale-100', 'opacity-100');
        contentTolak.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modalTolak.classList.remove('flex');
            modalTolak.classList.add('hidden');
        }, 300);
    }
</script>
@endsection