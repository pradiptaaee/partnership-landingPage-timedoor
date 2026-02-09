@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.activity.index') }}" class="text-decoration-none text-success">Activities</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
            <h3 class="fw-bold text-dark mb-0">{{ $activity->title }}</h3>
        </div>
        <a href="{{ route('admin.activity.index') }}" class="btn btn-outline-secondary px-4 rounded-pill shadow-sm transition-all hover-shadow">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        {{-- Sisi Kiri: Featured Image & Gallery --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-white fw-bold py-3 border-0">
                    <i class="bi bi-image me-2 text-success"></i>Featured Image
                </div>
                <div class="p-3 pt-0 text-center">
                    @if($activity->featured_image)
                        <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}"
                             class="img-fluid rounded-3 shadow-sm"
                             alt="{{ $activity->title }}" style="max-height: 250px; object-fit: cover; width: 100%;">
                    @else
                        <div class="bg-light rounded-3 py-5 text-muted">No Image Available</div>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white fw-bold py-3 border-0">
                    <i class="bi bi-images me-2 text-success"></i>Foto Kegiatan
                </div>
                <div class="card-body pt-0">
                    @if($activity->photos->count() > 0)
                        <div class="row g-2">
                            @foreach($activity->photos as $photo)
                                <div class="col-6">
                                    <img src="{{ asset('storage/activity/photos/' . $photo) }}"
                                         class="img-fluid rounded-3 shadow-sm border border-light"
                                         style="height: 100px; width: 100%; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small italic">Tidak ada foto tambahan.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sisi Kanan: Detail Informasi --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-info-circle text-success fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-dark">Informasi Utama</h5>
                    </div>
                    
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-bold">Partner</label>
                            <p class="mb-0 fw-semibold text-dark">{{ $activity->partner->name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-bold">Tanggal Kegiatan</label>
                            <p class="mb-0 fw-semibold text-dark">{{ \Carbon\Carbon::parse($activity->activity_date)->format('d F Y') }}</p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small text-uppercase fw-bold">Deskripsi Singkat</label>
                            <p class="mb-0 text-secondary">{{ $activity->short_description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-text-paragraph text-success fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-dark">Deskripsi Lengkap</h5>
                    </div>
                    <div class="text-secondary leading-relaxed">
                        {!! nl2br(e($activity->full_description)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-4 { border-radius: 1rem !important; }
    .transition-all { transition: all 0.3s ease; }
    .hover-shadow:hover { box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; }
    .leading-relaxed { line-height: 1.7; }
</style>
@endsection