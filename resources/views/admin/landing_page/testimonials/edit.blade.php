@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Edit Testimoni</h1>
            <p class="text-gray-500 text-sm">Perbarui ulasan dari orang tua siswa (Bahasa Indonesia)</p>
        </div>
        
        <a href="{{ route('admin.testimonials.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-100 transition border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">
        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row h-full">
            @csrf
            @method('PUT')
            
            {{-- KOLOM KIRI: INPUT FORM --}}
            <div class="w-full lg:w-6/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">
                    
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Nama Orang Tua <span class="text-red-500">*</span></label>
                        <input type="text" name="parent_name" value="{{ old('parent_name', $testimonial->parent_name) }}" 
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium" required>
                        @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Nama Murid / Umur</label>
                            <input type="text" name="student_name" value="{{ old('student_name', $testimonial->student_name) }}" 
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Kursus / Level</label>
                            <input type="text" name="course_name" value="{{ old('course_name', $testimonial->course_name) }}" 
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Isi Testimoni (ID) <span class="text-red-500">*</span></label>
                        <textarea name="review[id]" rows="5" 
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm leading-relaxed resize-none" required>{{ old('review.id', $testimonial->review['id'] ?? '') }}</textarea>
                        @error('review.id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex gap-3 items-start text-[#0f5132]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                        </svg>
                        <div>
                            <h4 class="font-bold text-sm mb-0.5">Auto-Translate Aktif</h4>
                            <p class="text-xs text-emerald-700 leading-relaxed">Cukup edit Bahasa Indonesia. Sistem otomatis memperbarui bahasa lain saat disimpan.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                    <a href="{{ route('admin.testimonials.index') }}" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>

            {{-- KOLOM KANAN: PREVIEW FOTO --}}
            <div class="w-full lg:w-6/12 bg-gray-900 relative group overflow-hidden flex items-center justify-center min-h-[300px]">
                <input id="dropzone-file" name="parent_image" type="file" class="hidden" accept="image/*" onchange="LandingPage.previewTestimonialImage(event)" />
                
                <label for="dropzone-file" class="absolute inset-0 z-20 cursor-pointer flex flex-col items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[2px]">
                    <div class="w-16 h-16 mb-3 rounded-full bg-white/10 border border-white/20 flex items-center justify-center text-white shadow-lg transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                    </div>
                    <span class="text-white font-bold text-lg tracking-tight">Ganti Foto</span>
                </label>

                <div class="w-full h-full relative">
                    <img id="preview-image" src="{{ Storage::url($testimonial->parent_image) }}" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105 group-hover:brightness-75">
                    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black/80 to-transparent pointer-events-none"></div>
                </div>

                <div class="absolute bottom-6 left-6 right-6 z-10 pointer-events-none">
                    <p class="text-[10px] text-[#4ade80] font-bold uppercase tracking-wider mb-1 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#4ade80] animate-pulse"></span> Foto Saat Ini
                    </p>
                    <p id="file-name" class="text-white font-medium text-sm truncate opacity-90">{{ basename($testimonial->parent_image) }}</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/admin/landing_page/app.js')
@endpush