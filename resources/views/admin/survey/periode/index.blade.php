@extends('layouts.admin')

@section('content')

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div
    class="p-6 space-y-6"
    x-data="{
        openModal: false,
        
        {{-- State untuk Edit Modal --}}
        editModal: false,
        editAction: '',
        editNama: '',
        editMulai: '',
        editSelesai: '',
        
        openEdit(url, nama, mulai, selesai) {
            this.editAction = url;
            this.editNama = nama;
            this.editMulai = mulai;
            this.editSelesai = selesai;
            this.editModal = true;
        }
    }"
>

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

            <svg
                class="w-5 h-5"
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

            <span class="text-sm font-medium">

                {{ session('success') }}

            </span>

        </div>

    </div>

    @endif

    {{-- ERROR ALERT --}}
    @if(session('error'))

    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-5 right-5 z-[9999]"
    >

        <div class="bg-red-500 text-white px-5 py-4 rounded-2xl shadow-2xl flex items-center gap-3">

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />

            </svg>

            <span class="text-sm font-medium">

                {{ session('error') }}

            </span>

        </div>

    </div>

    @endif

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h1 class="text-2xl font-bold text-[#1D2059]">

                    Manajemen Periode Survey

                </h1>

                <p class="text-sm text-gray-500 mt-1">

                    Kelola periode survei kepuasan masyarakat Kalurahan

                </p>

            </div>

            {{-- BUTTON --}}
            <button
                type="button"
                @click="openModal = true"
                class="
                    px-5 py-3
                    rounded-xl
                    bg-[#1D2059]
                    text-white
                    text-sm
                    font-medium
                    hover:opacity-90
                    transition
                "
            >

                Buka Periode Survey

            </button>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px]">

                <thead>

                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">

                        <th class="px-6 py-4 w-[80px]">
                            No
                        </th>

                        <th class="px-6 py-4 min-w-[220px]">
                            Nama Periode
                        </th>

                        <th class="px-6 py-4 w-[180px]">
                            Tanggal Mulai
                        </th>

                        <th class="px-6 py-4 w-[180px]">
                            Tanggal Selesai
                        </th>

                        <th class="px-6 py-4 w-[160px]">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center w-[250px]">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($periode as $item)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- NO --}}
                        <td class="px-6 py-5 text-gray-500">

                            {{ $loop->iteration }}

                        </td>

                        {{-- NAMA --}}
                        <td class="px-6 py-5">

                            <div class="font-semibold text-[#1D2059]">

                                {{ $item->nama_periode }}

                            </div>

                        </td>

                        {{-- TANGGAL MULAI --}}
                        <td class="px-6 py-5 whitespace-nowrap">

                            <div class="font-medium text-gray-700">

                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}

                            </div>

                        </td>

                        {{-- TANGGAL SELESAI --}}
                        <td class="px-6 py-5 whitespace-nowrap">

                            <div class="font-medium text-gray-700">

                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}

                            </div>

                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($item->status_periode == 'Buka')

                                <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">

                                    Dibuka

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-lg text-[11px] font-semibold bg-red-50 text-red-700 border border-red-100">

                                    Ditutup

                                </span>

                            @endif

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-2">

                                {{-- EDIT BUTTON --}}
                                <button
                                    type="button"
                                    @click="openEdit(
                                        '{{ route('admin.survey.periode.update', $item->periode_survey_id) }}', 
                                        '{{ $item->nama_periode }}', 
                                        '{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d') }}', 
                                        '{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d') }}'
                                    )"
                                    class="
                                        px-4 py-2
                                        rounded-xl
                                        bg-blue-50
                                        text-blue-700
                                        text-xs
                                        font-semibold
                                        border border-blue-100
                                        hover:bg-blue-100
                                        transition
                                    "
                                >
                                    Edit
                                </button>

                                {{-- TOGGLE STATUS BUKA / TUTUP --}}
                                @if($item->status_periode == 'Tutup')

                                <form
                                    action="{{ route('admin.survey.periode.update-status', $item->periode_survey_id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="status_periode" value="Buka">

                                    <button
                                        type="submit"
                                        class="
                                            px-4 py-2
                                            rounded-xl
                                            bg-emerald-50
                                            text-emerald-700
                                            text-xs
                                            font-semibold
                                            border border-emerald-100
                                            hover:bg-emerald-100
                                            transition
                                        "
                                    >

                                        Buka

                                    </button>

                                </form>

                                @else

                                <form
                                    action="{{ route('admin.survey.periode.update-status', $item->periode_survey_id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="status_periode" value="Tutup">

                                    <button
                                        type="submit"
                                        class="
                                            px-4 py-2
                                            rounded-xl
                                            bg-red-50
                                            text-red-700
                                            text-xs
                                            font-semibold
                                            border border-red-100
                                            hover:bg-red-100
                                            transition
                                        "
                                    >

                                        Tutup

                                    </button>

                                </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="py-16 text-center text-gray-400">

                            <div class="flex flex-col items-center">

                                <svg
                                    class="w-12 h-12 mb-3 text-gray-300"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7
                                        a2 2 0 00-2-2H6a2 2 0 00-2 2v11
                                        a2 2 0 002 2z"
                                    />

                                </svg>

                                <p class="font-medium">

                                    Belum ada periode survey

                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- MODAL TAMBAH --}}
    <div
        x-show="openModal"
        x-cloak
        class="fixed inset-0 z-[9999] flex items-center justify-center"
    >

        <div
            @click="openModal = false"
            class="absolute inset-0 bg-black/40 backdrop-blur-sm"
        ></div>

        <div
            x-transition
            class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl p-7 mx-4"
        >

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-[#1D2059]">Buka Periode Survey</h2>
                <p class="text-sm text-gray-500 mt-1">Tambahkan periode survei kepuasan masyarakat baru</p>
            </div>

            <form action="{{ route('admin.survey.periode.buka') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Periode</label>
                    <input type="text" name="nama_periode" required placeholder="Contoh: Survey Januari 2026" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" @click="openModal = false" class="px-5 py-3 rounded-xl border border-gray-200 text-sm font-medium hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="px-5 py-3 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">Simpan Periode</button>
                </div>

            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div
        x-show="editModal"
        x-cloak
        class="fixed inset-0 z-[9999] flex items-center justify-center"
    >

        <div
            @click="editModal = false"
            class="absolute inset-0 bg-black/40 backdrop-blur-sm"
        ></div>

        <div
            x-transition
            class="relative bg-white w-full max-w-lg rounded-3xl shadow-2xl p-7 mx-4"
        >

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-[#1D2059]">Edit Periode Survey</h2>
                <p class="text-sm text-gray-500 mt-1">Ubah detail periode survei yang sudah ada</p>
            </div>

            {{-- Binding x-bind:action (atau :action) ke editAction --}}
            <form :action="editAction" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Periode</label>
                    {{-- Binding value ke x-model="editNama" --}}
                    <input type="text" name="nama_periode" x-model="editNama" required placeholder="Contoh: Survey Januari 2026" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" x-model="editMulai" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" x-model="editSelesai" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" @click="editModal = false" class="px-5 py-3 rounded-xl border border-gray-200 text-sm font-medium hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="px-5 py-3 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">Simpan Perubahan</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection