@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">Edit Potensi Produk</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui data potensi produk</p>
        </div>

        <a href="{{ route('admin.potensi-produk.index') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm">
            Kembali
        </a>
    </div>

    {{-- FORM --}}
    <form action="{{ route('admin.potensi-produk.update', $potensi->potensi_produk_id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6">

        @csrf
        @method('PUT')

        {{-- JUDUL --}}
        <div>
            <label class="text-sm font-semibold">Judul Potensi Produk</label>
            <input type="text"
                   name="judul_potensi_produk"
                   value="{{ old('judul_potensi_produk', $potensi->judul_potensi_produk) }}"
                   class="w-full border rounded-xl px-4 py-3 mt-2">
        </div>

        {{-- NAMA PRODUK --}}
        <div>
            <label class="text-sm font-semibold">Nama Produk</label>
            <input type="text"
                   name="nama_potensi_produk"
                   value="{{ old('nama_potensi_produk', $potensi->nama_potensi_produk) }}"
                   class="w-full border rounded-xl px-4 py-3 mt-2">
        </div>

        {{-- TANGGAL --}}
        <div>
            <label class="text-sm font-semibold">Tanggal</label>
            <input type="date"
                   name="tanggal_potensi_produk"
                   value="{{ old('tanggal_potensi_produk', $potensi->tanggal_potensi_produk) }}"
                   class="w-full border rounded-xl px-4 py-3 mt-2">
        </div>

        {{-- KATEGORI --}}
        <div>
            <label class="text-sm font-semibold">Kategori</label>
            <select name="kategori_potensi_produk"
                    class="w-full border rounded-xl px-4 py-3 mt-2">

                <option value="Potensi Daerah"
                    {{ $potensi->kategori_potensi_produk == 'Potensi Daerah' ? 'selected' : '' }}>
                    Potensi Daerah
                </option>

                <option value="Produk Usaha Daerah"
                    {{ $potensi->kategori_potensi_produk == 'Produk Usaha Daerah' ? 'selected' : '' }}>
                    Produk Usaha Daerah
                </option>

            </select>
        </div>

        {{-- ARTIKEL --}}
        <div>
            <label class="text-sm font-semibold">Artikel</label>
            <textarea name="artikel_potensi_produk"
                      id="editor"
                      class="w-full border rounded-xl px-4 py-3 mt-2">{{ old('artikel_potensi_produk', $potensi->artikel_potensi_produk) }}</textarea>
        </div>

        {{-- FOTO LAMA --}}
        <div>
            <label class="text-sm font-semibold">Foto Lama</label>

            <div class="grid grid-cols-3 gap-3 mt-3">
                @forelse($potensi->gambarPotensiProduk as $foto)
                    <img src="{{ asset('storage/' . $foto->url_foto_potensi_produk) }}"
                         class="rounded-xl w-full h-28 object-cover border">
                @empty
                    <p class="text-sm text-gray-400">Belum ada foto</p>
                @endforelse
            </div>
        </div>

        {{-- UPLOAD BARU (INI YANG FIX SESUAI CONTROLLER) --}}
        <div>
            <label class="text-sm font-semibold">Upload Foto Baru</label>

            <input type="file"
                   name="foto[]"
                   multiple
                   accept="image/*"
                   class="w-full mt-2 border rounded-xl p-3">
        </div>

        <p class="text-xs text-gray-400">
            *Jika upload foto baru, foto lama akan diganti semua
        </p>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('admin.potensi-produk.index') }}"
               class="px-5 py-2 rounded-xl bg-gray-100 text-gray-700">
                Batal
            </a>

            <button type="submit"
                    class="px-5 py-2 rounded-xl bg-[#1D2059] text-white">
                Update
            </button>
        </div>

    </form>

</div>

@endsection