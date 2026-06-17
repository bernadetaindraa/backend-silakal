@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-[#1D2059]">
                Sampah Produk Hukum
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Daftar produk hukum yang telah dihapus sementara
            </p>
        </div>

        <a href="{{ route('admin.produk-hukum.index') }}"
           class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
            Kembali
        </a>

    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))

        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl"
        >
            {{ session('success') }}
        </div>

    @endif

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">

                    <tr class="text-left text-gray-500">

                        <th class="px-6 py-4 font-semibold">
                            Nama Dokumen
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Nomor Dokumen
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Kategori
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Tanggal Ditetapkan
                        </th>

                        <th class="px-6 py-4 font-semibold text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    {{-- Menggunakan $data karena dikirim dari compact('data') di controller --}}
                    @forelse($data as $item)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- NAMA DOKUMEN --}}
                            <td class="px-6 py-4">

                                <div class="font-semibold text-[#1D2059] line-clamp-2">
                                    {{ $item->nama_dokumen }}
                                </div>

                            </td>

                            {{-- NOMOR DOKUMEN --}}
                            <td class="px-6 py-4 text-gray-600">

                                {{ $item->nomor_dokumen }}

                            </td>

                            {{-- KATEGORI --}}
                            <td class="px-6 py-4 text-gray-600">

                                <span class="px-3 py-1 rounded-xl bg-gray-100 text-xs text-gray-700">
                                    {{ $item->kategori_dokumen }}
                                </span>

                            </td>

                            {{-- TANGGAL DITETAPKAN --}}
                            <td class="px-6 py-4 text-gray-500">

                                {{ \Carbon\Carbon::parse($item->tanggal_ditetapkan)->translatedFormat('d F Y') }}

                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- RESTORE --}}
                                    <form
                                        {{-- Sesuaikan 'id' dengan primary key model Anda jika bukan 'id' --}}
                                        action="{{ url('admin/produk-hukum/restore/' . $item->id) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="px-4 py-2 rounded-xl bg-blue-100 text-blue-700 hover:bg-blue-200 transition text-xs font-semibold"
                                        >
                                            Restore
                                        </button>

                                    </form>

                                    {{-- DELETE PERMANENT --}}
                                    <form
                                        action="{{ url('admin/produk-hukum/force-delete/' . $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus permanen data produk hukum ini beserta file fisiknya?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200 transition text-xs font-semibold"
                                        >
                                            Hapus Permanen
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">

                                Belum ada data produk hukum di sampah

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection