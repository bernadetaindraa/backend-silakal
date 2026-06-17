@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'Pengaduan Masyarakat',
        'subtitle' => 'ꦥꦼꦔꦢꦸꦮꦤ꧀ ꦩꦱꦾꦫꦏꦠ꧀',
    ])

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <nav class="text-sm text-gray-500 mb-10">
            <a href="/" class="hover:text-blue-600 transition">Beranda</a> &gt;
            <span class="text-gray-400">Survey dan Pengaduan</span> &gt;
            <span class="text-blue-600 font-medium">Pengaduan Masyarakat</span>
        </nav>

        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-[#1D2059] tracking-tight">
                Pengaduan Masyarakat
            </h1>

            <p class="text-base text-gray-500 mt-2">
                Sampaikan pengaduan dan masukan Anda kepada kami
            </p>
        </div>

        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-10">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
                    <ul class="list-disc pl-5 text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('pengaduan.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf

                {{-- USER ID --}}
                <input
                    type="hidden"
                    name="user_id"
                    value="{{ auth()->user()->user_id }}"
                >

                {{-- ROW 1 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal
                        </label>

                        <input
                            type="text"
                            value="{{ date('d F Y') }}"
                            disabled
                            class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm text-gray-500"
                        >

                        <input
                            type="hidden"
                            name="tanggal_pengaduan"
                            value="{{ date('Y-m-d') }}"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Jenis Pengaduan
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="jenis_pengaduan"
                            required
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Pilih Jenis Pengaduan</option>

                            <option value="Infrastruktur" {{ old('jenis_pengaduan') == 'Infrastruktur' ? 'selected' : '' }}>
                                Infrastruktur
                            </option>

                            <option value="Pelayanan" {{ old('jenis_pengaduan') == 'Pelayanan' ? 'selected' : '' }}>
                                Pelayanan Publik
                            </option>

                            <option value="Keamanan" {{ old('jenis_pengaduan') == 'Keamanan' ? 'selected' : '' }}>
                                Keamanan & Ketertiban
                            </option>

                            <option value="Lainnya" {{ old('jenis_pengaduan') == 'Lainnya' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>
                    </div>
                </div>

                {{-- ROW 2 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Pengadu
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama_pengadu"
                            value="{{ old('nama_pengadu') }}"
                            placeholder="Nama Lengkap Pengadu"
                            required
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Kontak Pengadu
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="kontak_pengadu"
                            value="{{ old('kontak_pengadu') }}"
                            placeholder="08xxxxxxxxxx"
                            required
                            class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                </div>

                {{-- JUDUL --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Pengaduan
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="judul_pengaduan"
                        value="{{ old('judul_pengaduan') }}"
                        placeholder="Masukkan Judul Pengaduan"
                        required
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                {{-- LOKASI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Lokasi Kejadian
                        <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        name="lokasi_kejadian"
                        rows="2"
                        placeholder="Masukkan lokasi kejadian"
                        required
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                    >{{ old('lokasi_kejadian') }}</textarea>
                </div>

                {{-- ISI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Isi Pengaduan
                        <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        name="isi_pengaduan"
                        rows="5"
                        placeholder="Jelaskan detail pengaduan"
                        required
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ old('isi_pengaduan') }}</textarea>
                </div>

                {{-- FILE --}}
                <div x-data="{ previews: [] }">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Upload Bukti
                    </label>

                    <label
                        class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition"
                    >
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                </path>
                            </svg>

                            <p class="text-xs text-gray-500">
                                Upload Foto / PDF Bukti
                            </p>
                        </div>

                        <input
                            type="file"
                            name="files[]"
                            multiple
                            accept=".jpg,.jpeg,.png,.pdf"
                            class="hidden"
                            @change="
                                previews = [];
                                for (const file of $event.target.files) {
                                    if (file.type.includes('image')) {
                                        previews.push(URL.createObjectURL(file));
                                    }
                                }
                            "
                        >
                    </label>

                    {{-- PREVIEW --}}
                    <div
                        x-show="previews.length > 0"
                        x-cloak
                        class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4"
                    >
                        <template x-for="preview in previews" :key="preview">
                            <img
                                :src="preview"
                                class="w-full h-40 object-cover rounded-xl border border-gray-200"
                            >
                        </template>
                    </div>

                    <p class="text-xs text-gray-400 mt-2">
                        Format: JPG, JPEG, PNG, PDF (Max 2MB)
                    </p>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end pt-4">
                    <button
                        type="submit"
                        class="px-14 py-3 bg-[#1D2059] hover:bg-blue-900 text-white font-bold rounded-full text-sm transition shadow-md"
                    >
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection