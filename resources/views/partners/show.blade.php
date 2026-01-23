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
                        <p class="text-muted mb-0 small">{{ $activity->partner->email ?? 'info@timedooracademy.com' }}</p>
                    </div>
                    <div class="col-md-4">
                        <i class="bi bi-telephone fs-3 mb-2" style="color: #10A300;"></i>
                        <h6 class="fw-bold mb-1">Telepon</h6>
                        <p class="text-muted mb-0 small">{{ $activity->partner->phone ?? '+62 888 947 793' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- KATEGORI: SEMINAR --}}
        @if (strtolower($activity->category_activity) == 'seminar')
            <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; overflow: hidden;">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if ($activity->speaker_photo)
                            <img src="{{ asset('storage/' . $activity->speaker_photo) }}" class="w-100 h-100"
                                style="object-fit: cover; min-height: 300px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center h-100"
                                style="min-height: 300px;">
                                <i class="bi bi-person-bounding-box text-secondary" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px; background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);">
                                    <i class="bi bi-person-badge text-white fs-4"></i>
                                </div>
                                <h3 class="fw-bold mb-0" style="color: #001D7A;">Profil Pembicara</h3>
                            </div>
                            <h4 class="fw-bold text-dark mb-2">{{ $activity->speaker_name }}</h4>
                            <p class="text-muted italic mb-4" style="font-size: 18px; line-height: 1.8;">
                                "{{ $activity->short_description }}"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- KATEGORI: WORKSHOP (Tanpa Foto Mentor) --}}
        @if (strtolower($activity->category_activity) == 'workshop')
            <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; border-left: 10px solid #10A300;">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 50px; height: 50px; background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);">
                            <i class="bi bi-mortarboard text-white fs-4"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color: #001D7A;">Mentor Workshop</h3>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">{{ $activity->mentor_name }}</h4>
                    <p class="text-muted mb-0" style="font-size: 17px; line-height: 1.8;">
                        {{ $activity->short_description }}
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



        <div class="mb-5">
            <h3 class="fw-bold mb-4 text-center" style="color: #001D7A;">
                <i class="bi bi-images me-2" style="color: #10A300;"></i>
                Galeri Kegiatan
            </h3>

            <div class="row g-3">
                @forelse ($activity->photos as $index => $photo)
                    <div class="{{ $index === 0 ? 'col-md-8' : 'col-md-4' }}">
                        <div class="gallery-box {{ $index === 0 ? 'gallery-large' : 'gallery-small' }}">
                            {{-- PERBAIKAN: Menggunakan image_path sesuai database --}}
                            <img src="{{ asset('storage/activity/gallery/' . $photo->image_path) }}"
                                alt="Galeri {{ $activity->title }}" class="w-100 h-100 gallery-img shadow-sm">
                        </div>
                    </div>
                @empty
                    {{-- Tampilan jika galeri kosong --}}
                    <div class="col-12">
                        <div class="card border-0 shadow-sm bg-light text-center py-5" style="border-radius: 15px;">
                            <div class="card-body">
                                <i class="bi bi-camera-video-off text-secondary mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-muted">Belum ada dokumentasi foto untuk kegiatan ini.</h5>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>


        <div class="text-center mt-5">
            <a href="{{ route('partnership.index') }}" class="btn text-white px-5 py-3 mb-5"
                style="background: linear-gradient(135deg, #10A300 0%, #0d8500 100%); border: none; border-radius: 50px; font-weight: bold;">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Kegiatan
            </a>
        </div>
    </div>

    <style>
        .gallery-box {
            overflow: hidden;
            border-radius: 15px;
        }

        .gallery-large {
            height: 450px;
        }

        .gallery-small {
            height: 218px;
        }

        .gallery-img {
            object-fit: cover;
            transition: 0.3s;
        }

        .gallery-img:hover {
            transform: scale(1.03);
        }

        .italic {
            font-style: italic;
        }
    </style>
@endsection
