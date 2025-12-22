@extends('layouts.admin') 

@section('content')
{{-- CONTAINER UTAMA --}}
<div class="w-full p-6 bg-gray-50 h-[calc(100vh-80px)] overflow-hidden flex flex-col">
    
    {{-- 1. HEADER PAGE --}}
    <div class="flex justify-between items-center mb-6 shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Edit Banner
            </h1>
            <p class="text-gray-500 text-sm">
                Perbarui informasi atau ganti gambar banner
            </p>
        </div>

        <a href="{{ route('admin.banners.index') }}" 
           class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition duration-200 shadow-sm text-sm flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- 2. CARD FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex-grow flex flex-col">
        
        {{--  route update  --}}
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf
            @method('PUT') 
            
            <div class="flex flex-col lg:flex-row h-full">
                
                {{-- KOLOM KIRI: Input Data  --}}
                <div class="w-full lg:w-2/5 p-6 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col justify-between">
                    
                    {{-- Bagian Input --}}
                    <div>
                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                JUDUL BANNER <span class="text-red-500">*</span>
                            </label>
                            {{-- Value diisi data lama --}}
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title', $banner->title) }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 placeholder-gray-400" 
                                   placeholder="Contoh: Winner Tech Kids 2024" 
                                   required>
                            <p class="text-xs text-gray-400 mt-2">
                                Judul ini akan ditampilkan sebagai teks utama pada slider.
                            </p>
                        </div>

                        <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                            <h4 class="text-yellow-800 font-bold text-sm mb-1"><i class="bi bi-exclamation-circle mr-1"></i> Mode Edit</h4>
                            <p class="text-xs text-yellow-700 leading-relaxed">
                                Jika Anda tidak ingin mengganti gambar, biarkan kolom upload kosong. Gambar lama akan tetap digunakan.
                            </p>
                        </div>
                    </div>

                    {{-- Bagian Tombol --}}
                    <div class="mt-8 pt-6 border-t border-gray-100 flex gap-3">
                        <a href="{{ route('admin.banners.index') }}" 
                           class="flex-1 px-5 py-3 text-center rounded-lg border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-1 px-5 py-3 rounded-lg bg-blue-600 text-white font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition duration-300 flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                            <i class="bi bi-check-lg"></i>
                            Update
                        </button>
                    </div>
                </div>

                {{-- KOLOM KANAN: Preview Gambar --}}
                <div class="w-full lg:w-3/5 bg-gray-900 relative group h-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer relative">
                        
                        {{-- 1. PROMPT  --}}
                        <div id="upload-prompt" class="hidden flex-col items-center justify-center p-6 text-center z-10">
                            <div class="w-20 h-20 mb-4 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center">
                                <i class="bi bi-cloud-arrow-up text-4xl text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-1">Ganti Gambar</h3>
                            <p class="text-sm text-gray-300">Klik untuk upload baru</p>
                        </div>

                        {{-- 2. PREVIEW CONTAINER --}}
                        <div id="preview-container" class="absolute inset-0 w-full h-full bg-black">
                            
                            {{-- Gambar Preview --}}
                            <img id="preview-image" 
                                 src="{{ Storage::url($banner->image) }}" 
                                 alt="Current Banner" 
                                 class="w-full h-full object-contain opacity-100 transition duration-300 group-hover:opacity-70">
                            
                            {{-- Overlay Info --}}
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/90 to-transparent flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Gambar Saat Ini</p>
                                    <p id="file-name" class="text-white font-medium truncate max-w-xs">
                                        {{ basename($banner->image) }}
                                    </p>
                                </div>
                                <div class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs border border-white/30 hover:bg-white hover:text-gray-900 transition">
                                    <i class="bi bi-pencil-square mr-1"></i> Klik untuk ganti
                                </div>
                            </div>
                        </div>

                        {{-- Input File (TIDAK REQUIRED di Edit) --}}
                        <input id="dropzone-file" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                    </label>
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
                // Update gambar dengan file baru
                previewImg.src = e.target.result;
                fileNameTxt.textContent = "Baru: " + input.files[0].name; // Update nama file
                
                // Pastikan preview terlihat
                promptDiv.classList.add('hidden');
                previewDiv.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection