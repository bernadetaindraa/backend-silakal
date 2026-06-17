@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-[9999]"
    >

        <div class="bg-green-500 text-white px-5 py-4 rounded-2xl shadow-xl flex items-center gap-3">

            <svg class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"/>
            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>
    </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-[9999]"
    >

        <div class="bg-red-500 text-white px-5 py-4 rounded-2xl shadow-xl flex items-center gap-3">

            <svg class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>

            <span class="text-sm font-medium">
                {{ session('error') }}
            </span>

        </div>
    </div>
    @endif

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Tambah Berita
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan berita baru untuk website Kalurahan Hargobinangun
            </p>
        </div>

        <a href="{{ url('admin/berita') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
            Kembali
        </a>
    </div>

    {{-- FORM --}}
    <form
        x-data="{ confirmModal: false }"
        x-ref="form"
        @submit.prevent="confirmModal = true"

        action="{{ url('admin/berita/store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-6"
    >
        @csrf

        {{-- JUDUL --}}
        <div>

            <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                Judul Berita
            </label>

            <input type="text"
                   name="judul_berita"
                   value="{{ old('judul_berita') }}"
                   placeholder="Masukkan judul berita..."
                   class="w-full border @error('judul_berita') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">

            @error('judul_berita')
                <p class="text-red-500 text-xs mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- KATEGORI + STATUS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- KATEGORI --}}
            <div>

                <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                    Kategori Berita
                </label>

                {{-- SEARCHABLE DROPDOWN --}}
                <div x-data="{
                        open: false,
                        search: '',
                        selected: @js(old('kategori_berita_id', []))
                    }"
                    class="relative">

                    <div @click="open = !open"
                         class="w-full border @error('kategori_berita_id') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3 bg-white cursor-pointer flex items-center justify-between">

                        <div class="flex flex-wrap gap-2">

                            <template x-if="selected.length === 0">
                                <span class="text-sm text-gray-400">
                                    Pilih kategori berita
                                </span>
                            </template>

                            @foreach($kategori as $item)

                                <template x-if="selected.includes('{{ $item->kategori_berita_id }}')">

                                    <span class="px-2 py-1 bg-[#1D2059]/10 text-[#1D2059] rounded-lg text-xs">
                                        {{ $item->nama_kategori }}
                                    </span>

                                </template>

                            @endforeach

                        </div>

                        <svg class="w-4 h-4 text-gray-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>

                        </svg>

                    </div>

                    {{-- DROPDOWN --}}
                    <div x-show="open"
                         x-transition
                         @click.away="open = false"
                         class="absolute z-50 mt-2 w-full bg-white border border-gray-200 rounded-2xl shadow-lg p-3">

                        {{-- SEARCH --}}
                        <input type="text"
                               x-model="search"
                               placeholder="Cari kategori..."
                               class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20 mb-3">

                        {{-- LIST --}}
                        <div class="max-h-60 overflow-y-auto space-y-2">

                            @foreach($kategori as $item)

                            <label x-show="'{{ strtolower($item->nama_kategori) }}'.includes(search.toLowerCase())"
                                   class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50 cursor-pointer">

                                <input type="checkbox"
                                       name="kategori_berita_id[]"
                                       value="{{ $item->kategori_berita_id }}"
                                       x-model="selected"
                                       class="rounded border-gray-300 text-[#1D2059] focus:ring-[#1D2059]">

                                <span class="text-sm text-gray-700">
                                    {{ $item->nama_kategori }}
                                </span>

                            </label>

                            @endforeach

                        </div>

                    </div>

                </div>

                @error('kategori_berita_id')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- STATUS --}}
            <div>

                <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                    Status Berita
                </label>

                <select name="status_berita"
                        class="w-full border @error('status_berita') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">

                    <option value="">
                        Pilih Status
                    </option>

                    <option value="Published"
                        {{ old('status_berita') == 'Published' ? 'selected' : '' }}>
                        Published
                    </option>

                    <option value="Draft"
                        {{ old('status_berita') == 'Draft' ? 'selected' : '' }}>
                        Draft
                    </option>

                </select>

                @error('status_berita')
                    <p class="text-red-500 text-xs mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

        {{-- TANGGAL --}}
        <div>

            <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                Tanggal Berita
            </label>

            <input type="date"
                   name="tanggal_berita"
                   value="{{ old('tanggal_berita', now()->format('Y-m-d')) }}"
                   class="w-full border @error('tanggal_berita') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">

            @error('tanggal_berita')
                <p class="text-red-500 text-xs mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- FOTO --}}
        <div
            x-data="{
                files: [],
                preview: [],

                updateFiles(e) {

                    this.files = Array.from(e.target.files)

                    this.renderPreview()
                },

                renderPreview() {

                    this.preview = []

                    this.files.forEach(file => {
                        this.preview.push(URL.createObjectURL(file))
                    })

                    let dataTransfer = new DataTransfer()

                    this.files.forEach(file => {
                        dataTransfer.items.add(file)
                    })

                    this.$refs.fileInput.files = dataTransfer.files
                },

                removeImage(index) {

                    this.files.splice(index, 1)

                    this.renderPreview()
                },

                moveLeft(index) {

                    if(index === 0) return

                    ;[this.files[index - 1], this.files[index]] =
                    [this.files[index], this.files[index - 1]]

                    this.renderPreview()
                },

                moveRight(index) {

                    if(index === this.files.length - 1) return

                    ;[this.files[index + 1], this.files[index]] =
                    [this.files[index], this.files[index + 1]]

                    this.renderPreview()
                }
            }"
        >

            <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                Foto Berita
            </label>

            <input
                type="file"
                x-ref="fileInput"
                name="foto_berita[]"
                multiple
                accept="image/*"

                @change="updateFiles($event)"

                class="w-full border
                    @error('foto_berita.*')
                        border-red-400
                    @else
                        border-gray-200
                    @enderror

                    rounded-xl px-4 py-3 text-sm bg-white
                    file:mr-4
                    file:px-4
                    file:py-2
                    file:rounded-lg
                    file:border-0
                    file:bg-[#1D2059]
                    file:text-white
                    hover:file:opacity-90"
            >

            @error('foto_berita.*')
                <p class="text-red-500 text-xs mt-2">
                    {{ $message }}
                </p>
            @enderror

            {{-- PREVIEW --}}
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"
                x-show="preview.length"
            >

                <template x-for="(image, index) in preview" :key="index">

                    <div class="relative group">

                        {{-- IMAGE --}}
                        <img
                            :src="image"
                            class="w-full h-32 object-cover rounded-xl border border-gray-200"
                        >

                        {{-- NOMOR --}}
                        <div class="absolute top-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded-lg">
                            <span x-text="index + 1"></span>
                        </div>

                        {{-- ACTION --}}
                        <div class="absolute top-2 right-2 flex gap-1">

                            {{-- LEFT --}}
                            <button
                                type="button"
                                @click="moveLeft(index)"
                                class="w-7 h-7 rounded-full bg-white text-gray-700 shadow flex items-center justify-center hover:bg-gray-100"
                            >
                                ←
                            </button>

                            {{-- RIGHT --}}
                            <button
                                type="button"
                                @click="moveRight(index)"
                                class="w-7 h-7 rounded-full bg-white text-gray-700 shadow flex items-center justify-center hover:bg-gray-100"
                            >
                                →
                            </button>

                            {{-- DELETE --}}
                            <button
                                type="button"
                                @click="removeImage(index)"
                                class="w-7 h-7 rounded-full bg-red-500 text-white shadow flex items-center justify-center hover:bg-red-600"
                            >
                                ✕
                            </button>

                        </div>

                    </div>

                </template>

            </div>

        </div>

        {{-- ISI BERITA --}}
        <div>

            <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                Isi Berita
            </label>

            <textarea
                id="editor"
                name="isi_berita"
                rows="10"
                class="w-full border @error('isi_berita') border-red-400 @else border-gray-200 @enderror rounded-xl">
                {{ old('isi_berita') }}
            </textarea>

            @error('isi_berita')
                <p class="text-red-500 text-xs mt-2">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 pt-2">

            <a href="{{ url('admin/berita') }}"
               class="px-5 py-3 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
                Batal
            </a>

            <button type="submit"
                    class="px-5 py-3 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">
                Simpan Berita
            </button>

        </div>

        {{-- MODAL KONFIRMASI --}}
        <div
            x-show="confirmModal"
            x-transition.opacity
            x-cloak
            class="fixed inset-0 z-[9999] flex items-center justify-center px-4"
            style="display: none;"
        >

            {{-- BACKDROP --}}
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                @click="confirmModal = false"
            ></div>

            {{-- MODAL --}}
            <div
                x-show="confirmModal"
                x-transition.scale
                class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl p-6"
            >

                {{-- ICON --}}
                <div class="flex items-center justify-center w-16 h-16 mx-auto rounded-full bg-blue-100 mb-4">

                    <svg
                        class="w-8 h-8 text-[#1D2059]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

                {{-- TITLE --}}
                <h2 class="text-2xl font-bold text-center text-[#1D2059] mb-2">
                    Konfirmasi Simpan
                </h2>

                {{-- DESC --}}
                <p class="text-sm text-gray-500 text-center mb-6 leading-relaxed">
                    Pastikan data berita sudah benar sebelum disimpan.
                </p>

                {{-- BUTTON --}}
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
                        class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white hover:opacity-90 transition"
                    >
                        Ya, Simpan
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
        .create(document.querySelector('#editor'), {

            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'link',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                '|',
                'undo',
                'redo'
            ]

        })
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    [x-cloak] {
        display: none !important;
    }

    .ck-editor {
        z-index: 1 !important;
    }
</style>
@endsection