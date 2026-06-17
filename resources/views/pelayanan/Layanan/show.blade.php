@extends('layouts.admin')

@section('content')
<div class="p-4 mx-auto space-y-6 md:p-6 max-w-7xl">

    {{-- HEADER & AKSI ATAS --}}
    <div class="flex flex-col justify-between gap-4 p-6 bg-white border border-gray-100 shadow-sm rounded-3xl md:flex-row md:items-center">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ route('pelayanan.layanan.index') }}" 
                   class="p-2 transition-colors bg-gray-50 hover:bg-gray-100 text-gray-500 hover:text-gray-700 rounded-xl" title="Kembali">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-[#1D2059] tracking-tight">
                    Detail Layanan
                </h1>
            </div>
            <p class="text-sm text-gray-500 ml-11">
                Informasi lengkap pengajuan dokumen dan layanan warga.
            </p>
        </div>

        {{-- STATUS & AKSI VIEW ONLY --}}
        <div class="flex flex-wrap items-center gap-3 ml-11 md:ml-0">
            <span class="px-3 py-1.5 rounded-xl text-sm font-bold shadow-sm uppercase tracking-wider {{ $layanan->status_badge }}">
                {{ $layanan->status_label ?? ucfirst($layanan->status_layanan) }}
            </span>

            <!-- {{-- TOMBOL PREVIEW & DOWNLOAD SURAT HASIL (Tampil jika file_surat ada) --}}
            @if(!empty($layanan->file_surat)) 
                <a href="{{ asset('storage/' . $layanan->file_surat) }}" target="_blank" 
                   class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-blue-700 transition-all bg-blue-50 shadow-sm hover:bg-blue-100 rounded-xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Preview Surat
                </a>
                <a href="{{ asset('storage/' . $layanan->file_surat) }}" download 
                   class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white transition-all bg-emerald-500 shadow-sm hover:bg-emerald-600 rounded-xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download Surat
                </a>
            @endif -->
        </div>
    </div>

    {{-- ALERT CATATAN PENOLAKAN --}}
    @if($layanan->status_layanan == 'ditolak' && $layanan->catatan_penolakan)
    <div class="flex items-start gap-4 p-5 border shadow-sm bg-red-50 border-red-200 rounded-3xl">
        <div class="p-2 text-red-600 bg-red-100 shrink-0 rounded-xl">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <h3 class="mb-1 font-bold text-red-800">Pengajuan Ditolak</h3>
            <p class="text-sm leading-relaxed text-red-700">
                <span class="font-semibold">Alasan/Catatan:</span> {{ $layanan->catatan_penolakan }}
            </p>
        </div>
    </div>
    @endif

    {{-- DATA UTAMA: DIBUAT DENGAN FORMAT TABEL CLEAN --}}
    <div class="grid gap-6 lg:grid-cols-2">

        {{-- TABEL INFORMASI PEMOHON --}}
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <div class="p-2 text-blue-600 bg-blue-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-[#1D2059]">Informasi Akun Pemohon</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Nama Lengkap</td>
                            <td class="px-6 py-3 font-semibold text-gray-900">{{ $layanan->user?->nama_lengkap ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">NIK</td>
                            <td class="px-6 py-3 font-mono font-semibold text-gray-900">{{ $layanan->user?->nik ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Tempat Lahir</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->user?->tempat_lahir ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Tanggal Lahir</td>
                            <td class="px-6 py-3 font-medium text-gray-800">
                                {{ $layanan->user?->tanggal_lahir ? \Carbon\Carbon::parse($layanan->user->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Jenis Kelamin</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->user?->jenis_kelamin ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Agama</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->user?->agama ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Pekerjaan</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->user?->pekerjaan ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Pendidikan</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->user?->pendidikan_terakhir ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Status Perkawinan</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->user?->status_perkawinan ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">No Telepon</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->user?->nomor_telepon ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- TABEL INFORMASI LAYANAN --}}
        <div class="flex flex-col overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <div class="p-2 text-amber-600 bg-amber-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-[#1D2059]">Rincian Pengajuan Layanan</h2>
            </div>

            <div class="flex-grow overflow-x-auto">
                <table class="w-full h-full text-sm text-left">
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Nomor Layanan</td>
                            <td class="px-6 py-3 font-mono font-bold text-[#1D2059]">{{ $layanan->nomor_layanan }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Jenis Layanan</td>
                            <td class="px-6 py-3 font-bold text-gray-900">{{ $layanan->jenis_layanan_label ?? $layanan->jenis_layanan }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Keperluan</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->keperluan_layanan ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Tanggal Pengajuan</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $layanan->created_at?->translatedFormat('d M Y, H:i') }}</td>
                        </tr>
                        <tr class="hover:bg-gray-50/50">
                            <td class="w-1/3 px-6 py-3 font-medium text-gray-500">Status</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ ucfirst($layanan->status_layanan) }}</td>
                        </tr>

                        {{-- Ekstrak Data Tambahan JSON ke dalam baris tabel --}}
                        @php
                            $extra = is_string($layanan->data_tambahan) ? json_decode($layanan->data_tambahan, true) : $layanan->data_tambahan;
                            // Memprioritaskan data yang sudah diformat jika ada
                            $extraData = !empty($layanan->formatted_data_tambahan) ? $layanan->formatted_data_tambahan : $extra;
                        @endphp
                        
                        @if(is_array($extraData) && count($extraData) > 0)
                            <tr>
                                <td colspan="2" class="px-6 py-2 text-xs font-bold tracking-widest text-center text-gray-400 uppercase bg-gray-50 border-y border-gray-200/60">
                                    Data Tambahan (Isian Warga)
                                </td>
                            </tr>
                            @foreach($extraData as $key => $val)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="w-1/3 px-6 py-3 font-medium text-gray-500">{{ ucfirst(str_replace('_',' ',$key)) }}</td>
                                    <td class="px-6 py-3 font-medium text-gray-800">
                                        @if(is_array($val))
                                            <ul class="list-disc list-inside">
                                                @foreach($val as $item) <li>{{ $item }}</li> @endforeach
                                            </ul>
                                        @else
                                            {{ $val }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TABEL LAMPIRAN DOKUMEN & TOMBOL PREVIEW/DOWNLOAD --}}
    <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <div class="flex items-center gap-3">
                <div class="p-2 text-indigo-600 bg-indigo-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-[#1D2059]">Dokumen Persyaratan (Lampiran Warga)</h2>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left whitespace-nowrap">
                <thead class="text-xs tracking-wider text-gray-500 uppercase bg-gray-50/30">
                    <tr>
                        <th class="w-16 px-6 py-4 font-semibold text-center">No</th>
                        <th class="px-6 py-4 font-semibold">Jenis Dokumen</th>
                        <th class="w-64 px-6 py-4 font-semibold text-center">Aksi Dokumen</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100">
                    @forelse($layanan->lampiranLayanan as $index => $lampiran)
                        <tr class="transition-colors hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $lampiran->jenis_dokumen }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- PREVIEW BUTTON --}}
                                    <a href="{{ asset('storage/' . $lampiran->url_file_dokumen) }}" target="_blank" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold rounded-lg text-xs transition-colors" title="Lihat Dokumen">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Preview
                                    </a>
                                    
                                    {{-- DOWNLOAD BUTTON --}}
                                    <a href="{{ asset('storage/' . $lampiran->url_file_dokumen) }}" download 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 font-semibold rounded-lg text-xs transition-colors" title="Unduh Dokumen">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center text-gray-400">
                                    <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="text-sm font-medium">Tidak ada dokumen persyaratan yang dilampirkan warga.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- HASIL PROSES SURAT (TABEL RINGKAS) --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-bold text-[#1D2059]">Detail Surat Hasil Proses</h3>
            </div>
        </div>
        
        <div class="p-0 overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Nomor & Tgl Surat</th>
                        <th class="px-6 py-4 font-semibold">Penandatangan</th>
                        <th class="px-6 py-4 font-semibold">Keterangan / Isi</th>
                        <th class="px-6 py-4 font-semibold text-right">Dokumen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @if($layanan->nomor_surat || $layanan->file_surat)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <p class="font-semibold text-gray-900 mb-1">{{ $layanan->nomor_surat ?? 'Belum ada nomor' }}</p>
                            <p class="text-xs text-gray-500">{{ $layanan->tanggal_surat ? \Carbon\Carbon::parse($layanan->tanggal_surat)->translatedFormat('d M Y') : '-' }}</p>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <p class="font-medium text-gray-900">{{ $layanan->nama_penandatangan ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $layanan->jabatan_penandatangan ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 align-top max-w-xs truncate" title="{{ $layanan->isi_surat }}">
                            {{ $layanan->isi_surat ?? '-' }}
                        </td>
                        <td class="px-6 py-4 align-top text-right">
                            @if($layanan->file_surat)
                                <a href="{{ asset('storage/' . $layanan->file_surat) }}" target="_blank" 
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 font-semibold rounded-lg text-xs transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Lihat File
                                </a>
                            @else
                                <span class="text-xs text-gray-400 italic">Belum diupload</span>
                            @endif
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center">
                            <div class="text-gray-400 flex flex-col items-center">
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p class="text-sm font-medium">Belum ada surat yang diproses.</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection