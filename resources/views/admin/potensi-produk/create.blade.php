@extends('layouts.admin')

@section('content')

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div class="p-6 space-y-6">

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="fixed top-5 right-5 z-[9999]">
        <div class="bg-emerald-500 text-white px-5 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    {{-- ERROR ALERT --}}
    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="fixed top-5 right-5 z-[9999]">
        <div class="bg-red-500 text-white px-5 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Tambah Potensi Produk
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Masukkan data potensi produk komoditas dan unggah gambar pendukungnya
            </p>
        </div>

        <a href="{{ route('admin.potensi-produk.index') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
            Kembali
        </a>
    </div>

    {{-- FORM --}}
    <form
        x-data="potensiForm()"
        x-ref="form"
        @submit.prevent="confirmModal = true"
        action="{{ route('admin.potensi-produk.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-8"
    >
        @csrf

        {{-- INFORMASI UTAMA PRODUK --}}
        <div class="space-y-5">
            <h2 class="text-lg font-bold text-[#1D2059] border-b border-gray-100 pb-2">
                Informasi Produk
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- JUDUL POTENSI PRODUK --}}
                <div>
                    <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                        Judul Potensi Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul_potensi_produk" value="{{ old('judul_potensi_produk') }}" placeholder="Contoh: Pengembangan Madu Hutan Asli" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 @error('judul_potensi_produk') border-red-500 @enderror" required>
                    @error('judul_potensi_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- NAMA PRODUK --}}
                <div>
                    <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_potensi_produk" value="{{ old('nama_potensi_produk') }}" placeholder="Contoh: Madu Lanceng Kelulut" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 @error('nama_potensi_produk') border-red-500 @enderror" required>
                    @error('nama_potensi_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- TANGGAL PRODUK --}}
                <div>
                    <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_potensi_produk" value="{{ old('tanggal_potensi_produk', now()->format('Y-m-d')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 @error('tanggal_potensi_produk') border-red-500 @enderror" required>
                    @error('tanggal_potensi_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- KATEGORI PRODUK --}}
                <div>
                    <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                        Kategori Potensi Produk <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori_potensi_produk" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 @error('kategori_potensi_produk') border-red-500 @enderror" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Potensi Daerah" {{ old('kategori_potensi_produk') == 'Potensi Daerah' ? 'selected' : '' }}>Potensi Daerah</option>
                        <option value="Produk Usaha Daerah" {{ old('kategori_potensi_produk') == 'Produk Usaha Daerah' ? 'selected' : '' }}>Produk Usaha Daerah</option>
                    </select>
                    @error('kategori_potensi_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- ARTIKEL POTENSI PRODUK --}}
            <div>
                <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                    Artikel / Deskripsi Produk <span class="text-red-500">*</span>
                </label>
                <textarea id="editor" name="artikel_potensi_produk" rows="10" class="w-full border border-gray-200 rounded-xl @error('artikel_potensi_produk') border-red-500 @enderror">{{ old('artikel_potensi_produk') }}</textarea>
                @error('artikel_potensi_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- UPLOAD MULTIPLE GAMBAR PRODUK --}}
        <div class="space-y-4">
            <div>
                <h2 class="text-lg font-bold text-[#1D2059]">Gambar Potensi Produk</h2>
                <p class="text-sm text-gray-500">Pilih satu atau beberapa gambar visual produk pendukung</p>
            </div>

            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 bg-gray-50 text-center relative hover:bg-gray-100/50 transition">
                <input type="file" name="foto[]" multiple accept="image/*" @change="previewImages($event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div class="space-y-2 pointer-events-none">
                    <svg class="w-10 h-10 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-sm font-medium text-gray-600">Klik atau seret file gambar ke sini untuk mengunggah</p>
                    <p class="text-xs text-gray-400">PNG, JPG, JPEG (Maks. 2MB per gambar)</p>
                </div>
            </div>

            {{-- LIVE PREVIEW GAMBAR (ALPINE JS) --}}
            <template x-if="imagePreviews.length > 0">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pt-2">
                    <template x-for="(src, index) in imagePreviews" :key="index">
                        <div class="relative group aspect-square rounded-xl overflow-hidden border border-gray-100 shadow-sm bg-white">
                            <img :src="src" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <button type="button" @click="removePreview(index)" class="p-2 bg-red-600 text-white rounded-lg text-xs font-semibold shadow hover:bg-red-700 transition">Hapus</button>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
            @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- BUTTON ACTIONS --}}
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.potensi-produk.index') }}" class="px-5 py-3 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">Batal</a>
            <button type="submit" class="px-5 py-3 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:bg-[#151740] transition">Simpan Potensi Produk</button>
        </div>

        {{-- MODAL KONFIRMASI --}}
        <div x-show="confirmModal" x-transition.opacity x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center px-4">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="confirmModal = false"></div>
            <div x-show="confirmModal" x-transition.scale class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl p-6">
                <div class="flex items-center justify-center w-16 h-16 mx-auto rounded-full bg-blue-100 mb-4">
                    <svg class="w-8 h-8 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-center text-[#1D2059] mb-2">Konfirmasi Simpan</h2>
                <p class="text-sm text-gray-500 text-center mb-6">Pastikan seluruh data potensi produk beserta gambar sudah sesuai sebelum disimpan.</p>
                <div class="flex justify-center gap-3">
                    <button type="button" @click="confirmModal = false" class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition">Batal</button>
                    <button type="button" @click="$refs.form.submit()" class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white hover:bg-[#151740] transition">Ya, Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- SCRIPT ALPINE & CKEDITOR --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Inisialisasi CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    // Handler AlpineJS untuk Upload Gambar
    function potensiForm() {
        return {
            confirmModal: false,
            imagePreviews: [],
            
            previewImages(event) {
                const files = event.target.files;
                this.imagePreviews = []; 
                if (files) {
                    Array.from(files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreviews.push(e.target.result);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },
            removePreview(index) {
                // Catatan: Ini hanya menghapus preview, untuk menghapus file dari input membutuhkan manipulasi DataTransfer
                this.imagePreviews.splice(index, 1);
            }
        }
    }
</script>

@endsection