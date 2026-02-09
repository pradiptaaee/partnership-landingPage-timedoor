<section class="w-full bg-white">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="mt-5 sm:mt-12 max-w-5xl mx-auto">

            <!-- Headline -->
            <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" class="text-left mb-20 md:mb-32">
                <h2 class="text-blue-900 font-extrabold text-4xl sm:text-6xl md:text-7xl leading-tight tracking-tight">
                    {!! __('Section Benefit Title') !!}
                </h2>
            </div>

            <div class="flex gap-3 mb-5 w-full md:w-4/6">
                {{-- KOTAK 1 --}}
                <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="500" class="border-2 border-dashed border-[#848484] rounded-2xl p-3 flex flex-col justify-center w-2/6">
                    <p class="text-xs md:text-sm lg:text-lg font-bold text-[#1C2F70]">
                        {!! __('Stats Follow') !!}
                    </p>
                    <p class="font-bold text-base md:text-2xl lg:text-4xl text-[#10AF13]">10.000</p>
                    <p class="text-xs md:text-sm lg:text-lg font-bold text-[#1C2F70]">
                        {{ __('Stats Students') }} &rarr;
                    </p>
                </div>

                {{-- KOTAK 2 --}}
                <div data-aos="fade-up" data-aos-delay="250" data-aos-duration="500" class="border-2 border-dashed border-[#848484] rounded-2xl p-3 flex flex-col justify-center w-2/5">
                    <p class="text-xs md:text-sm lg:text-lg font-bold text-[#1C2F70]">
                        {{ __('Stats Compete') }}
                    </p>
                    <p class="font-bold text-sm md:text-xl lg:text-2xl text-[#10AF13]">
                        {{ __('Stats Competition') }}
                    </p>
                    <p class="text-xs md:text-sm lg:text-lg font-bold text-[#1C2F70]">
                        {{ __('Stats Modules') }} &rarr;
                    </p>
                </div>

                {{-- KOTAK 3 --}}
                <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="500" class="border-2 border-dashed border-[#848484] rounded-2xl p-3 flex flex-col justify-center w-2/6">
                    <p class="text-xs font-bold md:text-sm lg:text-lg text-[#1C2F70]">
                        {!! __('Stats Follow') !!}
                    </p>

                    <p class="font-bold text-base md:text-2xl lg:text-4xl text-[#10AF13]">10.000</p>
                    <p class="text-xs md:text-sm font-bold lg:text-lg text-[#1C2F70]">
                        {{ __('Stats Students') }} &rarr;
                    </p>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="500" class="flex md:flex-row gap-4 items-stretch">
                <button class="flex-grow w-4/5 p-2 bg-[#10AF13] hover:bg-green-700 text-white font-black {{ $fontClasses['cta_btn'] ?? 'text-base sm:text-3xl md:text-4xl' }} rounded-2xl shadow-lg transition transform hover:-translate-y-1 uppercase tracking-wide text-center">
                    {{ __('Button Price') }}
                </button>

                <button class="{{ $fontClasses['cta_btn2'] ?? 'text-base sm:text-3xl md:text-4xl' }} flex-shrink-0 p-2 bg-[#10AF13] hover:bg-green-700 text-white font-black rounded-2xl shadow-lg transition transform hover:-translate-y-1 uppercase tracking-wide text-center leading-tight flex items-center justify-center ">

                    {!! __('Button Book Split') !!}
                </button>
            </div>

        </div>
    </div>
</section>