@extends('landing_page.layouts.app')


@section('content')

<div class="w-full max-w-[1440px] mx-auto overflow-hidden mb-10 mt-10">
    <div class="grid lg:grid-cols-2 gap-10">

        <div class="bg-white p-8 md:p-16 lg:p-20 flex flex-col justify-center">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-[#1e3a5f] mb-3">
                {{ __('Book a Free Trial') }}
            </h1>
            <p class="text-base text-gray-600 mb-12 leading-relaxed">
                {{ __('Trial Desc') }}
            </p>
            <div class="relative w-full max-w-lg mx-auto">
                <img src="{{ asset('images/trial-image.png') }}" alt="trial img">
            </div>
        </div>

        <div class="bg-white p-6 md:p-12 lg:p-16 overflow-y-auto">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-xl shadow-sm animate-bounce-short">
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            @endif

            <form id="trialForm" action="{{ route('landing.book-trial.store') }}" method="POST">
                @csrf

                <div class="grid md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight uppercase">{{ __('Prefix') }}</label>
                        <div class="bg-[#e8eaed] rounded-[8px] h-[44px] overflow-hidden">
                            <select class="w-full h-full bg-transparent border-none px-3 text-[14px] text-[#3c4043] focus:ring-0 focus:outline-none cursor-pointer" id="prefix" name="prefix" required>
                                <<option value="Mr." {{ old('prefix') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                <option value="Mrs." {{ old('prefix') == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                                <option value="Ms." {{ old('prefix') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                                <option value="Mx." {{ old('prefix') == 'Mx.' ? 'selected' : '' }}>Mx.</option>
                                <option value="Miss." {{ old('prefix') == 'Miss.' ? 'selected' : '' }}>Miss.</option>
                                <option value="Dr." {{ old('prefix') == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                                <option value="Prof." {{ old('prefix') == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight uppercase">{{ __('Name') }}</label>
                        <div class="bg-[#e8eaed] rounded-[8px] h-[44px] overflow-hidden">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Your Name') }}" required
                                class="w-full h-full bg-transparent border-none px-4 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight uppercase">{{ __('Country') }}</label>
                    <div class="bg-[#e8eaed] rounded-[8px] h-[44px] overflow-hidden">
                        <select id="country" name="country" required
                            class="w-full h-full bg-transparent border-none px-3 text-sm text-[#3c4043] focus:ring-0 focus:outline-none cursor-pointer">
                            <option value="Indonesia" {{ old('country') == 'Indonesia'            ? 'selected' : '' }}>Indonesia</option>
                            <option value="Singapore" {{ old('country') == 'Singapore'            ? 'selected' : '' }}>Singapore</option>
                            <option value="Malaysia" {{ old('country') == 'Malaysia'             ? 'selected' : '' }}>Malaysia</option>
                            <option value="Australia" {{ old('country') == 'Australia'            ? 'selected' : '' }}>Australia</option>
                            <option value="Bangladesh" {{ old('country') == 'Bangladesh'           ? 'selected' : '' }}>Bangladesh</option>
                            <option value="Brazil" {{ old('country') == 'Brazil'               ? 'selected' : '' }}>Brazil</option>
                            <option value="Canada" {{ old('country') == 'Canada'               ? 'selected' : '' }}>Canada</option>
                            <option value="China" {{ old('country') == 'China'                ? 'selected' : '' }}>China</option>
                            <option value="France" {{ old('country') == 'France'               ? 'selected' : '' }}>France</option>
                            <option value="Germany" {{ old('country') == 'Germany'              ? 'selected' : '' }}>Germany</option>
                            <option value="India" {{ old('country') == 'India'                ? 'selected' : '' }}>India</option>
                            <option value="Japan" {{ old('country') == 'Japan'                ? 'selected' : '' }}>Japan</option>
                            <option value="Netherlands" {{ old('country') == 'Netherlands'          ? 'selected' : '' }}>Netherlands</option>
                            <option value="New Zealand" {{ old('country') == 'New Zealand'          ? 'selected' : '' }}>New Zealand</option>
                            <option value="Pakistan" {{ old('country') == 'Pakistan'             ? 'selected' : '' }}>Pakistan</option>
                            <option value="Philippines" {{ old('country') == 'Philippines'          ? 'selected' : '' }}>Philippines</option>
                            <option value="Qatar" {{ old('country') == 'Qatar'                ? 'selected' : '' }}>Qatar</option>
                            <option value="Saudi Arabia" {{ old('country') == 'Saudi Arabia'         ? 'selected' : '' }}>Saudi Arabia</option>
                            <option value="South Korea" {{ old('country') == 'South Korea'          ? 'selected' : '' }}>South Korea</option>
                            <option value="Thailand" {{ old('country') == 'Thailand'             ? 'selected' : '' }}>Thailand</option>
                            <option value="Turkey" {{ old('country') == 'Turkey'               ? 'selected' : '' }}>Turkey</option>
                            <option value="United Arab Emirates" {{ old('country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                            <option value="United Kingdom" {{ old('country') == 'United Kingdom'       ? 'selected' : '' }}>United Kingdom</option>
                            <option value="United States" {{ old('country') == 'United States'        ? 'selected' : '' }}>United States</option>
                            <option value="Vietnam" {{ old('country') == 'Vietnam'              ? 'selected' : '' }}>Vietnam</option>
                            <option value="Other" {{ old('country') == 'Other'                ? 'selected' : '' }}>{{ __('Other') }}</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight uppercase">Whatsapp / Phone Number</label>
                        
                        <div class="bg-[#e8eaed] rounded-[8px] h-[44px] w-full relative">
                            <input type="tel" id="phone" name="phone" required 
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full h-full bg-transparent border-none text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight uppercase">{{ __('Email') }}</label>
                        <div class="bg-[#e8eaed] rounded-[8px] h-[44px] overflow-hidden">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required
                                class="w-full h-full bg-transparent border-none px-4 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none">
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight uppercase">{{ __('Kids List') }}</label>
                    <div class="bg-[#e8eaed] rounded-[8px] overflow-hidden">
                        <textarea id="kids_list" name="kids_list" required
                            class="w-full bg-transparent border-none px-4 py-3 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none min-h-[100px] resize-y"
                            placeholder="[Name - Age]">{{ old('kids_list') }}</textarea>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight uppercase">{{ __('Message') }}</label>
                    <div class="bg-[#e8eaed] rounded-[8px] overflow-hidden">
                        <textarea id="message" name="message" 
                            class="w-full bg-transparent border-none px-4 py-3 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none min-h-[100px] resize-y"
                            placeholder="Pesan Anda...">{{ old('message') }}</textarea>
                    </div>
                </div>

                <button type="submit"
                    class="w-fit min-w-[200px] bg-[#10AF13] text-white font-bold py-3 px-10 rounded-xl uppercase text-base transition-all duration-150 hover:bg-[#0E8E10] active:translate-y-[2px]">
                    {{ __('Send Message') }}
                </button>
            </form>
        </div>
        <div class="px-6 py-4">
            <div class="flex items-center space-x-4 text-lg">

                <a href="{{ route('landing') }}" class="text-gray-400 font-medium hover:text-gray-600 transition">
                    Home
                </a>

                <svg class="w-4 h-4 text-[#10AF13]" fill="currentColor" viewBox="0 0 20 20">
                    <polygon points="0,0 20,10 0,20"></polygon>
                </svg>

                <span class="text-gray-600 font-semibold">
                    {{ __('Book a Free Trial') }}
                </span>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@vite('resources/js/landing_page/trial.js')
@endpush