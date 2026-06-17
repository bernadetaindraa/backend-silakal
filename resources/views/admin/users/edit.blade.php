@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <h1 class="text-2xl font-bold text-[#1D2059]">Edit User</h1>
        <p class="text-sm text-gray-500 mt-1">Perbarui data pengguna</p>
    </div>

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.users.update', $user->user_id) }}"
          class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-5">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- ROLE --}}
            <div>
                <label class="text-sm font-medium">Role</label>
                <select name="role_id"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
                    @foreach($roles as $role)
                        <option value="{{ $role->role_id }}"
                            {{ $user->role_id == $role->role_id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- DUSUN --}}
            <div>
                <label class="text-sm font-medium">Dusun</label>
                <select name="dusun_id"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
                    @foreach($dusun as $d)
                        <option value="{{ $d->dusun_id }}"
                            {{ $user->dusun_id == $d->dusun_id ? 'selected' : '' }}>
                            {{ $d->nama_dusun }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- NIK --}}
            <div>
                <label class="text-sm font-medium">NIK</label>
                <input type="text" name="nik"
                       value="{{ $user->nik }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
            </div>

            {{-- NAMA --}}
            <div>
                <label class="text-sm font-medium">Nama Lengkap</label>
                <input type="text" name="nama_lengkap"
                       value="{{ $user->nama_lengkap }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
            </div>

            {{-- TEMPAT LAHIR --}}
            <div>
                <label class="text-sm font-medium">Tempat Lahir</label>
                <input type="text" name="tempat_lahir"
                       value="{{ $user->tempat_lahir }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
            </div>

            {{-- TANGGAL LAHIR --}}
            <div>
                <label class="text-sm font-medium">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                       value="{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
            </div>

            {{-- JENIS KELAMIN (DROPDOWN FIX) --}}
            <div>
                <label class="text-sm font-medium">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
                    <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
            </div>

            {{-- AGAMA (DROPDOWN FIX) --}}
            <div>
                <label class="text-sm font-medium">Agama</label>
                <select name="agama"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                        <option value="{{ $agama }}" {{ $user->agama == $agama ? 'selected' : '' }}>
                            {{ $agama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STATUS PERKAWINAN (DROPDOWN FIX) --}}
            <div>
                <label class="text-sm font-medium">Status Perkawinan</label>
                <select name="status_perkawinan"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
                    @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $status)
                        <option value="{{ $status }}" {{ $user->status_perkawinan == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PEKERJAAN --}}
            <div>
                <label class="text-sm font-medium">Pekerjaan</label>
                <input type="text" name="pekerjaan"
                       value="{{ $user->pekerjaan }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
            </div>

            {{-- PENDIDIKAN (DROPDOWN FIX) --}}
            <div>
                <label class="text-sm font-medium">Pendidikan Terakhir</label>
                <select name="pendidikan_terakhir"
                        class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
                    @foreach(['Tidak Sekolah','SD','SMP','SMA/K','D3','S1','S2','S3'] as $edu)
                        <option value="{{ $edu }}" {{ $user->pendidikan_terakhir == $edu ? 'selected' : '' }}>
                            {{ $edu }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TELEPON --}}
            <div>
                <label class="text-sm font-medium">No Telepon</label>
                <input type="text" name="nomor_telepon"
                       value="{{ $user->nomor_telepon }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email"
                       value="{{ $user->email }}"
                       class="w-full mt-1 border rounded-xl px-4 py-3 text-sm">
            </div>

            {{-- PASSWORD OPTIONAL --}}
            <div class="md:col-span-2" x-data="{ show: false }">

                <label class="text-sm font-medium">Password (opsional)</label>

                <div class="relative mt-1">

                    <input 
                        :type="show ? 'text' : 'password'"
                        name="password"
                        class="w-full border rounded-xl px-4 py-3 text-sm pr-12"
                        placeholder="Kosongkan jika tidak diubah"
                    >

                    <button 
                        type="button"
                        @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"
                    >
                        👁
                    </button>

                </div>
            </div>

            {{-- CONFIRM PASSWORD OPTIONAL --}}
            <div class="md:col-span-2" x-data="{ show: false }">

                <label class="text-sm font-medium">Konfirmasi Password</label>

                <div class="relative mt-1">

                    <input 
                        :type="show ? 'text' : 'password'"
                        name="password_confirmation"
                        class="w-full border rounded-xl px-4 py-3 text-sm pr-12"
                        placeholder="Ulangi password jika diubah"
                    >

                    <button 
                        type="button"
                        @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"
                    >
                        👁
                    </button>

                </div>

            </div>

        </div>

        {{-- BUTTON + MODAL --}}
        <div x-data="{ open: false }" class="flex justify-end gap-3 pt-5">

            <a href="{{ route('admin.users.index') }}"
               class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700">
                Batal
            </a>

            <button type="button"
                    @click="open = true"
                    class="px-5 py-2.5 rounded-xl bg-[#1D2059] text-white">
                Simpan
            </button>

            {{-- MODAL --}}
            <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-[9999]">

                <div class="absolute inset-0 bg-black/50" @click="open=false"></div>

                <div class="relative bg-white p-6 rounded-2xl w-full max-w-md">

                    <h2 class="text-lg font-bold text-center">Konfirmasi</h2>
                    <p class="text-sm text-gray-500 text-center mt-2">
                        Yakin ingin menyimpan perubahan?
                    </p>

                    <div class="flex justify-center gap-3 mt-6">

                        <button type="button"
                                @click="open=false"
                                class="px-4 py-2 bg-gray-100 rounded-xl">
                            Batal
                        </button>

                        <button type="submit"
                                class="px-4 py-2 bg-[#1D2059] text-white rounded-xl">
                            Ya Simpan
                        </button>

                    </div>

                </div>
            </div>

        </div>

    </form>

</div>

@endsection