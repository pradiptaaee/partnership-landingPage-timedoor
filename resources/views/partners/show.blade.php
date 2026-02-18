@extends('layouts.app')

@section('content')
    <section class="hero-detail position-relative mb-5" style="height: 500px; overflow: hidden;">
        @if ($activity->featured_image_url)
            <img src="{{ $activity->featured_image_url }}" class="w-100" alt="{{ $activity->title }}"
                style="height: 100%; object-fit: cover;">
        @else
            <div class="d-flex align-items-center justify-content-center bg-light border-bottom" style="height: 100%;">
                <div class="text-center">
                    <i class="bi bi-image text-secondary" style="font-size: 3rem;"></i>
                    <p class="text-muted small mb-0">No Hero Image</p>
                </div>
            </div>
        @endif
        <div class="overlay position-absolute w-100 h-100 d-flex align-items-end"
            style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 60%, transparent 100%); top: 0;">
            <div class="container pb-5">
                <span class="badge px-3 py-2 mb-3" style="background-color: #10A300; font-size: 14px;">
                    <i class="bi bi-calendar-event me-1"></i> {{ $activity->activity_date->translatedFormat('d F Y') }}
                </span>
                <h1 class="text-white fw-bold display-4 mb-0">
                    {{ $activity->title }}
                </h1>
            </div>
        </div>
    </section>

    <div class="container mb-5">
        <div class="card border-0 shadow-sm mb-5"
            style="border-radius: 15px; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
            <div class="card-body p-4">
                <div class="row text-center">
                    <div class="col-md-4 border-end">
                        <i class="bi bi-calendar-check fs-3 mb-2" style="color: #10A300;"></i>
                        <h6 class="fw-bold mb-1">Tanggal</h6>
                        <p class="text-muted mb-0 small">{{ $activity->activity_date->translatedFormat('d F Y') }}</p>
                    </div>
                    <div class="col-md-4 border-end">
                        <i class="bi bi-envelope fs-3 mb-2" style="color: #10A300;"></i>
                        <h6 class="fw-bold mb-1">Email</h6>
                        <p class="text-muted mb-0 small">{{ $activity->partner->email ?? '-' }}</p>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-telephone fs-3 mb-2" style="color: #10A300;"></i>
                        <h6 class="fw-bold mb-1">Telepon</h6>
                        <p class="text-muted mb-0 small">{{ $activity->partner->no_telepon ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- KATEGORI: SEMINAR --}}
        {{-- SEMINAR: Speaker Profile --}}
        @if (strtolower($activity->category_activity) === 'seminar')
            <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; overflow: hidden;">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if (!empty($activity->seminarDetail->speaker_photo))
                            <img src="{{ asset('storage/activity/speakers/' . $activity->seminarDetail->speaker_photo) }}"
                                class="w-100 h-100" style="object-fit: cover; min-height: 300px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center h-100"
                                style="min-height: 300px;">
                                <i class="bi bi-person-circle text-secondary" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px;
                        background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);">
                                    <i class="bi bi-person-badge text-white fs-4"></i>
                                </div>
                                <h3 class="fw-bold mb-0" style="color: #001D7A;">Profil Pembicara</h3>
                            </div>

                            <h4 class="fw-bold text-dark mb-2">
                                {{ $activity->seminarDetail->speaker_name }}
                            </h4>

                            <p class="text-muted fst-italic mb-4" style="font-size: 18px; line-height: 1.8;">
                                "{{ $activity->seminarDetail->speaker_about ?? 'Informasi pembicara tidak tersedia.' }}"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (strtolower($activity->category_activity) === 'workshop')
            <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; border-left: 10px solid #10A300;">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 50px; height: 50px;
                background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);">
                            <i class="bi bi-mortarboard text-white fs-4"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color: #001D7A;">Mentor Workshop</h3>
                    </div>

                    <h4 class="fw-bold text-dark mb-2">
                        {{ $activity->workshopDetail->mentor_name ?? '-' }}
                    </h4>

                    <p class="text-muted mb-0" style="font-size: 17px; line-height: 1.8;">
                        {{ $activity->workshopDetail->description }}
                    </p>
                </div>
            </div>
        @endif


        <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px;">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-md-1 text-center mb-4 mb-md-0">
                        <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px; background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);">
                            <i class="bi bi-book text-white fs-3"></i>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <h4 class="fw-bold mb-4" style="color: #001D7A;">Deskripsi Lengkap</h4>
                        <div class="text-muted" style="font-size: 16px; line-height: 1.9; text-align: justify;">
                            {!! nl2br(e($activity->full_description)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <livewire:activity-gallery :activity="$activity" />


        <div class="text-center mt-5">
            <a href="{{ route('partnership.index') }}" class="btn text-white px-5 py-3 mb-5"
                style="background: linear-gradient(135deg, #10A300 0%, #0d8500 100%); border: none; border-radius: 50px; font-weight: bold;">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Kegiatan
            </a>
        </div>
    </div>

    <style>
        /* === GALLERY GRID === */
/* === MASONRY GALLERY === */
.gallery-masonry {
    column-count: 3;
    column-gap: 1rem;
}

.gallery-masonry .gallery-item {
    break-inside: avoid;
    margin-bottom: 1rem;
    border-radius: 14px;
    overflow: hidden;
    background: #f4f6f8;
    cursor: pointer;
}

.gallery-masonry img {
    width: 100%;
    height: auto; /* ⬅ rasio asli */
    display: block;
    transition: transform .35s ease;
}

.gallery-masonry .gallery-item:hover img {
    transform: scale(1.04);
}

/* === RESPONSIVE === */
@media (max-width: 992px) {
    .gallery-masonry {
        column-count: 2;
    }
}

@media (max-width: 576px) {
    .gallery-masonry {
        column-count: 1;
    }
}



/* ===== LIGHTBOX ===== */
.lightbox-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.85);
    z-index: 1055;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-image {
    max-width: 85vw;
    max-height: 85vh;
    object-fit: contain;
}

.lightbox-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 48px;
    color: white;
    background: none;
    border: none;
    cursor: pointer;
}

.lightbox-btn.left { left: 24px; }
.lightbox-btn.right { right: 24px; }

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 26px;
    color: white;
    background: none;
    border: none;
}



        .italic {
            font-style: italic;
        }
    </style>
@endsection
