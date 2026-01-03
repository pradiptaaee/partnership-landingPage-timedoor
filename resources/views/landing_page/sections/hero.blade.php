<section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 lg:w-full min-h-screen flex flex-col">

        <nav class="flex justify-between items-center py-6">
            <div class="w-32 sm:w-40">
                {{-- LOGO SVG (Dipendekkan biar tidak kepanjangan di chat, isi tetap sama) --}}
                <img src="https://timedooracademy.com/images/logo-timedoor-academy-v2.png" alt="Timedoor Academy" class="w-full h-auto"> 
            </div>
            
            {{-- TOMBOL GANTI BAHASA --}}
            <a href="#" class="bg-[#10AF13] text-white text-xs sm:text-sm font-bold py-2.5 px-4 rounded-xl transition duration-300 uppercase shadow-[0_7px_0_#0E8E10] hover:scale-105">
                {{ __('Book a Free Trial') }}
            </a>
        </nav>

        <main class="mt-4 sm:mt-8 xl:mt-5 mx-auto flex-grow">
            <div class="mx-4 xl:w-3/4 mx-auto">
                <h2 class="text-blue-900 font-bold text-3xl md:text-5xl lg:text-6xl xl:text-3xl mb-3 xl:mb-0">
                    {{ __('Hero Title') }}
                </h2>
                <h1 class="text-blue-900 font-extrabold text-5xl leading-14 md:leading-20 lg:leading-24 md:text-7xl lg:text-8xl xl:text-5xl mb-3 xl:mb-0">
                    {{ __('Hero Subtitle') }}
                </h1>
                <p class="text-gray-900 text-base sm:text-lg md:text-xl lg:text-2xl xl:text-base mb-5 max-w-2xl leading-relaxed">
                    {{ __('Hero Desc') }}
                </p>
            </div>
            <div class="w-full xl:w-3/4 bg-gray-100 rounded-4xl aspect-[4/3] sm:aspect-video mb-10 mx-auto shadow-sm overflow-hidden relative group">
                <img src="https://i.pinimg.com/1200x/39/79/ca/3979cafea548c6745f9eb1bf9808305e.jpg" alt="Kids Coding" class="object-cover w-full h-full opacity-80 group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="mb-16 text-center">
                <a href="#" class="inline-block bg-[#10AF13] hover:bg-[#0E8E10] text-white text-xl sm:text-2xl font-extrabold py-4 px-8 sm:px-12 rounded-2xl shadow-[0_7px_0_#0E8E10] transition transform hover:-translate-y-1">
                    {{ __('Book a Free Trial') }}
                </a>
            </div>
        </main>
    </section>