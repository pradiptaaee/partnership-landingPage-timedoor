@extends('layouts.admin') 

@section('content')
{{-- CONTAINER UTAMA --}}
<div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Tambah Testimoni</h1>
            <p class="text-gray-500 text-sm">Input data review dari orang tua murid (Auto-Translate)</p>
        </div>
        
        <a href="{{ route('admin.testimonials.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-100 hover:text-[#0f5132] transition border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- CARD FORM WRAPPER --}}
    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">
        
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row h-full">
            @csrf
            
            {{-- KOLOM KIRI: Input Form --}}
            <div class="w-full lg:w-6/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                
                <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">
                    
                    {{-- 1. Nama Orang Tua --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Nama Orang Tua <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="parent_name" 
                               value="{{ old('parent_name') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                               placeholder="Contoh: Ibu Ani" required>
                        @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 2. Grid Identitas Anak & Kursus --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Siswa --}}
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                Nama Murid / Umur <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="student_name" 
                                   value="{{ old('student_name') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                                   placeholder="Cth: Budi, 10th" required>
                            @error('student_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nama Kursus --}}
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                Level / Kursus <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="course_name" 
                                   value="{{ old('course_name') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                                   placeholder="Cth: Web Dev Lvl 1" required>
                            @error('course_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- 3. Isi Review (Translatable) --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Isi Testimoni (ID) <span class="text-red-500">*</span>
                        </label>
                        <textarea name="review[id]" 
                                  rows="5" 
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm leading-relaxed resize-none" 
                                  placeholder="Tulis pendapat mereka di sini dalam Bahasa Indonesia..." required>{{ old('review.id') }}</textarea>
                        
                        @error('review.id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- INFO BOX: Auto Translate --}}
                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex gap-3 items-start">
                        <div class="shrink-0 mt-0.5 text-[#0f5132]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[#0f5132] font-bold text-sm mb-0.5">Fitur Auto-Translate</h4>
                            <p class="text-xs text-emerald-700 leading-relaxed">
                                Cukup isi Bahasa Indonesia. Sistem akan otomatis menerjemahkan ke Inggris, Jepang, & Arab saat disimpan.
                            </p>
                        </div>
                    </div>

                </div>

                {{-- ACTION BUTTONS --}}
                <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                    <a href="{{ route('admin.testimonials.index') }}" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 hover:text-gray-800 transition">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Simpan Testimoni
                    </button>
                </div>

            </div>

            {{-- KOLOM KANAN: Upload Foto Modern --}}
            <div class="w-full lg:w-6/12 bg-gray-50 relative group flex flex-col justify-center items-center p-8 border-l border-gray-100 min-h-[350px]">
                
                {{-- Input File Hidden --}}
                <input id="dropzone-file" name="parent_image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                
                {{-- 1. UPLOAD PROMPT (Default State) --}}
                <label for="dropzone-file" id="upload-prompt" class="cursor-pointer flex flex-col items-center justify-center w-full h-full border-2 border-dashed border-gray-300 rounded-2xl hover:border-[#0f5132] hover:bg-emerald-50/30 transition-all duration-300 group-hover:scale-[0.99]">
                    <div class="w-16 h-16 mb-4 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center text-[#0f5132] group-hover:scale-110 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    </div>
                    <h3 class="text-gray-700 font-bold text-lg mb-1">Foto Orang Tua / Murid</h3>
                    <p class="text-sm text-gray-500 mb-6">Klik di sini atau drag & drop file</p>
                    <span class="px-3 py-1 bg-white border border-gray-200 rounded-full text-xs font-medium text-gray-400">JPG, PNG (Rasio 1:1 disarankan)</span>
                </label>

                {{-- 2. PREVIEW IMAGE (Hidden State) --}}
                <div id="preview-container" class="hidden absolute inset-0 w-full h-full bg-gray-900 flex items-center justify-center p-8">
                    {{-- Tombol Ganti --}}
                    <label for="dropzone-file" class="absolute top-6 right-6 z-20 cursor-pointer p-2 bg-black/50 hover:bg-black/70 rounded-full text-white backdrop-blur-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                    </label>

                    <img id="preview-image" src="#" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                    
                    {{-- Info File --}}
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 to-transparent">
                        <p class="text-[10px] text-[#4ade80] font-bold uppercase tracking-wider mb-1 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#4ade80] animate-pulse"></span> Siap Diupload
                        </p>
                        <p id="file-name" class="text-white font-medium truncate max-w-md opacity-90">nama_file.jpg</p>
                    </div>
                </div>

                {{-- Error Message --}}
                @error('parent_image')
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 animate-bounce">
                        <span class="bg-red-500 text-white px-4 py-2 rounded-full text-xs font-bold shadow-lg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                            {{ $message }}
                        </span>
                    </div>
                @enderror

            </div>

        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const promptDiv = document.getElementById('upload-prompt');
        const previewDiv = document.getElementById('preview-container');
        const previewImg = document.getElementById('preview-image');
        const fileNameTxt = document.getElementById('file-name');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                fileNameTxt.textContent = input.files[0].name;

                promptDiv.classList.add('hidden');
                previewDiv.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
</style>
@endsection