@extends('layouts.app')

@section('content')
    <section class="">
        {{-- HERO SECTION --}}
        <section class="bg-white mt-16 mb-8 px-4">

            <!-- TITLE -->
            <div class="w-full">
                <h1
                    class="text-center font-bold text-[#001D7A]
                   text-lg sm:text-xl md:text-2xl
                   px-4 py-4 mb-6">
                    {{ __('partnership.title') }}
                </h1>
            </div>

            <!-- HERO IMAGE -->
            <div class="px-4 sm:px-8 md:px-16 lg:px-45">
                <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                    alt="School Partnership"
                    class="w-full shadow-sm
                    max-h-[300px] sm:max-h-[420px] md:max-h-[540px]
                    object-cover
                    rounded-xl md:rounded-[20px]">
            </div>

            <!-- INTRO TEXT -->
            <div class="py-12 sm:py-16 md:py-20 px-4">
                <div class="max-w-4xl mx-auto">

                    <p class="text-gray-600 text-base sm:text-md  leading-relaxed mb-6">
                        {{ __('partnership.intro_1') }}
                    </p>

                    <p class="text-gray-600 text-base sm:text-md  leading-relaxed mb-6">
                        {{ __('partnership.intro_2') }}
                    </p>

                    <p class="text-gray-600 text-base sm:text-md  leading-relaxed">
                        <a href="#" class="text-[#001D7A] font-semibold hover:underline">
                            {{ __('partnership.contact') }}
                        </a>
                        {{ __('partnership.contact_suffix') }}
                    </p>

                </div>
            </div>

        </section>



        {{-- SLIDER LOGO --}}
        <div class="w-full">
            <h1 class="text-center font-bold text-[#001D7A] 
                   text-[1.50rem] px-5 py-3">
                {{ __('partnership.our_partners') }}
            </h1>
        </div>

        <section class="py-4 bg-white">

            <div class="overflow-hidden w-full">

                <div class="flex w-max animate-scroll hover:[animation-play-state:paused]">

                    {{-- Loop Pertama --}}
                    @foreach ($partners as $p)
                        @if ($p->logo)
                            <div
                                class="flex-shrink-0
                                w-[120px] h-[70px]
                                sm:w-[180px] sm:h-[100px]
                                md:w-[240px] md:h-[140px]
                                lg:w-[300px] lg:h-[180px]
                                flex items-center justify-center
                                p-2">

                                <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}"
                                    title="{{ $p->name }}"
                                    class="max-w-full max-h-full object-contain
                                    transition-transform duration-300
                                    hover:scale-110 cursor-pointer">
                            </div>
                        @endif
                    @endforeach

                    {{-- Duplicate untuk infinite --}}
                    @foreach ($partners as $p)
                        @if ($p->logo)
                            <div
                                class="flex-shrink-0
                                w-[120px] h-[70px]
                                sm:w-[180px] sm:h-[100px]
                                md:w-[240px] md:h-[140px]
                                lg:w-[300px] lg:h-[180px]
                                flex items-center justify-center
                                p-2">

                                <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}"
                                    title="{{ $p->name }}"
                                    class="max-w-full max-h-full object-contain
                                    transition-transform duration-300
                                    hover:scale-110 cursor-pointer">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        {{-- WORKSHOP SECTION --}}
        <section class="pt-10 pb-20 bg-[#EDFFF3]">
            <div class="max-w-7xl mx-auto px-4 ">

                <h2 class="text-center text-2xl font-bold my-12">
                    {{ __('partnership.workshop_title') }}
                </h2>

                <!-- Search Section -->
                @livewire('partner-activity-card')

            </div>
        </section>
    </section>

@endsection
