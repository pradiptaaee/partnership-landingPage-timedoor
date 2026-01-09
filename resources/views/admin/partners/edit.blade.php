@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Breadcrumb & Header --}}
    <div class="mb-8">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.partners.index') }}" 
                       class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-amber-600 transition-colors">
                        <i class="bi bi-house-door mr-2"></i>
                        Partner
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 text-xs"></i>
                        <span class="ml-2 text-sm font-medium text-gray-500">Edit Partner</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="bi bi-pencil-square text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Partner</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi partner</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Form Card --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Card Header --}}
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                    <h2 class="text-lg font-semibold text-white flex items-center">
                        <i class="bi bi-pencil-fill mr-2"></i>
                        Form Edit Partner
                    </h2>
                </div>

                {{-- Card Body --}}
                <div class="p-6">
                    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama Partner --}}
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Partner <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('name') border-red-500 ring-2 ring-red-200 @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $partner->name) }}" 
                                   placeholder="Masukkan nama partner"
                                   required>
                            @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-6">
                            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('category') border-red-500 ring-2 ring-red-200 @enderror" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category', $partner->category) }}" 
                                   placeholder="Contoh: Pemerintah, Swasta, NGO"
                                   required>
                            @error('category')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('description') border-red-500 ring-2 ring-red-200 @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Masukkan deskripsi partner (opsional)">{{ old('description', $partner->description) }}</textarea>
                            @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Current Logo --}}
                        @if($partner->logo)
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Logo Saat Ini</label>
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $partner->logo) }}" 
                                     alt="{{ $partner->name }}" 
                                     class="rounded-xl border-2 border-gray-200 shadow-md max-w-xs">
                                <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg">
                                    <i class="bi bi-check2 text-lg font-bold"></i>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Logo Upload --}}
                        <div class="mb-8">
                            <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ $partner->logo ? 'Ganti Logo' : 'Upload Logo' }}
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-amber-50 file:text-amber-700 file:font-medium hover:file:bg-amber-100 @error('logo') border-red-500 ring-2 ring-red-200 @enderror" 
                                       id="logo" 
                                       name="logo" 
                                       accept="image/png,image/jpeg,image/jpg,image/webp"
                                       onchange="previewImage(event)">
                            </div>
                            <p class="mt-2 text-xs text-gray-500 flex items-center">
                                <i class="bi bi-info-circle mr-1"></i>
                                {{ $partner->logo ? 'Kosongkan jika tidak ingin mengganti logo. ' : '' }}
                                Format: PNG, JPG, JPEG, WEBP. Maksimal 2MB
                            </p>
                            @error('logo')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                            @enderror
                            
                            {{-- New Image Preview --}}
                            <div id="imagePreview" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview Logo Baru:</p>
                                <div class="relative inline-block">
                                    <img id="preview" src="" alt="Preview" class="rounded-xl border-2 border-amber-300 shadow-md max-w-xs">
                                    <button type="button" 
                                            onclick="removePreview()" 
                                            class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-colors">
                                        <i class="bi bi-x text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-3 pt-4 border-t border-gray-200">
                            <button type="submit" 
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-lg hover:from-amber-600 hover:to-amber-700 shadow-md hover:shadow-lg transition-all duration-200">
                                <i class="bi bi-check-circle-fill"></i>
                                Update Partner
                            </button>
                            <a href="{{ route('admin.partners.index') }}" 
                               class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                <i class="bi bi-x-circle"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1 space-y-6">
            
            {{-- Info Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-900 flex items-center">
                        <i class="bi bi-info-circle-fill mr-2"></i>
                        Informasi
                    </h3>
                </div>
                <div class="p-6">
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="bi bi-check2 text-green-600 text-sm font-bold"></i>
                            </div>
                            <span class="text-sm text-gray-700">
                                Field dengan tanda <span class="text-red-500 font-semibold">*</span> wajib diisi
                            </span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="bi bi-check2 text-green-600 text-sm font-bold"></i>
                            </div>
                            <span class="text-sm text-gray-700">
                                Logo lama akan diganti jika upload logo baru
                            </span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="bi bi-check2 text-green-600 text-sm font-bold"></i>
                            </div>
                            <span class="text-sm text-gray-700">
                                Pastikan logo berkualitas baik
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Quick Actions Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-6 py-4 border-b border-purple-200">
                    <h3 class="text-lg font-semibold text-purple-900 flex items-center">
                        <i class="bi bi-lightning-charge-fill mr-2"></i>
                        Aksi Cepat
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.activity.index', ['partner_id' => $partner->id]) }}" 
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-lg hover:from-green-600 hover:to-green-700 shadow-md hover:shadow-lg transition-all duration-200">
                        <i class="bi bi-calendar-check-fill"></i>
                        Lihat Kegiatan Partner
                    </a>
                    
                    <button type="button"
                            onclick="confirmDelete()"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 shadow-md hover:shadow-lg transition-all duration-200">
                        <i class="bi bi-trash3-fill"></i>
                        Hapus Partner
                    </button>
                </div>
            </div>

            {{-- Warning Card --}}
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl shadow-sm border border-red-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-exclamation-triangle-fill text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-red-900 mb-2">Perhatian</h4>
                        <p class="text-sm text-red-800">
                            Menghapus partner akan menghapus semua kegiatan yang terkait
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Form (Hidden) --}}
<form id="deleteForm" action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.classList.add('hidden');
    }
}

function removePreview() {
    document.getElementById('logo').value = '';
    document.getElementById('imagePreview').classList.add('hidden');
}

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus partner ini?\n\nSemua kegiatan terkait juga akan terhapus.\n\nTindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection