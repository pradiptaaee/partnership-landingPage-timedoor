@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Tambah Testimoni</h1>
            <p class="text-gray-500 text-sm">Input data review dari orang tua murid (Auto-Translate)</p>
        </div>
        
        <a href="{{ route('admin.testimonials.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-100 transition border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- ERROR NOTIFICATION --}}
    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 animate-fadeIn">
            <p class="font-bold text-sm mb-1">Terjadi kesalahan input:</p>
            <ul class="list-disc list-inside text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CARD FORM WRAPPER --}}
    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row h-full">
            @csrf
            
            {{-- KOLOM KIRI --}}
            <div class="w-full lg:w-6/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">
                    
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Nama Orang Tua <span class="text-red-500">*</span></label>
                        <input type="text" name="parent_name" value="{{ old('parent_name') }}"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium" 
                               placeholder="Contoh: Ibu Ani" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Nama Murid / Umur <span class="text-red-500">*</span></label>
                            <input type="text" name="student_name" value="{{ old('student_name') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium" 
                                   placeholder="Cth: Budi, 10th" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Level / Kursus <span class="text-red-500">*</span></label>
                            <input type="text" name="course_name" value="{{ old('course_name') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm font-medium" 
                                   placeholder="Cth: Web Dev Lvl 1" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">Isi Testimoni (ID) <span class="text-red-500">*</span></label>
                        <textarea name="review[id]" rows="5" 
                                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] outline-none transition text-sm leading-relaxed resize-none" 
                                  placeholder="Tulis pendapat mereka di sini..." required>{{ old('review.id') }}</textarea>
                    </div>

                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex gap-3 items-start text-[#0f5132]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                        </svg>
                        <div>
                            <h4 class="font-bold text-sm mb-0.5 text-emerald-900">Auto-Translate Aktif</h4>
                            <p class="text-xs text-emerald-700 leading-relaxed">Isi dalam Bahasa Indonesia. Sistem otomatis menerjemahkan saat disimpan.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                    <a href="{{ route('admin.testimonials.index') }}" class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                        Simpan Testimoni
                    </button>
                </div>
            </div>

            {{-- KOLOM KANAN --}}
            <div class="w-full lg:w-6/12 bg-gray-50 relative group flex flex-col justify-center items-center p-8 border-l border-gray-100 min-h-[400px]">
                <input id="dropzone-file" name="parent_image" type="file" class="hidden" accept="image/*" onchange="LandingPage.previewTestimonialImage(event)" />
                
                <label for="dropzone-file" id="upload-prompt" class="cursor-pointer flex flex-col items-center justify-center w-full h-full border-2 border-dashed border-gray-300 rounded-2xl hover:border-[#0f5132] transition-all duration-300">
                    <div class="w-16 h-16 mb-4 rounded-full bg-white shadow-sm flex items-center justify-center text-[#0f5132]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    </div>
                    <h3 class="text-gray-700 font-bold text-lg mb-1">Foto Orang Tua / Murid</h3>
                    <p class="text-sm text-gray-500 mb-6">Klik untuk unggah foto</p>
                    <span class="px-3 py-1 bg-white border border-gray-200 rounded-full text-xs font-medium text-gray-400 uppercase tracking-widest">JPG, PNG, WEBP</span>
                </label>

                <div id="preview-container" class="hidden absolute inset-0 w-full h-full bg-gray-900 flex items-center justify-center p-8">
                    <label for="dropzone-file" class="absolute top-6 right-6 z-20 cursor-pointer p-2 bg-black/50 rounded-full text-white backdrop-blur-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                    </label>
                    <img id="preview-image" src="#" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                    <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 to-transparent">
                        <p id="file-name" class="text-white font-medium truncate max-w-md opacity-90 text-sm"></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/admin/landing_page/app.js')
@endpush