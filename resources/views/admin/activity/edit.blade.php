@extends('layouts.admin')

@section('title', 'Edit Kegiatan Partner')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Breadcrumb & Header --}}
        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.activity.index') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-amber-600 transition-colors">
                            <i class="bi bi-house-door mr-2"></i>
                            Kegiatan
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="bi bi-chevron-right text-gray-400 text-xs"></i>
                            <span class="ml-2 text-sm font-medium text-gray-500">Edit Kegiatan</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="bi bi-pencil-square text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Kegiatan</h1>
                    <p class="text-gray-600 mt-1">Perbarui informasi kegiatan partner</p>
                </div>
            </div>
        </div>

        {{-- Success Alert --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3 animate-slideDown">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-check-circle-fill text-white text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800 transition-colors">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        <form action="{{ route('admin.activity.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Main Form --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Basic Information Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
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
                                    <select
                                        class="w-full appearance-none px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white cursor-pointer @error('partner_id') border-red-500 ring-2 ring-red-200 @enderror"
                                        id="partner_id" name="partner_id" required>
                                        <option value="">-- Pilih Partner --</option>
                                        @foreach ($partners as $partner)
                                            <option value="{{ $partner->id }}"
                                                {{ old('partner_id', $activity->partner_id) == $partner->id ? 'selected' : '' }}>
                                                {{ $partner->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
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
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('title') border-red-500 ring-2 ring-red-200 @enderror"
                                    id="title" name="title" value="{{ old('title', $activity->title) }}"
                                    placeholder="Contoh: Workshop Pelatihan Digital Marketing" required>
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="bi bi-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Category Activity --}}
                            <div>
                                <label for="category_activity" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kategori Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="category_activity" name="category_activity"
                                    value="{{ old('category_activity', $activity->category_activity) }}"
                                    placeholder="Contoh: seminar, workshop, event" oninput="toggleShortDesc(this.value)"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('category_activity') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>

                                @error('category_activity')
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
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('activity_date') border-red-500 ring-2 ring-red-200 @enderror"
                                    id="activity_date" name="activity_date"
                                    value="{{ old('activity_date', \Carbon\Carbon::parse($activity->activity_date)->format('Y-m-d')) }}"
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
                                <textarea
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('short_description') border-red-500 ring-2 ring-red-200 @enderror"
                                    id="short_description" name="short_description" rows="3" placeholder="Ringkasan kegiatan (maks 200 karakter)"
                                    maxlength="200" required>{{ old('short_description', $activity->short_description) }}</textarea>
                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <i class="bi bi-info-circle mr-1"></i>
                                        <span id="char_count">{{ strlen($activity->short_description) }}</span>/200
                                        karakter
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
                                <textarea
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 @error('full_description') border-red-500 ring-2 ring-red-200 @enderror"
                                    id="full_description" name="full_description" rows="6"
                                    placeholder="Jelaskan detail kegiatan, tujuan, hasil, dan hal-hal penting lainnya..." required>{{ old('full_description', $activity->full_description) }}</textarea>
                                @error('full_description')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="bi bi-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Current Featured Image --}}
                    @if ($activity->featured_image)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                                <h3 class="text-lg font-semibold text-blue-900 flex items-center">
                                    <i class="bi bi-image-fill mr-2"></i>
                                    Gambar Utama Saat Ini
                                </h3>
                            </div>
                            <div class="p-6 text-center">
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}"
                                        alt="{{ $activity->title }}"
                                        class="rounded-xl border-2 border-gray-200 shadow-md max-w-full"
                                        style="max-height: 300px;">
                                    <div
                                        class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg">
                                        <i class="bi bi-check2 text-lg font-bold"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Media Upload Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                            <h2 class="text-lg font-semibold text-white flex items-center">
                                <i class="bi bi-cloud-upload-fill mr-2"></i>
                                Upload Media Baru
                            </h2>
                        </div>

                        <div class="p-6 space-y-6">
                            {{-- Featured Image --}}
                            <div>
                                <label for="featured_image" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Ganti Gambar Utama <span class="text-gray-500">(Opsional)</span>
                                </label>
                                <input type="file"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700 file:font-medium hover:file:bg-green-100 @error('featured_image') border-red-500 ring-2 ring-red-200 @enderror"
                                    id="featured_image" name="featured_image" accept="image/*"
                                    onchange="previewFeaturedImage(event)">
                                <p class="mt-2 text-xs text-gray-500 flex items-center">
                                    <i class="bi bi-info-circle mr-1"></i>
                                    Kosongkan jika tidak ingin mengganti. Rekomendasi: 1200x600px, maksimal 2MB
                                </p>
                                @error('featured_image')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="bi bi-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror

                                {{-- Featured Image Preview --}}
                                <div id="featured_preview" class="mt-4 hidden">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar Baru:</p>
                                    <div class="relative inline-block">
                                        <img id="featured_img" src="" alt="Preview"
                                            class="rounded-xl border-2 border-green-300 shadow-md max-w-xs">
                                        <button type="button" onclick="removeFeaturedPreview()"
                                            class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-colors">
                                            <i class="bi bi-x text-xl"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Multiple Photos --}}
                            <div>
                                <label for="photos" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tambah Foto Galeri <span class="text-gray-500">(Opsional)</span>
                                </label>
                                <input type="file"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700 file:font-medium hover:file:bg-green-100 @error('photos.*') border-red-500 ring-2 ring-red-200 @enderror"
                                    id="photos" name="photos[]" accept="image/*" multiple
                                    onchange="previewMultipleImages(event)">
                                <p class="mt-2 text-xs text-gray-500 flex items-center">
                                    <i class="bi bi-info-circle mr-1"></i>
                                    Upload foto tambahan untuk galeri. Maksimal 2MB per foto
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

                    {{-- Existing Gallery Photos --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-6 py-4 border-b border-purple-200">
                            <h3 class="text-lg font-semibold text-purple-900 flex items-center">
                                <i class="bi bi-images mr-2"></i>
                                Galeri Foto ({{ $activity->photos->count() }})
                            </h3>
                        </div>
                        <div class="p-6">
                            @if ($activity->photos->isEmpty())
                                <div class="text-center py-12">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-3">
                                        <i class="bi bi-image text-3xl text-gray-400"></i>
                                    </div>
                                    <p class="text-gray-500">Tidak ada foto kegiatan</p>
                                </div>
                            @else
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="photoGallery">
                                    @foreach ($activity->photos as $photo)
                                        <div class="relative group" id="photo-{{ $photo->id }}">
                                            <img src="{{ asset('storage/activity/photos/' . $photo->image_path) }}"
                                                alt="Photo"
                                                class="w-full h-32 object-cover rounded-lg border-2 border-gray-200 group-hover:border-purple-300 transition-all duration-200">

                                            <button type="button"
                                                class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-all duration-200 opacity-0 group-hover:opacity-100 btn-delete-photo"
                                                data-photo-id="{{ $photo->id }}" title="Hapus foto">
                                                <i class="bi bi-trash3-fill text-sm"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- Action Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                        <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 border-b border-indigo-200">
                            <h3 class="text-lg font-semibold text-indigo-900 flex items-center">
                                <i class="bi bi-lightning-charge-fill mr-2"></i>
                                Aksi
                            </h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-lg hover:from-amber-600 hover:to-amber-700 shadow-md hover:shadow-lg transition-all duration-200">
                                <i class="bi bi-check-circle-fill"></i>
                                Update Kegiatan
                            </button>
                            <a href="{{ route('admin.activity.index') }}"
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                <i class="bi bi-arrow-left-circle"></i>
                                Kembali
                            </a>

                            <div class="border-t border-gray-200 my-4"></div>

                            <button type="button" onclick="deleteActivity()"
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 shadow-md hover:shadow-lg transition-all duration-200">
                                <i class="bi bi-trash3-fill"></i>
                                Hapus Kegiatan
                            </button>
                        </div>
                    </div>

                    {{-- Info Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="bi bi-info-circle-fill mr-2"></i>
                                Informasi
                            </h3>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-4 text-sm">
                                <li>
                                    <p class="font-semibold text-gray-700 mb-1">Slug:</p>
                                    <code
                                        class="px-2 py-1 bg-gray-100 rounded text-xs text-gray-800 break-all">{{ $activity->slug }}</code>
                                </li>
                                <li>
                                    <p class="font-semibold text-gray-700 mb-1">Dibuat:</p>
                                    <p class="text-gray-600">{{ $activity->created_at->format('d M Y H:i') }}</p>
                                </li>
                                <li>
                                    <p class="font-semibold text-gray-700 mb-1">Diupdate:</p>
                                    <p class="text-gray-600">{{ $activity->updated_at->format('d M Y H:i') }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Delete Activity Form --}}
    <form id="deleteActivityForm" action="{{ route('admin.activity.destroy', $activity->id) }}" method="POST"
        class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // Character counter
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
                        col.innerHTML =
                            `<img src="${e.target.result}" class="img-thumbnail" style="height: 100px; object-fit: cover;">`;
                        previewContainer.appendChild(col);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                previewContainer.style.display = 'none';
            }
        }

        // Delete activity
        function deleteActivity() {
            if (confirm('Apakah Anda yakin ingin menghapus kegiatan ini? Semua foto terkait akan ikut terhapus.')) {
                document.getElementById('deleteActivityForm').submit();
            }
        }

        // Delete individual photo
        function deletePhoto(photoId) {
            if (!confirm('Yakin ingin menghapus foto ini?')) return;

            fetch(`/admin/activity/photo/${photoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Gagal hapus');
                    return res.json();
                })
                .then(() => {
                    location.reload(); // simpel & aman
                })
                .catch(err => {
                    alert('Terjadi kesalahan saat menghapus foto');
                    console.error(err);
                });
        }
    </script>

    <style>
        .card {
            border-radius: 0.5rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .position-relative .btn-danger {
            opacity: 0.9;
        }

        .position-relative:hover .btn-danger {
            opacity: 1;
        }
    </style>
@endsection
