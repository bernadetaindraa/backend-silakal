@extends('layouts.admin')

@section('content')

{{-- BUNGKUS UTAMA X-DATA (Harus membungkus tabel DAN modal) --}}
<div x-data="{
    editOpen: false,
    deleteOpen: false,
    editId: '',
    editJenis: '',
    editStatus: '',
    deleteId: '',

    editNama:'',
    editJenis:'',
    editStatus:'',
    editPengiriman:'',

    editNomorSurat:'',
    editTanggalSurat:'',
    editPenandatangan:'',
    editJabatan:'',
    editIsi:'',
}">

    <div class="p-4 mx-auto space-y-6 md:p-6 max-w-7xl">

        {{-- HEADER --}}
        <div class="flex flex-col justify-between gap-4 p-6 bg-white border border-gray-100 shadow-sm rounded-3xl sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-[#1D2059] tracking-tight">
                    Manajemen Layanan
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola proses pembuatan surat dan dokumen administrasi warga.
                </p>
            </div>
            <div class="shrink-0">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-600 text-xs font-semibold rounded-xl">
                    Total: {{ $layanan->total() }} Dokumen
                </span>
            </div>
        </div>

        {{-- TABLE SECTION --}}
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl">
            <div class="p-6 border-b border-gray-100">
                <h3 class="font-bold text-[#1D2059] text-lg tracking-tight mb-4">
                    Daftar Layanan Warga
                </h3>

                <form method="GET" id="filterForm" action="{{ url()->current() }}">
                    <div class="flex flex-col items-stretch gap-4 md:flex-row md:items-center">
                        
                        {{-- Input Pencarian --}}
                        <div class="relative flex-grow md:flex-[2]">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="searchInput"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama pemohon atau nomor layanan..."
                                class="w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 focus:border-[#1D2059] focus:ring-1 focus:ring-[#1D2059] rounded-2xl text-sm transition-colors outline-none"
                            >
                        </div>

                        {{-- Dropdown Status --}}
                        <div class="relative flex-grow md:flex-[1]">
                            <select
                                id="statusSelect"
                                name="status"
                                class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 focus:border-[#1D2059] focus:ring-1 focus:ring-[#1D2059] rounded-2xl text-sm transition-colors outline-none appearance-none cursor-pointer"
                            >
                                <option value="">Semua Status</option>
                                <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="siap_diambil" {{ request('status') == 'siap_diambil' ? 'selected' : '' }}>Siap Diambil</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- Tombol Reset --}}
                        @if(request('search') || request('status'))
                            <div class="flex items-center justify-center shrink-0">
                                <a href="{{ url()->current() }}" 
                                   class="inline-flex items-center gap-1.5 px-4 py-3 text-sm font-semibold text-rose-600 hover:text-rose-700 bg-rose-50 hover:bg-rose-100/80 rounded-2xl transition-colors duration-200 w-full md:w-auto justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Clear
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left whitespace-nowrap">
                    <thead class="text-[11px] font-bold tracking-wider text-gray-500 uppercase bg-gray-50/80">
                        <tr>
                            <th class="w-12 px-6 py-4 text-center">No</th>
                            <th class="px-6 py-4">Tanggal Pengajuan</th>
                            <th class="px-6 py-4">Pemohon</th>
                            <th class="px-6 py-4">Jenis Layanan</th>
                            <th class="px-6 py-4 text-center">Metode Kirim</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="w-40 px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($layanan as $item)
                        <tr class="transition-colors duration-150 hover:bg-gray-50/60">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">
                                {{ $layanan->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                {{ $item->tanggal_layanan?->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $item->user->nama_lengkap ?? '-' }}
                            </td>
                            <td class="px-6 py-4 max-w-[220px]">
                                <span class="block text-gray-600 truncate" title="{{ $item->jenis_layanan_label }}">
                                    {{ $item->jenis_layanan_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->pengiriman_layanan == 'email')
                                    <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-[11px] font-semibold border border-blue-100">
                                        Email
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 bg-gray-50 text-gray-600 rounded-lg text-[11px] font-semibold border border-gray-200">
                                        Ambil Loket
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold shadow-sm uppercase tracking-wider {{ $item->status_badge }}">
                                    {{ $item->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    {{-- Tombol Dropdown --}}
                                    <button
                                        @click="open = !open"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-600 transition"
                                    >
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
                                        </svg>
                                    </button>

                                    {{-- Menu Dropdown --}}
                                    <div
                                        x-show="open"
                                        x-transition
                                        @click.away="open = false"
                                        x-cloak
                                        class="absolute right-0 z-50 w-48 mt-2 overflow-hidden bg-white border border-gray-100 shadow-xl rounded-2xl"
                                    >
                                        {{-- Detail --}}
                                        <a href="{{ route('pelayanan.layanan.show', $item->layanan_id) }}"
                                           class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detail
                                        </a>

                                        {{-- Proses --}}
                                        @if($item->status_layanan == 'diverifikasi')
                                        <a href="{{ route('pelayanan.layanan.pembuatan-surat', $item->layanan_id) }}"
                                        class="flex items-center w-full gap-3 px-4 py-3 text-sm text-blue-600 hover:bg-blue-50">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.868v4.264a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                            </svg>

                                            Proses
                                        </a>
                                        @endif

                                        {{-- Surat --}}
                                        @if($item->status_layanan == 'diproses')
                                        <a href="{{ route('pelayanan.layanan.pembuatan-surat', $item->layanan_id) }}"
                                           class="flex items-center gap-3 px-4 py-3 text-sm text-amber-600 hover:bg-amber-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            Generate Surat
                                        </a>
                                        @endif

                                        {{-- Ubah --}}
                                        <button
                                            @click="
                                                editOpen = true;
                                                editId = '{{ $item->layanan_id }}';

                                                editNama = '{{ $item->user->nama_lengkap ?? '' }}';
                                                editJenis = '{{ $item->jenis_layanan }}';
                                                editStatus = '{{ $item->status_layanan }}';
                                                editPengiriman = '{{ $item->pengiriman_layanan }}';

                                                editNomorSurat = '{{ $item->nomor_surat }}';
                                                editTanggalSurat = '{{ $item->tanggal_surat ? \Carbon\Carbon::parse($item->tanggal_surat)->format('Y-m-d') : '' }}';
                                                editPenandatangan = '{{ $item->nama_penandatangan }}';
                                                editJabatan = '{{ $item->jabatan_penandatangan }}';
                                                editIsi = `{{ $item->isi_surat }}`;
                                            "
                                            class="flex items-center w-full gap-3 px-4 py-3 text-sm text-indigo-600 hover:bg-indigo-50"
                                        >
                                            {{-- Icon Edit --}}
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>

                                            Edit
                                        </button>


                                        {{-- Selesai --}}
                                        @if($item->status_layanan == 'siap_diambil')
                                        <form action="{{ route('pelayanan.layanan.selesai', $item->layanan_id) }}" method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" 
                                                class="flex items-center w-full gap-3 px-4 py-3 text-sm text-emerald-600 hover:bg-emerald-50">

                                                {{-- Icon Check --}}
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"/>
                                                </svg>

                                                Tandai Selesai
                                            </button>

                                        </form>
                                        @endif


                                        <div class="border-t border-gray-100"></div>


                                        {{-- Hapus --}}
                                        <button
                                            type="button"
                                            @click="
                                                deleteOpen = true;
                                                deleteId = '{{ $item->layanan_id }}';
                                            "
                                            class="flex items-center w-full gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50"
                                        >

                                            {{-- Icon Trash --}}
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7L5 7M10 11V17M14 11V17M6 7L7 19A2 2 0 009 21H15A2 2 0 0017 19L18 7M9 7V4A1 1 0 0110 3H14A1 1 0 0115 4V7"/>
                                            </svg>

                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-16 font-medium text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586-3.586a2 2 0 00-2.828 0L12 14m0 0l-3.586-3.586a2 2 0 00-2.828 0L4 13"></path>
                                    </svg>
                                    <span>Tidak ada dokumen layanan yang cocok dengan filter</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="p-6 border-t border-gray-100 bg-gray-50/30">
                {{ $layanan->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL EDIT FULL --}}
    <div x-show="editOpen" x-cloak 
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 overflow-y-auto">
        
        {{-- Backdrop --}}
        <div @click="editOpen=false" class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>

        {{-- Modal Container --}}
        <div @click.away="editOpen=false" 
            class="bg-white rounded-3xl w-full max-w-2xl shadow-2xl relative z-10 my-auto transform transition-all">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white rounded-t-3xl z-20">
                <h3 class="font-bold text-lg text-[#1D2059]">Edit Data Layanan</h3>
                <button @click="editOpen=false" class="text-gray-400 hover:text-red-500 transition">✕</button>
            </div>

            {{-- Form --}}
            <form
                :action="'{{ url('/pelayanan/layanan') }}/' + editId"
                method="POST"
                enctype="multipart/form-data"
                class="p-6 space-y-5"
            >
                @csrf
                @method('PUT')
            
                {{-- Row 1: Nama & Jenis --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Pemohon</label>
                        <input type="text" x-model="editNama" disabled class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-sm cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jenis Layanan</label>
                        <input type="text" name="jenis_layanan" x-model="editJenis" disabled class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-sm cursor-not-allowed">
                    </div>
                </div>

                {{-- Row 2: Status & Pengiriman --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                        <select name="status_layanan" x-model="editStatus" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                            <option value="diverifikasi">Diverifikasi</option>
                            <option value="diproses">Diproses</option>
                            <option value="siap_diambil">Siap Diambil</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Metode Pengiriman</label>
                        <select name="pengiriman_layanan" x-model="editPengiriman" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                            <option value="email">Email</option>
                            <option value="ambil">Ambil Loket</option>
                        </select>
                    </div>
                </div>

                {{-- Row 3: Nomor & Tanggal --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Surat</label>
                        <input type="text" name="nomor_surat" x-model="editNomorSurat" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" x-model="editTanggalSurat" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                    </div>
                </div>

                {{-- Row 4: Penandatangan --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Penandatangan</label>
                        <input type="text" name="nama_penandatangan" x-model="editPenandatangan" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jabatan Penandatangan</label>
                        <input type="text" name="jabatan_penandatangan" x-model="editJabatan" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                    </div>
                </div>

                {{-- Isi Surat --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Isi Surat</label>
                    <textarea name="isi_surat" rows="3" x-model="editIsi" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm"></textarea>
                </div>

                {{-- Upload File --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Unggah Dokumen Baru</label>
                    <input type="file" name="file_surat" 
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-200 rounded-xl bg-gray-50 p-1">
                </div>

                {{-- Footer Buttons --}}
                <div class="pt-4 flex flex-col-reverse sm:flex-row gap-3">
                    <button type="button" @click="editOpen=false" class="w-full sm:w-1/3 py-2.5 bg-gray-100 text-gray-700 font-semibold rounded-xl text-sm hover:bg-gray-200">Batal</button>
                    <button type="submit" class="w-full sm:w-2/3 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl text-sm hover:bg-indigo-700 shadow-lg">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <div
        x-show="deleteOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
    >
        <div
            @click.away="deleteOpen=false"
            class="w-full max-w-md overflow-hidden bg-white shadow-2xl rounded-2xl"
        >
            <div class="flex items-center justify-between px-6 py-4 border-b border-red-100 bg-red-50/50">
                <h2 class="flex items-center gap-2 text-lg font-bold text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Konfirmasi Hapus
                </h2>
                <button @click="deleteOpen=false" class="text-red-400 transition hover:text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <p class="text-gray-600">
                    Apakah Anda yakin ingin menghapus data layanan ini? Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
                </p>
            </div>

            <div class="flex items-center justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-200">
                <button
                    type="button"
                    @click="deleteOpen=false"
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-700 transition bg-white border border-gray-300 rounded-xl hover:bg-gray-50 shadow-sm"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Batal
                </button>

                <form
                    :action="'{{ url('/pelayanan/layanan') }}/' + deleteId"
                    method="POST"
                    class="m-0"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus Permanen
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- AUTOMATIC SUBMIT SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        const statusSelect = document.getElementById('statusSelect');
        let typingTimer;

        // 1. Auto-submit saat mengetik (dengan Debounce 500ms agar server tidak overload)
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    filterForm.submit();
                }, 500);
            });

            // Mempertahankan posisi kursor fokus di akhir teks setelah reload/submit otomatis
            if (searchInput.value.length > 0) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }
        }

        // 2. Auto-submit langsung saat dropdown status diubah
        if (statusSelect) {
            statusSelect.addEventListener('change', function () {
                filterForm.submit();
            });
        }
    });
</script>
@endsection