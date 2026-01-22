@extends('layouts.admin') 

@section('content')
{{-- CONTAINER UTAMA --}}
<div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Edit Project</h1>
            <p class="text-gray-500 text-sm">Perbarui informasi karya siswa (Bahasa Indonesia)</p>
        </div>
        
        <a href="{{ route('admin.projects.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-100 hover:text-[#0f5132] transition border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- CARD WRAPPER --}}
    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">
        
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row h-full">
            @csrf
            @method('PUT')
            
            {{-- KOLOM KIRI: INPUT FORM --}}
            <div class="w-full lg:w-5/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                
                <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">
                    
                    {{-- 1. Nama Murid --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Nama Murid <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="student_name" 
                               value="{{ old('student_name', $project->student_name) }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                               placeholder="Nama lengkap murid" 
                               required>
                        @error('student_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 2. Umur Murid --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Umur <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="age" 
                                   value="{{ old('age', $project->age) }}"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                                   placeholder="Contoh: 12 Years" 
                                   required>
                            <div class="absolute right-4 top-3 text-gray-400 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                            </div>
                        </div>
                        @error('age') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 3. Tipe Project (Translatable) --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Judul Project (ID) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="project_type[id]" 
                               value="{{ old('project_type.id', $project->getTranslation('project_type', 'id')) }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium" 
                               placeholder="Judul dalam Bahasa Indonesia" 
                               required>
                        @error('project_type.id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- INFO BOX: Auto Translate --}}
                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex gap-3 items-start">
                        <div class="shrink-0 mt-0.5 text-[#0f5132]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.223 1.794.49 2.684.785" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[#0f5132] font-bold text-sm mb-0.5">Auto-Translate Aktif</h4>
                            <p class="text-xs text-emerald-700 leading-relaxed">
                                Jika Anda mengubah judul Indonesia, sistem akan otomatis menerjemahkan ulang ke Inggris & Jepang saat disimpan.
                            </p>
                        </div>
                    </div>

                </div>

                {{-- ACTION BUTTONS --}}
                <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                    <a href="{{ route('admin.projects.index') }}" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 hover:text-gray-800 transition">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        Simpan Perubahan
                    </button>
                </div>

            </div>

            {{-- KOLOM KANAN: PREVIEW GAMBAR --}}
            <div class="w-full lg:w-7/12 bg-gray-900 relative group overflow-hidden flex items-center justify-center min-h-[300px] lg:min-h-auto">
                
                {{-- Hidden Input --}}
                <input id="dropzone-file" name="project_image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                
                {{-- Trigger Button (Center Overlay) --}}
                <label for="dropzone-file" class="absolute inset-0 z-20 cursor-pointer flex flex-col items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[2px]">
                    <div class="w-16 h-16 mb-3 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white shadow-lg transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                    </div>
                    <span class="text-white font-bold text-lg tracking-tight">Ganti Gambar</span>
                    <span class="text-gray-300 text-xs mt-1">Klik untuk mengunggah screenshot baru</span>
                </label>

                {{-- Image Container --}}
                <div class="w-full h-full relative">
                    <img id="preview-image" 
                         src="{{ Storage::url($project->project_image) }}" 
                         class="w-full h-full object-contain transition-all duration-500 group-hover:scale-95 group-hover:opacity-60">
                    
                    {{-- Gradient Overlay Bawah --}}
                    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black/90 to-transparent pointer-events-none"></div>
                </div>

                {{-- Info File (Floating Bottom) --}}
                <div class="absolute bottom-6 left-6 right-6 z-10 flex justify-between items-end pointer-events-none">
                    <div>
                        <p class="text-[10px] text-[#4ade80] font-bold uppercase tracking-wider mb-1 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#4ade80] animate-pulse"></span>
                            Gambar Saat Ini
                        </p>
                        <p id="file-name" class="text-white font-medium text-sm truncate max-w-xs opacity-90">
                            {{ basename($project->project_image) }}
                        </p>
                    </div>
                </div>

                {{-- Error Message --}}
                @error('project_image')
                    <div class="absolute top-4 left-1/2 -translate-x-1/2 z-30 animate-bounce">
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
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.getElementById('preview-image');
                const fileName = document.getElementById('file-name');
                
                // Visual feedback loading
                img.style.opacity = '0.5';
                
                setTimeout(() => {
                    img.src = e.target.result;
                    fileName.innerHTML = `<span class="text-yellow-400 font-bold">Baru:</span> ${input.files[0].name}`;
                    img.style.opacity = '1';
                }, 200);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb { background-color: #d1d5db; }
</style>
@endsection