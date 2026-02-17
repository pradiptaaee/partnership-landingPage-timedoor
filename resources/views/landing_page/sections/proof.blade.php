{{-- 1. LOAD CSS SWIPER --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

{{-- CSS Fix untuk slider jalan mulus (Running Text style) --}}
<style>
    .swiper_left .swiper-wrapper {
        transition-timing-function: linear !important;
    }
</style>

<section class="w-full bg-[#10AF13] relative overflow-hidden bg-green-trigger margin">

    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute bottom-[-120px] left-[-120px] text-[#069801]">
            <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-fidget-spinner xl:w-[400px] xl:h-[400px]">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 0a5 5 0 0 1 3.584 8.488l-.012 .012a5 5 0 0 1 1.33 2.517l.018 .101l.251 -.048q .15 -.025 .3 -.041l.304 -.024l.225 -.005a5 5 0 1 1 -4.89 6.046l-.032 -.164l-.24 .048a5 5 0 0 1 -.556 .062l-.282 .008q -.427 0 -.84 -.07l-.239 -.048l-.004 .025a5 5 0 0 1 -3.331 3.834l-.22 .068a5 5 0 1 1 -.461 -9.728l.173 .036l.019 -.102c.19 -.95 .653 -1.824 1.331 -2.516l-.05 -.052a5.02 5.02 0 0 1 -1.355 -2.978l-.018 -.244l-.005 -.225a5 5 0 0 1 5 -5m6 15a1 1 0 0 0 -1 1v.01a1 1 0 0 0 2 0v-.01a1 1 0 0 0 -1 -1m-12 0a1 1 0 0 0 -1 1v.01a1 1 0 0 0 2 0v-.01a1 1 0 0 0 -1 -1m6 -4.995c-1.1 0 -1.99 .891 -1.99 1.99v.02a1.99 1.99 0 0 0 3.98 0v-.02a1.99 1.99 0 0 0 -1.99 -1.99m0 -6.005a1 1 0 0 0 -1 1v.01a1 1 0 0 0 2 0v-.01a1 1 0 0 0 -1 -1" />
            </svg>
        </div>

        <div class="absolute bottom-40 left-20 text-[#08CB00]">
            <svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l2 4 4 2-4 2-2 4-2-4-4-2 4-2z" />
            </svg>
        </div>

        <div class="absolute bottom-[-100px] right-[-100px] xl:bottom-[-300px] xl:right-[-300px] text-[#08CB00] -rotate-45">
            <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wifi-2 xl:w-[1000px] xl:h-[1000px]">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 18l.01 0" />
                <path d="M9.172 15.172a4 4 0 0 1 5.656 0" />
                <path d="M6.343 12.343a8 8 0 0 1 11.314 0" />
            </svg>
        </div>

    </div>

    <div class="relative z-9 pt-14 md:pt-14">
        <div class="">
            <div class="swiper swiper_left">
                <div class="swiper-wrapper ![transition-timing-function:linear]">

                    {{-- CEK DATA DATABASE --}}
                    @if(isset($banners) && $banners->isNotEmpty())
                    @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <div class="border-4 border-white rounded-[2.5rem] mb-10 lg:mb-14 p-6 sm:p-10 flex items-center justify-between gap-8 relative overflow-hidden bg-[#10AF13]">
                            <div class="text-white z-10 w-1/2">
                                <h3 class=" {{ $fontClasses['proof_bnr'] }} font-semibold leading-tight">
                                    {{-- Langsung pakai data yang sudah diproses di controller --}}
                                    {{ $banner->localized_title }}
                                </h3>
                            </div>
                            <div class="w-1/2 aspect-video bg-gray-800 rounded-3xl flex items-center justify-center text-white text-center overflow-hidden shadow-lg">
                                <img src="{{ Storage::url($banner->image) }}"
                                    class="w-full h-full object-cover opacity-80"
                                    alt="Banner Image">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    {{-- FALLBACK CONTENT --}}
                    <div class="swiper-slide">
                        <div class="border-4 border-white rounded-[2.5rem] mb-10 lg:mb-14 p-6 sm:p-10 flex items-center justify-between gap-8 relative overflow-hidden bg-[#10AF13]">
                            <div class="text-white z-10 w-1/2">
                                <h3 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-4xl font-semibold leading-tight">
                                    🏆 Winner: Tech Kids Grand Prix ASEAN 2024
                                </h3>
                            </div>
                            <div class="w-1/2 aspect-video bg-gray-800 rounded-3xl flex items-center justify-center text-white text-center overflow-hidden shadow-lg">
                                <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1740&auto=format&fit=crop" class="w-full h-full object-cover opacity-80" alt="Winner">
                            </div>
                        </div>
                    </div>
                    {{-- DUMMY 2 --}}
                    <div class="swiper-slide">
                        <div class="border-4 border-white rounded-[2.5rem] mb-10 lg:mb-14 p-6 sm:p-10 flex items-center justify-between gap-8 relative overflow-hidden bg-[#10AF13]">
                            <div class="text-white z-10 w-1/2">
                                <h3 class="text-xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-4xl font-semibold leading-tight">
                                    🏆 Winner: Tech Kids Grand Prix ASEAN 2024
                                </h3>
                            </div>
                            <div class="w-1/2 aspect-video bg-gray-800 rounded-3xl flex items-center justify-center text-white text-center overflow-hidden shadow-lg">
                                <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1740&auto=format&fit=crop" class="w-full h-full object-cover opacity-80" alt="Winner">
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            <div>
                <h2 data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" class="text-white text-center font-extrabold text-2xl sm:text-4xl md:text-5xl lg:text-6xl mb-5">
                    {{ __('Section Testimoni') }}
                </h2>

                <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" class="px-4 sm:px-6 lg:px-8 overflow-visible">
                    <div class="swiper swiper_right">
                        <div class="swiper-wrapper">

                            {{-- CEK DATA --}}
                            @if(isset($testimonials) && $testimonials->isNotEmpty())
                            @foreach($testimonials as $item)
                            <div class="swiper-slide">
                                <div class="flex justify-center items-center">
                                    <div class="flex gap-0 xl:w-3/5 bg-white rounded-[2.5rem] p-8 sm:p-12 shadow-xl mb-12">
                                        <div class="w-2/5">
                                            <div class="w-[100px] h-[100px] md:w-[200px] md:h-[200px] lg:w-[300px] lg:h-[300px] xl:h-[200px] xl:w-[200px] bg-gray-200 overflow-hidden border-4 border-green-100">
                                                <img src="{{ Storage::url($item->parent_image) }}" class="w-full h-full object-cover" alt="{{ $item->parent_name }}">
                                            </div>
                                            <div class="text-blue-900">
                                                <p class="font-extrabold text-xs md:text-xl lg:text-3xl">{{ $item->parent_name }}</p>
                                                <p class="text-[10px] md:text-lg lg:text-2xl font-semibold text-gray-600">{{ $item->student_name }}</p>
                                                <p class="text-[10px] md:text-lg lg:text-2xl text-gray-500">{{ $item->course_name }}</p>
                                            </div>
                                        </div>
                                        <div class="w-3/5">
                                            <blockquote class="text-blue-900 font-bold text-[15px] sm:text-xl md:text-3xl lg:text-[41px] xl:text-4xl leading-relaxed italic">
                                                {{-- Langsung pakai data yang sudah diproses di controller --}}
                                                "{{ $item->localized_review }}"
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            {{-- FALLBACK --}}
                            <div class="swiper-slide">
                                <div class="flex justify-center items-center">
                                    <div class="flex gap-0 xl:w-3/5 bg-white rounded-[2.5rem] p-8 sm:p-12 shadow-xl mb-12">
                                        <div class="w-2/5">
                                            <div class="w-[100px] h-[100px] md:w-[200px] md:h-[200px] lg:w-[300px] lg:h-[300px] xl:h-[200px] xl:w-[200px] bg-gray-200 overflow-hidden border-4 border-green-100">
                                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=1888&auto=format&fit=crop" class="w-full h-full object-cover">
                                            </div>
                                            <div class="text-blue-900">
                                                <p class="font-extrabold text-xs md:text-xl lg:text-3xl">Ngurah Diva</p>
                                                <p class="text-[10px] md:text-lg lg:text-2xl font-semibold text-gray-600">Students Name, age</p>
                                                <p class="text-[10px] md:text-lg lg:text-2xl text-gray-500">Level/Courses</p>
                                            </div>
                                        </div>
                                        <div class="w-3/5">
                                            <blockquote class="text-blue-900 font-bold text-[15px] sm:text-xl md:text-3xl lg:text-[41px] xl:text-4xl leading-relaxed italic">
                                                "My daughter's problem-solving skills have improved so much... The teachers are patient and the small class is perfect."
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- DUMMY 2 --}}
                            <div class="swiper-slide">
                                <div class="flex justify-center items-center">
                                    <div class="flex gap-0 xl:w-3/5 bg-white rounded-[2.5rem] p-8 sm:p-12 shadow-xl mb-12">
                                        <div class="w-2/5">
                                            <div class="w-[100px] h-[100px] md:w-[200px] md:h-[200px] lg:w-[300px] lg:h-[300px] xl:h-[200px] xl:w-[200px] bg-gray-200 overflow-hidden border-4 border-green-100">
                                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=1888&auto=format&fit=crop" class="w-full h-full object-cover">
                                            </div>
                                            <div class="text-blue-900">
                                                <p class="font-extrabold text-xs md:text-xl lg:text-3xl">Komang Sudana</p>
                                                <p class="text-[10px] md:text-lg lg:text-2xl font-semibold text-gray-600">Students Name, age</p>
                                                <p class="text-[10px] md:text-lg lg:text-2xl text-gray-500">Level/Courses</p>
                                            </div>
                                        </div>
                                        <div class="w-3/5">
                                            <blockquote class="text-blue-900 font-bold text-[15px] sm:text-xl md:text-3xl lg:text-[41px] xl:text-4xl leading-relaxed italic">
                                                "My daughter's problem-solving skills have improved so much... The teachers are patient and the small class is perfect."
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</section>

{{-- 2. SCRIPT JAVASCRIPT UNTUK MENGAKTIFKAN SWIPER --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>