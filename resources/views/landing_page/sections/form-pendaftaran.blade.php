@extends('landing_page.layouts.app')

@section('content')
<div class="bg-white min-h-screen overflow-hidden">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-8 py-8">
        
        {{-- --- NOTIFIKASI START --- --}}
        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-[8px] flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-4xl mx-auto mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-[8px] shadow-sm text-sm font-bold">
                {{ session('error') }}
            </div>
        @endif
        {{-- --- NOTIFIKASI END --- --}}

        <div class="flex flex-row items-start gap-12 lg:gap-20">
            
            <div class="w-[35%]">
                <div class="mb-10">
                    <h1 class="text-[52px] font-black text-[#1a2e5a] leading-[1.1] mb-3">
                        Book Free Trial
                    </h1>
                    <p class="text-[15px] text-[#6b7280] font-normal leading-[1.6]">
                        Maximize children's potential with A fun-based IT education
                    </p>
                </div>
                
                <div class="relative w-full">
                    <img src="{{ asset('assets/img/trial-illustration.png') }}" alt="Trial Illustration" class="w-full h-auto">
                </div>
            </div>

            <div class="w-[65%]">
                {{-- Update ACTION ke Route Store --}}
                <form action="{{ route('landing.book-trial.store') }}" method="POST" class="space-y-[18px]">
                    @csrf
                    
                    <div class="grid grid-cols-12 gap-[18px]">
                        <div class="col-span-4">
                            <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight text-uppercase">Prefix</label>
                            <div class="relative">
                                <select name="prefix" class="w-full bg-[#e8eaed] border-none rounded-[8px] h-[44px] px-4 text-[14px] text-[#3c4043] focus:ring-0 focus:outline-none appearance-none">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-[#5f6368]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-8">
                            <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight text-uppercase">Name</label>
                            <input type="text" name="name" placeholder="Your Name" required class="w-full bg-[#e8eaed] border-none rounded-[8px] h-[44px] px-4 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight text-uppercase">Country</label>
                        <div class="relative">
                            <select name="country" class="w-full bg-[#e8eaed] border-none rounded-[8px] h-[44px] px-4 text-[14px] text-[#3c4043] focus:ring-0 focus:outline-none appearance-none">
                                <option value="Indonesia">Indonesia</option>
                                <option value="Japan">Japan</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Malaysia">Malaysia</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-[#5f6368]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-[18px]">
                        <div>
                            <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight text-uppercase">Whatsapp / Phone Number</label>
                            <div class="flex items-stretch bg-[#e8eaed] rounded-[8px] h-[44px] overflow-hidden">
                                <div class="relative flex items-center border-r border-[#dadce0] pl-3 pr-2">
                                    <span class="text-[14px] text-[#3c4043] font-medium flex items-center gap-1.5">
                                        <img src="https://flagcdn.com/w20/id.png" width="18" alt="ID" class="inline-block">
                                        <span>+62</span>
                                    </span>
                                </div>
                                <input type="tel" name="phone" placeholder="812-345-678" required class="flex-1 bg-transparent border-none px-3 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight text-uppercase">Email</label>
                            <input type="email" name="email" placeholder="Email" required class="w-full bg-[#e8eaed] border-none rounded-[8px] h-[44px] px-4 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight text-uppercase">Kids List</label>
                        <textarea name="kids_list" rows="4" placeholder="Please list all the Kids that want to join free trial following this format [Name - Age]&#10;eg: Jhon - 12" class="w-full bg-[#e8eaed] border-none rounded-[8px] py-3 px-4 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none resize-none leading-[1.6]"></textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-[#6b7280] mb-[8px] tracking-tight text-uppercase">Message</label>
                        <textarea name="message" rows="4" class="w-full bg-[#e8eaed] border-none rounded-[8px] py-3 px-4 text-[14px] text-[#3c4043] placeholder-[#80868b] focus:ring-0 focus:outline-none resize-none leading-[1.6]"></textarea>
                    </div>

                    <div class="flex justify-start pt-2">
                        <button type="submit" class="bg-[#0caf13] hover:bg-[#0a9610] text-white font-bold py-[13px] px-[42px] rounded-[8px] text-[13px] tracking-wide transition-all duration-200">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection