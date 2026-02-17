@extends('landing_page.layouts.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js"></script>

@section('content')
<style>
    /* 1. Container Library: Wajib relative biar dropdown nempel di dia */
    .iti { width: 100%; display: block; }

    /* 2. Input Nomor: Padding kiri biar gak nabrak bendera */
    #phone { padding-left: 90px !important; }

    /* 3. Dropdown List Negara: INI KUNCINYA BIAR NEMPEL & RAPI */
    .iti__country-list {
        width: 100% !important;      /* Lebar ngikutin induknya */
        max-width: 100% !important;  /* Gak boleh lebih lebar */
        border-radius: 0 0 8px 8px;  /* Sudut bawah tumpul */
        border: 1px solid #dadce0;
        border-top: none;            /* Hapus border atas biar seolah nyambung (opsional) */
        margin-top: 2px;             /* Jarak dikit biar manis */
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        z-index: 999;
    }

    /* 4. Area Bendera */
    .iti__flag-container {
        border: none;
        background: transparent;
    }
    
    /* 5. Teks +62 */
    .iti__selected-dial-code {
        color: #3c4043;
        font-size: 14px;
        font-weight: 500;
    }
</style>

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
                        <select name="country" id="country" required 
                            class="w-full h-full bg-transparent border-none px-3 text-[14px] text-[#3c4043] focus:ring-0 focus:outline-none cursor-pointer">
                            <option value="Indonesia">Indonesia</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Australia">Australia</option>
                            <option value="Other">Other</option>
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
    </div>
</div>

<script>
    const inputPhone = document.querySelector("#phone");
    const form = document.getElementById("trialForm");

    // 1. Inisialisasi Library
    const iti = window.intlTelInput(inputPhone, {
        initialCountry: "id",
        separateDialCode: true,
        autoPlaceholder: "off",
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.js",
    });

    // 2. Gabungin Nomor Pas Submit
    form.addEventListener('submit', function() {
        const fullNumber = iti.getNumber();
        inputPhone.value = fullNumber; 
    });
</script>
@endsection