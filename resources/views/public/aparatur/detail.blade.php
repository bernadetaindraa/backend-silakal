@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'Aparatur Kalurahan Hargobinangun',
        'subtitle' => 'ꦄꦥꦫꦠꦸꦂ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦁꦒꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

            <div class="border-b border-gray-200 pb-6 mb-8">
                <h1 class="text-3xl font-bold text-blue-950 mb-2">
                    {{ $aparatur->user->nama_lengkap }}
                </h1>

                <p class="text-lg text-gray-500">
                    {{ $aparatur->nama_jabatan }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                <div class="lg:col-span-1">
                    <div class="bg-blue-50 rounded-2xl p-8 text-center border border-blue-100">

                        <div class="w-28 h-28 rounded-full bg-blue-100 mx-auto flex items-center justify-center text-3xl font-bold text-blue-900 mb-5">
                            {{ strtoupper(substr($aparatur->user->nama_lengkap, 0, 1)) }}
                        </div>

                        <h2 class="text-xl font-bold text-blue-950 mb-2">
                            {{ $aparatur->user->nama_lengkap }}
                        </h2>

                        <p class="text-gray-500">
                            {{ $aparatur->nama_jabatan }}
                        </p>

                    </div>
                </div>

                <div class="lg:col-span-2 space-y-10">

                    <div>
                        <h3 class="text-xl font-bold text-blue-950 mb-5">
                            Informasi Aparatur
                        </h3>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                                <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">
                                    {{ $aparatur->user->nama_lengkap }}
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                                <p class="text-sm text-gray-500 mb-1">Jabatan</p>
                                <p class="font-semibold text-gray-800">
                                    {{ $aparatur->nama_jabatan }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-blue-950 mb-5">
                            Riwayat Pendidikan
                        </h3>

                        @if($aparatur->riwayatPendidikan->count())

                            <div class="space-y-4">

                                @foreach($aparatur->riwayatPendidikan as $pendidikan)

                                    <div class="border border-gray-100 rounded-xl p-5 bg-gray-50">

                                        <h4 class="font-bold text-gray-800 mb-1">
                                            {{ $pendidikan->tingkat_pendidikan }}
                                        </h4>

                                        <p class="text-sm text-gray-600">
                                            {{ $pendidikan->nama_instansi }}
                                        </p>

                                        @if($pendidikan->jurusan)
                                            <p class="text-sm text-gray-500 mt-1">
                                                Jurusan: {{ $pendidikan->jurusan }}
                                            </p>
                                        @endif

                                        <p class="text-sm text-gray-400 mt-2">
                                            {{ $pendidikan->tahun_masuk }} - {{ $pendidikan->tahun_selesai }}
                                        </p>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="bg-gray-50 border border-dashed border-gray-200 rounded-xl p-6 text-gray-500 text-sm">
                                Belum ada data pendidikan.
                            </div>

                        @endif
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-blue-950 mb-5">
                            Riwayat Jabatan
                        </h3>

                        @if($aparatur->riwayatJabatan->count())

                            <div class="overflow-x-auto rounded-xl border border-gray-100">

                                <table class="min-w-full text-sm">

                                    <thead class="bg-blue-950 text-white">
                                        <tr>
                                            <th class="px-5 py-4 text-left">Jabatan</th>
                                            <th class="px-5 py-4 text-left">Nomor SK</th>
                                            <th class="px-5 py-4 text-left">Periode</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-100 bg-white">

                                        @foreach($aparatur->riwayatJabatan as $jabatan)

                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-5 py-4 font-medium text-gray-800">
                                                    {{ $jabatan->nama_jabatan }}
                                                </td>

                                                <td class="px-5 py-4 text-gray-600">
                                                    {{ $jabatan->nomor_sk }}
                                                </td>

                                                <td class="px-5 py-4 text-gray-500">
                                                    {{ \Carbon\Carbon::parse($jabatan->tanggal_mulai)->format('Y') }}
                                                    -
                                                    {{ $jabatan->tanggal_selesai ? \Carbon\Carbon::parse($jabatan->tanggal_selesai)->format('Y') : 'Sekarang' }}
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        @else

                            <div class="bg-gray-50 border border-dashed border-gray-200 rounded-xl p-6 text-gray-500 text-sm">
                                Belum ada riwayat jabatan.
                            </div>

                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection