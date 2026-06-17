@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Edit Berita
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui data berita website Kalurahan Hargobinangun
            </p>
        </div>

        <a href="{{ url('admin/berita') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
            Kembali
        </a>
    </div>

    {{-- FORM --}}
    <form action="{{ route('admin.berita.update', $berita->berita_id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-6">

        @csrf
        @method('PUT')

        {{-- JUDUL --}}
        <div>
            <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                Judul Berita
            </label>

            <input type="text"
                   name="judul_berita"
                   value="{{ old('judul_berita', $berita->judul_berita) }}"
                   placeholder="Masukkan judul berita..."
                   class="w-full border rounded-xl px-4 py-3 text-sm outline-none transition
                   @error('judul_berita')
                        border-red-300 focus:ring-red-200 focus:border-red-400
                   @else
                        border-gray-200 focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059]
                   @enderror">

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
                    Kategori
                </label>

                <select
                    name="kategori_berita_id[]"
                    multiple
                    class="w-full border rounded-xl px-4 py-3 text-sm outline-none min-h-[180px]
                    @error('kategori_berita_id')
                        border-red-300 focus:ring-red-200 focus:border-red-400
                    @else
                        border-gray-200 focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059]
                    @enderror"
                >

                    @foreach($kategori as $item)

                        <option
                            value="{{ $item->kategori_berita_id }}"

                            @if(
                                in_array(
                                    $item->kategori_berita_id,
                                    old(
                                        'kategori_berita_id',
                                        $berita->kategori->pluck('kategori_berita_id')->toArray()
                                    )
                                )
                            )
                                selected
                            @endif
                        >
                            {{ $item->nama_kategori }}
                        </option>

                    @endforeach

                </select>

                <p class="text-xs text-gray-400 mt-2">
                    CTRL / CMD untuk memilih lebih dari satu kategori
                </p>

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

                <select
                    name="status_berita"
                    class="w-full border rounded-xl px-4 py-3 text-sm outline-none
                    @error('status_berita')
                        border-red-300 focus:ring-red-200 focus:border-red-400
                    @else
                        border-gray-200 focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059]
                    @enderror"
                >

                    <option value="">
                        Pilih Status
                    </option>

                    <option value="Published"
                        {{ old('status_berita', $berita->status_berita) == 'Published' ? 'selected' : '' }}>
                        Published
                    </option>

                    <option value="Draft"
                        {{ old('status_berita', $berita->status_berita) == 'Draft' ? 'selected' : '' }}>
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
                   value="{{ old('tanggal_berita', \Carbon\Carbon::parse($berita->tanggal_berita)->format('Y-m-d')) }}"
                   class="w-full border rounded-xl px-4 py-3 text-sm outline-none transition
                   @error('tanggal_berita')
                        border-red-300 focus:ring-red-200 focus:border-red-400
                   @else
                        border-gray-200 focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059]
                   @enderror">

            @error('tanggal_berita')
                <p class="text-red-500 text-xs mt-2">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- FOTO LAMA --}}
        @if($berita->foto->count() > 0)

        <div>
            <label class="block text-sm font-semibold text-[#1D2059] mb-3">
                Foto Saat Ini
            </label>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @foreach($berita->foto as $foto)

                    <div class="relative group">

                        <img
                            src="{{ asset('storage/' . $foto->url_file_berita) }}"
                            class="w-full h-32 object-cover rounded-xl border border-gray-200"
                        >

                    </div>

                @endforeach

            </div>
        </div>

        @endif

        {{-- FOTO BARU --}}
        <div x-data="{ preview: [] }">

            <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                Upload Foto Baru
            </label>

            <input
                type="file"
                x-ref="fileInput"
                name="foto_berita[]"
                multiple
                accept="image/*"

                @change="
                    preview = []

                    Array.from($event.target.files).forEach(file => {
                        preview.push(URL.createObjectURL(file))
                    })
                "

                class="w-full border rounded-xl px-4 py-3 text-sm bg-white
                        file:mr-4
                        file:px-4
                        file:py-2
                        file:rounded-lg
                        file:border-0
                        file:bg-[#1D2059]
                        file:text-white
                        hover:file:opacity-90

                        @error('foto_berita')
                            border-red-300
                        @else
                            border-gray-200
                        @enderror"
            >

            <p class="text-xs text-gray-400 mt-2">
                Kosongkan jika tidak ingin mengganti foto
            </p>

            @error('foto_berita')
                <p class="text-red-500 text-xs mt-2">
                    {{ $message }}
                </p>
            @enderror

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

                        {{-- NOMOR URUT --}}
                        <div class="absolute top-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded-lg">
                            <span x-text="index + 1"></span>
                        </div>

                        {{-- DELETE --}}
                        <button
                            type="button"

                            @click="
                                preview.splice(index, 1)

                                let files = Array.from($refs.fileInput.files)

                                files.splice(index, 1)

                                let dataTransfer = new DataTransfer()

                                files.forEach(file => dataTransfer.items.add(file))

                                $refs.fileInput.files = dataTransfer.files
                            "

                            class="absolute top-2 right-2 w-7 h-7 rounded-full bg-red-500 text-white text-xs flex items-center justify-center shadow-md hover:bg-red-600 transition"
                        >
                            ✕
                        </button>

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
                class="w-full border rounded-xl
                @error('isi_berita')
                    border-red-300
                @else
                    border-gray-200
                @enderror"
            >{{ old('isi_berita', $berita->isi_berita) }}</textarea>

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
                Update Berita
            </button>

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
                '|',
                'undo',
                'redo'
            ]

        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection