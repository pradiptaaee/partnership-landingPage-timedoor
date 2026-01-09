@extends('layouts.admin') 

@section('content')
{{-- Container Utama --}}
<div class="w-full p-6 bg-gray-50 h-[calc(100vh-80px)] overflow-hidden flex flex-col">
    
    {{-- HEADER PAGE --}}
    <div class="flex justify-between items-center mb-6 shrink-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Project</h1>
            <p class="text-gray-500 text-sm">Perbarui data karya murid</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 text-sm flex items-center gap-2 transition">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- MAIN CARD FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex-grow flex flex-col">
        {{-- Form mengarah ke Route Update dengan ID project --}}
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="h-full flex flex-col">
            @csrf
            @method('PUT') 
            
            <div class="flex flex-col lg:flex-row h-full">
                
                {{-- BAGIAN KIRI: INPUT TEKS --}}
                <div class="w-full lg:w-1/2 p-6 border-r border-gray-100 overflow-y-auto custom-scrollbar flex flex-col">
                    
                    <div class="space-y-6">
                        {{-- 1. Input Nama Murid --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                Nama Murid <span class="text-red-500">*</span>
                            </label>
                            {{-- Value diisi old input jika gagal validasi, atau data dari DB --}}
                            <input type="text" 
                                   name="student_name" 
                                   value="{{ old('student_name', $project->student_name) }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition @error('student_name') border-red-500 @enderror" 
                                   placeholder="Contoh: Budi Santoso" 
                                   required>
                            @error('student_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 2. Input Tipe Project --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                                Tipe Project / Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="project_type" 
                                   value="{{ old('project_type', $project->project_type) }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition @error('project_type') border-red-500 @enderror" 
                                   placeholder="Contoh: Website Portfolio" 
                                   required>
                            @error('project_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Info Box --}}
                        <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-200 flex gap-3 items-start">
                            <i class="bi bi-info-circle-fill text-yellow-600 mt-0.5 text-lg"></i>
                            <div>
                                <h5 class="font-bold text-yellow-800 text-sm">Info Mode Edit</h5>
                                <p class="text-xs text-yellow-700 leading-relaxed mt-1">
                                    Gambar di sebelah kanan adalah gambar yang aktif saat ini. 
                                    <strong>Biarkan kosong input filenya</strong> jika Anda tidak ingin mengubah gambar tersebut.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Update --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full py-3 rounded-lg bg-blue-600 text-white font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition transform hover:-translate-y-0.5">
                            <i class="bi bi-check-lg mr-2"></i> Update Project
                        </button>
                    </div>
                </div>

                {{-- BAGIAN KANAN: PREVIEW GAMBAR  --}}
                <div class="w-full lg:w-1/2 bg-gray-900 relative group h-64 lg:h-full">
                    {{-- Label sebagai trigger input file --}}
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer relative overflow-hidden">
                        
                        {{-- Prompt Upload  --}}
                        <div id="upload-prompt" class="hidden flex-col items-center justify-center p-6 text-center z-10">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                <i class="bi bi-cloud-arrow-up text-4xl text-white"></i>
                            </div>
                            <h3 class="font-bold text-white">Pilih Gambar Baru</h3>
                            <p class="text-sm text-gray-300 mt-1">Klik untuk mengganti</p>
                        </div>

                        {{-- Preview Container  --}}
                        <div id="preview-container" class="absolute inset-0 w-full h-full bg-black">
                            <img id="preview-image" 
                                 src="{{ Storage::url($project->project_image) }}" 
                                 class="w-full h-full object-cover opacity-100 group-hover:opacity-50 transition duration-500">
                            
                            {{-- Overlay Informasi File di Bawah --}}
                            <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/90 via-black/50 to-transparent flex justify-between items-end translate-y-2 group-hover:translate-y-0 transition duration-500">
                                <div class="overflow-hidden">
                                    <p class="text-xs text-blue-400 uppercase font-bold tracking-wider mb-1">Gambar Saat Ini</p>
                                    {{-- Menampilkan nama file asli menggunakan basename() --}}
                                    <p id="file-name" class="text-white text-sm truncate font-medium">{{ basename($project->project_image) }}</p>
                                </div>
                                {{-- Tombol Visual "Ganti" --}}
                                <div class="shrink-0 px-4 py-2 bg-white/20 backdrop-blur-md rounded-lg text-white text-sm font-semibold border border-white/30 group-hover:bg-white group-hover:text-gray-900 transition flex items-center gap-2">
                                    <i class="bi bi-pencil-square"></i> Ganti
                                </div>
                            </div>
                        </div>

                        {{-- Input File --}}
                        <input id="dropzone-file" name="project_image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                        @error('project_image')
                            <div class="absolute inset-0 bg-red-900/80 flex items-center justify-center p-6 text-white text-center z-20">
                                <div>
                                    <i class="bi bi-exclamation-circle text-4xl mb-2 block"></i>
                                    <p class="font-bold">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </label>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- Javascript untuk Preview Gambar Baru --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const promptDiv = document.getElementById('upload-prompt');
        const previewDiv = document.getElementById('preview-container');
        const previewImg = document.getElementById('preview-image');
        const fileNameTxt = document.getElementById('file-name');

        // Jika user memilih file baru
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Ganti source gambar dengan file baru
                previewImg.src = e.target.result;
                // Update teks nama file
                fileNameTxt.textContent = "File Baru: " + input.files[0].name;
                // Pastikan container preview terlihat dan prompt hidden
                promptDiv.classList.add('hidden');
                previewDiv.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection