<section class="w-full bg-[#10AF13] relative overflow-hidden bg-green-trigger">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 relative z-10">

        <h2 data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" class="mt-8 text-white text-center font-extrabold text-[22px] sm:text-5xl lg:text-6xl xl:text-5xl tracking-tight drop-shadow-sm">
            {{ __('Section Project') }}
        </h2>

        <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="500" class="relative w-full py-5 xl:py-6">

            <!-- Navigation Buttons -->
            <button class="btn-prev absolute left-1 xl:left-[8%] top-1/2 -translate-y-1/2 z-20 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-white/20 rounded-full blur-xl group-hover:bg-white/30 transition-all duration-300"></div>
                    <svg width="22" height="22" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="relative rounded-full transition-all duration-300 group-hover:scale-110 xl:w-14 xl:h-14 md:w-10 md:h-10 drop-shadow-lg">
                        <circle cx="17" cy="17" r="16" stroke="white" stroke-width="2.5" class="group-hover:stroke-white/90" />
                        <path d="M21 8L12 17L21 26" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </button>

            <button class="btn-next absolute right-1 xl:right-[8%] top-1/2 -translate-y-1/2 z-20 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-white/20 rounded-full blur-xl group-hover:bg-white/30 transition-all duration-300"></div>
                    <svg width="22" height="22" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="relative rounded-full transition-all duration-300 group-hover:scale-110 xl:w-14 xl:h-14 md:w-10 md:h-10 drop-shadow-lg">
                        <circle cx="17" cy="17" r="16" stroke="white" stroke-width="2.5" class="group-hover:stroke-white/90" />
                        <path d="M13 8L22 17L13 26" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </button>

            <div class="swiper project_swiper w-[82%] xl:w-3/5 mx-auto h-full">
                <div class="swiper-wrapper">

                    {{-- Data dari controller --}}
                    @if(isset($projects) && $projects->count() > 0)
                        @foreach($projects as $proj)
                            <div class="swiper-slide group"
                                data-name="{{ $proj->student_name }}"
                                data-age="{{ $proj->formatted_age }}"
                                data-project="{{ $proj->localized_project_type }}">
                                <div class="relative bg-white rounded-[2.5rem] xl:rounded-[3rem] p-2 xl:p-3 transition-all duration-500">
                                    <div class="relative aspect-video rounded-[2rem] xl:rounded-[2.5rem] overflow-hidden bg-gradient-to-br from-purple-900 to-blue-900">
                                        <img src="{{ Storage::url(str_replace('public/', '', $proj->project_image)) }}"
                                            class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-105 group-hover:opacity-90"
                                            onerror="this.src='https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop'">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- STATIC FALLBACK --}}
                        <div class="swiper-slide group"
                            data-name="Krisna Mahardika"
                            data-age="17 Years"
                            data-project="Website">
                            <div class="relative bg-white rounded-[2.5rem] xl:rounded-[3rem] p-2 xl:p-3 transition-all duration-500">
                                <div class="relative aspect-video rounded-[2rem] xl:rounded-[2.5rem] overflow-hidden bg-gradient-to-br from-purple-900 to-blue-900">
                                    <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop"
                                        class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-105 group-hover:opacity-90">
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="swiper-pagination !bottom-[-2.5rem]"></div>
            </div>
        </div>

        {{-- INFO PROJECT (TEXT DI BAWAH SLIDER) --}}
        <div class="text-center pb-10">
            <h3 data-aos="fade-up" data-aos-delay="200" data-aos-duration="500" id="students" class="text-white font-extrabold text-base sm:text-4xl lg:text-5xl xl:text-4xl tracking-wide mb-3 drop-shadow-md">
                Student Name
            </h3>
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="500" class="inline-flex items-center gap-4 bg-white/10 px-6 py-2 rounded-2xl backdrop-blur-sm border border-white/10">
                <span class="text-white font-bold text-sm sm:text-2xl lg:text-3xl">{{ __('Project Type') }}:</span>
                <span class="bg-[#1C2F70] text-[#FFD43C] px-6 py-1.5 rounded-xl text-sm sm:text-2xl font-bold shadow-lg transform -skew-x-6 border-2 border-[#fbbf24]/50">
                    <span id="project_type" class="block transform skew-x-6">Website</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <!-- Dot Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #0E8E10 1px, transparent 1px); background-size: 50px 50px;"></div>

        <!-- Subtle Wave Lines -->
        <div class="absolute bottom-0 left-0 w-full h-3/5 opacity-30">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-full">
                <path d="M0,50 Q300,10 600,50 T1200,50 L1200,120 L0,120 Z" fill="#0E8E10" />
            </svg>
        </div>

        <div class="absolute bottom-0 left-0 w-full h-1/2 opacity-55">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-full">
                <path d="M0,70 Q300,30 600,70 T1200,70 L1200,120 L0,120 Z" fill="#0E8E10" />
            </svg>
        </div>

        <!-- Grid Lines Subtle -->
        <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(#0E8E10 1px, transparent 1px), linear-gradient(90deg, #0E8E10 1px, transparent 1px); background-size: 100px 100px;"></div>
    </div>
</section>