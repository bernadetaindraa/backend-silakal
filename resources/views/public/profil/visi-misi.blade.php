@extends('layouts.public')

@section('content')
<div class="font-['Montserrat'] bg-[#F4F7FB] min-h-screen pb-24">
    
    @include('public.partials.banner', [
        'title' => 'Visi dan Misi Kalurahan Hargobinangun',
        'subtitle' => 'ꦮꦶꦱꦶꦢꦤ꧀ꦩꦶꦱꦶꦏꦭꦸꦫꦲꦤ꧀ꦲꦂꦒꦺꦴꦧꦶꦤꦔꦸꦤ꧀',
    ])

    <div class="max-w-7xl mx-auto px-6 mt-8">
        
        <div class="mb-16">
            <div class="text-xs md:text-sm text-gray-500 mb-6">
                <a href="/" class="hover:text-blue-600">Beranda</a> &gt; 
                <span class="hover:text-blue-600 cursor-pointer">Profil Kalurahan</span> &gt; 
                <span class="text-blue-600 font-semibold">Visi dan Misi Kalurahan</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-[#1D2059]">Visi dan Misi Kalurahan Hargobinangun</h2>
            <p class="text-gray-600 mt-2 text-sm md:text-base">Visi Misi berjalan Kalurahan Hargobinangun</p>
        </div>

        <div class="max-w-4xl mx-auto flex flex-col items-center space-y-16">
            
            <div class="text-center w-full">
                <h3 class="text-2xl font-bold text-[#1D2059] mb-6">Visi</h3>
                <p class="text-gray-800 text-lg md:text-xl font-medium italic">
                    "Terwujudnya Kalurahan Hargobinangun Yang Maju, Mandiri, Dan Berbudaya"
                </p>
            </div>

            <div class="w-full">
                <h3 class="text-2xl font-bold text-[#1D2059] mb-6 text-center">Misi</h3>
                
                <ol class="list-decimal text-gray-700 text-sm md:text-base leading-relaxed space-y-4 pl-5 md:pl-0 md:max-w-3xl md:mx-auto">
                    <li class="pl-2">
                        Mengoptimalkan penyelenggaraan Pemerintahan Kalurahan yang transparan, cepat, dan akuntabel dengan didukung oleh teknologi informasi.
                    </li>
                    <li class="pl-2">
                        Memberdayakan seluruh potensi yang ada di masyarakat, baik sumber daya manusia, sumber daya alam, maupun pemberdayaan ekonomi kerakyatan.
                    </li>
                    <li class="pl-2">
                        Melaksanakan pembangunan yang berkesinambungan dan merata, menjaga kelestarian lingkungan, serta mengedepankan partisipasi dan gotong royong masyarakat.
                    </li>
                    <li class="pl-2">
                        Mengembangkan potensi kebudayaan sebagai media perekat persatuan antarwarga di wilayah Kalurahan Hargobinangun.
                    </li>
                </ol>
            </div>

        </div>

    </div>
</div>
@endsection