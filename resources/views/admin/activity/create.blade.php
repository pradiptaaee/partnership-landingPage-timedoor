@extends('layouts.admin')

@section('title', 'Tambah Kegiatan Partner')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Breadcrumb & Header --}}
    <div class="mb-8">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.activity.index') }}" 
                       class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">
                        <i class="bi bi-house-door mr-2"></i>
                        Kegiatan
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 text-xs"></i>
                        <span class="ml-2 text-sm font-medium text-gray-500">Tambah Kegiatan</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="bi bi-plus-circle-fill text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Tambah Kegiatan Baru</h1>
                <p class="text-gray-600 mt-1">Dokumentasikan kegiatan partner dengan detail</p>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.activity.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Main Form --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Basic Information Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="bi bi-info-circle-fill mr-2"></i>
                            Informasi Dasar
                        </h2>
                    </div>

                    <div class="p-6 space-y-6">
                        {{-- Partner Selection --}}
                        <div>
                            <label for="partner_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Partner <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select class="w-full appearance-none px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white cursor-pointer @error('partner_id') border-red-500 ring-2 ring-red-200 @enderror" 
                                        id="partner_id" name="partner_id" required>
                                    <option value="">-- Pilih Partner --</option>
                                    @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>
                            @error('partner_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Title --}}
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                Judul Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('title') border-red-500 ring-2 ring-red-200 @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Contoh: Workshop Pelatihan Digital Marketing"
                                   required>
                            @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Activity Date --}}
                        <div>
                            <label for="activity_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('activity_date') border-red-500 ring-2 ring-red-200 @enderror" 
                                   id="activity_date" 
                                   name="activity_date"
                                   value="{{ old('activity_date') }}"
                                   required>
                            @error('activity_date')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Short Description --}}
                        <div>
                            <label for="short_description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Singkat <span class="text-red-500">*</span>
                            </label>
                            <textarea class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('short_description') border-red-500 ring-2 ring-red-200 @enderror" 
                                      id="short_description" 
                                      name="short_description" 
                                      rows="3" 
                                      placeholder="Ringkasan kegiatan (maks 200 karakter)" 
                                      maxlength="200"
                                      required>{{ old('short_description') }}</textarea>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="bi bi-info-circle mr-1"></i>
                                    <span id="char_count">0</span>/200 karakter
                                </p>
                            </div>
                            @error('short_description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Full Description --}}
                        <div>
                            <label for="full_description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 @error('full_description') border-red-500 ring-2 ring-red-200 @enderror" 
                                      id="full_description" 
                                      name="full_description" 
                                      rows="6"
                                      placeholder="Jelaskan detail kegiatan, tujuan, hasil, dan hal-hal penting lainnya..." 
                                      required>{{ old('full_description') }}</textarea>
                            @error('full_description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Media Upload Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="bi bi-images mr-2"></i>
                            Media & Foto
                        </h2>
                    </div>

                    <div class="p-6 space-y-6">
                        {{-- Featured Image --}}
                        <div>
                            <label for="featured_image" class="block text-sm font-semibold text-gray-700 mb-2">
                                Gambar Utama <span class="text-gray-500">(Opsional)</span>
                            </label>
                            <input type="file" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700 file:font-medium hover:file:bg-green-100 @error('featured_image') border-red-500 ring-2 ring-red-200 @enderror" 
                                   id="featured_image" 
                                   name="featured_image" 
                                   accept="image/*"
                                   onchange="previewFeaturedImage(event)">
                            <p class="mt-2 text-xs text-gray-500 flex items-center">
                                <i class="bi bi-info-circle mr-1"></i>
                                Rekomendasi: 1200x600px, maksimal 2MB
                            </p>
                            @error('featured_image')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror

                            {{-- Featured Image Preview --}}
                            <div id="featured_preview" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar Utama:</p>
                                <div class="relative inline-block">
                                    <img id="featured_img" src="" alt="Preview" class="rounded-xl border-2 border-green-300 shadow-md max-w-xs">
                                    <button type="button" 
                                            onclick="removeFeaturedPreview()" 
                                            class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-colors">
                                        <i class="bi bi-x text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Multiple Photos --}}
                        <div>
                            <label for="photos" class="block text-sm font-semibold text-gray-700 mb-2">
                                Foto Galeri <span class="text-gray-500">(Opsional)</span>
                            </label>
                            <input type="file" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700 file:font-medium hover:file:bg-green-100 @error('photos.*') border-red-500 ring-2 ring-red-200 @enderror" 
                                   id="photos" 
                                   name="photos[]" 
                                   accept="image/*" 
                                   multiple
                                   onchange="previewMultipleImages(event)">
                            <p class="mt-2 text-xs text-gray-500 flex items-center">
                                <i class="bi bi-info-circle mr-1"></i>
                                Upload beberapa foto sekaligus. Maksimal 2MB per foto
                            </p>
                            @error('photos.*')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror

                            {{-- Multiple Photos Preview --}}
                            <div id="photos_preview" class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4 hidden"></div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Action Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-6 py-4 border-b border-purple-200">
                        <h3 class="text-lg font-semibold text-purple-900 flex items-center">
                            <i class="bi bi-lightning-charge-fill mr-2"></i>
                            Aksi
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-indigo-800 shadow-md hover:shadow-lg transition-all duration-200">
                            <i class="bi bi-check-circle-fill"></i>
                            Simpan Kegiatan
                        </button>
                        <a href="{{ route('admin.activity.index') }}" 
                           class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            <i class="bi bi-x-circle"></i>
                            Batal
                        </a>
                    </div>
                </div>

                {{-- Help Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                        <h3 class="text-lg font-semibold text-blue-900 flex items-center">
                            <i class="bi bi-question-circle-fill mr-2"></i>
                            Panduan
                        </h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="bi bi-check2 text-green-600 text-sm font-bold"></i>
                                </div>
                                <span class="text-sm text-gray-700">
                                    Pastikan semua field wajib <span class="text-red-500 font-semibold">*</span> terisi
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="bi bi-check2 text-green-600 text-sm font-bold"></i>
                                </div>
                                <span class="text-sm text-gray-700">
                                    Gunakan gambar berkualitas tinggi
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="bi bi-check2 text-green-600 text-sm font-bold"></i>
                                </div>
                                <span class="text-sm text-gray-700">
                                    Deskripsi singkat untuk preview
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="bi bi-check2 text-green-600 text-sm font-bold"></i>
                                </div>
                                <span class="text-sm text-gray-700">
                                    Deskripsi lengkap untuk detail
                                </span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="bi bi-check2 text-green-600 text-sm font-bold"></i>
                                </div>
                                <span class="text-sm text-gray-700">
                                    Upload beberapa foto untuk galeri
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
// Character counter for short description
document.getElementById('short_description').addEventListener('input', function() {
    document.getElementById('char_count').textContent = this.value.length;
});

// Preview featured image
function previewFeaturedImage(event) {
    const preview = document.getElementById('featured_img');
    const previewContainer = document.getElementById('featured_preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
}

// Preview multiple images
function previewMultipleImages(event) {
    const previewContainer = document.getElementById('photos_preview');
    const files = event.target.files;
    
    previewContainer.innerHTML = '';
    
    if (files.length > 0) {
        previewContainer.style.display = 'flex';
        
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="height: 100px; object-fit: cover;">`;
                previewContainer.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    } else {
        previewContainer.style.display = 'none';
    }
}
</script>

<style>
.card {
    border-radius: 0.5rem;
}

.form-control:focus, .form-select:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}
</style>
@endsection