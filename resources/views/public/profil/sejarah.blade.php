@extends('layouts.public')

@section('content')
<style> [x-cloak] { display: none !important; } </style>

<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-20">
    
    @include('public.partials.banner', [
        'title' => 'Sejarah Kalurahan Hargobinangun',
        'subtitle' => 'ꦱꦼꦗꦫꦃꦏꦭꦸꦫꦲꦤ꧀ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div x-data="{ tab: 'sejarah' }" class="max-w-7xl mx-auto px-6 mt-8">
        
        <div class="mb-10">
            <div class="text-xs md:text-sm text-gray-500 mb-6">
                <a href="/" class="hover:text-blue-600">Beranda</a> &gt; 
                <span class="hover:text-blue-600 cursor-pointer">Profil Kalurahan</span> &gt; 
                <span class="text-blue-600 font-semibold">Sejarah Kalurahan</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-[#1D2059]">Sejarah Kalurahan Hargobinangun</h2>
            <p class="text-gray-600 mt-2 text-sm md:text-base">Sejarah didirikannya Kalurahan Hargobinangun dan Wilayah Administrasi</p>
        </div>

        <div class="flex justify-center space-x-4 mb-16">
            <button @click="tab = 'sejarah'" 
                    :class="tab === 'sejarah' ? 'bg-[#1D2059] text-white' : 'bg-transparent text-[#1D2059] border border-[#1D2059] hover:bg-gray-100'" 
                    class="px-8 py-2 rounded-full font-semibold transition text-sm">
                Sejarah
            </button>
            <button @click="tab = 'wilayah'" 
                    :class="tab === 'wilayah' ? 'bg-[#1D2059] text-white' : 'bg-transparent text-[#1D2059] border border-[#1D2059] hover:bg-gray-100'" 
                    class="px-8 py-2 rounded-full font-semibold transition text-sm">
                Wilayah
            </button>
        </div>

        <div x-show="tab === 'sejarah'" x-transition.opacity.duration.500ms x-cloak class="space-y-16">
            
            <div class="text-center max-w-4xl mx-auto">
                <h3 class="text-xl font-bold text-[#1D2059] mb-6">Sejarah</h3>
                <p class="text-gray-700 leading-relaxed text-sm">
                    Kalurahan Hargobinangun berdiri pada tahun 1946 sebagai hasil penggabungan tiga kalurahan, yaitu Kaliurang, Purworejo, dan Pandanpuro. Penggabungan tersebut resmi dilakukan pada 28 Desember 1946 dengan pusat pemerintahan awal di Sawungan, di rumah Bapak Hardjo Martoyo yang sekaligus menjabat sebagai lurah pertama. Nama Kalurahan Hargobinangun kemudian ditetapkan secara resmi melalui Maklumat Pemerintah Daerah Istimewa Yogyakarta Nomor 5 Tahun 1948. Seiring waktu, pusat pemerintahan berkembang dari rumah lurah, gedung serbaguna, hingga kantor kalurahan yang digunakan sampai sekarang.
                </p>
            </div>

            <div>
                <h3 class="text-xl font-bold text-[#1D2059] mb-8 text-center">Daftar Kalurahan Lama</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
                        <h4 class="font-bold text-[#1D2059] text-lg mb-2">KALIURANG</h4>
                        <p class="text-xs text-gray-500 mb-6">Lurah: Bapak Parto Wirono</p>
                        <p class="text-xs text-gray-700 leading-relaxed">
                            Daftar Padukuhan: Kaliurang Barat, Kaliurang Timur, Ngipiksari, Boyong
                        </p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
                        <h4 class="font-bold text-[#1D2059] text-lg mb-2">PURWOREJO</h4>
                        <p class="text-xs text-gray-500 mb-6">Lurah: Bapak Hardjo Martoyo</p>
                        <p class="text-xs text-gray-700 leading-relaxed">
                            Daftar Padukuhan: Jetisan, Sawungan, Sawungsari, NDari, Purworejo, Panggeran, Sidorejo, Banteng
                        </p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center">
                        <h4 class="font-bold text-[#1D2059] text-lg mb-2">PANDANPURO</h4>
                        <p class="text-xs text-gray-500 mb-6">Lurah: Bapak Joyo Pawiro</p>
                        <p class="text-xs text-gray-700 leading-relaxed">
                            Daftar Padukuhan: Pandanpuro, Gondanglegi, Randu, Ngetehan, Selorejo, Ponggol, Wonorejo
                        </p>
                    </div>
                </div>
            </div>

            <div class="pb-10">
                <h3 class="text-xl font-bold text-[#1D2059] mb-16 text-center">Alamat Pusat Pemerintahan Kalurahan</h3>
                
                <div class="relative max-w-4xl mx-auto px-4 hidden md:block">
                    <div class="absolute top-1/2 left-0 right-0 h-1 bg-[#1D2059] -translate-y-1/2 z-0"></div>
                    
                    <div class="relative z-10 flex justify-between items-center">
                        <div class="flex flex-col items-center w-1/3 relative -top-16">
                            <span class="text-xs font-semibold text-gray-600 mb-1">1946-1979</span>
                            <h4 class="text-sm font-bold text-gray-900">Rumah Bapak Hardjo Martojo</h4>
                            <p class="text-xs text-gray-500 mb-4">Sawungan</p>
                            <div class="w-4 h-4 bg-[#1D2059] rounded-full absolute bottom-[-1.1rem]"></div>
                        </div>

                        <div class="flex flex-col items-center w-1/3 relative top-16">
                            <div class="w-4 h-4 bg-[#1D2059] rounded-full absolute top-[-1.1rem]"></div>
                            <span class="text-xs font-semibold text-gray-600 mt-4 mb-1">1979-1981</span>
                            <h4 class="text-sm font-bold text-gray-900">Gedung Serbaguna</h4>
                            <p class="text-xs text-gray-500">Sawungan</p>
                        </div>

                        <div class="flex flex-col items-center w-1/3 relative -top-16">
                            <span class="text-xs font-semibold text-gray-600 mb-1">1981-Sekarang</span>
                            <h4 class="text-sm font-bold text-gray-900">Kantor Kalurahan Hargobinangun</h4>
                            <p class="text-xs text-gray-500 mb-4">Sawungan</p>
                            <div class="w-4 h-4 bg-[#1D2059] rounded-full absolute bottom-[-1.1rem]"></div>
                        </div>
                    </div>
                </div>

                <div class="md:hidden space-y-8 border-l-2 border-[#1D2059] ml-4 pl-6 relative">
                    <div class="relative">
                        <div class="absolute -left-[1.95rem] top-1 w-4 h-4 bg-[#1D2059] rounded-full"></div>
                        <span class="text-xs font-semibold text-gray-600">1946-1979</span>
                        <h4 class="text-sm font-bold text-gray-900 mt-1">Rumah Bapak Hardjo Martojo</h4>
                        <p class="text-xs text-gray-500">Sawungan</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[1.95rem] top-1 w-4 h-4 bg-[#1D2059] rounded-full"></div>
                        <span class="text-xs font-semibold text-gray-600">1979-1981</span>
                        <h4 class="text-sm font-bold text-gray-900 mt-1">Gedung Serbaguna</h4>
                        <p class="text-xs text-gray-500">Sawungan</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[1.95rem] top-1 w-4 h-4 bg-[#1D2059] rounded-full"></div>
                        <span class="text-xs font-semibold text-gray-600">1981-Sekarang</span>
                        <h4 class="text-sm font-bold text-gray-900 mt-1">Kantor Kalurahan Hargobinangun</h4>
                        <p class="text-xs text-gray-500">Sawungan</p>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="tab === 'wilayah'" x-transition.opacity.duration.500ms x-cloak class="pb-10">
            <h3 class="text-xl font-bold text-[#1D2059] mb-8 text-center">Wilayah Administrasi</h3>
            
            <div class="max-w-4xl mx-auto bg-white p-1 rounded-xl shadow-sm border border-gray-200 overflow-x-auto">
                <table class="w-full text-sm text-center border-collapse">
                    <thead>
                        <tr class="bg-[#1D2059] text-white">
                            <th class="px-6 py-4 border border-gray-800 w-16">No</th>
                            <th class="px-6 py-4 border border-gray-800">Kring</th>
                            <th class="px-6 py-4 border border-gray-800">Dusun</th>
                            <th class="px-6 py-4 border border-gray-800">Kepala Dusun</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $wilayah = [
                                ['Kring I', 'Jetisan', 'Sri Hartanto'],
                                ['Kring II', 'Sawungan, Sawungsari, Dari', 'P. Diko Prasetyo Wibisono'],
                                ['Kring III', 'Purworejo', 'Muhammad Eko Nugroho, S.E.'],
                                ['Kring IV', 'Banteng dan Sidorejo', 'Wahyu Isharyanta, A.Md.'],
                                ['Kring V', 'Boyong', 'Marjupri'],
                                ['Kring VI', 'Ngipiksari', 'Puspita Rama Sari'],
                                ['Kring VII', 'Kaliurang Timur', 'Anggara Daniawan'],
                                ['Kring VIII', 'Kaliurang Barat', 'Satriya Pandu Permana'],
                                ['Kring IX', 'Pandanpuro dan Gondanglegi', 'Asep Widodo'],
                                ['Kring X', 'Randu dan Wonokerso (Ngetehan)', 'Marsudi'],
                                ['Kring XI', 'Tanen (Selorejo) dan Panggeran', 'Suhardi'],
                                ['Kring XII', 'Wonorejo dan Ponggol', 'Monika Esti Widyaningsih, S.Pd'],
                            ];
                        @endphp

                        @foreach ($wilayah as $index => $row)
                        <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100 transition-colors">
                            <td class="px-6 py-4 border border-gray-300 text-gray-600">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 border border-gray-300 font-medium text-gray-800">
                                {{ $row[0] }}
                            </td>

                            <td class="px-6 py-4 border border-gray-300 text-gray-700">
                                {{ $row[1] }}
                            </td>

                            <td class="px-6 py-4 border border-gray-300 text-gray-700">
                                {{ $row[2] }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection