<section 
    class="relative h-[250px] lg:h-[300px] flex flex-col items-center justify-center text-center px-4"
    style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('{{ asset('images/default-banner.jpg') }}'); background-size: cover; background-position: center;"
>
    <h1 class="text-white text-3xl md:text-4xl font-bold max-w-4xl leading-tight drop-shadow-lg">
        {{ $title }}
    </h1>

    @if(isset($subtitle))
        <p class="text-white text-xl mt-3 font-serif opacity-90 drop-shadow-md">
            {{ $subtitle }}
        </p>
    @endif
</section>