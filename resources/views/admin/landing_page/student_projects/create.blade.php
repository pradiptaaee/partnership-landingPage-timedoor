@extends('layouts.admin') 

@section('content')
<div class="w-full p-6 bg-gray-50 h-[calc(100vh-80px)] overflow-hidden flex flex-col">
    
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6 shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Project Baru</h1>
            <p class="text-gray-500 text-sm">Upload hasil karya murid (Multi-bahasa Otomatis)</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 text-sm flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div> 

    {{-- CARD FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex-grow flex flex-col">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf
            
            <div class="flex flex-col lg:flex-row h-full">
                
                {{-- KIRI: INPUT TEXT --}}
                <div class="w-full lg:w-1/2 p-6 border-r border-gray-100 overflow-y-auto flex flex-col">
                    
                    <div class="space-y-6">
                        {{-- 1. Nama Murid (Tidak perlu translate) --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                Nama Murid <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="student_name" 
                                   value="{{ old('student_name') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition @error('student_name') border-red-500 @enderror" 
                                   placeholder="Contoh: Budi Santoso" 
                                   required>
                            @error('student_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 2. Tipe Project (INPUT UTAMA: BAHASA INDONESIA) --}}
                        {{-- PERBAIKAN: name="project_type[id]" --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                Tipe Project / Judul (Bahasa Indonesia) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="project_type[id]" 
                                   value="{{ old('project_type.id') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition @error('project_type.id') border-red-500 @enderror" 
                                   placeholder="Contoh: Pengembangan Game" 
                                   required>
                            
                            @error('project_type.id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <p class="text-xs text-blue-600 mt-2">
                                <i class="bi bi-magic mr-1"></i> Sistem akan menerjemahkan: <b>Indo -> Inggris -> Jepang</b> secara otomatis.
                            </p>
                        </div>

                        {{-- Info Box --}}
                        <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 flex gap-3 items-start mt-6">
                            <i class="bi bi-info-circle-fill text-blue-600 mt-0.5 text-lg"></i>
                            <div>
                                <h5 class="font-bold text-blue-900 text-sm">Info Upload Gambar</h5>
                                <p class="text-xs text-blue-800 leading-relaxed mt-1">
                                    Silakan upload screenshot hasil karya murid pada <strong>area di sebelah kanan</strong>.
                                    <br class="mb-1">
                                    <span class="opacity-90">
                                        • Rekomendasi Ukuran: <strong>1920 x 1080 px (Landscape)</strong>
                                        <br>
                                        • Format: JPG/PNG, Maksimal <strong>2MB</strong>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Tombol Simpan --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full py-3 rounded-lg bg-blue-600 text-white font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition transform hover:-translate-y-0.5">
                            <i class="bi bi-save mr-2"></i> Simpan Project
                        </button>
                    </div>
                </div>

                {{-- KANAN: UPLOAD FOTO --}}
                <div class="w-full lg:w-1/2 bg-gray-50 relative group h-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer hover:bg-gray-100 transition duration-300 relative overflow-hidden">
                        
                        {{-- Prompt --}}
                        <div id="upload-prompt" class="flex flex-col items-center justify-center p-6 text-center z-10">
                            <div class="w-20 h-20 bg-white rounded-full shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                <i class="bi bi-laptop text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="font-bold text-gray-700">Screenshot Project</h3>
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG (Max 2MB)</p>
                        </div>

                        {{-- Preview --}}
                        <div id="preview-container" class="hidden absolute inset-0 w-full h-full bg-black">
                            <img id="preview-image" src="#" class="w-full h-full object-cover opacity-90">
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                <p class="text-white text-xs font-bold uppercase tracking-wider mb-1">File Terpilih</p>
                                <p id="file-name" class="text-white text-sm truncate">nama-file.jpg</p>
                            </div>
                        </div>

                        {{-- INPUT FILE (HAPUS REQUIRED DISINI) --}}
                        <input id="dropzone-file" name="project_image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                    </label>

                    {{-- Pesan Error Gambar --}}
                    @error('project_image')
                        <div class="absolute bottom-4 left-0 right-0 text-center z-20">
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold border border-red-200 shadow-sm">
                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                            </span>
                        </div>
                    @enderror
                </div>

            </div>
        </form>
    </div>
</div>

{{-- Script Preview Image --}}
<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('file-name').textContent = input.files[0].name;
                document.getElementById('upload-prompt').classList.add('hidden');
                document.getElementById('preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection