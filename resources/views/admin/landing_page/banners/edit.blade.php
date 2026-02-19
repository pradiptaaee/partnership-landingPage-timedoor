@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Edit Banner</h1>
            <p class="text-gray-500 text-sm">Perbarui informasi dan visual banner (Bahasa Indonesia)</p>
        </div>
        
        <a href="{{ route('admin.banners.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-50 hover:text-[#0f5132] transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- CARD WRAPPER --}}
    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">
        
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row h-full">
            @csrf
            @method('PUT')
            
            {{-- KOLOM KIRI: INPUT FORM --}}
            <div class="w-full lg:w-5/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                
                <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">
                    
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Judul Banner (ID) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title[id]" 
                               value="{{ old('title.id', $banner->getTranslation('title', 'id')) }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                            Deskripsi (ID) <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description[id]" rows="5" 
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm leading-relaxed resize-none" required>{{ old('description.id', $banner->getTranslation('description', 'id')) }}</textarea>
                    </div>

                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex gap-3 items-start">
                        <div class="shrink-0 mt-0.5 text-[#0f5132]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[#0f5132] font-bold text-sm mb-0.5">Auto-Translate Aktif</h4>
                            <p class="text-xs text-emerald-700 leading-relaxed">Jika Anda mengubah teks Bahasa Indonesia ini, sistem akan otomatis menerjemahkan ulang ke bahasa lain.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                    <a href="{{ route('admin.banners.index') }}" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>

            {{-- KOLOM KANAN: GAMBAR FULL --}}
            <div class="w-full lg:w-7/12 bg-gray-100 relative group overflow-hidden flex items-center justify-center min-h-[300px]">
                
                {{-- PEMANGGILAN JS MODULAR --}}
                <input id="dropzone-file" name="image" type="file" class="hidden" accept="image/*" onchange="LandingPage.updatePreviewBanner(event)" />
                
                <label for="dropzone-file" class="absolute inset-0 z-20 cursor-pointer flex flex-col items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white mb-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                    <span class="text-white font-bold text-lg tracking-tight">Ganti Gambar</span>
                </label>

                <img id="preview-image" 
                     src="{{ Storage::url($banner->image) }}" 
                     class="w-full h-full object-cover absolute inset-0 transition-opacity duration-300">

                <div class="absolute bottom-4 left-4 z-10 flex items-center gap-2 pointer-events-none">
                    <span class="w-2 h-2 rounded-full bg-[#4ade80] animate-pulse"></span>
                    <span class="text-[10px] font-bold text-white uppercase tracking-wider drop-shadow-md">GAMBAR SAAT INI</span>
                </div>

                @error('image')
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
@endsection

@push('scripts')
    @vite('resources/js/admin/landing_page/app.js')
@endpush