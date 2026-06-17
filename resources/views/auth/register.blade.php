@extends('layouts.public')

@section('content')
<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex justify-center items-center">
    
    <div class="max-w-5xl w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden grid grid-cols-1 md:grid-cols-12">        
        <div class="md:col-span-4 bg-[#1D2059] p-8 text-white flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full blur-xl"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-10 bg-teal-600 rounded flex items-center justify-center font-bold text-[9px] text-center leading-none text-white">
                        <img src="{{ asset('images/logo-kabupaten.png') }}" alt="Logo Kabupaten" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h2 class="text-[10px] uppercase tracking-wider text-gray-300 font-semibold leading-tight">Kalurahan</h2>
                        <p class="text-xs font-bold tracking-wide">Hargobinangun</p>
                    </div>
                </div>
                
                <h3 class="text-xl font-bold leading-tight mt-12">Pendaftaran Akun Warga</h3>
                <p class="text-xs text-gray-300 mt-2 leading-relaxed">Silakan isi data diri Anda sesuai dengan Kartu Keluarga atau KTP elektrik yang sah untuk menikmati layanan mandiri online.</p>
            </div>

            <div class="mt-12 md:mt-0 relative z-10">
                <p class="text-[11px] text-gray-400">Sudah punya akun?</p>
                <a href="{{ route('login') }}" class="mt-1 inline-block text-[11px] font-semibold uppercase tracking-wide text-blue-400 hover:text-blue-300 transition underline underline-offset-4">
                    Masuk ke Dashboard &rarr;
                </a>
            </div>
        </div>

        <div class="md:col-span-8 p-8 sm:p-10">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-[#1D2059]">Buat Akun Baru</h3>
                <p class="text-xs text-gray-400 mt-1">Pastikan data yang Anda masukkan benar demi kelancaran verifikasi sistem.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- NIK -->
                    <div class="sm:col-span-2">
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            NIK <span class="text-red-500">*</span>
                        </label>

                        <input 
                            type="text"
                            name="nik"
                            maxlength="16"
                            required
                            value="{{ old('nik') }}"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 focus:ring-2 focus:ring-[#1D2059] outline-none
                            @error('nik') border-red-500 @else border-gray-300 @enderror"
                        >

                        @error('nik')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama -->
                    <div class="sm:col-span-2">
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>

                        <input 
                            type="text"
                            name="nama_lengkap"
                            required
                            value="{{ old('nama_lengkap') }}"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl  mt-1 focus:ring-2 focus:ring-[#1D2059] outline-none
                            @error('nama_lengkap') border-red-500 @else border-gray-300 @enderror"
                        >

                        @error('nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- hidden role -->
                    <input type="hidden" name="role_id" value="3">

                    <!-- Dusun -->
                    <div class="sm:col-span-2">
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Dusun <span class="text-red-500">*</span>
                        </label>

                        <select 
                            name="dusun_id"
                            required
                            class="w-full px-4 py-2.5 text-sm border rounded-xl  mt-1 focus:ring-2 focus:ring-[#1D2059] outline-none
                            @error('dusun_id') border-red-500 @else border-gray-300 @enderror"
                        >
                            <option value="">Pilih Dusun</option>

                            @foreach($dusun as $d)
                                <option value="{{ $d->dusun_id }}"
                                    {{ old('dusun_id') == $d->dusun_id ? 'selected' : '' }}>
                                    {{ $d->nama_dusun }}
                                </option>
                            @endforeach
                        </select>

                        @error('dusun_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tempat lahir -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>

                        <input 
                            type="text"
                            name="tempat_lahir"
                            required
                            value="{{ old('tempat_lahir') }}"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                    </div>

                    <!-- tanggal lahir -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>

                        <input 
                            type="date"
                            name="tanggal_lahir"
                            required
                            value="{{ old('tanggal_lahir') }}"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                    </div>

                    <!-- Jenis kelamin -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>

                        <select 
                            name="jenis_kelamin"
                            required
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <!-- agama -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Agama <span class="text-red-500">*</span>
                        </label>

                        <select 
                            name="agama"
                            required
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                            <option value="">Pilih Agama</option>

                            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                                <option value="{{ $agama }}"
                                    {{ old('agama') == $agama ? 'selected' : '' }}>
                                    {{ $agama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- status perkawinan -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Status Perkawinan <span class="text-red-500">*</span>
                        </label>

                        <select 
                            name="status_perkawinan"
                            required
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                            <option value="">Pilih Status</option>

                            @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $status)
                                <option value="{{ $status }}"
                                    {{ old('status_perkawinan') == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- pekerjaan -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Pekerjaan
                        </label>

                        <input 
                            type="text"
                            name="pekerjaan"
                            value="{{ old('pekerjaan') }}"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                    </div>

                    <!-- pendidikan -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Pendidikan Terakhir <span class="text-red-500">*</span>
                        </label>

                        <select 
                            name="pendidikan_terakhir"
                            required
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                            <option value="">Pilih Pendidikan</option>

                            @foreach(['Tidak Sekolah','SD','SMP','SMA/K','D3','S1','S2','S3'] as $pendidikan)
                                <option value="{{ $pendidikan }}"
                                    {{ old('pendidikan_terakhir') == $pendidikan ? 'selected' : '' }}>
                                    {{ $pendidikan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- nomor telepon -->
                    <div class="sm:col-span-2">
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>

                        <input 
                            type="text"
                            name="nomor_telepon"
                            required
                            value="{{ old('nomor_telepon') }}"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                    </div>

                    <!-- email -->
                    <div class="sm:col-span-2">
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Email <span class="text-red-500">*</span>
                        </label>

                        <input 
                            type="email"
                            name="email"
                            required
                            value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                    </div>

                    <!-- password -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Password <span class="text-red-500">*</span>
                        </label>

                        <input 
                            type="password"
                            name="password"
                            required
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                    </div>

                    <!-- konfirmasi -->
                    <div>
                        <label class="text-[11px] font-semibold uppercase tracking-wide text-gray-700">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>

                        <input 
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full px-4 py-2.5 text-sm border rounded-xl mt-1 border-gray-300 focus:ring-2 focus:ring-[#1D2059] outline-none"
                        >
                    </div>

                </div>

                <!-- checkbox -->
                <div class="flex items-start gap-2">
                    <input 
                        type="checkbox"
                        name="terms"
                        required
                        class="mt-1 w-4 h-4 text-[#1D2059] border-gray-300 rounded"
                    >

                    <p class="text-xs text-gray-500 leading-relaxed">
                        Saya setuju dengan 
                        <a href="#" class="text-blue-600 hover:underline">
                            syarat dan ketentuan
                        </a>.
                    </p>
                </div>

                <button 
                    type="submit"
                    class="w-full bg-[#1D2059] hover:bg-[#161847] transition text-white py-3 rounded-xl font-semibold"
                >
                    Daftar Akun
                </button>

            </form>
        </div>

    </div>
</div>
@endsection