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
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
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
    </h1>
</div>

<section class="partnership-slider py-4">
    <div class="slider-container">
        <div class="slider-track" id="sliderTrack">
            @foreach ($partners as $p)
            <div class="slider-item">
                <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}">
            </div>
            @endforeach

            <!-- Duplikasi untuk infinite loop -->
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

        <!-- Search Section -->
        @livewire('partner-search')

        <div class="mt-5 d-flex justify-content-center">
            {{ $activities->links() }}
        </div>

    </div>
    </div>
    </div>

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
        .slider-container {
            overflow: hidden;
            width: 100%;
            position: relative;
        }

        .slider-track {
            display: flex;
            gap: 20px;
            animation: slide 50s linear infinite;
            width: fit-content;
        }

        .slider-item {
            flex-shrink: 0;
            width: 200px;
            height: 100px;
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

        /* Pause on hover */
        .slider-track:hover {
            animation-play-state: paused;
        }

        /* -------- WORKSHOP CARDS -------- */
        .workshop-img {
            height: 200px;
            object-fit: cover;
        }

        .date-text {
            color: #10A300;
            font-size: 14px;
            font-weight: 600;
        }

        .card-title-color {
            font-weight: 700;
            font-size: 18px;
            color: #0C3D8F;
        }

        /* Button */
        .btn-primary {
            background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0d8500 0%, #0a6b00 100%);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(16, 163, 0, 0.4);
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