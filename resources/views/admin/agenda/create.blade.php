@extends('layouts.admin')

@section('content')

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div class="p-6 space-y-6">

    {{-- SUCCESS --}}
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

    {{-- ERROR --}}
    @if(session('error'))

    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
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
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>

            <h1 class="text-2xl font-bold text-[#1D2059]">
                Tambah Agenda
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan agenda kegiatan, piket dukuh, dan izin cuti
            </p>

        </div>

        <a href="{{ route('admin.agenda.index') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
            Kembali
        </a>

    </div>

    {{-- FORM --}}
    <form
        x-data="agendaForm()"
        x-ref="form"
        @submit.prevent="confirmModal = true"
        action="{{ route('admin.agenda.store') }}"
        method="POST"
        class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-8"
    >

        @csrf

        {{-- INFORMASI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- JUDUL --}}
            <div>

                <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                    Judul Agenda
                </label>

                <input
                    type="text"
                    name="judul_agenda"
                    value="{{ old('judul_agenda') }}"
                    placeholder="Masukkan judul agenda..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20"
                >

            </div>

            {{-- TANGGAL --}}
            <div>

                <label class="block text-sm font-semibold text-[#1D2059] mb-2">
                    Tanggal Agenda
                </label>

                <input
                    type="date"
                    name="tanggal_agenda"
                    value="{{ old('tanggal_agenda', now()->format('Y-m-d')) }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#1D2059]/20"
                >

            </div>

        </div>

        {{-- AGENDA --}}
        <div class="space-y-4">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-[#1D2059]">
                        Agenda Kegiatan
                    </h2>

                    <p class="text-sm text-gray-500">
                        Agenda dalam / luar kantor
                    </p>

                </div>

                <button
                    type="button"
                    @click="addAgenda()"
                    class="px-4 py-2 rounded-xl bg-[#1D2059] text-white text-sm"
                >
                    + Tambah
                </button>

            </div>

            <template x-for="(item, index) in agendaItems" :key="index">

                <div class="border border-gray-200 rounded-2xl p-5 bg-gray-50 relative">

                    <button
                        type="button"
                        @click="removeAgenda(index)"
                        class="absolute top-4 right-4 w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center"
                    >
                        ✕
                    </button>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- USER --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Aparatur / Dukuh
                            </label>

                            <select
                                :name="`agenda_items[${index}][user_id]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                                <option value="">
                                    Pilih Aparatur / Dukuh
                                </option>

                                @foreach($users as $user)

                                <option value="{{ $user->user_id }}">
                                    {{ $user->nama_lengkap }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- KATEGORI --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori
                            </label>

                            <select
                                :name="`agenda_items[${index}][kategori_agenda]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                                <option value="">
                                    Pilih Kategori
                                </option>

                                <option value="Di Dalam Kantor Kalurahan">
                                    Di Dalam Kantor Kalurahan
                                </option>

                                <option value="Di Luar Kantor Kalurahan">
                                    Di Luar Kantor Kalurahan
                                </option>

                            </select>

                        </div>

                        {{-- WAKTU --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Waktu
                            </label>

                            <input
                                type="time"
                                :name="`agenda_items[${index}][waktu_agenda]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                        {{-- NAMA --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Agenda
                            </label>

                            <input
                                type="text"
                                :name="`agenda_items[${index}][nama_agenda]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                        {{-- TEMPAT --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tempat
                            </label>

                            <input
                                type="text"
                                :name="`agenda_items[${index}][tempat_agenda]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                        {{-- PENYELENGGARA --}}
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Penyelenggara
                            </label>

                            <input
                                type="text"
                                :name="`agenda_items[${index}][penyelenggara_agenda]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                    </div>

                </div>

            </template>

        </div>

        {{-- PIKET --}}
        <div class="space-y-4">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-[#1D2059]">
                        Piket Dukuh
                    </h2>

                </div>

                <button
                    type="button"
                    @click="addPiket()"
                    class="px-4 py-2 rounded-xl bg-yellow-500 text-white text-sm"
                >
                    + Tambah
                </button>

            </div>

            <template x-for="(item, index) in piketItems" :key="index">

                <div class="border border-yellow-100 rounded-2xl p-5 bg-yellow-50 relative">

                    <button
                        type="button"
                        @click="removePiket(index)"
                        class="absolute top-4 right-4 w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center"
                    >
                        ✕
                    </button>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Aparatur / Dukuh
                            </label>

                            <select
                                :name="`piket_dukuh[${index}][user_id]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                                <option value="">
                                    Pilih Aparatur / Dukuh
                                </option>

                                @foreach($users as $user)

                                <option value="{{ $user->user_id }}">
                                    {{ $user->nama_lengkap }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Waktu Piket
                            </label>

                            <input
                                type="time"
                                :name="`piket_dukuh[${index}][waktu_piket]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Keterangan
                            </label>

                            <input
                                type="text"
                                :name="`piket_dukuh[${index}][keterangan_piket]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                    </div>

                </div>

            </template>

        </div>

        {{-- IZIN --}}
        <div class="space-y-4">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-[#1D2059]">
                        Izin / Cuti
                    </h2>

                </div>

                <button
                    type="button"
                    @click="addIzin()"
                    class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm"
                >
                    + Tambah
                </button>

            </div>

            <template x-for="(item, index) in izinItems" :key="index">

                <div class="border border-red-100 rounded-2xl p-5 bg-red-50 relative">

                    <button
                        type="button"
                        @click="removeIzin(index)"
                        class="absolute top-4 right-4 w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center"
                    >
                        ✕
                    </button>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Aparatur / Dukuh
                            </label>

                            <select
                                :name="`izin_cuti[${index}][user_id]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                                <option value="">
                                    Pilih Aparatur / Dukuh
                                </option>

                                @foreach($users as $user)

                                <option value="{{ $user->user_id }}">
                                    {{ $user->nama_lengkap }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Mulai
                            </label>

                            <input
                                type="date"
                                :name="`izin_cuti[${index}][tanggal_mulai_izin_cuti]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Selesai
                            </label>

                            <input
                                type="date"
                                :name="`izin_cuti[${index}][tanggal_selesai_izin_cuti]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Alasan
                            </label>

                            <input
                                type="text"
                                :name="`izin_cuti[${index}][alasan_izin_cuti]`"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm"
                            >

                        </div>

                    </div>

                </div>

            </template>

        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 pt-4">

            <a href="{{ route('admin.agenda.index') }}"
               class="px-5 py-3 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium">
                Batal
            </a>

            <button
                type="submit"
                class="px-5 py-3 rounded-xl bg-[#1D2059] text-white text-sm font-medium"
            >
                Simpan Agenda
            </button>

        </div>

        {{-- MODAL --}}
        <div
            x-show="confirmModal"
            x-transition.opacity
            x-cloak
            class="fixed inset-0 z-[9999] flex items-center justify-center px-4"
        >

            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                @click="confirmModal = false"
            ></div>

            <div
                x-show="confirmModal"
                x-transition.scale
                class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl p-6"
            >

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

                <h2 class="text-2xl font-bold text-center text-[#1D2059] mb-2">
                    Konfirmasi Simpan
                </h2>

                <p class="text-sm text-gray-500 text-center mb-6">
                    Pastikan data agenda sudah benar sebelum disimpan.
                </p>

                <div class="flex justify-center gap-3">

                    <button
                        type="button"
                        @click="confirmModal = false"
                        class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700"
                    >
                        Batal
                    </button>

                    <button
                        type="button"
                        @click="$refs.form.submit()"
                        class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white"
                    >
                        Ya, Simpan
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<script>
    function agendaForm() {

        return {

            confirmModal: false,

            agendaItems: [{}],
            piketItems: [{}],
            izinItems: [],

            addAgenda() {
                this.agendaItems.push({})
            },

            removeAgenda(index) {

                if(this.agendaItems.length > 1) {
                    this.agendaItems.splice(index, 1)
                }

            },

            addPiket() {
                this.piketItems.push({})
            },

            removePiket(index) {

                if(this.piketItems.length > 1) {
                    this.piketItems.splice(index, 1)
                }

            },

            addIzin() {
                this.izinItems.push({})
            },

            removeIzin(index) {
                this.izinItems.splice(index, 1)
            }

        }

    }
</script>

@endsection