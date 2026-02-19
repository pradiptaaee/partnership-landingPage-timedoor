@extends('layouts.app')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="relative mb-12 aspect-[16/9] sm:aspect-[21/9] overflow-hidden">
    @if ($activity->featured_image_url)
    <img
        src="{{ $activity->featured_image_url }}"
        alt="{{ $activity->title }}"
        class="w-full h-full object-cover">
    @else
    <div class="flex items-center justify-center bg-gray-100 h-full">
        <div class="text-center text-gray-400">
            <i class="bi bi-image text-5xl"></i>
            <p class="text-sm">No Hero Image</p>
        </div>
    </div>
    @endif

    <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/80 via-black/40 to-transparent">
        <div class="max-w-7xl mx-auto px-4 pb-6 sm:pb-10">
            <span class="inline-block mb-3 px-3 py-1 bg-[#10A300] text-white text-xs sm:text-sm rounded">
                <i class="bi bi-calendar-event mr-1"></i>
                {{ $activity->activity_date->translatedFormat('d F Y') }}
            </span>
            <h1 class="text-white font-bold text-2xl sm:text-3xl md:text-5xl leading-tight">
                {{ $activity->title }}
            </h1>
        </div>
    </div>
</section>

{{-- ================= CONTENT ================= --}}
<div class="max-w-7xl mx-auto px-4 mb-16">

    {{-- INFO CARD --}}
    <div class="bg-white rounded-2xl shadow-sm mb-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center p-6">
            <div class="sm:border-r border-gray-200">
                <i class="bi bi-calendar-check text-3xl sm:text-4xl mb-2 text-[#10A300]"></i>
                <h6 class="font-bold">Tanggal</h6>
                <p class="text-gray-500 text-sm">
                    {{ $activity->activity_date->translatedFormat('d F Y') }}
                </p>
            </div>

            <div class="sm:border-r border-gray-200">
                <i class="bi bi-envelope text-3xl sm:text-4xl mb-2 text-[#10A300]"></i>
                <h6 class="font-bold">Email</h6>
                <p class="text-gray-500 text-sm">
                    {{ $activity->partner->email ?? '-' }}
                </p>
            </div>

            <div>
                <i class="bi bi-telephone text-3xl sm:text-4xl mb-2 text-[#10A300]"></i>
                <h6 class="font-bold">Telepon</h6>
                <p class="text-gray-500 text-sm">
                    {{ $activity->partner->no_telepon ?? '-' }}
                </p>
            </div>
        </div>
    </div>

    {{-- ================= SEMINAR ================= --}}
    @if (strtolower($activity->category_activity) === 'seminar')
    <div class="bg-white rounded-2xl shadow-sm mb-12 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-12">
            <div class="md:col-span-4">
                @if (!empty($activity->seminarDetail->speaker_photo))
                <img
                    src="{{ asset('storage/activity/speakers/' . $activity->seminarDetail->speaker_photo) }}"
                    class="w-full aspect-square md:aspect-auto md:h-full object-cover">
                @else
                <div class="flex items-center justify-center bg-gray-100 aspect-square">
                    <i class="bi bi-person-circle text-6xl text-gray-400"></i>
                </div>
                @endif
            </div>

            <div class="md:col-span-8 p-6 sm:p-10">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 bg-gradient-to-br from-[#10A300] to-[#0d8500]">
                        <i class="bi bi-person-badge text-white text-xl"></i>
                    </div>
                    <h3 class="font-bold text-2xl text-[#001D7A]">Profil Pembicara</h3>
                </div>

                <h4 class="font-bold text-xl mb-2">
                    {{ $activity->seminarDetail->speaker_name }}
                </h4>

                <p class="text-gray-500 italic leading-relaxed">
                    "{{ $activity->seminarDetail->speaker_about ?? 'Informasi pembicara tidak tersedia.' }}"
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- ================= WORKSHOP ================= --}}
    @if (strtolower($activity->category_activity) === 'workshop')
    <div class="bg-white rounded-2xl shadow-sm border-l-8 border-[#10A300] mb-12">
        <div class="p-6 sm:p-10">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 bg-gradient-to-br from-[#10A300] to-[#0d8500]">
                    <i class="bi bi-mortarboard text-white text-xl"></i>
                </div>
                <h3 class="font-bold text-2xl text-[#001D7A]">Profil Mentor</h3>
            </div>

            <h4 class="font-bold text-xl mb-2">
                {{ $activity->workshopDetail->mentor_name ?? '-' }}
            </h4>

            <p class="text-gray-500 leading-relaxed">
                {{ $activity->workshopDetail->description }}
            </p>
        </div>
    </div>
    @endif

    {{-- ================= DESKRIPSI ================= --}}
    <div class="bg-white rounded-2xl shadow-sm mb-12">
        <div class="p-6 sm:p-10 grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-1 flex justify-center">
                <div class="w-14 h-14 rounded-full flex items-center justify-center bg-gradient-to-br from-[#10A300] to-[#0d8500]">
                    <i class="bi bi-book text-white text-2xl"></i>
                </div>
            </div>

            <div class="md:col-span-11">
                <h4 class="font-bold text-xl text-[#001D7A] mb-4">Deskripsi Lengkap</h4>
                <div class="text-gray-500 leading-relaxed text-justify">
                    {!! nl2br(e($activity->full_description)) !!}
                </div>
            </div>
        </div>
    </div>

    {{-- ================= GALLERY ================= --}}
    <livewire:activity-gallery :activity="$activity" />

    {{-- ================= BACK BUTTON ================= --}}
    <div class="text-center mt-16">
        <a
            href="{{ route('partnership.index') }}"
            class="inline-flex items-center gap-2 px-8 py-3 text-white font-bold rounded-full bg-gradient-to-br from-[#10A300] to-[#0d8500] hover:opacity-90 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Kegiatan
        </a>
    </div>

</div>

<style>
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
        height: auto;
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
        background: rgba(0, 0, 0, .85);
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

    .lightbox-btn.left {
        left: 24px;
    }

    .lightbox-btn.right {
        right: 24px;
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 26px;
        color: white;
        background: none;
        border: none;
    }
</style>
@endsection