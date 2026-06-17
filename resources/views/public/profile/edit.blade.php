@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-[#F4F7FB] py-10 font-['Montserrat']">

    <div class="max-w-5xl mx-auto px-4">

        {{-- HEADER --}}
        <div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#1D2059] via-[#28306F] to-[#3949AB] shadow-2xl mb-8">

            <div class="absolute -top-20 -right-20 w-72 h-72 bg-white/10 rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-56 h-56 bg-white/5 rounded-full"></div>

            <div class="relative z-10 p-8 md:p-10">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-white">
                            Edit Profile
                        </h1>

                        <p class="text-blue-100 mt-3 text-sm">
                            Kelola informasi akun dan keamanan profile Anda
                        </p>

                    </div>

                    <a href="{{ route('user.profile') }}"
                        class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-white/15 hover:bg-white/25 border border-white/20 backdrop-blur text-white text-sm font-bold transition">

                        Kembali

                    </a>

                </div>

            </div>

        </div>

        {{-- ALERT --}}
        @if(session('success'))

            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700 font-medium">
                {{ session('success') }}
            </div>

        @endif

        {{-- ERROR --}}
        @if($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <p class="font-bold text-red-700 mb-2">
                    Terjadi kesalahan:
                </p>

                <ul class="list-disc pl-5 text-sm text-red-600 space-y-1">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- FORM PROFILE --}}
        <form
            action="{{ route('user.profile.update') }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8"
        >

            @csrf
            @method('PUT')

            {{-- FOTO PROFILE --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-6 pb-8 border-b border-gray-100">

                <div class="relative">

                    @if(Auth::user()->url_foto_profil)

                        <img
                            src="{{ asset('storage/' . Auth::user()->url_foto_profil) }}"
                            class="w-28 h-28 rounded-3xl object-cover border-4 border-blue-100 shadow-lg"
                        >

                    @else

                        <div class="w-28 h-28 rounded-3xl bg-gradient-to-r from-[#1D2059] to-blue-600 flex items-center justify-center text-4xl font-bold text-white shadow-lg">

                            {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}

                        </div>

                    @endif

                </div>

                <div class="flex-1">

                    <h3 class="text-lg font-bold text-[#1D2059]">
                        Foto Profile
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 mb-4">
                        Upload foto profile baru dengan format JPG, JPEG, atau PNG.
                    </p>

                    <input
                        type="file"
                        name="url_foto_profil"
                        class="block w-full text-sm text-gray-500
                        file:mr-4
                        file:py-3
                        file:px-5
                        file:rounded-2xl
                        file:border-0
                        file:text-sm
                        file:font-bold
                        file:bg-[#1D2059]
                        file:text-white
                        hover:file:bg-blue-700"
                    >

                </div>

            </div>

            {{-- FORM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                {{-- NAMA --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="nama_lengkap"
                        value="{{ old('nama_lengkap', Auth::user()->nama_lengkap) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- EMAIL --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', Auth::user()->email) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- NIK --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        NIK
                    </label>

                    <input
                        type="text"
                        name="nik"
                        value="{{ old('nik', Auth::user()->nik) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- TELEPON --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        name="nomor_telepon"
                        value="{{ old('nomor_telepon', Auth::user()->nomor_telepon) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- TEMPAT LAHIR --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Tempat Lahir
                    </label>

                    <input
                        type="text"
                        name="tempat_lahir"
                        value="{{ old('tempat_lahir', Auth::user()->tempat_lahir) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- TANGGAL LAHIR --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', Auth::user()->tanggal_lahir ? \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->format('Y-m-d') : '') }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- JENIS KELAMIN --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                        <option value="">Pilih Jenis Kelamin</option>

                        <option value="Laki-laki"
                            {{ Auth::user()->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="Perempuan"
                            {{ Auth::user()->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>

                </div>

                {{-- AGAMA --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Agama
                    </label>

                    <input
                        type="text"
                        name="agama"
                        value="{{ old('agama', Auth::user()->agama) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- PEKERJAAN --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Pekerjaan
                    </label>

                    <input
                        type="text"
                        name="pekerjaan"
                        value="{{ old('pekerjaan', Auth::user()->pekerjaan) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- STATUS --}}
                <div>

                    <label class="text-sm font-bold text-gray-700">
                        Status Perkawinan
                    </label>

                    <input
                        type="text"
                        name="status_perkawinan"
                        value="{{ old('status_perkawinan', Auth::user()->status_perkawinan) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

                {{-- PENDIDIKAN --}}
                <div class="md:col-span-2">

                    <label class="text-sm font-bold text-gray-700">
                        Pendidikan Terakhir
                    </label>

                    <input
                        type="text"
                        name="pendidikan_terakhir"
                        value="{{ old('pendidikan_terakhir', Auth::user()->pendidikan_terakhir) }}"
                        class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                    >

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-10 flex justify-end">

                <button
                    type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-[#1D2059] to-blue-700 hover:opacity-90 text-white rounded-2xl font-bold shadow-xl transition"
                >

                    Simpan Perubahan

                </button>

            </div>

        </form>

        {{-- UBAH PASSWORD --}}
        <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 p-8 mt-8">

            <h2 class="text-2xl font-bold text-[#1D2059]">
                Ubah Password
            </h2>

            <p class="text-sm text-gray-500 mt-2 mb-8">
                Gunakan password yang kuat dan aman.
            </p>

            <form action="{{ route('user.profile.password') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">

                    <div>

                        <label class="text-sm font-bold text-gray-700">
                            Password Lama
                        </label>

                        <input
                            type="password"
                            name="current_password"
                            class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                        >

                    </div>

                    <div>

                        <label class="text-sm font-bold text-gray-700">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                        >

                    </div>

                    <div>

                        <label class="text-sm font-bold text-gray-700">
                            Konfirmasi Password Baru
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="mt-2 w-full rounded-2xl border-gray-300 focus:ring-[#1D2059] focus:border-[#1D2059]"
                        >

                    </div>

                </div>

                <div class="mt-8 flex justify-end">

                    <button
                        type="submit"
                        class="px-8 py-4 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-bold shadow-lg transition"
                    >

                        Ubah Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection