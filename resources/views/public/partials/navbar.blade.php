<nav 
    x-data="{ 
        open: false,
        mobileProfil: false,
        mobileLayanan: false,
        mobileProdukHukum: false,
        mobileKebudayaan: false,
        mobileSurvey: false
    }"
    class="bg-[#1D2059] text-white px-6 py-4 sticky top-0 z-50 shadow-md"
>
    <div class="max-w-7xl mx-auto flex justify-between items-center font-['Montserrat']">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-kabupaten.png') }}" class="h-10 w-auto">
            <div class="leading-tight text-xs font-bold uppercase tracking-wider">
                PEMERINTAH DESA<br>HARGOBINANGUN
            </div>
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex space-x-6 text-[11px] font-semibold uppercase tracking-wider items-center">

            <a href="{{ route('home') }}" class="hover:text-blue-300 transition">
                Beranda
            </a>

            {{-- PROFIL --}}
            <div class="relative group">
                <button class="hover:text-blue-300 transition flex items-center gap-1">
                    PROFIL
                    <span class="text-[10px]">▾</span>
                </button>
                <div class="absolute left-0 top-full hidden group-hover:block bg-white text-[#1D2059] py-2 w-52 shadow-xl rounded-b-lg border-t-2 border-blue-600">
                    <a href="{{ route('sejarah') }}" class="block px-4 py-2 hover:bg-gray-100">Sejarah Kalurahan</a>
                    <a href="{{ route('visi-misi') }}" class="block px-4 py-2 hover:bg-gray-100">Visi & Misi Kalurahan</a>
                    <a href="{{ route('aparatur.index') }}" class="block px-4 py-2 hover:bg-gray-100">Aparatur Kalurahan</a>
                    <a href="{{ route('bpkal.anggota') }}" class="block px-4 py-2 hover:bg-gray-100">BPKal</a>
                </div>
            </div>

            <a href="{{ route('berita') }}" class="hover:text-blue-300 transition">
                Berita
            </a>

            <a href="{{ route('agenda') }}" class="hover:text-blue-300 transition">
                Agenda
            </a>

            {{-- LAYANAN --}}
            <div class="relative group">
                <button class="hover:text-blue-300 transition flex items-center gap-1">
                    LAYANAN
                    <span class="text-[10px]">▾</span>
                </button>
                <div class="absolute left-0 top-full hidden group-hover:block bg-white text-[#1D2059] py-2 w-52 shadow-xl rounded-b-lg border-t-2 border-blue-600">
                    <a href="{{ route('layanan.panduan') }}" class="block px-4 py-2 hover:bg-gray-100">Panduan Layanan</a>
                    <a href="{{ route('user.layanan.pengajuan') }}" class="block px-4 py-2 hover:bg-gray-100">Ajukan Layanan</a>
                    @auth
                        <a href="{{ route('user.layanan.tracking') }}" class="block px-4 py-2 hover:bg-gray-100">Tracking Layanan</a>
                        <a href="{{ route('user.layanan.riwayat') }}" class="block px-4 py-2 hover:bg-gray-100">Riwayat Layanan</a>
                    @endauth
                </div>
            </div>

            {{-- PRODUK HUKUM --}}
            <div class="relative group">
                <button class="hover:text-blue-300 transition flex items-center gap-1">
                    PRODUK HUKUM
                    <span class="text-[10px]">▾</span>
                </button>
                <div class="absolute left-0 top-full hidden group-hover:block bg-white text-[#1D2059] py-2 w-64 shadow-xl rounded-b-lg border-t-2 border-blue-600">
                    <a href="{{ route('produk-hukum.index', 'perencanaan-penganggaran') }}" class="block px-4 py-2 hover:bg-gray-100">Perencanaan & Penganggaran</a>
                    <a href="{{ route('produk-hukum.index', 'laporan') }}" class="block px-4 py-2 hover:bg-gray-100">Laporan</a>
                    <a href="{{ route('produk-hukum.index', 'peraturan-kalurahan') }}" class="block px-4 py-2 hover:bg-gray-100">Peraturan Kalurahan</a>
                    <a href="{{ route('produk-hukum.index', 'peraturan-lurah') }}" class="block px-4 py-2 hover:bg-gray-100">Peraturan Lurah</a>
                </div>
            </div>

            <a href="{{ route('potensi-produk.index') }}" class="hover:text-blue-300 transition">
                Potensi & Produk
            </a>

            {{-- KEBUDAYAAN --}}
            <div class="relative group">
                <button class="hover:text-blue-300 transition flex items-center gap-1">
                    KEBUDAYAAN
                    <span class="text-[10px]">▾</span>
                </button>
                <div class="absolute left-0 top-full hidden group-hover:block bg-white text-[#1D2059] py-2 w-56 shadow-xl rounded-b-lg border-t-2 border-blue-600">
                    <a href="{{ route('kebudayaan.benda') }}" class="block px-4 py-2 hover:bg-gray-100">Kebudayaan Benda</a>
                    <a href="{{ route('kebudayaan.non-benda') }}" class="block px-4 py-2 hover:bg-gray-100">Kebudayaan Non Benda</a>
                </div>
            </div>

            {{-- SURVEY --}}
            <div class="relative group">
                <button class="hover:text-blue-300 transition flex items-center gap-1">
                    SURVEY & PENGADUAN
                    <span class="text-[10px]">▾</span>
                </button>
                <div class="absolute right-0 top-full hidden group-hover:block bg-white text-[#1D2059] py-2 w-52 shadow-xl rounded-b-lg border-t-2 border-blue-600">
                    <a href="{{ route('survey-ikm') }}" class="block px-4 py-2 hover:bg-gray-100 uppercase">Survey IKM</a>
                    <a href="{{ route('survey-ikm.hasil') }}" class="block px-4 py-2 hover:bg-gray-100 uppercase">Hasil Survey</a>
                    <a href="{{ route('pengaduan') }}" class="block px-4 py-2 hover:bg-gray-100 uppercase">Pengaduan</a>
                </div>
            </div>

            {{-- AUTH HUB DESKTOP --}}
            @guest
                <a href="{{ route('login') }}"
                    class="bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded-full transition text-xs font-bold shadow-sm">
                    LOGIN
                </a>
            @else
                <div class="relative" x-data="{ profileOpen: false }" @click.away="profileOpen = false">
                    <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 focus:outline-none group">
                        <div class="relative inline-block">
                            @if(Auth::user()->url_foto_profil)
                                <img 
                                    src="{{ asset('storage/' . Auth::user()->url_foto_profil) }}"
                                    class="w-9 h-9 rounded-full object-cover ring-2 ring-transparent group-hover:ring-blue-400 transition-all duration-200"
                                >
                            @else
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xs ring-2 ring-transparent group-hover:ring-blue-400 transition-all duration-200 shadow-inner">
                                    {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}
                                </div>
                            @endif
                            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-[#1D2059]"></span>
                        </div>
                        <svg class="w-3 h-3 text-gray-400 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div 
                        x-show="profileOpen"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-3 w-60 bg-white text-gray-800 rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50 font-sans"
                        style="display: none;"
                    >
                        <div class="px-4 py-3 bg-gray-50/80 border-b border-gray-100">
                            <p class="font-bold text-sm text-gray-900 truncate leading-tight">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 truncate mt-0.5 font-normal normal-case">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <div class="p-1">
                            <a href="{{ route('user.profile') }}"
                                class="flex items-center px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-lg transition">
                                Profile Saya
                            </a>

                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left flex items-center px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-lg transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest

        </div>

        {{-- HAMBURGER MOBILE --}}
        <button
            @click="open = !open"
            class="md:hidden text-white focus:outline-none"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

    </div>

    {{-- MOBILE MENU DRAWER --}}
    <div
        x-show="open"
        x-transition
        class="md:hidden mt-4 bg-[#252963] rounded-xl p-4 space-y-2 text-sm font-semibold uppercase"
        style="display: none;"
    >
        <a href="{{ route('home') }}" class="block py-2">Beranda</a>

        {{-- MOBILE PROFIL PULLDOWN --}}
        <div>
            <button @click="mobileProfil = !mobileProfil" class="w-full flex justify-between items-center py-2">
                <span>Profil</span>
                <span x-text="mobileProfil ? '▴' : '▾'"></span>
            </button>
            <div x-show="mobileProfil" x-transition class="pl-4 space-y-1 text-xs normal-case">
                <a href="{{ route('sejarah') }}" class="block py-2 text-gray-200">Sejarah Kalurahan</a>
                <a href="{{ route('visi-misi') }}" class="block py-2 text-gray-200">Visi & Misi Kalurahan</a>
                <a href="{{ route('aparatur.index') }}" class="block py-2 text-gray-200">Aparatur Kalurahan</a>
                <a href="{{ route('bpkal.anggota') }}" class="block py-2 text-gray-200">BPKal</a>
            </div>
        </div>

        <a href="{{ route('berita') }}" class="block py-2">Berita</a>
        <a href="{{ route('agenda') }}" class="block py-2">Agenda</a>

        {{-- MOBILE LAYANAN PULLDOWN --}}
        <div>
            <button @click="mobileLayanan = !mobileLayanan" class="w-full flex justify-between items-center py-2">
                <span>Layanan</span>
                <span x-text="mobileLayanan ? '▴' : '▾'"></span>
            </button>
            <div x-show="mobileLayanan" x-transition class="pl-4 space-y-1 text-xs normal-case">
                <a href="{{ route('layanan.panduan') }}" class="block py-2 text-gray-200">Panduan Layanan</a>
                <a href="{{ route('user.layanan.pengajuan') }}" class="block py-2 text-gray-200">Ajukan Layanan</a>
                @auth
                    <a href="{{ route('user.layanan.tracking') }}" class="block py-2 text-gray-200">Tracking Layanan</a>
                    <a href="{{ route('user.layanan.riwayat') }}" class="block py-2 text-gray-200">Riwayat Layanan</a>
                @endauth
            </div>
        </div>

        {{-- MOBILE PRODUK HUKUM PULLDOWN --}}
        <div>
            <button @click="mobileProdukHukum = !mobileProdukHukum" class="w-full flex justify-between items-center py-2">
                <span>PRODUK HUKUM</span>
                <span x-text="mobileProdukHukum ? '▴' : '▾'"></span>
            </button>
            <div x-show="mobileProdukHukum" x-transition class="pl-4 space-y-1 text-xs normal-case">
                <a href="{{ route('produk-hukum.index', 'perencanaan-penganggaran') }}" class="block py-2 text-gray-200">Perencanaan & Penganggaran</a>
                <a href="{{ route('produk-hukum.index', 'laporan') }}" class="block py-2 text-gray-200">Laporan</a>
                <a href="{{ route('produk-hukum.index', 'peraturan-kalurahan') }}" class="block py-2 text-gray-200">Peraturan Kalurahan</a>
                <a href="{{ route('produk-hukum.index', 'peraturan-lurah') }}" class="block py-2 text-gray-200">Peraturan Lurah</a>
            </div>
        </div>

        <a href="{{ route('potensi-produk.index') }}" class="block py-2">Potensi & Produk</a>

        {{-- MOBILE KEBUDAYAAN PULLDOWN --}}
        <div>
            <button @click="mobileKebudayaan = !mobileKebudayaan" class="w-full flex justify-between items-center py-2">
                <span>Kebudayaan</span>
                <span x-text="mobileKebudayaan ? '▴' : '▾'"></span>
            </button>
            <div x-show="mobileKebudayaan" x-transition class="pl-4 space-y-1 text-xs normal-case">
                <a href="{{ route('kebudayaan.benda') }}" class="block py-2 text-gray-200">Kebudayaan Benda</a>
                <a href="{{ route('kebudayaan.non-benda') }}" class="block py-2 text-gray-200">Kebudayaan Non Benda</a>
            </div>
        </div>

        {{-- MOBILE SURVEY PULLDOWN --}}
        <div>
            <button @click="mobileSurvey = !mobileSurvey" class="w-full flex justify-between items-center py-2">
                <span>Survey & Pengaduan</span>
                <span x-text="mobileSurvey ? '▴' : '▾'"></span>
            </button>
            <div x-show="mobileSurvey" x-transition class="pl-4 space-y-1 text-xs normal-case">
                <a href="{{ route('survey-ikm') }}" class="block py-2 text-gray-200">Survey IKM</a>
                <a href="{{ route('survey-ikm.hasil') }}" class="block py-2 text-gray-200">Hasil Survey</a>
                <a href="{{ route('pengaduan') }}" class="block py-2 text-gray-200">Pengaduan</a>
            </div>
        </div>

        {{-- MOBILE AUTH SEGMENT --}}
        <div class="pt-4 border-t border-white/10">
            @guest
                <a href="{{ route('login') }}"
                    class="block text-center bg-blue-600 hover:bg-blue-700 px-4 py-2.5 rounded-xl transition text-xs font-bold tracking-wide">
                    LOGIN
                </a>
            @else
                <div class="bg-[#1D2059]/60 border border-white/5 rounded-xl p-3.5 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="relative inline-block flex-shrink-0">
                            @if(Auth::user()->url_foto_profil)
                                <img 
                                    src="{{ asset('storage/' . Auth::user()->url_foto_profil) }}"
                                    class="w-11 h-11 rounded-full object-cover border border-white/20"
                                >
                            @else
                                <div class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-base shadow-inner">
                                    {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}
                                </div>
                            @endif
                            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-[#252963]"></span>
                        </div>

                        <div class="overflow-hidden">
                            <p class="text-sm font-bold text-white truncate normal-case leading-tight">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-300 truncate mt-0.5 font-normal normal-case">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-2 border-t border-white/10 font-sans tracking-normal">
                        <a href="{{ route('user.profile') }}"
                            class="flex items-center justify-center py-2 px-3 rounded-lg bg-white/10 hover:bg-white/20 text-xs text-white normal-case font-medium transition">
                            Profile Saya
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit"
                                class="w-full text-center py-2 px-3 rounded-lg bg-red-500/20 hover:bg-red-500/30 text-xs text-red-300 font-semibold transition">
                                LOGOUT
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>

    </div>
</nav>