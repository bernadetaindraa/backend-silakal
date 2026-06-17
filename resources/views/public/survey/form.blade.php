@extends('layouts.public')

@section('content')
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- BREADCRUMB --}}
        <nav class="text-sm text-gray-500 mb-10">
            <a href="/" class="hover:text-blue-600 transition">
                Beranda
            </a>

            &gt;

            <span class="text-gray-400">
                Survey dan Pengaduan
            </span>

            &gt;

            <span class="text-blue-600 font-medium">
                Survey IKM
            </span>
        </nav>

        {{-- HEADER --}}
        <div class="text-center mb-10">

            <h1 class="text-3xl font-extrabold text-[#1D2059] tracking-tight">
                Survey Kepuasan Masyarakat (IKM)
            </h1>

            <p class="text-base text-gray-500 mt-2">
                Pengukuran tingkat kepuasan masyarakat terhadap pelayanan kalurahan
            </p>

        </div>

        {{-- CARD --}}
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-10">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR --}}
            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- VALIDATION --}}
            @if ($errors->any())

                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">

                    <ul class="list-disc pl-5 text-sm text-red-600 space-y-1">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- FORM --}}
            <form
                action="{{ route('survey-ikm.store') }}"
                method="POST"
                class="space-y-8"
            >

                @csrf

                {{-- DATA RESPONDEN --}}
                <div>

                    <h3 class="text-sm font-bold text-[#1D2059] border-b border-gray-200 pb-2 mb-6 uppercase tracking-wider">
                        Data Responden
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- UMUR --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Umur
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                name="umur_responden"
                                value="{{ old('umur_responden') }}"
                                placeholder="Isi umur anda"
                                min="1"
                                required
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >

                        </div>

                        {{-- JENIS KELAMIN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Kelamin
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="jenis_kelamin_responden"
                                required
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >

                                <option value="">
                                    Pilih Jenis Kelamin
                                </option>

                                <option
                                    value="Laki-laki"
                                    {{ old('jenis_kelamin_responden') == 'Laki-laki' ? 'selected' : '' }}
                                >
                                    Laki-laki
                                </option>

                                <option
                                    value="Perempuan"
                                    {{ old('jenis_kelamin_responden') == 'Perempuan' ? 'selected' : '' }}
                                >
                                    Perempuan
                                </option>

                            </select>

                        </div>

                        {{-- PENDIDIKAN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Pendidikan Terakhir
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="pendidikan_responden"
                                required
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >

                                <option value="">
                                    Pilih Pendidikan Terakhir
                                </option>

                                <option value="Tidak Sekolah" {{ old('pendidikan_responden') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                    Tidak Sekolah
                                </option>

                                <option value="Tidak Tamat SD/Sederajat" {{ old('pendidikan_responden') == 'Tidak Tamat SD/Sederajat' ? 'selected' : '' }}>
                                    Tidak Tamat SD / Sederajat
                                </option>

                                <option value="Tamat SD/Sederajat" {{ old('pendidikan_responden') == 'Tamat SD/Sederajat' ? 'selected' : '' }}>
                                    Tamat SD / Sederajat
                                </option>

                                <option value="Tidak Tamat SMP/Sederajat" {{ old('pendidikan_responden') == 'Tidak Tamat SMP/Sederajat' ? 'selected' : '' }}>
                                    Tidak Tamat SMP / Sederajat
                                </option>

                                <option value="Tamat SMP/Sederajat" {{ old('pendidikan_responden') == 'Tamat SMP/Sederajat' ? 'selected' : '' }}>
                                    Tamat SMP / Sederajat
                                </option>

                                <option value="Tidak Tamat SMA/Sederajat" {{ old('pendidikan_responden') == 'Tidak Tamat SMA/Sederajat' ? 'selected' : '' }}>
                                    Tidak Tamat SMA / Sederajat
                                </option>

                                <option value="Tamat SMA/Sederajat" {{ old('pendidikan_responden') == 'Tamat SMA/Sederajat' ? 'selected' : '' }}>
                                    Tamat SMA / SMK / Sederajat
                                </option>

                                <option value="Tamat D1/D2/D3" {{ old('pendidikan_responden') == 'Tamat D1/D2/D3' ? 'selected' : '' }}>
                                    Tamat D1 / D2 / D3
                                </option>

                                <option value="Tamat S1/S2/S3" {{ old('pendidikan_responden') == 'Tamat S1/S2/S3' ? 'selected' : '' }}>
                                    Tamat S1 / S2 / S3
                                </option>

                            </select>

                        </div>

                        {{-- PEKERJAAN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Pekerjaan
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="pekerjaan_responden"
                                required
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >

                                <option value="">
                                    Pilih Pekerjaan
                                </option>

                                <option value="PNS / TNI / Polri">
                                    PNS / TNI / Polri
                                </option>

                                <option value="Pegawai Swasta">
                                    Pegawai Swasta
                                </option>

                                <option value="Wiraswasta / Usahawan">
                                    Wiraswasta / Usahawan
                                </option>

                                <option value="Petani / Buruh">
                                    Petani / Buruh
                                </option>

                                <option value="Pelajar / Mahasiswa">
                                    Pelajar / Mahasiswa
                                </option>

                                <option value="Lainnya">
                                    Lainnya
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- DETAIL LAYANAN --}}
                <div>

                    <h3 class="text-sm font-bold text-[#1D2059] border-b border-gray-200 pb-2 mb-6 uppercase tracking-wider">
                        Detail Layanan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- TANGGAL --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal
                            </label>

                            <input
                                type="text"
                                value="{{ date('d F Y') }}"
                                disabled
                                class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm text-gray-500"
                            >

                            <input
                                type="hidden"
                                name="tanggal_survey"
                                value="{{ date('Y-m-d') }}"
                            >

                        </div>

                        {{-- JENIS LAYANAN --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Layanan
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="jenis_layanan"
                                required
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >

                                <option value="">
                                    Pilih Jenis Layanan
                                </option>

                                <option value="Layanan Administrasi Kependudukan">
                                    Layanan Administrasi Kependudukan
                                </option>

                                <option value="Surat Keterangan Pengantar">
                                    Surat Keterangan Pengantar
                                </option>

                                <option value="Rekomendasi / Perizinan">
                                    Rekomendasi / Perizinan
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- PERTANYAAN SURVEY --}}
                <div>

                    <h3 class="text-sm font-bold text-[#1D2059] border-b border-gray-200 pb-2 mb-6 uppercase tracking-wider">
                        Unsur Pelayanan
                    </h3>

                    <div class="space-y-6">

                        @forelse($pertanyaanList as $index => $q)

                            <div class="border-b border-gray-100 pb-5">

                                {{-- PERTANYAAN --}}
                                <p class="text-sm font-medium text-gray-800 mb-3">

                                    {{ $index + 1 }}.

                                    {{ $q->pertanyaan_survey }}

                                    <span class="text-red-500">*</span>

                                </p>

                                {{-- HIDDEN QUESTION ID --}}
                                <input
                                    type="hidden"
                                    name="detail_jawaban[{{ $index }}][pertanyaan_survey_id]"
                                    value="{{ $q->pertanyaan_survey_id }}"
                                >

                                {{-- OPSI --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">

                                    @foreach($q->opsiJawaban as $opsi)

                                        <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 text-sm transition">

                                            <input
                                                type="radio"
                                                name="detail_jawaban[{{ $index }}][opsi_jawaban_survey_id]"
                                                value="{{ $opsi->opsi_jawaban_survey_id }}"
                                                required
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                            >

                                            <span class="text-gray-700">
                                                {{ $opsi->opsi_jawaban }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        @empty

                            <div class="text-sm text-gray-500 text-center py-6 bg-gray-50 rounded-xl border border-gray-200">

                                Data pertanyaan survey belum tersedia.

                            </div>

                        @endforelse

                    </div>

                </div>

                {{-- SARAN --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Kritik dan Saran (Opsional)
                    </label>

                    <textarea
                        name="saran_masukan"
                        rows="4"
                        placeholder="Berikan kritik dan saran anda..."
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                    >{{ old('saran_masukan') }}</textarea>

                </div>

                {{-- SUBMIT --}}
                <div class="flex justify-end pt-4">

                    <button
                        type="submit"
                        class="px-14 py-3 bg-[#1D2059] hover:bg-blue-900 text-white font-bold rounded-full text-sm transition shadow-md"
                    >
                        Submit Survey
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection