@extends('layouts.app')

@section('content')
    <!-- Title Section -->
    <section class="title-section py-4 bg-white">
        <div class="container-fluid px-0">
            <h1 class="fw-bold display-5 text-primary text-start">Sekolah Partnership</h1>
        </div>
    </section>

<!-- ===========================
      TITLE SECTION
=========================== -->
<section class="title-section py-4 bg-white">
    <div class="container-fluid px-0">
        <h1 class="fw-bold display-5 text-primary text-center">Goverment Partnership</h1>
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
    </section>


<!-- ===========================
      SLIDER (AUTOPLAY FLEX)
=========================== -->
<section class="partnership-slider py-4">
    <div class="slider-container">
        <div class="slider-track">
            <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg">
            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978">
            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978">
        </div>
    </section>


<!-- ===========================
      WORKSHOP SECTION
=========================== -->
<section class="workshop-section py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Workshop dan Pelatihan Sekolah</h2>

        <div class="row g-4">

            <!-- Workshop 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                        class="card-img-top workshop-img">

                    <div class="card-body d-flex flex-column p-4">
                        <p class="date-text">10 Februari 2024</p>
                        <h5 class="card-title-color">Workshop Digital Learning</h5>

                        <p class="text-muted flex-grow-1">
                            Pelatihan intensif untuk guru dalam menggunakan platform pembelajaran digital dan tools modern untuk mengajar.
                        </p>

                        <a href="{{ route('partners.show', 'workshop-digital-learning') }}"
                            class="btn btn-primary mt-3">
                            <i class="bi bi-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>

            <!-- Workshop 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                        class="card-img-top workshop-img">

                    <div class="card-body d-flex flex-column p-4">
                        <p class="date-text">15 Februari 2024</p>
                        <h5 class="card-title-color">Pelatihan Manajemen Kelas</h5>

                        <p class="text-muted flex-grow-1">
                            Workshop untuk meningkatkan kemampuan guru dalam mengelola kelas dan menciptakan lingkungan belajar yang kondusif.
                        </p>

                        <a href="{{ route('partners.show', 'workshop-digital-learning') }}"
                            class="btn btn-primary mt-3">
                            <i class="bi bi-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>

            <!-- Workshop 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                        class="card-img-top workshop-img">

                    <div class="card-body d-flex flex-column p-4">
                        <p class="date-text">20 Februari 2024</p>
                        <h5 class="card-title-color">Seminar Kurikulum Merdeka</h5>

                        <p class="text-muted flex-grow-1">
                            Pelatihan implementasi Kurikulum Merdeka dengan pendekatan pembelajaran yang berpusat pada siswa.
                        </p>

                        <a href="{{ route('partners.show', 'workshop-digital-learning') }}"
                            class="btn btn-primary mt-3">
                            <i class="bi bi-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>


<!-- ===========================
      CUSTOM CSS
=========================== -->
<style>
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
    }

    .slider-track {
        display: flex;
        gap: 10px;
        animation: slide 10s linear infinite;
    }

    .slider-track img {
        width: 33.33%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
    }

    @keyframes slide {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
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
</style>

@endsection
