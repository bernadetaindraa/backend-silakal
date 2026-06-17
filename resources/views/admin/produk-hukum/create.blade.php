@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6 max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Tambah Dokumen Baru
            </h1>
        </div>

        <a href="{{ route('admin.produk-hukum.index') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
            Kembali
        </a>
    </div>

    {{-- FORM CONTAINER --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden p-6">
        
        {{-- PASTIKAN SUDAH MENAMBAHKAN enctype="multipart/form-data" --}}
        <form action="{{ route('admin.produk-hukum.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- NAMA DOKUMEN --}}
                <div class="md:col-span-2">
                    <label for="nama_dokumen" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="nama_dokumen" 
                           id="nama_dokumen"
                           value="{{ old('nama_dokumen') }}"
                           placeholder="Masukkan nama atau judul dokumen resmi..."
                           class="w-full border @error('nama_dokumen') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:ring-[#1D2059]/20 focus:border-[#1D2059] @enderror rounded-xl px-4 py-3 text-sm outline-none transition focus:ring-2">
                    @error('nama_dokumen')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- KATEGORI DOKUMEN --}}
                <div class="md:col-span-2">
                    <label for="kategori_dokumen" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori Dokumen <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori_dokumen" 
                            id="kategori_dokumen"
                            class="w-full border @error('kategori_dokumen') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:ring-[#1D2059]/20 focus:border-[#1D2059] @enderror rounded-xl px-4 py-3 text-sm outline-none transition focus:ring-2 bg-white">
                        <option value="">-- Pilih Kategori Dokumen --</option>
                        <option value="Perencanaan Penganggaran" {{ old('kategori_dokumen') == 'Perencanaan Penganggaran' ? 'selected' : '' }}>Perencanaan Penganggaran</option>
                        <option value="Peraturan Kalurahan" {{ old('kategori_dokumen') == 'Peraturan Kalurahan' ? 'selected' : '' }}>Peraturan Kalurahan</option>
                        <option value="Laporan" {{ old('kategori_dokumen') == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                        <option value="Peraturan Lurah" {{ old('kategori_dokumen') == 'Peraturan Lurah' ? 'selected' : '' }}>Peraturan Lurah</option>
                    </select>
                    @error('kategori_dokumen')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NOMOR DOKUMEN --}}
                <div>
                    <label for="nomor_dokumen" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="nomor_dokumen" 
                           id="nomor_dokumen"
                           value="{{ old('nomor_dokumen') }}"
                           placeholder="Contoh: 12/PERKAL/2026"
                           class="w-full border @error('nomor_dokumen') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:ring-[#1D2059]/20 focus:border-[#1D2059] @enderror rounded-xl px-4 py-3 text-sm outline-none transition focus:ring-2">
                    @error('nomor_dokumen')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TANGGAL DITETAPKAN --}}
                <div>
                    <label for="tanggal_ditetapkan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Ditetapkan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="tanggal_ditetapkan" 
                           id="tanggal_ditetapkan"
                           value="{{ old('tanggal_ditetapkan') }}"
                           class="w-full border @error('tanggal_ditetapkan') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:ring-[#1D2059]/20 focus:border-[#1D2059] @enderror rounded-xl px-4 py-3 text-sm outline-none transition focus:ring-2">
                    @error('tanggal_ditetapkan')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TIPE DOKUMEN --}}
                <div class="md:col-span-2">
                    <label for="tipe_dokumen" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tipe Dokumen <span class="text-red-500">*</span>
                    </label>
                    <select name="tipe_dokumen" 
                            id="tipe_dokumen"
                            class="w-full border @error('tipe_dokumen') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:ring-[#1D2059]/20 focus:border-[#1D2059] @enderror rounded-xl px-4 py-3 text-sm outline-none transition focus:ring-2 bg-white">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="PDF" {{ old('tipe_dokumen') == 'PDF' ? 'selected' : '' }}>PDF</option>
                        <option value="Docx" {{ old('tipe_dokumen') == 'Docx' ? 'selected' : '' }}>Word (Docx)</option>
                        <option value="Excel" {{ old('tipe_dokumen') == 'Excel' ? 'selected' : '' }}>Excel</option>
                        <option value="JPG" {{ old('tipe_dokumen') == 'JPG' ? 'selected' : '' }}>JPG</option>
                        <option value="PNG" {{ old('tipe_dokumen') == 'PNG' ? 'selected' : '' }}>PNG</option>
                        <option value="JPEG" {{ old('tipe_dokumen') == 'JPEG' ? 'selected' : '' }}>JPEG</option>
                        <option value="Link" {{ old('tipe_dokumen') == 'Link' ? 'selected' : '' }}>Tautan / Link Eksternal</option>
                    </select>
                    @error('tipe_dokumen')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- DYNAMIC INPUT 1: URL DOKUMEN (Hanya muncul jika tipe 'Link') --}}
                <div id="container_url" class="md:col-span-2 hidden">
                    <label for="url_dokumen" class="block text-sm font-semibold text-gray-700 mb-2">
                        URL Berkas / Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="url" 
                           name="url_dokumen" 
                           id="url_dokumen"
                           value="{{ old('url_dokumen') }}"
                           placeholder="https://drive.google.com/... atau tautan file"
                           class="w-full border @error('url_dokumen') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:ring-[#1D2059]/20 focus:border-[#1D2059] @enderror rounded-xl px-4 py-3 text-sm outline-none transition focus:ring-2">
                    @error('url_dokumen')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- DYNAMIC INPUT 2: UPLOAD FILE (Muncul jika tipe PDF, Docx, Excel) --}}
                <div id="container_file" class="md:col-span-2 hidden">
                    <label for="file_dokumen" class="block text-sm font-semibold text-gray-700 mb-2">
                        Unggah File Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="file" 
                           name="file_dokumen" 
                           id="file_dokumen"
                           class="w-full border @error('file_dokumen') border-red-500 focus:ring-red-500/20 @else border-gray-200 focus:ring-[#1D2059]/20 focus:border-[#1D2059] @enderror rounded-xl px-4 py-3 text-sm outline-none transition focus:ring-2 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#1D2059]/10 file:text-[#1D2059] hover:file:bg-[#1D2059]/20">
                    <p class="text-xs text-gray-400 mt-1">Format file harus sesuai dengan tipe dokumen yang dipilih (Maks. 10MB)</p>
                    @error('file_dokumen')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- SUBMIT BUTTONS --}}
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.produk-hukum.index') }}" 
                   class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition shadow-sm shadow-[#1D2059]/20">
                    Simpan Dokumen
                </button>
            </div>

        </form>

    </div>
</div>

{{-- JAVASCRIPT LOGIC TOGGLE --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipeDokumen = document.getElementById('tipe_dokumen');
        const containerUrl = document.getElementById('container_url');
        const containerFile = document.getElementById('container_file');

        function handleTipeDokumenChange() {
            const val = tipeDokumen.value;
            
            if (val === 'Link') {
                containerUrl.classList.remove('hidden');
                containerFile.classList.add('hidden');
            } else if (val === 'PDF' || val === 'Docx' || val === 'Excel' || val === 'JPG' || val === 'PNG' || val === 'JPEG') {
                containerUrl.classList.add('hidden');
                containerFile.classList.remove('hidden');
            } else {
                // Jika belum memilih tipe dokumen
                containerUrl.classList.add('hidden');
                containerFile.classList.add('hidden');
            }
        }

        tipeDokumen.addEventListener('change', handleTipeDokumenChange);
        
        // Jalankan saat pertama kali reload (untuk mengamankan kondisi error/old value)
        handleTipeDokumenChange();
    });
</script>
@endsection