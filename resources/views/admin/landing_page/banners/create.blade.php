@extends('layouts.admin') 

@section('content')
<div class="w-full p-6 bg-gray-50 min-h-screen">
    
    {{-- 1. HEADER PAGE (Konsisten dengan Index) --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Tambah Banner Baru
            </h1>
            <p class="text-gray-500 mt-2 text-sm">
                Isi form di bawah untuk menambahkan slide banner baru
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.banners.index') }}" 
           class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition duration-200 shadow-sm text-sm flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- 2. CARD FORM --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl mx-auto md:mx-0">
        <div class="p-6 md:p-8">
            
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Input Judul --}}
                <div class="mb-8">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        JUDUL BANNER <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 placeholder-gray-400" 
                           placeholder="Contoh: Winner Tech Kids 2024" 
                           required>
                </div>

                {{-- Input Upload Gambar (Style Drag & Drop Modern) --}}
                <div class="mb-8">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        UPLOAD GAMBAR <span class="text-red-500">*</span>
                    </label>
                    
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300 group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                {{-- Icon Cloud --}}
                                <div class="w-12 h-12 mb-3 rounded-full bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition">
                                    <i class="bi bi-cloud-arrow-up text-2xl text-blue-600"></i>
                                </div>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold text-gray-900">Klik untuk upload</span> atau drag and drop</p>
                                <p class="text-xs text-gray-500">Format: JPG, PNG (Maksimal 2MB)</p>
                            </div>
                            <input id="dropzone-file" name="image" type="file" class="hidden" accept="image/*" required />
                        </label>
                    </div>
                </div>

                {{-- Bagian Tombol Aksi --}}
                <div class="border-t border-gray-100 pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.banners.index') }}" 
                       class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition duration-300 flex items-center gap-2 transform hover:-translate-y-0.5">
                        <i class="bi bi-save"></i>
                        Simpan Banner
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection