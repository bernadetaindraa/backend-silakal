@extends('layouts.public')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    @include('public.partials.banner', [
        'title' => 'BPKal Kalurahan Hargobinangun',
        'subtitle' => 'ꦧꦥꦺꦏꦭ꧀ ꦏꦭꦸꦫꦲꦤ꧀ ꦲꦂꦒꦺꦴꦧꦶꦤꦁꦒꦸꦤ꧀',
    ])

    <div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

            <div class="border-b border-gray-200 pb-6 mb-8">
                <h1 class="text-3xl font-bold text-blue-950 mb-2">
                    {{ $anggota->user->nama_lengkap }}
                </h1>

                <p class="text-lg text-gray-500">
                    {{ $anggota->jabatan }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                <div class="lg:col-span-1">
                    <div class="bg-blue-50 rounded-2xl p-8 text-center border border-blue-100">

                        <div class="w-28 h-28 rounded-full bg-blue-100 mx-auto flex items-center justify-center text-3xl font-bold text-blue-900 mb-5">
                            {{ strtoupper(substr($anggota->user->nama_lengkap, 0, 1)) }}
                        </div>

                        <h2 class="text-xl font-bold text-blue-950 mb-2">
                            {{ $anggota->user->nama_lengkap }}
                        </h2>

                        <p class="text-gray-500">
                            {{ $anggota->jabatan }}
                        </p>

                    </div>
                </div>

                <div class="lg:col-span-2">

                    <h3 class="text-xl font-bold text-blue-950 mb-5">
                        Informasi Anggota BPKal
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-5">

                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <p class="text-sm text-gray-500 mb-1">
                                Nama Lengkap
                            </p>

                            <p class="font-semibold text-gray-800">
                                {{ $anggota->user->nama_lengkap }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <p class="text-sm text-gray-500 mb-1">
                                Jabatan
                            </p>

                            <p class="font-semibold text-gray-800">
                                {{ $anggota->jabatan }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <p class="text-sm text-gray-500 mb-1">
                                Agama
                            </p>

                            <p class="font-semibold text-gray-800">
                                {{ $anggota->user->agama ?? '-' }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <p class="text-sm text-gray-500 mb-1">
                                Pendidikan
                            </p>

                            <p class="font-semibold text-gray-800">
                                {{ $anggota->user->pendidikan_terakhir ?? '-' }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 sm:col-span-2">
                            <p class="text-sm text-gray-500 mb-1">
                                Wilayah Musyawarah
                            </p>

                            <p class="font-semibold text-gray-800">
                                {{ $anggota->wilayah_musyawarah ?: '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection