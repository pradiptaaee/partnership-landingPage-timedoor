@extends('layouts.admin') 

@section('content')
<div class="w-full p-6 bg-gray-50 h-[calc(100vh-80px)] overflow-hidden flex flex-col">
    
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6 shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Testimoni Baru</h1>
            <p class="text-gray-500 text-sm">Input data review dari orang tua murid</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 text-sm flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex-grow flex flex-col">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf
            
            <div class="flex flex-col lg:flex-row h-full">
                
                {{-- KIRI: INPUT FORM  --}}
                <div class="w-full lg:w-1/2 p-6 border-r border-gray-100 overflow-y-auto custom-scrollbar flex flex-col">
                    
                    <div class="space-y-5">
                        {{-- 1. Identitas Ortu --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Orang Tua <span class="text-red-500">*</span></label>
                            <input type="text" name="parent_name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Contoh: Ibu Ani" required>
                        </div>

                        {{-- 2. Identitas Anak & Kursus --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Murid / Umur</label>
                                <input type="text" name="student_name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Cth: Budi, 10th">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Level / Kursus</label>
                                <input type="text" name="course_name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Cth: Web Dev Lvl 1">
                            </div>
                        </div>

                        {{-- 3. Isi Review --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Isi Testimoni <span class="text-red-500">*</span></label>
                            <textarea name="review" rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition resize-none" placeholder="Tulis pendapat mereka di sini..." required></textarea>
                            <p class="text-xs text-gray-400 mt-2 text-right">Tulis apa adanya sesuai perkataan orang tua.</p>
                        </div>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full py-3 rounded-lg bg-blue-600 text-white font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition transform hover:-translate-y-0.5">
                            <i class="bi bi-save mr-2"></i> Simpan Testimoni
                        </button>
                    </div>
                </div>

                {{-- KANAN: UPLOAD FOTO --}}
                <div class="w-full lg:w-1/2 bg-gray-50 relative group h-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer hover:bg-gray-100 transition duration-300 relative overflow-hidden">
                        
                        {{-- Prompt Awal --}}
                        <div id="upload-prompt" class="flex flex-col items-center justify-center p-6 text-center z-10">
                            <div class="w-20 h-20 bg-white rounded-full shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                <i class="bi bi-person-bounding-box text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="font-bold text-gray-700">Foto Orang Tua / Murid</h3>
                            <p class="text-sm text-gray-500 mt-1">Klik atau drag & drop di sini</p>
                            <p class="text-xs text-gray-400 mt-2">Rasio 1:1 (Kotak) disarankan</p>
                        </div>

                        {{-- Preview Image --}}
                        <div id="preview-container" class="hidden absolute inset-0 w-full h-full bg-black">
                            <img id="preview-image" src="#" class="w-full h-full object-cover opacity-90">
                            
                            {{-- Overlay Info --}}
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                <p class="text-white text-xs font-bold uppercase tracking-wider mb-1">File Terpilih</p>
                                <p id="file-name" class="text-white text-sm truncate">nama-file.jpg</p>
                            </div>
                        </div>

                        <input id="dropzone-file" name="parent_image" type="file" class="hidden" accept="image/*" required onchange="previewImage(event)" />
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
                previewImg.src = e.target.result;
                fileNameTxt.textContent = input.files[0].name;

                promptDiv.classList.add('hidden');
                previewDiv.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection