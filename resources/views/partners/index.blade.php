@extends('layouts.app')

@section('content')

<!-- ===========================
    TITLE SECTION
=========================== -->
<section class="title-section py-4 bg-white">
    <div class="container-fluid px-0">
        <h1 class="fw-bold text-primary text-center fs-3">Partnership</h1>
    </div>
</section>

<!-- ===========================
    HERO IMAGE
=========================== -->
<section class="hero-section">
    <div class="container py-4 px-lg-3 px-md-4 px-3">
        <img
            src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
            alt="School Partnership"
            class="img-fluid w-100 shadow-sm hero-img">
    </div>
</section>

<!-- ===========================
    INTRO TEXT
=========================== -->
<section class="intro-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <p class="text-center text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===========================
    PARTNER SLIDER
=========================== -->
<div class="container-fluid px-0">
    <h2 class="fw-bold text-primary text-center fs-3">
        {{ __('Partnership') }}
    </h2>
</div>

<section class="partnership-slider py-4">
    <div class="slider-container">
        <div class="slider-track">

            @foreach ($partners as $p)
            <div class="slider-item">
                <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}">
            </div>
            @endforeach

            {{-- Duplikasi untuk infinite loop --}}
            @foreach ($partners as $p)
            <div class="slider-item">
                <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}">
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- ===========================
    WORKSHOP SECTION
=========================== -->
<section class="workshop-section py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Workshop dan Pelatihan Sekolah</h2>

        {{-- Livewire Search --}}
        @livewire('partner-search')

        {{-- Pagination --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $activities->links('pagination') }}
        </div>
    </div>
</section>

<!-- ===========================
    STYLE
=========================== -->
<style>
    /* Global */
    .text-primary {
        color: #001D7A !important;
    }

    /* Hero Image */
    .hero-img {
        max-height: 420px;
        object-fit: cover;
        border-radius: 20px;
    }

    /* Slider */
    .slider-container {
        overflow: hidden;
        width: 100%;
    }

    .slider-track {
        display: flex;
        gap: 20px;
        animation: slide 40s linear infinite;
    }

    .slider-track:hover {
        animation-play-state: paused;
    }

    .slider-item {
        width: 200px;
        height: 100px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slider-item img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    @keyframes slide {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* Workshop Card Image */
    .workshop-img {
        height: 200px;
        object-fit: cover;
    }

    /* Filter Button Hover */
    .btnFilter:hover {
        background-color: #d2d2d2;
    }

    /* Workshop Background */
    .workshop-section {
        background-color: #EDFFF3;
    }
</style>

<!-- ===========================
    SCRIPT
=========================== -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const loadMoreLink = document.getElementById("loadMoreLink");
        if (loadMoreLink) {
            loadMoreLink.addEventListener("click", function(e) {
                e.preventDefault();
                document.getElementById("moreWorkshops")?.classList.remove("d-none");
                this.style.display = "none";
            });
        }

        const loadMore = document.getElementById("loadMore");
        if (loadMore) {
            loadMore.addEventListener("click", function(e) {
                e.preventDefault();
                document.getElementById("Workshops")?.classList.remove("d-none");
                this.style.display = "none";
            });
        }

    });
</script>

@endsection