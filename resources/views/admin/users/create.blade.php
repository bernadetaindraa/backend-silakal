@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <h1 class="text-2xl font-bold text-[#1D2059]">Tambah User</h1>
        <p class="text-sm text-gray-500 mt-1">Buat akun pengguna baru</p>
    </div>

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.users.store') }}"
          class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-6"
          x-data="{ open:false, showPass:false, showPassConfirm:false }">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- ROLE --}}
            <div>
                <label class="text-sm font-medium">Role *</label>
                <select name="role_id"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                        @error('role_id') border-red-500 @else border-gray-200 @enderror">
                    <option value="">Pilih Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DUSUN --}}
            <div>
                <label class="text-sm font-medium">Dusun *</label>
                <select name="dusun_id"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                        @error('dusun_id') border-red-500 @else border-gray-200 @enderror">
                    <option value="">Pilih Dusun</option>
                    @foreach($dusun as $d)
                        <option value="{{ $d->dusun_id }}" {{ old('dusun_id') == $d->dusun_id ? 'selected' : '' }}>
                            {{ $d->nama_dusun }}
                        </option>
                    @endforeach
                </select>
                @error('dusun_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIK --}}
            <div>
                <label class="text-sm font-medium">NIK *</label>
                <input type="text" name="nik" value="{{ old('nik') }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                       @error('nik') border-red-500 @else border-gray-200 @enderror"
                       maxlength="16">
                @error('nik')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NAMA --}}
            <div>
                <label class="text-sm font-medium">Nama Lengkap *</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                       @error('nama_lengkap') border-red-500 @else border-gray-200 @enderror">
                @error('nama_lengkap')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TEMPAT LAHIR --}}
            <div>
                <label class="text-sm font-medium">Tempat Lahir *</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                       @error('tempat_lahir') border-red-500 @else border-gray-200 @enderror">
                @error('tempat_lahir')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TANGGAL LAHIR --}}
            <div>
                <label class="text-sm font-medium">Tanggal Lahir *</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                       @error('tanggal_lahir') border-red-500 @else border-gray-200 @enderror">
                @error('tanggal_lahir')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- JENIS KELAMIN (REGISTER STYLE) --}}
            <div>
                <label class="text-sm font-medium">Jenis Kelamin *</label>
                <select name="jenis_kelamin"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                        @error('jenis_kelamin') border-red-500 @else border-gray-200 @enderror">
                    <option value="">Pilih</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- AGAMA --}}
            <div>
                <label class="text-sm font-medium">Agama *</label>
                <select name="agama"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                        @error('agama') border-red-500 @else border-gray-200 @enderror">
                    <option value="">Pilih</option>
                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $a)
                        <option value="{{ $a }}" {{ old('agama')==$a ? 'selected' : '' }}>{{ $a }}</option>
                    @endforeach
                </select>
                @error('agama')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- STATUS --}}
            <div>
                <label class="text-sm font-medium">Status Perkawinan *</label>
                <select name="status_perkawinan"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                        @error('status_perkawinan') border-red-500 @else border-gray-200 @enderror">
                    <option value="">Pilih</option>
                    @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $s)
                        <option value="{{ $s }}" {{ old('status_perkawinan')==$s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                @error('status_perkawinan')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PEKERJAAN --}}
            <div>
                <label class="text-sm font-medium">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
            </div>

            {{-- PENDIDIKAN --}}
            <div>
                <label class="text-sm font-medium">Pendidikan *</label>
                <select name="pendidikan_terakhir"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                        @error('pendidikan_terakhir') border-red-500 @else border-gray-200 @enderror">
                    <option value="">Pilih</option>
                    @foreach(['Tidak Sekolah','SD','SMP','SMA/K','D3','S1','S2','S3'] as $p)
                        <option value="{{ $p }}" {{ old('pendidikan_terakhir')==$p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                @error('pendidikan_terakhir')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TELEPON --}}
            <div>
                <label class="text-sm font-medium">No Telepon *</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                       @error('nomor_telepon') border-red-500 @else border-gray-200 @enderror">
                @error('nomor_telepon')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-medium">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm
                       @error('email') border-red-500 @else border-gray-200 @enderror">
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="relative">
                <label class="text-sm font-medium">Password *</label>

                <input :type="showPass ? 'text' : 'password'"
                       name="password"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm pr-10">

                <button type="button"
                        class="absolute right-3 top-9 text-gray-500"
                        @click="showPass = !showPass">
                    👁
                </button>

                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="relative">
                <label class="text-sm font-medium">Konfirmasi Password *</label>

                <input :type="showPassConfirm ? 'text' : 'password'"
                       name="password_confirmation"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm pr-10">

                <button type="button"
                        class="absolute right-3 top-9 text-gray-500"
                        @click="showPassConfirm = !showPassConfirm">
                    👁
                </button>
            </div>

        </div>

        {{-- BUTTON + MODAL --}}
        <div class="flex justify-end gap-3 pt-5" x-data="{ open:false }">

            <a href="{{ route('admin.users.index') }}"
               class="px-5 py-2.5 bg-gray-100 rounded-xl">
                Batal
            </a>

            <button type="button"
                    @click="open=true"
                    class="px-5 py-2.5 bg-[#1D2059] text-white rounded-xl">
                Simpan
            </button>

            {{-- MODAL --}}
            <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-[9999]">

                <div class="absolute inset-0 bg-black/50" @click="open=false"></div>

                <div class="bg-white p-6 rounded-2xl w-full max-w-md relative">

                    <h2 class="text-lg font-bold text-center">Konfirmasi</h2>
                    <p class="text-sm text-gray-500 text-center mt-2">
                        Yakin ingin membuat user baru?
                    </p>

                    <div class="flex justify-center gap-3 mt-6">

                        <button type="button"
                                @click="open=false"
                                class="px-4 py-2 bg-gray-100 rounded-xl">
                            Batal
                        </button>

                        <button type="submit"
                                class="px-4 py-2 bg-[#1D2059] text-white rounded-xl">
                            Simpan
                        </button>

                    </div>

                </div>
            </div>

        </div>

    </form>
</div>

@endsection