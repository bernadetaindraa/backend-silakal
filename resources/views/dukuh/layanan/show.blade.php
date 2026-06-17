@extends('layouts.admin')

@section('content')

<style>
    [x-cloak] { display: none !important; }
</style>

<div class="p-6 space-y-6">

    {{-- HEADER & TOMBOL KEMBALI --}}
    <div class="flex items-center gap-4">
        <a href="{{ route('dukuh.layanan.index') }}"
           class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#1D2059] transition">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m7 7H3" />
            </svg>
        </a>

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Verifikasi Layanan Surat Pengantar
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Periksa kesesuaian data warga sebelum meneruskan ke tahap selanjutnya.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KOLOM KIRI --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- INFORMASI PEMOHON --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h2 class="text-lg font-bold text-[#1D2059] mb-4 border-b pb-3">
                    Informasi Pemohon
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">

                    <div>
                        <span class="block text-xs text-gray-500">Nama Lengkap</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->nama_lengkap ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">NIK</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->nik ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Tempat Lahir</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->tempat_lahir ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Tanggal Lahir</span>
                        <div class="font-medium text-gray-800">
                            {{\Carbon\carbon::parse($layanan->user?->tanggal_lahir)->translatedFormat('d M Y') ?? '-'}}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Jenis Kelamin</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->jenis_kelamin ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Agama</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->agama ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Pekerjaan</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->pekerjaan ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Pendidikan</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->pendidikan_terakhir ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Status Perkawinan</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->status_perkawinan ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">No Telepon</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->user?->nomor_telepon ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Jenis Layanan</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->jenis_layanan }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Nomor Layanan</span>
                        <div class="font-medium text-gray-800">
                            {{ $layanan->nomor_layanan }}
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-500">Status</span>
                        <div class="font-medium text-gray-800">
                            {{ ucfirst($layanan->status_layanan) }}
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <span class="block text-xs text-gray-500">Keperluan</span>
                        <div class="p-3 bg-gray-50 rounded-xl border text-gray-800">
                            {{ $layanan->keperluan_layanan ?? '-' }}
                        </div>
                    </div>

                    {{-- DATA TAMBAHAN JSON --}}
                    @if($layanan->data_tambahan)
                        <div class="md:col-span-2">
                            <span class="block text-xs text-gray-500 mb-2">Data Tambahan</span>

                            <div class="p-3 bg-gray-50 rounded-xl border text-sm text-gray-700">
                                @php
                                    $extra = is_string($layanan->data_tambahan)
                                        ? json_decode($layanan->data_tambahan, true)
                                        : $layanan->data_tambahan;
                                @endphp

                                @if(is_array($extra))
                                    @foreach($extra as $key => $val)
                                        <div class="flex justify-between border-b py-1">
                                            <span class="text-gray-500">{{ ucfirst(str_replace('_',' ',$key)) }}</span>
                                            <span class="font-medium">{{ $val }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            {{-- LAMPIRAN --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h2 class="text-lg font-bold text-[#1D2059] mb-4 border-b pb-3">
                    Dokumen Lampiran
                </h2>

                <div class="space-y-3">
                    @forelse($layanan->lampiranLayanan as $file)
                        <div class="flex items-center justify-between p-4 border rounded-xl hover:bg-gray-50">

                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 flex items-center justify-center rounded-lg">
                                    📎
                                </div>

                                <div>
                                    <div class="font-semibold text-sm">
                                        {{ $file->jenis_dokumen ?? 'Dokumen' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $file->url_file_dokumen ?? $file->file ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <a href="{{ asset('storage/' . ($file->url_file_dokumen ?? $file->file)) }}"
                               target="_blank"
                               class="px-3 py-1.5 border rounded-lg text-sm">
                                Lihat
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400">Tidak ada lampiran</p>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- KOLOM KANAN --}}
        <div class="lg:col-span-1">

           <div x-data="{
                status: '',
                modal: false,
                submitForm() {
                    if (this.status === '') return;

                    this.$nextTick(() => {
                        $el.querySelector('form').submit();
                    });
                }
            }">

                <h2 class="text-lg font-bold text-[#1D2059] mb-4 border-b pb-3">
                    Tindakan Verifikasi
                </h2>

                <form method="POST"
                      action="{{ route('dukuh.layanan.verifikasi', $layanan->layanan_id ?? $layanan->id) }}"
                      class="space-y-4">

                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status_layanan" x-model="status">
                    
                    {{-- SETUJUI --}}
                    <label class="flex items-center p-3 border rounded-xl cursor-pointer"
                        :class="status=='diverifikasi' ? 'border-green-500 bg-green-50' : ''">

                        <input type="radio" value="diverifikasi" x-model="status" class="mr-2">

                        <div>
                            <div class="font-semibold">Setujui & Teruskan</div>
                            <div class="text-xs text-gray-500">Lanjut ke desa</div>
                        </div>
                    </label>

                    {{-- TOLAK --}}
                    <label class="flex items-center p-3 border rounded-xl cursor-pointer"
                        :class="status=='ditolak' ? 'border-red-500 bg-red-50' : ''">

                        <input type="radio" value="ditolak" x-model="status" class="mr-2">

                        <div>
                            <div class="font-semibold">Tolak</div>
                            <div class="text-xs text-gray-500">Tidak memenuhi syarat</div>
                        </div>
                    </label>

                    {{-- CATATAN --}}
                    <div x-show="status=='ditolak'" x-cloak>
                        <textarea name="catatan_penolakan"
                                  class="w-full border rounded-xl p-2 text-sm"
                                  placeholder="Alasan penolakan wajib diisi"></textarea>
                    </div>

                    {{-- BUTTON --}}
                    <button type="button"
                            @click="modal=true"
                            :disabled="status==''"
                            class="w-full py-3 rounded-xl text-white bg-[#1D2059] disabled:opacity-50">

                        Proses Verifikasi
                    </button>

                    {{-- MODAL --}}
                    <div
                        x-show="modal"
                        x-cloak
                        class="fixed inset-0 z-[9999] flex items-center justify-center px-4"
                    >

                        {{-- BACKDROP --}}
                        <div
                            class="absolute inset-0 bg-black/50"
                            @click="modal = false"
                        ></div>

                        {{-- BOX --}}
                        <div
                            class="relative bg-white w-full max-w-md rounded-2xl shadow-2xl p-6"
                            x-transition
                        >

                            {{-- ICON --}}
                            <div class="flex items-center justify-center w-14 h-14 mx-auto rounded-full bg-blue-100 mb-4">

                                <svg class="w-7 h-7 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"/>
                                </svg>

                            </div>

                            {{-- TITLE --}}
                            <h2 class="text-xl font-bold text-center text-[#1D2059] mb-2">
                                Konfirmasi Verifikasi
                            </h2>

                            {{-- TEXT --}}
                            <p class="text-sm text-gray-500 text-center mb-6">
                                Apakah kamu yakin ingin memproses layanan ini?
                            </p>

                            {{-- BUTTONS --}}
                            <div class="flex justify-center gap-3">

                                {{-- BATAL --}}
                                <button
                                    type="button"
                                    @click="modal = false"
                                    class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200"
                                >
                                    Batal
                                </button>

                                {{-- KONFIRMASI (WAJIB BIRU) --}}
                                <button
                                    type="button"
                                    @click="submitForm()"
                                    class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white hover:opacity-90"
                                >
                                    Konfirmasi
                                </button>

                            </div>

                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection