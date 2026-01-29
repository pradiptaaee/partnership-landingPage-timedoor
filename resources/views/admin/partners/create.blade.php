@extends('layouts.admin')

@section('title', 'Tambah Partner')

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">
    
    {{-- 1. HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Tambah Partner</h1>
            <p class="text-gray-500 text-sm">Lengkapi informasi untuk mendaftarkan partner baru.</p>
        </div>
        
        <a href="{{ route('admin.partners.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-50 hover:text-[#0f5132] transition border border-gray-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- CARD WRAPPER --}}
    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">
        
        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row h-full">
            @csrf
            
            {{-- KOLOM KIRI: Input Form --}}
            <div class="w-full lg:w-7/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                
                <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">
                    
                    {{-- 1. Nama Partner --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Nama Partner <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                               placeholder="Contoh: PT. Teknologi Nusantara" 
                               required>
                        @error('name') 
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> 
                        @enderror
                    </div>

                    {{-- 2. Kategori --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="category" 
                               value="{{ old('category') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                               placeholder="Contoh: Swasta, Pemerintah, NGO" 
                               required>
                        @error('category') 
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> 
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" >
                        @error('email') 
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> 
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            No Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="no_telepon" 
                               value="{{ old('no_telepon') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                               
                               >
                        @error('no_telepon') 
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> 
                        @enderror
                    </div>

                    {{-- 3. Deskripsi --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Deskripsi Singkat
                        </label>
                        <textarea name="description" 
                                  rows="4" 
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm leading-relaxed resize-none" 
                                  placeholder="Jelaskan sedikit tentang partner ini...">{{ old('description') }}</textarea>
                        @error('description') 
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> 
                        @enderror
                    </div>

                </div>

                {{-- ACTION BUTTONS --}}
                <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                    <a href="{{ route('admin.partners.index') }}" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 hover:text-gray-800 transition">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Simpan Partner
                    </button>
                </div>

            </div>

            {{-- KOLOM KANAN: Upload Logo & Info --}}
            <div class="w-full lg:w-5/12 bg-gray-50 border-l border-gray-100 overflow-y-auto custom-scrollbar flex flex-col p-8">
                
                {{-- Upload Area --}}
                <div class="mb-8">
                    <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-4">
                        Logo Partner
                    </label>
                    
                    <div class="relative group w-full h-64 bg-white rounded-2xl border-2 border-dashed border-gray-300 hover:border-[#0f5132] hover:bg-emerald-50/30 transition-all duration-300 overflow-hidden flex flex-col items-center justify-center text-center cursor-pointer">
                        
                        <input type="file" id="logo" name="logo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewImage(event)">
                        
                        {{-- Prompt --}}
                        <div id="upload-prompt" class="p-6">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400 group-hover:bg-white group-hover:text-[#0f5132] transition shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-600 group-hover:text-[#0f5132]">Upload Logo</p>
                            <p class="text-[10px] text-gray-400 mt-1">PNG, JPG (Max 2MB)</p>
                        </div>

                        {{-- Preview Image --}}
                        <img id="preview" src="" class="hidden w-full h-full object-contain p-4 z-10">
                        
                        {{-- Remove Button (Hidden by default) --}}
                        <button type="button" id="remove-btn" onclick="removePreview()" class="hidden absolute top-3 right-3 z-30 p-2 bg-white text-red-500 rounded-full shadow-md hover:bg-red-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    @error('logo') <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p> @enderror
                </div>

                {{-- Info Section --}}
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-[#0f5132]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        Panduan
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex gap-3 text-xs text-gray-600 leading-relaxed">
                            <span class="w-1.5 h-1.5 bg-[#0f5132] rounded-full mt-1.5 shrink-0"></span>
                            Pastikan logo memiliki latar belakang transparan (PNG) untuk hasil terbaik.
                        </li>
                        <li class="flex gap-3 text-xs text-gray-600 leading-relaxed">
                            <span class="w-1.5 h-1.5 bg-[#0f5132] rounded-full mt-1.5 shrink-0"></span>
                            Gunakan gambar berkualitas tinggi agar tidak pecah saat ditampilkan.
                        </li>
                        <li class="flex gap-3 text-xs text-gray-600 leading-relaxed">
                            <span class="w-1.5 h-1.5 bg-[#0f5132] rounded-full mt-1.5 shrink-0"></span>
                            Isi kategori dengan jelas (misal: "Teknologi", "Pendidikan") untuk memudahkan filter.
                        </li>
                    </ul>
                </div>

            </div>

        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const prompt = document.getElementById('upload-prompt');
        const removeBtn = document.getElementById('remove-btn');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                prompt.classList.add('hidden');
                removeBtn.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function removePreview() {
        const input = document.getElementById('logo');
        const preview = document.getElementById('preview');
        const prompt = document.getElementById('upload-prompt');
        const removeBtn = document.getElementById('remove-btn');

        input.value = '';
        preview.src = '';
        preview.classList.add('hidden');
        prompt.classList.remove('hidden');
        removeBtn.classList.add('hidden');
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
</style>
@endsection