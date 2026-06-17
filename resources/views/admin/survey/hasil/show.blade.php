@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-[#1D2059]">
                    Detail Survey Responden
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $survey->jenis_layanan }} • {{ \Carbon\Carbon::parse($survey->tanggal_survey)->translatedFormat('d F Y') }}
                </p>
            </div>

            <a
                href="{{ route('admin.survey.index') }}"
                class="px-5 py-3 rounded-xl bg-gray-100 text-gray-700 text-sm font-medium hover:bg-gray-200 transition"
            >
                Kembali
            </a>

        </div>

    </div>

    {{-- DATA RESPONDEN --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KIRI --}}
        <div class="lg:col-span-1 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">

            <h2 class="text-lg font-bold text-[#1D2059] mb-4">
                Data Responden
            </h2>

            <div class="space-y-3 text-sm">

                <div>
                    <p class="text-gray-500">Jenis Layanan</p>
                    <p class="font-semibold text-[#1D2059]">{{ $survey->jenis_layanan }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Jenis Kelamin</p>
                    <p class="font-semibold">{{ $survey->jenis_kelamin_responden }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Umur</p>
                    <p class="font-semibold">{{ $survey->umur_responden }} Tahun</p>
                </div>

                <div>
                    <p class="text-gray-500">Pendidikan</p>
                    <p class="font-semibold">{{ $survey->pendidikan_responden }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Pekerjaan</p>
                    <p class="font-semibold">{{ $survey->pekerjaan_responden }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal Survey</p>
                    <p class="font-semibold">
                        {{ \Carbon\Carbon::parse($survey->tanggal_survey)->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Periode</p>
                    <p class="font-semibold">
                        {{ $survey->periodeSurvey->nama_periode ?? '-' }}
                    </p>
                </div>

            </div>

        </div>

        {{-- KANAN: JAWABAN --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">

            <h2 class="text-lg font-bold text-[#1D2059] mb-6">
                Jawaban Unsur Pelayanan
            </h2>

            <div class="space-y-6">

                @forelse($survey->detailJawaban as $detail)

                    <div class="border border-gray-100 rounded-xl p-5">

                        <p class="font-semibold text-gray-800 mb-3">
                            {{ $loop->iteration }}.
                            {{ $detail->pertanyaanSurvey->pertanyaan_survey ?? '-' }}
                        </p>

                        <div class="inline-block px-3 py-1 rounded-lg bg-blue-50 text-blue-700 text-sm font-semibold">
                            {{ $detail->opsiJawaban->opsi_jawaban ?? '-' }}
                        </div>

                    </div>

                @empty

                    <p class="text-center text-gray-400 py-10">
                        Tidak ada data jawaban
                    </p>

                @endforelse

            </div>

        </div>

    </div>

    {{-- SARAN --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">

        <h2 class="text-lg font-bold text-[#1D2059] mb-4">
            Kritik & Saran
        </h2>

        <p class="text-gray-700 text-sm leading-relaxed">

            {{ $survey->saran_masukan ?? 'Tidak ada saran' }}

        </p>

    </div>

</div>

@endsection