@extends('layouts.admin')

@section('title', 'Edit Kegiatan Partner')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.activity.index') }}">Kegiatan</a></li>
                    <li class="breadcrumb-item active">Edit Kegiatan</li>
                </ol>
            </nav>
            <h1 class="h3 mb-1 text-gray-800">Edit Kegiatan</h1>
            <p class="text-muted mb-0">Perbarui informasi kegiatan partner</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.activity.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Main Form -->
                <div class="col-lg-8">
                    <!-- Basic Information Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-warning text-white">
                            <h6 class="mb-0"><i class="fas fa-edit me-2"></i>Informasi Dasar</h6>
                        </div>
                        <div class="card-body p-4">
                            <!-- Partner Selection -->
                            <div class="mb-3">
                                <label for="partner_id" class="form-label fw-bold">
                                    Partner <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('partner_id') is-invalid @enderror" id="partner_id"
                                    name="partner_id" required>
                                    <option value="">-- Pilih Partner --</option>
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}"
                                            {{ old('partner_id', $activity->partner_id) == $partner->id ? 'selected' : '' }}>
                                            {{ $partner->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('partner_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">
                                    Judul Kegiatan <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $activity->title) }}"
                                    placeholder="Contoh: Workshop Pelatihan Digital Marketing" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Activity Date -->
                            <div class="mb-3">
                                <label for="activity_date" class="form-label fw-bold">
                                    Tanggal Kegiatan <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control @error('activity_date') is-invalid @enderror"
                                    id="activity_date" name="activity_date"
                                    value="{{ old('activity_date', \Carbon\Carbon::parse($activity->activity_date)->format('Y-m-d')) }}"
                                    required>
                                @error('activity_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Short Description -->
                            <div class="mb-3">
                                <label for="short_description" class="form-label fw-bold">
                                    Deskripsi Singkat <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                    name="short_description" rows="3" placeholder="Ringkasan kegiatan (maks 200 karakter)" maxlength="200"
                                    required>{{ old('short_description', $activity->short_description) }}</textarea>
                                <small class="text-muted">
                                    <span id="char_count">{{ strlen($activity->short_description) }}</span>/200 karakter
                                </small>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Full Description -->
                            <div class="mb-3">
                                <label for="full_description" class="form-label fw-bold">
                                    Deskripsi Lengkap <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('full_description') is-invalid @enderror" id="full_description"
                                    name="full_description" rows="6"
                                    placeholder="Jelaskan detail kegiatan, tujuan, hasil, dan hal-hal penting lainnya..." required>{{ old('full_description', $activity->full_description) }}</textarea>
                                @error('full_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Current Featured Image -->
                    @if ($activity->featured_image)
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-image me-2"></i>Gambar Utama Saat Ini</h6>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}"
                                    alt="{{ $activity->title }}" class="img-fluid rounded" style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <!-- Media Upload Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0"><i class="fas fa-upload me-2"></i>Upload Media Baru</h6>
                        </div>
                        <div class="card-body p-4">
                            <!-- Featured Image -->
                            <div class="mb-4">
                                <label for="featured_image" class="form-label fw-bold">
                                    Ganti Gambar Utama <span class="text-muted">(Opsional)</span>
                                </label>
                                <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                    id="featured_image" name="featured_image" accept="image/*"
                                    onchange="previewFeaturedImage(event)">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti. Rekomendasi: 1200x600px,
                                    maksimal 2MB</small>
                                @error('featured_image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <!-- Featured Image Preview -->
                                <div id="featured_preview" class="mt-3" style="display: none;">
                                    <p class="mb-2 text-muted small">Preview Gambar Baru:</p>
                                    <img id="featured_img" src="" alt="Preview" class="img-thumbnail"
                                        style="max-height: 200px;">
                                </div>
                            </div>

                            <!-- Multiple Photos -->
                            <div class="mb-3">
                                <label for="photos" class="form-label fw-bold">
                                    Tambah Foto Galeri <span class="text-muted">(Opsional)</span>
                                </label>
                                <input type="file" class="form-control @error('photos.*') is-invalid @enderror"
                                    id="photos" name="photos[]" accept="image/*" multiple
                                    onchange="previewMultipleImages(event)">
                                <small class="text-muted">Upload foto tambahan untuk galeri. Maksimal 2MB per foto.</small>
                                @error('photos.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <!-- Multiple Photos Preview -->
                                <div id="photos_preview" class="row g-2 mt-3" style="display: none;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Existing Gallery Photos -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-images me-2"></i>
                                Galeri Foto ({{ $activity->photos->count() }})
                            </h6>
                        </div>
                        <div class="card-body">
                            
                            {{-- LOGIKA KONDISIONAL BARU --}}
                            @if ($activity->photos->isEmpty())
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-image fa-2x mb-2"></i>
                                    <p class="mb-0">Tidak ada foto kegiatan.</p>
                                </div>
                            @else
                                <div class="row g-3" id="photoGallery">
                                    @foreach ($activity->photos as $photo)
                                        {{-- Beri ID unik agar mudah dihapus via JS --}}
                                        <div class="col-md-3" id="photo-{{ $photo->id }}"> 
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/activity/photos/' . $photo->image_path) }}"
                                                    alt="Photo" class="img-thumbnail w-100"
                                                    style="height: 150px; object-fit: cover;">
                                                
                                                {{-- TOMBOL HAPUS BARU (Memicu JS) --}}
                                                <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 btn-delete-photo"
                                                    data-photo-id="{{ $photo->id }}" title="Hapus foto">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Action Card -->
                    <div class="card shadow-sm border-0 mb-3 sticky-top" style="top: 20px;">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Aksi</h6>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-save me-2"></i>Update Kegiatan
                            </button>
                            <a href="{{ route('admin.activity.index') }}" class="btn btn-secondary w-100 mb-3">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>

                            <hr>

                            <button type="button" class="btn btn-danger w-100" onclick="deleteActivity()">
                                <i class="fas fa-trash me-2"></i>Hapus Kegiatan
                            </button>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-2">
                                    <strong>Slug:</strong><br>
                                    <code>{{ $activity->slug }}</code>
                                </li>
                                <li class="mb-2">
                                    <strong>Dibuat:</strong><br>
                                    {{ $activity->created_at->format('d M Y H:i') }}
                                </li>
                                <li class="mb-0">
                                    <strong>Diupdate:</strong><br>
                                    {{ $activity->updated_at->format('d M Y H:i') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete Activity Form -->
    <form id="deleteActivityForm" action="{{ route('admin.activity.destroy', $activity->id) }}" method="POST"
        style="display: none;">
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
