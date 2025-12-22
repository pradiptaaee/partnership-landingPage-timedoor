@extends('layouts.admin') 

@section('content')
<div class="w-full p-6 bg-gray-50 h-[calc(100vh-80px)] overflow-hidden flex flex-col">
    
    {{-- 1. HEADER PAGE --}}
    <div class="flex justify-between items-center mb-6 shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Tambah Banner Baru
            </h1>
            <p class="text-gray-500 text-sm">
                Upload banner baru untuk landing page
            </p>
        </div>

        <a href="{{ route('admin.banners.index') }}" 
           class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition duration-200 shadow-sm text-sm flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- 2. CARD FORM (Flex Grow untuk mengisi sisa ruang) --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex-grow flex flex-col">
        
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf
            
            <div class="flex flex-col lg:flex-row h-full">
                
                {{-- KOLOM KIRI: Input Data & Tombol --}}
                <div class="w-full lg:w-2/5 p-6 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col justify-between">
                    
                    {{-- Bagian Input --}}
                    <div>
                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                JUDUL BANNER <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 placeholder-gray-400" 
                                   placeholder="Contoh: Winner Tech Kids 2024" 
                                   required>
                            <p class="text-xs text-gray-400 mt-2">
                                Judul ini akan ditampilkan sebagai teks utama pada slider banner.
                            </p>
                        </div>

                        <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                            <h4 class="text-blue-800 font-bold text-sm mb-1"><i class="bi bi-info-circle mr-1"></i> Tips Gambar</h4>
                            <p class="text-xs text-blue-600 leading-relaxed">
                                Gunakan gambar landscape dengan rasio 16:9 agar tampilan maksimal di layar desktop dan mobile. Pastikan resolusi minimal 1920x1080px.
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
                            <i class="bi bi-save"></i>
                            Simpan
                        </button>
                    </div>
                </div>

                {{-- KOLOM KANAN: Upload Gambar Full --}}
                <div class="w-full lg:w-3/5 bg-gray-50 relative group h-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer hover:bg-gray-100 transition duration-300 relative">
                        
                        {{-- 1. TAMPILAN PROMP --}}
                        <div id="upload-prompt" class="flex flex-col items-center justify-center p-6 text-center z-10">
                            <div class="w-20 h-20 mb-4 rounded-full bg-white shadow-sm flex items-center justify-center group-hover:scale-110 transition duration-300">
                                <i class="bi bi-cloud-arrow-up text-4xl text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-700 mb-1">Upload Gambar Banner</h3>
                            <p class="text-sm text-gray-500 mb-4">Klik di sini atau drag & drop file Anda</p>
                            <span class="px-3 py-1 bg-white border border-gray-300 rounded-full text-xs text-gray-500 font-mono">
                                JPG, PNG (Max 2MB)
                            </span>
                        </div>

                        {{-- 2. TAMPILAN PREVIEW  --}}
                        <div id="preview-container" class="hidden absolute inset-0 w-full h-full bg-black">
                            {{-- Gambar Preview Full Cover --}}
                            <img id="preview-image" src="#" alt="Preview" class="w-full h-full object-contain opacity-90">
                            
                            {{-- Overlay Info File --}}
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-gray-300 uppercase font-bold tracking-wider mb-1">File Terpilih</p>
                                    <p id="file-name" class="text-white font-medium truncate max-w-xs">nama-file.jpg</p>
                                </div>
                                <div class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs border border-white/30">
                                    <i class="bi bi-arrow-repeat mr-1"></i> Klik untuk ganti
                                </div>
                            </div>
                        </div>

                        {{-- Input Hidden --}}
                        <input id="dropzone-file" name="image" type="file" class="hidden" accept="image/*" required onchange="previewImage(event)" />
                    </label>
                    
                    {{-- Garis Putus-putus Dekorasi --}}
                    <div id="border-decoration" class="absolute inset-4 border-2 border-dashed border-gray-300 rounded-xl pointer-events-none"></div>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- SCRIPT JS --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const promptDiv = document.getElementById('upload-prompt');
        const previewDiv = document.getElementById('preview-container');
        const previewImg = document.getElementById('preview-image');
        const fileNameTxt = document.getElementById('file-name');
        const borderDecor = document.getElementById('border-decoration');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                fileNameTxt.textContent = input.files[0].name;

                promptDiv.classList.add('hidden');
                borderDecor.classList.add('hidden'); 
                previewDiv.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection