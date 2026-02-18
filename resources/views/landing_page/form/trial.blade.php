@extends('landing_page.layouts.app')

@section('content')

<div class="w-full max-w-[1440px] mx-auto overflow-hidden mb-10">
    <div class="grid lg:grid-cols-2 gap-10">

        {{-- Left Section --}}
        <div class="bg-white p-8 md:p-16 lg:p-20 flex flex-col justify-center">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-[#1e3a5f] mb-3">
                {{ __('Book a Free Trial') }}
            </h1>
            <p class="text-base text-gray-600 mb-12 leading-relaxed">
                {{ __('Trial Desc') }}
            </p>

            <div class="relative w-full max-w-lg mx-auto">
                <img src="{{ asset('images/trial-image.png') }}" alt="trial img" class="w-full h-auto">
            </div>
        </div>

        {{-- Right Section - Form --}}
        <div class="bg-white p-6 md:p-12 lg:p-16 overflow-y-auto">

            {{-- Success Message --}}
            @if(session('success'))
            <div class="flex items-center gap-2 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-xl shadow-sm" role="alert">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
            <div class="flex items-center gap-3 bg-red-100 border border-red-400 text-red-700 p-4 mb-6 rounded-xl" role="alert">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
            @endif

            <form id="trialForm" action="" method="POST">
                @csrf

                {{-- Prefix & Name --}}
                <div class="grid md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-2 tracking-widest uppercase">
                            {{ __('Prefix') }}
                        </label>
                        <div class="bg-[#e8eaed] rounded-lg h-11 overflow-hidden">
                            <select id="prefix" name="prefix" required
                                class="w-full h-full bg-transparent border-none px-3 text-sm text-[#3c4043] focus:ring-0 focus:outline-none cursor-pointer">
                                <option value="Mr." {{ old('prefix') == 'Mr.'   ? 'selected' : '' }}>Mr.</option>
                                <option value="Mrs." {{ old('prefix') == 'Mrs.'  ? 'selected' : '' }}>Mrs.</option>
                                <option value="Ms." {{ old('prefix') == 'Ms.'   ? 'selected' : '' }}>Ms.</option>
                                <option value="Mx." {{ old('prefix') == 'Mx.'   ? 'selected' : '' }}>Mx.</option>
                                <option value="Miss." {{ old('prefix') == 'Miss.' ? 'selected' : '' }}>Miss.</option>
                                <option value="Dr." {{ old('prefix') == 'Dr.'   ? 'selected' : '' }}>Dr.</option>
                                <option value="Prof." {{ old('prefix') == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-2 tracking-widest uppercase">
                            {{ __('Name') }}
                        </label>
                        <div class="bg-[#e8eaed] rounded-lg h-11 overflow-hidden @error('name') ring-2 ring-red-500 @enderror">
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="{{ __('Your Name') }}" required
                                class="w-full h-full bg-transparent border-none px-4 text-sm text-[#3c4043] placeholder-gray-400 focus:ring-0 focus:outline-none">
                        </div>
                        @error('name')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Country --}}
                <div class="mb-6">
                    <label class="block text-[11px] font-bold text-gray-500 mb-2 tracking-widest uppercase">
                        {{ __('Country') }}
                    </label>
                    <div class="bg-[#e8eaed] rounded-lg h-11 overflow-hidden">
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

                {{-- Phone & Email --}}
                <div class="grid md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-2 tracking-widest uppercase">
                            Whatsapp / Phone Number
                        </label>
                        <div class="bg-[#e8eaed] rounded-lg h-11 w-full relative">
                            <input type="tel" id="phone" name="phone" required
                                class="w-full h-full bg-transparent border-none text-sm text-[#3c4043] placeholder-gray-400 focus:ring-0 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-2 tracking-widest uppercase">
                            {{ __('Email') }}
                        </label>
                        <div class="bg-[#e8eaed] rounded-lg h-11 overflow-hidden @error('email') ring-2 ring-red-500 @enderror">
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="your@email.com" required
                                class="w-full h-full bg-transparent border-none px-4 text-sm text-[#3c4043] placeholder-gray-400 focus:ring-0 focus:outline-none">
                        </div>
                        @error('email')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Kids List --}}
                <div class="mb-6">
                    <label class="block text-[11px] font-bold text-gray-500 mb-2 tracking-widest uppercase">
                        {{ __('Kids List') }}
                    </label>
                    <div class="bg-[#e8eaed] rounded-lg overflow-hidden">
                        <textarea id="kids_list" name="kids_list" required
                            class="w-full bg-transparent border-none px-4 py-3 text-sm text-[#3c4043] placeholder-gray-400 focus:ring-0 focus:outline-none min-h-[100px] resize-y"
                            placeholder="{{ __('Please list all the kids that want to join free trial following this format') }}&#10;[Name - Age]&#10;eg: Jhon - 12">{{ old('kids_list') }}</textarea>
                    </div>
                </div>

                {{-- Message --}}
                <div class="mb-6">
                    <label class="block text-[11px] font-bold text-gray-500 mb-2 tracking-widest uppercase">
                        {{ __('Message') }}
                    </label>
                    <div class="bg-[#e8eaed] rounded-lg overflow-hidden">
                        <textarea id="message" name="message"
                            class="w-full bg-transparent border-none px-4 py-3 text-sm text-[#3c4043] placeholder-gray-400 focus:ring-0 focus:outline-none min-h-[100px] resize-y"
                            placeholder="{{ __('Tuliskan pesan Anda di sini...') }}">{{ old('message') }}</textarea>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="w-fit min-w-[200px] bg-[#10AF13] hover:bg-[#0E8E10] active:translate-y-0.5 text-white font-bold py-3 px-10 rounded-xl uppercase text-base transition-all duration-150">
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

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js"></script>
@vite('resources/js/landing_page/trial.js')
@endpush