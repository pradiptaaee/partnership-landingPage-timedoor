<section class="w-full bg-[#10AF13]">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            <nav class="flex justify-between items-center pb-12">
                <div class="w-32 sm:w-40 brightness-0 invert">
                     <img src="https://timedooracademy.com/images/logo-timedoor-academy-v2.png" alt="Timedoor Academy" class="w-full h-auto"> 
                </div>
                <a href="#" class="bg-white text-[#00C220] text-xs sm:text-sm font-bold py-2.5 px-4 rounded-xl transition duration-300 uppercase shadow-[0_7px_0_#0E8E10] hover:scale-105">
                    {{ __('Book a Free Trial') }}
                </a>
            </nav>

            <div class="swiper swiperLeft border-4 border-white rounded-[2.5rem] mb-10 lg:mb-14">
                <div class="swiper-wrapper">
                    @forelse($banners as $banner)
                        <div class="swiper-slide">
                            <div class="p-6 sm:p-10 flex items-center justify-between gap-8 relative overflow-hidden bg-[#10AF13]">
                                <div class="text-white z-10 w-1/2">
                                    <h3 class="text-base sm:text-3xl md:text-4xl lg:text-5xl font-semibold leading-tight">
                                        {{ $banner->title }}
                                    </h3>
                                </div>
                                <div class="w-1/2 aspect-video bg-gray-800 rounded-3xl flex items-center justify-center text-white text-center overflow-hidden shadow-lg">
                                    <img src="{{ Storage::url($banner->image) }}" class="w-full h-full object-cover opacity-80" alt="{{ $banner->title }}">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="p-10 bg-[#10AF13] text-white text-center">
                                <h3 class="text-3xl font-bold">Banner</h3>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <h2 class="text-white text-center font-extrabold text-2xl sm:text-4xl md:text-5xl lg:text-6xl mb-5">
                {{ __('Section Testimoni') }}
            </h2>

            <div class="swiper swiperRight">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $testimoni)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-[2.5rem] p-8 sm:p-12 shadow-xl mb-12 border border-gray-100 h-full">
                                <div class="flex gap-0">
                                    <div class="w-2/5 flex flex-col items-center sm:items-start text-center sm:text-left">
                                        <div class="w-[100px] h-[100px] md:w-[200px] md:h-[200px] lg:w-[300px] lg:h-[300px] bg-gray-200 overflow-hidden border-4 border-green-100 mb-4 rounded-3xl">
                                            <img src="{{ Storage::url($testimoni->parent_image) }}" alt="{{ $testimoni->parent_name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="text-blue-900 w-full pr-2">
                                            <p class="font-extrabold text-xs md:text-xl lg:text-3xl line-clamp-1">{{ $testimoni->parent_name }}</p>
                                            @if($testimoni->student_name)
                                                <p class="text-[10px] md:text-lg lg:text-2xl font-semibold text-gray-600 mt-1">{{ $testimoni->student_name }}</p>
                                            @endif
                                            @if($testimoni->course_name)
                                                <p class="text-[10px] md:text-lg lg:text-2xl text-gray-500">{{ $testimoni->course_name }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-3/5 flex items-center">
                                        <blockquote class="text-blue-900 font-bold text-[15px] sm:text-xl md:text-3xl lg:text-[41px] leading-relaxed italic relative">
                                            <span class="text-6xl text-green-200 absolute -top-4 -left-2 opacity-50 font-serif">"</span>
                                            {{ $testimoni->review }}
                                            <span class="text-6xl text-green-200 absolute -bottom-8 -right-2 opacity-50 font-serif">"</span>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="bg-white rounded-[2.5rem] p-12 shadow-xl text-center">
                                <p class="text-gray-500 text-xl">No Testimonials.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>