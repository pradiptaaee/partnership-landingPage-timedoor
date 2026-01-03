<section class="w-full bg-[#10AF13]">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <nav class="flex justify-between items-center pb-10">
                <div class="w-32 sm:w-40 brightness-0 invert">
                     <img src="https://timedooracademy.com/images/logo-timedoor-academy-v2.png" alt="Timedoor Academy" class="w-full h-auto"> 
                </div>
                <a href="#" class="bg-white text-[#00C220] text-xs sm:text-sm font-bold py-2.5 px-4 rounded-xl transition duration-300 uppercase shadow-[0_7px_0_#0E8E10] hover:scale-105">
                    {{ __('Book a Free Trial') }}
                </a>
            </nav>

            <h2 class="text-white text-center font-extrabold text-[22px] sm:text-5xl mb-5 lg:text-6xl tracking-tight drop-shadow-sm">
                {{ __('Section Project') }}
            </h2>

            <div class="flex w-full gap-1.5">
                <button class="btn-prev z-10">
                    <svg width="25" height="25" viewBox="0 0 34 34" fill="none"><circle cx="17" cy="17" r="16" stroke="white" stroke-width="2" /><path d="M21 8L12 17L21 26" stroke="white" stroke-width="2" /></svg>
                </button>

                <div class="swiper projectSwiper w-5/6 h-full bg-white rounded-[2.5rem]">
                    <div class="swiper-wrapper">
                        @forelse($projects as $project)
                            <div class="swiper-slide p-1.5 shadow-2xl mx-auto" 
                                data-student="{{ $project->student_name }}" 
                                data-type="{{ $project->project_type }}">
                                <div class="relative aspect-video rounded-[2.2rem] overflow-hidden bg-gray-900 group">
                                    <img src="{{ Storage::url($project->project_image) }}" alt="{{ $project->project_type }}" class="absolute inset-0 w-full h-full object-cover opacity-100 transition-transform duration-700 group-hover:scale-105">
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide p-1.5 text-center py-20">
                                <p class="text-gray-500">No Projects.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <button class="btn-next z-10">
                    <svg width="25" height="25" viewBox="0 0 34 34" fill="none"><circle cx="17" cy="17" r="16" stroke="white" stroke-width="2" /><path d="M13 8L22 17L13 26" stroke="white" stroke-width="2" /></svg>
                </button>
            </div>

            <div class="text-center mt-8 pb-10 fade-in-up">
                <h3 id="student-name-display" class="text-white font-extrabold text-base sm:text-4xl lg:text-5xl tracking-wide mb-3 drop-shadow-md transition-all duration-300">
                    {{ $projects->first()->student_name ?? 'Student Name' }}
                </h3>
                <div class="inline-flex items-center gap-4 bg-white/10 px-6 py-2 rounded-2xl backdrop-blur-sm border border-white/10">
                    <span class="text-white font-bold text-sm sm:text-2xl lg:text-3xl">{{ __('Project Type') }}:</span>
                    <span class="bg-[#1C2F70] text-[#FFD43C] px-6 py-1.5 rounded-xl text-sm sm:text-2xl font-bold shadow-lg transform -skew-x-6 border-2 border-[#fbbf24]/50">
                        <span id="project-type-display" class="block transform skew-x-6">
                            {{ $projects->first()->project_type ?? 'Type' }}
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </section>