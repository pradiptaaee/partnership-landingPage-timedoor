@extends('layouts.app')

@section('content')

<!-- ================= HERO SECTION ================= -->
<section class="pt-1 pb-20 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        {{-- TITLE --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#001D7A] leading-snug">
                School & Government Partnership
            </h1>
        </div>

        {{-- HERO IMAGE --}}
        <div class="rounded-3xl overflow-hidden">
            <img
                src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                alt="School Partnership"
                class="w-full h-[300px] md:h-[420px] object-cover">
        </div>

        {{-- INTRO --}}
        <div class="max-w-3xl mx-auto text-center mt-12">
            <p class="text-gray-600 text-base md:text-lg leading-relaxed mb-6">
                Jika Anda tertarik dengan kelas pemrograman atau desain, silakan hubungi kami.
                Timedoor Academy menyediakan layanan pendidikan teknologi untuk sekolah
                dan instansi pemerintah dengan kurikulum modern dan instruktur profesional.
            </p>

            <a href="#"
                class="inline-block px-8 py-3 rounded-full bg-[#001D7A] text-white font-semibold shadow-md hover:bg-blue-900 transition">
                Hubungi Kami
            </a>
        </div>

    </div>

</section>


<!-- ================= PARTNERS LOGO SLIDER ================= -->
<section class="py-20 bg-gray-50">
    <h2 class="text-center text-2xl md:text-3xl font-bold text-[#001D7A] mb-12">
        Mitra Kami
    </h2>

    <div class="relative overflow-hidden">

        {{-- Fade kiri --}}
        <div class="pointer-events-none absolute left-0 top-0 h-full w-12 sm:w-24 bg-gradient-to-r from-gray-50 to-transparent z-10"></div>

        {{-- Fade kanan --}}
        <div class="pointer-events-none absolute right-0 top-0 h-full w-12 sm:w-24 bg-gradient-to-l from-gray-50 to-transparent z-10"></div>

        <div class="slider-wrapper">
            <div class="slider-track flex items-center gap-4 sm:gap-8">

                {{-- SET 1 --}}
                @foreach ($partners as $p)
                @if ($p->logo)
                <div class="slider-item flex-shrink-0">
                    <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}"
                        class="w-16 h-16 sm:w-24 sm:h-24 object-contain">
                </div>
                @endif
                @endforeach

                {{-- SET 2 --}}
                @foreach ($partners as $p)
                @if ($p->logo)
                <div class="slider-item flex-shrink-0">
                    <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}"
                        class="w-16 h-16 sm:w-24 sm:h-24 object-contain">
                </div>
                @endif
                @endforeach

                {{-- SET 3 --}}
                @foreach ($partners as $p)
                @if ($p->logo)
                <div class="slider-item flex-shrink-0">
                    <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}"
                        class="w-16 h-16 sm:w-24 sm:h-24 object-contain">
                </div>
                @endif
                @endforeach

            </div>
        </div>

    </div>
</section>



<!-- ================= WORKSHOP SECTION ================= -->
<section class="py-20 bg-[#EDFFF3]">

    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-center text-2xl md:text-3xl font-bold text-[#001D7A] mb-12">
            Workshop dan Pelatihan Sekolah
        </h2>

        @livewire('partner-activity-card')

    </div>

</section>

@endsection