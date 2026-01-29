@extends('layouts.app')

@section('content')
<!-- ===========================
            TITLE SECTION
        =========================== -->
<section class="title-section py-4 bg-white">
    <div class="container-fluid px-0">
        <h1 class="fw-bold display-5 text-primary text-center px-5 fs-3">Partnership</h1>
    </div>
</section>


<!-- ===========================
            HERO IMAGE
        =========================== -->
<section class="hero-section">
    <div class="container py-4 px-lg-3 px-md-4 px-3">
        <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
            alt="School Partnership" class="img-fluid w-100 shadow-sm hero-img">
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===========================
            SLIDER (AUTOPLAY FLEX)
        =========================== -->
<div class="container-fluid px-0">
    <h1 class="fw-bold display-5 text-primary text-center px-5 fs-3">
        {{ __('Partnership') }}
        </h2>
</div>

<section class="partnership-slider py-4">
    <div class="slider-container overflow-hidden"> {{-- Pastikan overflow hidden agar rapi --}}
        <div class="slider-track" id="sliderTrack">

            {{-- Loop Pertama --}}
            @foreach ($partners as $p)
            {{-- Cek apakah logo ada dan file fisiknya ada --}}
            @if($p->logo)
            <div class="slider-item group relative inline-block ">
                <img src="{{ asset('storage/' . $p->logo) }}"
                    alt="{{ $p->name }}"
                    title="{{ $p->name }}" {{-- Tooltip bawaan browser --}}
                    class="transition-transform duration-300 hover:scale-110 cursor-pointer">
            </div>
            @endif
            @endforeach

            {{-- Duplikasi untuk Infinite Loop (Pastikan filter yang sama diterapkan) --}}
            @foreach ($partners as $p)
            @if($p->logo)
            <div class="slider-item group relative inline-block ">
                <img src="{{ asset('storage/' . $p->logo) }}"
                    alt="{{ $p->name }}"
                    title="{{ $p->name }}"
                    class="transition-transform duration-300 hover:scale-110 cursor-pointer">

            </div>
            @endif
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

        <!-- Search Section -->
        @livewire('partner-search')

    </div>
</section>
<style>
    /* Hover effect */
    .btnFilter:hover {
        background-color: #d2d2d2ff;
    }

    /* Global Primary Text Color */
    .text-primary {
        color: #001D7A !important;
    }

    /* -------- HERO IMAGE -------- */
    .hero-img {
        max-height: 420px;
        object-fit: cover;
        border-radius: 20px;
    }

    /* -------- SLIDER -------- */
    /* ===== SLIDER WRAPPER ===== */
    .slider-container {
        overflow: hidden;
        width: 100%;
        background: #ffffff;
    }

    /* ===== SLIDER TRACK ===== */
    .slider-track {
        display: flex;
        width: max-content;
        gap: 0px;
        animation: scroll 30s linear infinite;
    }

    /* ===== SLIDER ITEM ===== */
    .slider-item {
        flex: 0 0 auto;
        width: 300px;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }

    .slider-item img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* ===== ANIMATION ===== */
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* Pause on hover */
    .slider-track:hover {
        animation-play-state: paused;
    }


    /* Global Primary Text Color */
    .text-primary {
        color: #001D7A !important;
    }

    /* Pause on hover */
    .slider-track:hover {
        animation-play-state: paused;
    }

    /* -------- WORKSHOP CARDS -------- */
    .workshop-img {
        height: 200px;
        object-fit: cover;
    }


    .workshop-section {
        background-color: #EDFFF3;
    }

    /* Button Filter */
</style>
<script>
    document.getElementById("loadMoreLink").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("moreWorkshops").classList.remove("d-none");
        this.style.display = "none";
    });

    // load more 2
    document.getElementById("loadMore").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("Workshops").classList.remove("d-none");
        this.style.display = "none";
    });
</script>
@endsection