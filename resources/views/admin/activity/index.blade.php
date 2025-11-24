@extends('layouts.admin')

@section('title', 'Manajemen Kegiatan Partner')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Manajemen Kegiatan Partner</h1>
            <p class="text-muted mb-0">Kelola seluruh kegiatan dan aktivitas partner</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Partner
            </a>
            <a href="{{ route('admin.activity.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Kegiatan
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Filter Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.activity.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label small text-muted">Cari Kegiatan</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari judul kegiatan..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Partner</label>
                    <select name="partner_id" class="form-select">
                        <option value="">Semua Partner</option>
                        @foreach(\App\Models\Partner::orderBy('name')->get() as $partner)
                        <option value="{{ $partner->id }}" {{ request('partner_id') == $partner->id ? 'selected' : '' }}>
                            {{ $partner->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Urutkan</label>
                    <select name="sort" class="form-select">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul A-Z</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Activities Grid -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
        @forelse($activities as $activity)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 activity-card">
                <!-- Featured Image -->
                <div class="position-relative">
                    @if($activity->featured_image)
                    <img src="{{ asset('storage/' . $activity->featured_image) }}" 
                         class="card-img-top" 
                         alt="{{ $activity->title }}"
                         style="height: 200px; object-fit: cover;">
                    @else
                    <div class="bg-light d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                    @endif
                    
                    <!-- Partner Badge -->
                    <div class="position-absolute top-0 start-0 m-2">
                        <span class="badge bg-primary">{{ $activity->partner->name }}</span>
                    </div>

                    <!-- Photo Count Badge -->
                    @if($activity->photos && $activity->photos->count() > 0)
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-dark">
                            <i class="fas fa-images me-1"></i>{{ $activity->photos->count() }}
                        </span>
                    </div>
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <!-- Title -->
                    <h5 class="card-title mb-2">{{ Str::limit($activity->title, 50) }}</h5>
                    
                    <!-- Short Description -->
                    <p class="card-text text-muted small mb-3 flex-grow-1">
                        {{ Str::limit($activity->short_description, 100) }}
                    </p>

                    <!-- Date -->
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}
                        </small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.activity.edit', $activity->id) }}" 
                           class="btn btn-sm btn-warning text-white flex-fill">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.activity.destroy', $activity->id) }}" 
                              method="POST" 
                              class="flex-fill"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-light border-0">
                    <small class="text-muted">
                        <i class="far fa-clock me-1"></i>
                        Dibuat {{ $activity->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted mb-3">Belum Ada Kegiatan</h5>
                    <p class="text-muted mb-4">Mulai tambahkan kegiatan partner untuk ditampilkan di sini</p>
                    <a href="{{ route('admin.activity.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Kegiatan Pertama
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($activities->hasPages())
    <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted small">
            Menampilkan {{ $activities->firstItem() }} - {{ $activities->lastItem() }} dari {{ $activities->total() }} kegiatan
        </div>
        <div>
            {{ $activities->links() }}
        </div>
    </div>
    @endif
</div>

<style>
.activity-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border-radius: 0.5rem;
    overflow: hidden;
}

.activity-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.card-img-top {
    border-radius: 0;
}

.badge {
    font-weight: 500;
}
</style>
@endsection