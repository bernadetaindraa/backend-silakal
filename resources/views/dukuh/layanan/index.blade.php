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
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-transition 
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-[9999]"
    >
        <div class="bg-emerald-500 text-white px-5 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">Daftar Pengajuan Layanan</h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola dan verifikasi permohonan surat pengantar dari warga Padukuhan Anda.
            </p>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- FILTER & SEARCH --}}
        <div class="p-5 border-b border-gray-100 bg-gray-50/50">
            <form 
                method="GET" 
                action="{{ route('dukuh.layanan.index') }}" 
                id="filterForm"
                class="flex flex-col md:flex-row gap-3 md:items-center justify-between"
            >
                {{-- SEARCH --}}
                <div class="relative w-full max-w-md">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        id="searchInput"
                        value="{{ request('search') }}" 
                        placeholder="Cari NIK atau Nama Pemohon..." 
                        autocomplete="off"
                        class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none transition"
                    >
                </div>

                {{-- FILTER STATUS --}}
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <select 
                        name="status" 
                        onchange="document.getElementById('filterForm').submit()"
                        class="w-full md:w-auto border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none transition cursor-pointer bg-white"
                    >
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Disetujui (Diteruskan)</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px]">

                <thead>
                    <tr class="bg-gray-50/80 text-left text-xs uppercase text-gray-500 border-b">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Jenis Layanan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y text-sm">

                @forelse($layanan as $item)
                <tr>

                    <td class="px-6 py-4">{{ $loop->iteration }}</td>

                    <td class="px-6 py-4">
                        <div class="font-semibold text-[#1D2059]">
                            {{ $item->user->nama_lengkap ?? '-' }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $item->user->nik ?? '-' }}
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-medium">{{ $item->jenis_layanan }}</div>
                        <div class="text-xs text-gray-400">{{ $item->keperluan_layanan }}</div>
                    </td>

                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                    </td>

                    <td class="px-6 py-4">
                        @if($item->status_layanan == 'menunggu')
                            <span class="text-yellow-600 font-semibold">Menunggu</span>
                        @elseif($item->status_layanan == 'diverifikasi')
                            <span class="text-green-600 font-semibold">Diteruskan</span>
                        @else
                            <span class="text-red-600 font-semibold">Ditolak</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="px-6 py-4 text-center">

                        <div class="flex justify-center items-center gap-2" 
                            x-data="{
                                verif: false,
                                tolak: false,
                                form: null,
                                alasan: '',
                                submitForm() {
                                    this.form.submit()
                                }
                            }">

                            {{-- DETAIL --}}
                            <a href="{{ route('dukuh.layanan.show', $item->layanan_id) }}"
                            class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-xs rounded-lg transition">
                                Detail
                            </a>

                            @if($item->status_layanan == 'menunggu')

                            {{-- ✔ BUTTON VERIFIKASI --}}
                            <button
                                type="button"
                                @click="verif = true; form = $refs.verifForm"
                                class="px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs rounded-lg transition"
                            >
                                ✔
                            </button>

                            {{-- ✖ BUTTON TOLAK --}}
                            <button
                                type="button"
                                @click="tolak = true; form = $refs.tolakForm"
                                class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs rounded-lg transition"
                            >
                                ✖
                            </button>

                            {{-- FORM VERIF --}}
                            <form x-ref="verifForm" method="POST" action="{{ route('dukuh.layanan.verifikasi', $item->layanan_id) }}">
                                @csrf
                                <input type="hidden" name="status_layanan" value="diverifikasi">
                            </form>

                            {{-- FORM TOLAK --}}
                            <form x-ref="tolakForm" method="POST" action="{{ route('dukuh.layanan.verifikasi', $item->layanan_id) }}">
                                @csrf
                                <input type="hidden" name="status_layanan" value="ditolak">
                                <input type="hidden" name="catatan_penolakan" x-ref="catatan">
                            </form>

                            {{-- ================= VERIF MODAL ================= --}}
                            <div x-show="verif" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center px-4">

                                <div class="absolute inset-0 bg-black/50" @click="verif = false"></div>

                                <div class="relative bg-white w-full max-w-md rounded-2xl shadow-2xl p-6" x-transition>

                                    <div class="flex items-center justify-center w-14 h-14 mx-auto rounded-full bg-blue-100 mb-4">
                                        <svg class="w-7 h-7 text-[#1D2059]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>

                                    <h2 class="text-xl font-bold text-center text-[#1D2059] mb-2">
                                        Konfirmasi Verifikasi
                                    </h2>

                                    <p class="text-sm text-gray-500 text-center mb-6">
                                        Yakin ingin memverifikasi layanan ini?
                                    </p>

                                    <div class="flex justify-center gap-3">
                                        <button @click="verif = false"
                                                class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700">
                                            Batal
                                        </button>

                                        <button @click="submitForm()"
                                                class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white hover:opacity-90">
                                            Konfirmasi
                                        </button>
                                    </div>

                                </div>
                            </div>

                            {{-- ================= TOLAK MODAL ================= --}}
                            <div x-show="tolak" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center px-4">

                                <div class="absolute inset-0 bg-black/50" @click="tolak = false"></div>

                                <div class="relative bg-white w-full max-w-md rounded-2xl shadow-2xl p-6" x-transition>

                                    <div class="flex items-center justify-center w-14 h-14 mx-auto rounded-full bg-red-100 mb-4">
                                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>

                                    <h2 class="text-xl font-bold text-center text-[#1D2059] mb-2">
                                        Tolak Pengajuan
                                    </h2>

                                    <p class="text-sm text-gray-500 text-center mb-4">
                                        Masukkan alasan penolakan
                                    </p>

                                    <textarea x-model="alasan"
                                            class="w-full border rounded-xl p-3 text-sm mb-4"
                                            placeholder="Alasan penolakan..."></textarea>

                                    <div class="flex justify-center gap-3">

                                        <button @click="tolak = false"
                                                class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700">
                                            Batal
                                        </button>

                                        <button @click="
                                                $refs.catatan.value = alasan;
                                                submitForm();
                                            "
                                            class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:opacity-90">
                                            Tolak
                                        </button>

                                    </div>

                                </div>
                            </div>

                            @endif

                        </div>

                    </td>

                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center text-gray-400">
                            Tidak ada pengajuan layanan
                        </td>
                    </tr>
                @endforelse

                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($layanan->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $layanan->links() }}
        </div>
        @endif

    </div>
</div>

{{-- AUTO SUBMIT SEARCH --}}
<script>
    const searchInput = document.getElementById('searchInput');
    const filterForm = document.getElementById('filterForm');

    let timeout = null;

    if(searchInput.value !== '') {
        searchInput.focus();
        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    }

    searchInput.addEventListener('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => filterForm.submit(), 500);
    });
</script>

@endsection