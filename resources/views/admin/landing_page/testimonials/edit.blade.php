@extends('layouts.admin') 

@section('content')
<div class="w-full p-6 bg-gray-50 h-[calc(100vh-80px)] overflow-hidden flex flex-col">
    
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6 shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Testimoni</h1>
            <p class="text-gray-500 text-sm">Perbarui data review orang tua murid (Bahasa Indonesia)</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 text-sm flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex-grow flex flex-col">
        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf
            @method('PUT')
            
            <div class="flex flex-col lg:flex-row h-full">
                
                {{-- KIRI: INPUT FORM --}}
                <div class="w-full lg:w-1/2 p-6 border-r border-gray-100 overflow-y-auto custom-scrollbar flex flex-col">
                    
                    <div class="space-y-5">
                        {{-- 1. Identitas Ortu --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Orang Tua <span class="text-red-500">*</span></label>
                            <input type="text" name="parent_name" value="{{ old('parent_name', $testimonial->parent_name) }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                            @error('parent_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- 2. Identitas Anak & Kursus --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Murid / Umur</label>
                                <input type="text" name="student_name" value="{{ old('student_name', $testimonial->student_name) }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Level / Kursus</label>
                                <input type="text" name="course_name" value="{{ old('course_name', $testimonial->course_name) }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                            </div>
                        </div>

                        {{-- 3. Isi Review (PERBAIKAN UTAMA DISINI) --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                Isi Testimoni (Bahasa Indonesia) <span class="text-red-500">*</span>
                            </label>
                            
                            {{-- PERBAIKAN: name="review[id]" dan ambil getTranslation('id') --}}
                            <textarea name="review[id]" 
                                      rows="5" 
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition resize-none @error('review.id') border-red-500 @enderror" 
                                      required>{{ old('review.id', $testimonial->getTranslation('review', 'id')) }}</textarea>
                            
                            @error('review.id') 
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                            @enderror

                            {{-- Info Update Translate --}}
                            <div class="mt-2 p-3 bg-yellow-50 rounded-lg border border-yellow-100 flex gap-2 items-start">
                                <i class="bi bi-magic text-yellow-600 mt-0.5"></i>
                                <p class="text-xs text-yellow-700 leading-relaxed">
                                    <strong>Auto-Update:</strong> Jika Anda mengedit teks Indonesia ini, sistem akan otomatis menerjemahkan ulang ke semua bahasa lain agar tetap sinkron.
                                </p>
                            </div>
                        </div>

                        {{-- Info Mode Edit --}}
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 flex items-start gap-3">
                            <i class="bi bi-info-circle-fill text-gray-500 mt-0.5"></i>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Foto di sebelah kanan adalah foto saat ini. Biarkan kosong jika tidak ingin menggantinya.
                            </p>
                        </div>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full py-3 rounded-lg bg-blue-600 text-white font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition transform hover:-translate-y-0.5">
                            <i class="bi bi-check-lg mr-2"></i> Update Testimoni
                        </button>
                    </div>
                </div>

                {{-- KANAN: PREVIEW FOTO --}}
                <div class="w-full lg:w-1/2 bg-gray-900 relative group h-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer relative overflow-hidden">
                        
                        {{-- Prompt --}}
                        <div id="upload-prompt" class="hidden flex-col items-center justify-center p-6 text-center z-10">
                            <div class="w-20 h-20 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
                                <i class="bi bi-cloud-arrow-up text-4xl text-white"></i>
                            </div>
                            <h3 class="font-bold text-white">Ganti Foto</h3>
                            <p class="text-sm text-gray-300">Klik untuk upload baru</p>
                        </div>

                        {{-- Preview Image --}}
                        <div id="preview-container" class="absolute inset-0 w-full h-full bg-black">
                            <img id="preview-image" 
                                 src="{{ Storage::url($testimonial->parent_image) }}" 
                                 class="w-full h-full object-cover opacity-100 group-hover:opacity-60 transition duration-300">
                            
                            {{-- Overlay Info --}}
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/90 to-transparent flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Foto Saat Ini</p>
                                    <p id="file-name" class="text-white text-sm truncate max-w-[200px]">
                                        {{ basename($testimonial->parent_image) }}
                                    </p>
                                </div>
                                <div class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs border border-white/30 hover:bg-white hover:text-gray-900 transition">
                                    <i class="bi bi-pencil-square mr-1"></i> Ganti
                                </div>
                            </div>
                        </div>

                        {{-- Input File --}}
                        <input id="dropzone-file" name="parent_image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                    </label>
                    @error('parent_image')
                        <div class="absolute top-4 w-full text-center">
                            <span class="bg-red-500 text-white px-3 py-1 rounded text-xs font-bold">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

            </div>
        </form>
    </div>
</div>

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
                fileNameTxt.textContent = "Baru: " + input.files[0].name;
                
                // Efek visual file baru
                previewImg.classList.remove('opacity-100'); // Reset opacity class
                previewImg.classList.add('opacity-100'); // Force opacity
                
                promptDiv.classList.add('hidden');
                previewDiv.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection