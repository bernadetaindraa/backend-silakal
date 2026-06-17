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
                Edit Data Kebudayaan
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui informasi kebudayaan dan gambar pendukung
            </p>
        </div>

        <a href="{{ route('admin.kebudayaan.index') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
            Kembali
        </a>

    </div>

    {{-- FORM --}}
    <form
        x-data="kebudayaanForm()"
        x-ref="form"
        @submit.prevent="confirmModal = true"
        action="{{ route('admin.kebudayaan.update', $kebudayaan->kebudayaan_id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-8"
    >

        @csrf
        @method('PUT')

        {{-- INFORMASI KEBUDAYAAN --}}
        <div class="space-y-5">

            <h2 class="text-lg font-bold text-[#1D2059] border-b border-gray-100 pb-2">
                Informasi Kebudayaan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- JUDUL --}}
                <div>
                    <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                        Judul Kebudayaan
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="judul_kebudayaan"
                        value="{{ old('judul_kebudayaan', $kebudayaan->judul_kebudayaan) }}"
                        placeholder="Contoh: Tari Jathilan"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 @error('judul_kebudayaan') border-red-500 @enderror"
                        required
                    >

                    @error('judul_kebudayaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- JENIS --}}
                <div>
                    <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                        Jenis Kebudayaan
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="jenis_kebudayaan_id"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 @error('jenis_kebudayaan_id') border-red-500 @enderror"
                        required
                    >

                        <option value="">
                            Pilih Jenis Kebudayaan
                        </option>

                        @foreach($jenisKebudayaan as $jenis)

                            <option
                                value="{{ $jenis->jenis_kebudayaan_id }}"
                                {{ old('jenis_kebudayaan_id', $kebudayaan->jenis_kebudayaan_id) == $jenis->jenis_kebudayaan_id ? 'selected' : '' }}
                            >

                                {{ $jenis->nama_jenis }}

                                @if($jenis->kategoriKebudayaan)
                                    ({{ $jenis->kategoriKebudayaan->nama_kategori }})
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('jenis_kebudayaan_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- TAHUN --}}
                <div>
                    <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                        Tahun Ditetapkan
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        name="tahun_ditetapkan"
                        min="1900"
                        max="{{ date('Y') }}"
                        value="{{ old('tahun_ditetapkan', $kebudayaan->tahun_ditetapkan) }}"
                        placeholder="Contoh: 2015"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 @error('tahun_ditetapkan') border-red-500 @enderror"
                        required
                    >

                    @error('tahun_ditetapkan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- LOKASI --}}
                <div>
                    <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                        Lokasi Kebudayaan
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="lokasi_kebudayaan"
                        value="{{ old('lokasi_kebudayaan', $kebudayaan->lokasi_kebudayaan) }}"
                        placeholder="Contoh: Hargobinangun, Pakem"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 @error('lokasi_kebudayaan') border-red-500 @enderror"
                        required
                    >

                    @error('lokasi_kebudayaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- DESKRIPSI --}}
            <div>

                <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                    Deskripsi Kebudayaan
                    <span class="text-red-500">*</span>
                </label>

                <textarea
                    id="editor"
                    name="deskripsi_kebudayaan"
                    rows="10"
                    class="w-full border border-gray-200 rounded-xl @error('deskripsi_kebudayaan') border-red-500 @enderror"
                >{{ old('deskripsi_kebudayaan', $kebudayaan->deskripsi_kebudayaan) }}</textarea>

                @error('deskripsi_kebudayaan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

            </div>

        </div>

        {{-- FOTO LAMA --}}
        @if($kebudayaan->fotoKebudayaan->count())

        <div class="space-y-4">

            <div>
                <h2 class="text-lg font-bold text-[#1D2059]">
                    Foto Saat Ini
                </h2>

                <p class="text-sm text-gray-500">
                    Klik tombol hapus untuk menghilangkan foto tertentu
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

                @foreach($kebudayaan->fotoKebudayaan as $foto)

                    <div
                        x-data="{ removed: false }"
                        x-show="!removed"
                        class="relative group aspect-square rounded-2xl overflow-hidden border border-gray-100 shadow-sm bg-white"
                    >

                        {{-- INPUT HIDDEN --}}
                        <input
                            type="hidden"
                            name="existing_fotos[]"
                            value="{{ $foto->foto_kebudayaan_id }}"
                            x-bind:disabled="removed"
                        >

                        {{-- IMAGE --}}
                        <img
                            src="{{ asset('storage/' . $foto->url_foto_kebudayaan) }}"
                            class="w-full h-full object-cover"
                        >

                        {{-- OVERLAY --}}
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">

                            <button
                                type="button"
                                @click="removed = true"
                                class="px-3 py-2 bg-red-600 text-white rounded-xl text-xs font-semibold hover:bg-red-700 transition"
                            >
                                Hapus
                            </button>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

        @endif

        {{-- UPLOAD FOTO BARU --}}
        <div class="space-y-4">

            <div>
                <h2 class="text-lg font-bold text-[#1D2059]">
                    Upload Foto Baru
                </h2>

                <p class="text-sm text-gray-500">
                    Upload satu atau beberapa foto baru untuk mengganti foto lama
                </p>
            </div>

            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 bg-gray-50 text-center relative hover:bg-gray-100/50 transition">

                <input
                    type="file"
                    name="foto_kebudayaan[]"
                    multiple
                    accept="image/jpeg,image/png,image/jpg"
                    @change="previewImages($event)"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                >

                <div class="space-y-2 pointer-events-none">

                    <svg class="w-10 h-10 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    <p class="text-sm font-medium text-gray-600">
                        Klik atau seret gambar ke sini untuk upload
                    </p>

                    <p class="text-xs text-gray-400">
                        PNG, JPG, JPEG (Maks. 2MB per gambar)
                    </p>

                </div>

            </div>

            {{-- PREVIEW --}}
            <template x-if="imagePreviews.length > 0">

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pt-2">

                    <template x-for="(src, index) in imagePreviews" :key="index">

                        <div class="relative group aspect-square rounded-xl overflow-hidden border border-gray-100 shadow-sm bg-white">

                            <img :src="src" class="w-full h-full object-cover">

                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">

                                <button
                                    type="button"
                                    @click="removePreview(index)"
                                    class="p-2 bg-red-600 text-white rounded-lg text-xs font-semibold shadow hover:bg-red-700 transition"
                                >
                                    Hapus
                                </button>

                            </div>

                        </div>

                    </template>

                </div>

            </template>

            @error('foto_kebudayaan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            @error('foto_kebudayaan.*')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">

            <a
                href="{{ route('admin.kebudayaan.index') }}"
                class="px-5 py-3 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-5 py-3 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:bg-[#151740] transition"
            >
                Perbarui Kebudayaan
            </button>

        </div>

        {{-- MODAL --}}
        <div x-show="confirmModal" x-transition.opacity x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center px-4">

            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                 @click="confirmModal = false"></div>

            <div x-show="confirmModal"
                 x-transition.scale
                 class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl p-6">

                <div class="flex items-center justify-center w-16 h-16 mx-auto rounded-full bg-blue-100 mb-4">

                    <svg class="w-8 h-8 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7" />

                    </svg>

                </div>

                <h2 class="text-2xl font-bold text-center text-[#1D2059] mb-2">
                    Konfirmasi Perubahan
                </h2>

                <p class="text-sm text-gray-500 text-center mb-6">
                    Pastikan data kebudayaan yang diperbarui sudah sesuai sebelum disimpan.
                </p>

                <div class="flex justify-center gap-3">

                    <button
                        type="button"
                        @click="confirmModal = false"
                        class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition"
                    >
                        Batal
                    </button>

                    <button
                        type="button"
                        @click="$refs.form.submit()"
                        class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white hover:bg-[#151740] transition"
                    >
                        Ya, Perbarui
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

{{-- CKEDITOR --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>

    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    function kebudayaanForm() {

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
                this.imagePreviews.splice(index, 1);
            }

        }

    }

</script>

@endsection