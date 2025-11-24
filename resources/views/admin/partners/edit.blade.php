@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Partner</a></li>
                <li class="breadcrumb-item active">Edit Partner</li>
            </ol>
        </nav>
        <h1 class="h3 mb-1 text-gray-800">Edit Partner</h1>
        <p class="text-muted mb-0">Perbarui informasi partner</p>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-white">
                    <h6 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Partner</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Partner -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">
                                Nama Partner <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $partner->name) }}" 
                                   placeholder="Masukkan nama partner"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('category') is-invalid @enderror" 
                                   id="category" 
                                   name="category" 
                                   value="{{ old('category', $partner->category) }}" 
                                   placeholder="Contoh: Pemerintah, Swasta, NGO"
                                   required>
                            @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Masukkan deskripsi partner (opsional)">{{ old('description', $partner->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Logo -->
                        @if($partner->logo)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Logo Saat Ini</label>
                            <div>
                                <img src="{{ asset('storage/' . $partner->logo) }}" 
                                     alt="{{ $partner->name }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px;">
                            </div>
                        </div>
                        @endif

                        <!-- Logo Upload -->
                        <div class="mb-4">
                            <label for="logo" class="form-label fw-bold">
                                {{ $partner->logo ? 'Ganti Logo' : 'Upload Logo' }}
                            </label>
                            <input type="file" 
                                   class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" 
                                   name="logo" 
                                   accept="image/png,image/jpeg,image/jpg,image/webp"
                                   onchange="previewImage(event)">
                            <small class="text-muted">
                                {{ $partner->logo ? 'Kosongkan jika tidak ingin mengganti logo. ' : '' }}
                                Format: PNG, JPG, JPEG, WEBP. Maksimal 2MB
                            </small>
                            @error('logo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            
                            <!-- New Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <p class="mb-2 text-muted small">Preview Logo Baru:</p>
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Partner
                            </button>
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <small>Field dengan tanda <span class="text-danger">*</span> wajib diisi</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <small>Logo lama akan diganti jika upload logo baru</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <small>Pastikan logo berkualitas baik</small>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.activity.index', ['partner_id' => $partner->id]) }}" 
                       class="btn btn-success btn-sm w-100 mb-2">
                        <i class="fas fa-calendar-alt me-2"></i>Lihat Kegiatan Partner
                    </a>
                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" 
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini? Semua kegiatan terkait juga akan terhapus.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100">
                            <i class="fas fa-trash me-2"></i>Hapus Partner
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
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
</script>

<style>
.card {
    border-radius: 0.5rem;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}
</style>
@endsection