@extends('layouts.app')

@section('content')
    <!-- Title Section -->
    <section class="title-section py-4 bg-white">
        <div class="container-fluid px-0">
            <h1 class="fw-bold display-5 text-primary text-start">Sekolah Partnership</h1>
        </div>
    </section>

    <!-- Hero Image Section -->
    <section class="hero-section">
        <div class="container-fluid px-4">
            <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                alt="School Partnership" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
        </div>
    </section>

    <!-- Intro Text Section -->
    <section class="intro-section py-5">
        <div class="container-fluid px-0">
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

    <!-- Partnership Cards Section -->
    <section class="partnership-cards py-5 bg-light">
        <div class="px-0">
            <h2 class="text-center fw-bold mb-5">Keep Reading</h2>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border">
                        <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                            class="card-img-top" alt="Program Kerjasama Sekolah A"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-date mb-2" style="color: #10A300; font-size: 14px; font-weight: 500;">15 Januari
                                2024</p>
                            <h5 class="card-title fw-bold text-primary">Program Kerjasama Sekolah A</h5>
                            <p class="card-text text-muted flex-grow-1">
                                Program kerjasama pendidikan untuk meningkatkan kualitas pembelajaran dan pengembangan
                                kurikulum yang inovatif.
                            </p>
                            <a href="{{ route('partners.show', 'program-kerjasama-sekolah-a') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border">
                        <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                            class="card-img-top" alt="Partnership Teknologi Digital"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-date mb-2" style="color: #10A300; font-size: 14px; font-weight: 500;">20 Januari
                                2024</p>
                            <h5 class="card-title fw-bold text-primary">Partnership Teknologi Digital</h5>
                            <p class="card-text text-muted flex-grow-1">
                                Kolaborasi dalam penerapan teknologi digital untuk mendukung proses belajar mengajar yang
                                lebih interaktif.
                            </p>
                            <a href="{{ route('partners.show', 'partnership-teknologi-digital') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border">
                        <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                            class="card-img-top" alt="Kemitraan Pendidikan Inklusif"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-date mb-2" style="color: #10A300; font-size: 14px; font-weight: 500;">25 Januari
                                2024</p>
                            <h5 class="card-title fw-bold text-primary">Kemitraan Pendidikan Inklusif</h5>
                            <p class="card-text text-muted flex-grow-1">
                                Program partnership untuk mengembangkan pendidikan inklusif yang ramah bagi semua siswa
                                dengan kebutuhan berbeda.
                            </p>
                            <a href="{{ route('partners.show', 'kemitraan-pendidikan-inklusif') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workshop Section -->
    <section class="workshop-section py-5 bg-light">
        <div class="container-fluid px-0">
            <h2 class="text-center fw-bold mb-5">Workshop dan Pelatihan Sekolah</h2>
            <div class="row g-4">
                <!-- Workshop Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                            class="card-img-top" alt="Workshop Digital Learning" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-date mb-2" style="color: #10A300; font-size: 14px; font-weight: 500;">10 Februari
                                2024</p>
                            <h5 class="card-title fw-bold text-primary">Workshop Digital Learning</h5>
                            <p class="card-text text-muted flex-grow-1">
                                Pelatihan intensif untuk guru dalam menggunakan platform pembelajaran digital dan tools
                                modern untuk mengajar.
                            </p>
                            <a href="{{ route('partners.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Workshop Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                            class="card-img-top" alt="Pelatihan Manajemen Kelas" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-date mb-2" style="color: #10A300; font-size: 14px; font-weight: 500;">15 Februari
                                2024</p>
                            <h5 class="card-title fw-bold text-primary">Pelatihan Manajemen Kelas</h5>
                            <p class="card-text text-muted flex-grow-1">
                                Workshop untuk meningkatkan kemampuan guru dalam mengelola kelas dan menciptakan lingkungan
                                belajar yang kondusif.
                            </p>
                            <a href="{{ route('partners.show', 'pelatihan-manajemen-kelas') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Workshop Card 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                            class="card-img-top" alt="Seminar Kurikulum Merdeka" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-date mb-2" style="color: #10A300; font-size: 14px; font-weight: 500;">20
                                Februari 2024</p>
                            <h5 class="card-title fw-bold text-primary">Seminar Kurikulum Merdeka</h5>
                            <p class="card-text text-muted flex-grow-1">
                                Pelatihan implementasi Kurikulum Merdeka dengan pendekatan pembelajaran yang berpusat pada
                                siswa.
                            </p>
                            <a href="{{ route('partners.show', 'seminar-kurikulum-merdeka') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom CSS -->
    <style>
        /* FORCE ALL SECTIONS FULL WIDTH EDGE TO EDGE */
        .title-section .container-fluid,
        .hero-section .container-fluid,
        .intro-section .container-fluid,
        .partnership-cards .container-fluid,
        .workshop-section .container-fluid,
        .branch-section .container-fluid,
        .main-footer .container-fluid,
        .bottom-footer .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            max-width: 100% !important;
        }

        /* Remove all row margins */
        .partnership-cards .row,
        .workshop-section .row,
        .branch-section .row,
        .main-footer .row,
        .bottom-footer .row,
        .intro-section .row {
            --bs-gutter-x: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /* Remove all column padding */
        .partnership-cards [class*="col"],
        .workshop-section [class*="col"],
        .branch-section [class*="col"],
        .main-footer [class*="col"],
        .bottom-footer [class*="col"],
        .intro-section [class*="col"] {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Add minimal spacing between cards only */
        .partnership-cards .card,
        .workshop-section .card {
            margin: 0 5px 15px 5px;
        }

        /* Add minimal padding for text sections */
        .intro-section p,
        .branch-section h2,
        .main-footer h5,
        .main-footer h3,
        .bottom-footer p,
        .language-selector {
            padding-left: 15px;
            padding-right: 15px;
        }

        .hero-section {
            position: relative;
            overflow: hidden;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #ffffff !important;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0d8500 0%, #0a6b00 100%);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(16, 163, 0, 0.4);
        }

        .text-primary {
            color: #001D7A !important;
        }


        .footer-logo h3 {
            font-size: 24px;
            line-height: 1.2;
        }

        .main-footer a:hover {
            color: #10A300 !important;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        .language-selector span {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .language-selector span:hover {
            color: #10A300 !important;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #10A300 !important;
        }

        .social-icons,
        .footer-logo {
            padding-left: 15px;
        }
    </style>
    <!-- Indonesia -->
   
        
        




    <!-- Main Footer Section -->
@endsection
