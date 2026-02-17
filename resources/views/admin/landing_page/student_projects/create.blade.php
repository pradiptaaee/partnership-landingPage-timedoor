@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Tambah Project</h1>
            <p class="text-gray-500 text-sm">Showcase karya terbaik dari siswa (Auto-Translate)</p>
        </div>
        
        <a href="{{ route('admin.projects.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-100 transition border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- CARD FORM WRAPPER --}}
    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">
        
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row h-full">
            @csrf
            
            {{-- KOLOM KIRI: Input Form --}}
            <div class="w-full lg:w-5/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                
                <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">
                    
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Nama Murid <span class="text-red-500">*</span></label>
                        <input type="text" name="student_name" value="{{ old('student_name') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium" 
                               placeholder="Contoh: Budi Santoso" required>
                        @error('student_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Umur <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text" name="age" value="{{ old('age') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium" 
                                   placeholder="Contoh: 10 Tahun" required>
                            <div class="absolute right-4 top-3 text-gray-400 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                            </div>
                        </div>
                        @error('age') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Judul Project (ID) <span class="text-red-500">*</span></label>
                        <input type="text" name="project_type[id]" value="{{ old('project_type.id') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium" 
                               placeholder="Contoh: Game Petualangan Seru" required>
                        @error('project_type.id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex gap-3 items-start text-[#0f5132]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                        </svg>
                        <div>
                            <h4 class="font-bold text-sm mb-0.5">Fitur Auto-Translate</h4>
                            <p class="text-xs text-emerald-700 leading-relaxed">Judul project otomatis diterjemahkan: <b>Indo -> Inggris -> Jepang</b>.</p>
                        </div>
                    </div>

                </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                    <a href="{{ route('admin.projects.index') }}" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Simpan Project
                    </button>
                </div>

            </div>

            {{-- KOLOM KANAN: Upload Foto --}}
            <div class="w-full lg:w-7/12 bg-gray-50 relative group flex flex-col justify-center items-center p-8 border-l border-gray-100 min-h-[350px]">
                
                <input id="dropzone-file" name="project_image" type="file" class="hidden" accept="image/*" onchange="LandingPage.previewProjectImage(event)" />
                
                <label for="dropzone-file" id="upload-prompt" class="cursor-pointer flex flex-col items-center justify-center w-full h-full border-2 border-dashed border-gray-300 rounded-2xl hover:border-[#0f5132] transition-all duration-300">
                    <div class="w-16 h-16 mb-4 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center text-[#0f5132] group-hover:scale-110 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" /></svg>
                    </div>
                    <h3 class="text-gray-700 font-bold text-lg mb-1">Screenshot Project</h3>
                    <p class="text-sm text-gray-500 mb-6">Klik di sini atau drag & drop file</p>
                    <span class="px-3 py-1 bg-white border border-gray-200 rounded-full text-xs font-medium text-gray-400 uppercase tracking-widest">JPG, PNG (Max 2MB)</span>
                </label>

                <div id="preview-container" class="hidden absolute inset-0 w-full h-full bg-gray-900 flex items-center justify-center p-8">
                    <label for="dropzone-file" class="absolute top-6 right-6 z-20 cursor-pointer p-2 bg-black/50 hover:bg-black/70 rounded-full text-white backdrop-blur-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                    </label>

                    <img id="preview-image" src="#" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                    
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 to-transparent">
                        <p class="text-[10px] text-[#4ade80] font-bold uppercase tracking-wider mb-1 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#4ade80] animate-pulse"></span> Siap Diupload
                        </p>
                        <p id="file-name" class="text-white font-medium truncate max-w-md opacity-90 text-sm"></p>
                    </div>
                </div>

                @error('project_image')
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
@endsection

@push('scripts')
    @vite('resources/js/admin/landing_page/app.js')
@endpush