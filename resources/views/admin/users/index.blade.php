@extends('layouts.admin')

@section('content')

<style>
    [x-cloak] { display: none !important; }
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>
        </div>
    </div>
    @endif

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Manajemen User
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola data pengguna sistem
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}"
           class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">
            Tambah User
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    {{-- FILTER + SEARCH --}}
    <div class="p-5 border-b border-gray-100">

        <form method="GET" action="{{ url()->current() }}" class="space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-5 gap-3 items-end">

                {{-- SEARCH --}}
                <div class="md:col-span-2 relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>

                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, NIK, email..."
                        class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm
                            focus:ring-2 focus:ring-[#1D2059]/20 focus:border-[#1D2059] outline-none">
                </div>

                {{-- ROLE --}}
                <select name="role"
                    class="border border-gray-200 rounded-xl px-4 py-3 text-sm
                        focus:ring-2 focus:ring-[#1D2059]/20">

                    <option value="">Semua Role</option>

                    @foreach($roles as $role)
                        <option value="{{ $role->role_id }}"
                            {{ request('role') == $role->role_id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach

                </select>

                {{-- DUSUN --}}
                <select name="dusun"
                    class="border border-gray-200 rounded-xl px-4 py-3 text-sm
                        focus:ring-2 focus:ring-[#1D2059]/20">

                    <option value="">Semua Dusun</option>

                    @foreach($dusun as $d)
                        <option value="{{ $d->dusun_id }}"
                            {{ request('dusun') == $d->dusun_id ? 'selected' : '' }}>
                            {{ $d->nama_dusun }}
                        </option>
                    @endforeach

                </select>

                {{-- SORT BY NAME ONLY --}}
                <div class="grid grid-cols-1">

                    <select name="sort_order"
                        class="border border-gray-200 rounded-xl px-4 py-3 text-sm
                            focus:ring-2 focus:ring-[#1D2059]/20">

                        <option value="asc"
                            {{ request('sort_order', 'asc') == 'asc' ? 'selected' : '' }}>
                            Nama A → Z
                        </option>

                        <option value="desc"
                            {{ request('sort_order') == 'desc' ? 'selected' : '' }}>
                            Nama Z → A
                        </option>

                    </select>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white text-sm font-medium hover:opacity-90 transition">
                    Terapkan Filter
                </button>
            </div>

        </form>

    </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px]">

                <thead>
                    <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Dusun</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">No HP</th>
                        <th class="px-6 py-4">Pendidikan</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- NO --}}
                        <td class="px-6 py-5 text-gray-500">
                            {{ $loop->iteration }}
                        </td>

                        {{-- USER --}}
                        <td class="px-6 py-5">
                            <div class="font-semibold text-[#1D2059]">
                                {{ $user->nama_lengkap }}
                            </div>
                            <div class="text-xs text-gray-500">
                                NIK: {{ $user->nik }}
                            </div>
                        </td>

                        {{-- ROLE --}}
                        <td class="px-6 py-5">
                            <span class="px-2 py-1 rounded-md text-xs bg-blue-50 text-blue-700 font-semibold">
                                {{ $user->role->role_name ?? '-' }}
                            </span>
                        </td>

                        {{-- DUSUN --}}
                        <td class="px-6 py-5 text-gray-600">
                            {{ $user->dusun->nama_dusun ?? '-' }}
                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-5 text-gray-600">
                            {{ $user->email }}
                        </td>

                        {{-- NO HP --}}
                        <td class="px-6 py-5 text-gray-600">
                            {{ $user->nomor_telepon ?? '-' }}
                        </td>

                        {{-- PENDIDIKAN (SUDAH SESUAI ENUM DB) --}}
                        <td class="px-6 py-5 text-gray-600">
                            {{ $user->pendidikan_terakhir ?? '-' }}
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center gap-2">

                                {{-- EDIT --}}
                                <a href="{{ route('admin.users.edit', $user->user_id) }}"
                                class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:text-[#1D2059] hover:border-[#1D2059] hover:bg-[#1D2059]/5 transition">

                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                            m-1.414-9.414a2 2 0 112.828 2.828
                                            L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>

                                </a>

                                {{-- DELETE --}}
                                <div x-data="{ open: false }">

                                    <button
                                        @click="open = true"
                                        class="w-10 h-10 rounded-xl border border-red-100 flex items-center justify-center text-red-500 hover:bg-red-50 hover:border-red-200 transition"
                                    >

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7
                                                m5 4v6m4-6v6
                                                M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
                                        </svg>

                                    </button>

                                    {{-- MODAL --}}
                                    <div x-show="open"
                                        x-cloak
                                        class="fixed inset-0 z-[9999] flex items-center justify-center px-4">

                                        <div class="absolute inset-0 bg-black/50" @click="open=false"></div>

                                        <div class="relative bg-white w-full max-w-md rounded-3xl p-6 shadow-2xl">

                                            <h2 class="text-xl font-bold text-center text-[#1D2059]">
                                                Hapus User?
                                            </h2>

                                            <p class="text-sm text-gray-500 text-center mt-2">
                                                User <span class="font-semibold text-[#1D2059]">{{ $user->nama_lengkap }}</span> akan dihapus.
                                            </p>

                                            <div class="flex justify-center gap-3 mt-6">

                                                <button
                                                    @click="open=false"
                                                    class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition"
                                                >
                                                    Batal
                                                </button>

                                                <form method="POST"
                                                    action="{{ route('admin.users.destroy', $user->user_id) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 transition"
                                                    >
                                                        Hapus
                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-14 text-center text-gray-400">
                            Belum ada data user
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- AUTO SEARCH --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    let timeout;

    searchInput?.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => searchForm.submit(), 500);
    });
});
</script>

@endsection