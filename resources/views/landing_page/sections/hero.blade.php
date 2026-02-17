<section class="mx-3 px-4 sm:px-6 lg:px-8 lg:w-full xl:min-h-screen flex flex-col">

    <main data-aos="fade-up" data-aos-delay="100" data-aos-duration="500"
        class="mt-5 md:mt-10 lg:mt-14 xl:mt-0 mx-auto flex-grow xl:flex xl:flex-row-reverse xl:items-center xl:gap-12">

        <div class="xl:w-1/2 mx-auto">

            {{-- Hero Title --}}
            <h2
                class="text-blue-900 font-bold {{ $fontClasses['hero_h2'] }}">
                {{ __('Hero Title') }}
            </h2>

            {{-- Hero Subtitle --}}
            <h1
                class="text-blue-900 font-extrabold {{ $fontClasses['hero_h1'] }}">
                {{ __('Hero Subtitle') }}
            </h1>

            {{-- Hero Description --}}
            <p
                class="text-gray-900 {{ $fontClasses['hero_p'] }} max-w-2xl leading-relaxed">
                {{ __('Hero Desc') }}
            </p>

            <div class="mb-16 text-center xl:text-left hidden xl:block">
                <a href="{{ route('trial.index') }}" class="inline-block bg-[#10AF13] text-white text-xl sm:text-2xl font-extrabold py-4 px-8 sm:px-12 rounded-2xl shadow-[0_7px_0_#0E8E10] transform transition-all duration-150 hover:translate-y-[5px] hover:shadow-[0_5px_0_#0E8E10] active:translate-y-[7px] active:shadow-[0_2px_0_#0E8E10]">
                    {{ __('Book a Free Trial') }}
                </a>
            </div>
        </div>

        {{-- Hero Image - Data dari Controller --}}
        <div
            class="w-full xl:w-5/6 bg-gray-100 rounded-4xl aspect-4/3 sm:aspect-video mb-10 mx-auto shadow-sm overflow-hidden relative group">
            <img src="{{ $heroImageUrl }}"
                alt="Hero Banner {{ strtoupper(app()->getLocale()) }}"
                class="object-cover w-full h-full opacity-80 group-hover:scale-105 transition-transform duration-700">
        </div>

        <div class="mb-16 text-center xl:hidden">
            <a href="{{ route('trial.index') }}" class="inline-block bg-[#10AF13] text-white text-xl sm:text-2xl font-extrabold py-4 px-8 sm:px-12 rounded-2xl shadow-[0_7px_0_#0E8E10] transform transition-all duration-150 hover:translate-y-[5px] hover:shadow-[0_5px_0_#0E8E10] active:translate-y-[7px] active:shadow-[0_2px_0_#0E8E10]">
                {{ __('Book a Free Trial') }}
            </a>
        </div>

    </main>

</section>