@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Tambah Banner</h1>
            <p class="text-gray-500 text-sm">Upload banner baru untuk landing page (Auto-Translate)</p>
        </div>
        
        <a href="{{ route('admin.banners.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-100 hover:text-[#0f5132] transition border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">
        
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row h-full">
            @csrf
            
            <div class="w-full lg:w-5/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">
                    
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Judul Banner (ID/EN) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title[en]" value="{{ old('title.en') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium @error('title.en') border-red-500 bg-red-50 @enderror" 
                               placeholder="Contoh: Diskon Akhir Tahun 50%" required>
                        @error('title.en') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description[en]" rows="5"
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm leading-relaxed @error('description.en') border-red-500 bg-red-50 @enderror"
                                  placeholder="Tuliskan deskripsi singkat banner di sini..." required>{{ old('description.en') }}</textarea>
                        @error('description.en') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex gap-3 items-start">
                        <div class="shrink-0 mt-0.5 text-[#0f5132]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[#0f5132] font-bold text-sm mb-0.5">Fitur Auto-Translate</h4>
                            <p class="text-xs text-emerald-700 leading-relaxed">Cukup isi Bahasa Indonesia/Inggris. Sistem otomatis menerjemahkan ke bahasa lain saat disimpan.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                    <a href="{{ route('admin.banners.index') }}" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                        Simpan Banner
                    </button>
                </div>
            </div>

            <div class="w-full lg:w-7/12 bg-gray-50 relative group flex flex-col justify-center items-center p-8 border-l border-gray-100 min-h-[350px]">
                
                {{-- PEMANGGILAN JS MODULAR --}}
                <input id="dropzone-file" name="image" type="file" class="hidden" accept="image/*" onchange="LandingPage.previewBanner(event)" />
                
                <label for="dropzone-file" id="upload-prompt" class="cursor-pointer flex flex-col items-center justify-center w-full h-full border-2 border-dashed border-gray-300 rounded-2xl hover:border-[#0f5132] hover:bg-emerald-50/30 transition-all duration-300 group-hover:scale-[0.99]">
                    <div class="w-16 h-16 mb-4 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center text-[#0f5132] group-hover:scale-110 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                    </div>
                    <h3 class="text-gray-700 font-bold text-lg mb-1">Upload Gambar Banner</h3>
                    <p class="text-sm text-gray-500 mb-6">Klik di sini atau drag & drop file</p>
                    <span class="px-3 py-1 bg-white border border-gray-200 rounded-full text-xs font-medium text-gray-400">JPG, PNG (Max 2MB)</span>
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
                        <p id="file-name" class="text-white font-medium truncate max-w-md opacity-90">nama_file.jpg</p>
                    </div>
                </div>

                @error('image')
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