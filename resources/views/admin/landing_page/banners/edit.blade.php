@extends('layouts.admin') 

@section('content')
<div class="w-full p-6 bg-gray-50 h-[calc(100vh-80px)] overflow-hidden flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex justify-between items-center mb-6 shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Banner</h1>
            <p class="text-gray-500 text-sm">Update informasi banner (Bahasa Indonesia)</p>
        </div>
        <a href="{{ route('admin.banners.index') }}" 
           class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition duration-200 shadow-sm text-sm flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex-grow flex flex-col">
        
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf
            @method('PUT') 
            
            <div class="flex flex-col lg:flex-row h-full">
                
                {{-- KOLOM KIRI: Input Data --}}
                <div class="w-full lg:w-2/5 p-6 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col justify-between overflow-y-auto">
                    
                    <div>
                        {{-- 1. JUDUL (INDO) --}}
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                JUDUL (Bahasa Indonesia) <span class="text-red-500">*</span>
                            </label>
                            {{-- PERBAIKAN: name="title[id]" dan ambil translation 'id' --}}
                            <input type="text" 
                                   name="title[id]" 
                                   value="{{ old('title.id', $banner->getTranslation('title', 'id')) }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 outline-none transition @error('title.id') border-red-500 @enderror" 
                                   placeholder="Contoh: Belajar Coding Seru" 
                                   required>
                            @error('title.id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 2. DESKRIPSI (INDO) - Tadi Hilang --}}
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                DESKRIPSI (Bahasa Indonesia) <span class="text-red-500">*</span>
                            </label>
                            {{-- PERBAIKAN: name="description[id]" --}}
                            <textarea name="description[id]" 
                                      rows="4"
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 outline-none transition @error('description.id') border-red-500 @enderror"
                                      placeholder="Jelaskan banner ini..." 
                                      required>{{ old('description.id', $banner->getTranslation('description', 'id')) }}</textarea>
                            @error('description.id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- INFO BOX --}}
                        <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                            <h4 class="text-yellow-800 font-bold text-sm mb-1"><i class="bi bi-magic mr-1"></i> Auto-Translate Update</h4>
                            <p class="text-xs text-yellow-700 leading-relaxed">
                                Saat Anda mengubah teks Bahasa Indonesia, sistem akan <b>menerjemahkan ulang</b> ke Inggris, Jepang, dll secara otomatis.
                            </p>
                        </div>
                    </div>

                    {{-- TOMBOL --}}
                    <div class="mt-8 pt-6 border-t border-gray-100 flex gap-3">
                        <a href="{{ route('admin.banners.index') }}" class="flex-1 px-5 py-3 text-center rounded-lg border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition">Batal</a>
                        <button type="submit" class="flex-1 px-5 py-3 rounded-lg bg-blue-600 text-white font-bold shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
                            <i class="bi bi-check-lg"></i> Update Banner
                        </button>
                    </div>
                </div>

                {{-- KOLOM KANAN: Preview Gambar --}}
                <div class="w-full lg:w-3/5 bg-gray-900 relative group h-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer relative">
                        
                        {{-- Prompt Upload --}}
                        <div id="upload-prompt" class="hidden flex-col items-center justify-center p-6 text-center z-10">
                            <div class="w-16 h-16 mb-4 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                <i class="bi bi-cloud-arrow-up text-3xl text-white"></i>
                            </div>
                            <h3 class="text-white font-bold">Ganti Gambar</h3>
                            <p class="text-xs text-gray-300">Klik untuk upload baru</p>
                        </div>

                        {{-- Preview Image --}}
                        <div id="preview-container" class="absolute inset-0 w-full h-full bg-black">
                            <img id="preview-image" 
                                 src="{{ Storage::url($banner->image) }}" 
                                 class="w-full h-full object-contain opacity-100 transition duration-300 group-hover:opacity-60">
                            
                            {{-- Overlay Info --}}
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/90 to-transparent flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Gambar Saat Ini</p>
                                    <p id="file-name" class="text-white font-medium truncate max-w-xs">{{ basename($banner->image) }}</p>
                                </div>
                                <div class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded text-white text-xs border border-white/30">
                                    <i class="bi bi-pencil-square mr-1"></i> Ganti
                                </div>
                            </div>
                        </div>

                        {{-- Input File (Optional) --}}
                        <input id="dropzone-file" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                    </label>
                    @error('image')
                        <div class="absolute top-4 left-0 right-0 text-center z-20">
                            <span class="bg-red-500 text-white px-4 py-2 rounded-full text-xs font-bold shadow-lg">{{ $message }}</span>
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
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('file-name').textContent = "Baru: " + input.files[0].name;
                
                // Efek visual saat ada file baru
                document.getElementById('preview-image').classList.remove('opacity-100');
                document.getElementById('preview-image').classList.add('opacity-100'); 
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection