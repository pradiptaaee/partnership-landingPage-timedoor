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
    {{-- <section class="partnership-slider py-4">
    <div class="slider-container">
        <div class="slider-track">
            <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg">
            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978">
            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978">
        </div>
    </div>
</section> --}}
    <section class="partnership-slider py-4">
        <div class="slider-container">
            <div class="slider-track">
                @foreach ($partners as $p)
                    <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->name }}"
                        style="width: 200px; height: 100px; object-fit: contain;" class="">
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
            <div class="container my-5">
                <div class="search-wrapper mx-auto py-3 px-4 shadow-sm" style="border-radius: 15px; background: #ffffff;">

                    <form action="{{ route('partnership.index') }}" method="GET" class="d-flex gap-3">

                        <!-- SEARCH INPUT -->
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0"
                                placeholder="Cari kegiatan spesifik..." style="box-shadow:none;">
                        </div>

                        <!-- FILTER DROPDOWN -->
                        <div class="dropdown">
                            <button class="btn btnFilter px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                style="border-radius: 10px; border:1px solid #10A300; color:#10A300;">
                            </button>

                            <ul class="dropdown-menu p-3 shadow-sm" style="width: 250px;">

                                <!-- Filter Jenis Kegiatan -->
                                <li>
                                    <label class="form-label fw-semibold">Jenis Kegiatan</label>
                                    <select name="category" class="form-select mb-3">
                                        <option value="">Semua</option>
                                        <option value="Workshop">Workshop</option>
                                        <option value="Seminar">Seminar</option>
                                        <option value="Pelatihan">Pelatihan</option>
                                    </select>
                                </li>

                                <li>
                                    <label class="form-label fw-semibold">Tahun Kegiatan</label>
                                    <select name="year" class="form-select mb-3">
                                        <option value="">Semua Tahun</option>
                                        <option value="2025">2025</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </li>

                                <li class="mt-2 text-end">
                                    <button type="submit" class="btn btn-success px-4" style="border-radius: 10px;">
                                        Terapkan
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- BUTTON CARI -->
                        <button type="submit" class="btn text-white px-4"
                            style="background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);
                    border-radius: 10px;">
                            Cari
                        </button>
                    </form>
                </div>
            </div>

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
                                Pelatihan intensif untuk guru dalam menggunakan platform pembelajaran digital dan tools
                                modern untuk mengajar.
                            </p>

                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
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
                                Workshop untuk meningkatkan kemampuan guru dalam mengelola kelas dan menciptakan lingkungan
                                belajar yang kondusif.
                            </p>

                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
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
                                Pelatihan implementasi Kurikulum Merdeka dengan pendekatan pembelajaran yang berpusat pada
                                siswa.
                            </p>

                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" id="loadMoreLink" class="text-primary fw-bold" style="font-size: 18px;">
                    Load More &raquo;
                </a>
            </div>

            <div class="row g-4 d-none" id="moreWorkshops">

                <!-- Extra Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978"
                            class="card-img-top workshop-img">

                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">25 Februari 2024</p>
                            <h5 class="card-title-color">Workshop Inovasi Pembelajaran</h5>
                            <p class="text-muted flex-grow-1">
                                Pelatihan untuk meningkatkan kreativitas guru dalam merancang metode belajar inovatif.
                            </p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Extra Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7"
                            class="card-img-top workshop-img">

                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">28 Februari 2024</p>
                            <h5 class="card-title-color">Pelatihan Leadership Guru</h5>
                            <p class="text-muted flex-grow-1">
                                Membantu guru membangun karakter kepemimpinan dalam lingkungan sekolah.
                            </p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Extra Card 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7"
                            class="card-img-top workshop-img">

                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">3 Maret 2024</p>
                            <h5 class="card-title-color">Pelatihan Manajemen Sekolah</h5>
                            <p class="text-muted flex-grow-1">
                                Pelatihan manajemen administratif dan operasional untuk meningkatkan kualitas sekolah.
                            </p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Extra Card 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978"
                            class="card-img-top workshop-img">
                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">25 Februari 2024</p>
                            <h5 class="card-title-color">Workshop Inovasi Pembelajaran</h5>
                            <p class="text-muted flex-grow-1">Meningkatkan kreativitas guru dalam merancang pembelajaran
                                inovatif.</p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Extra Card 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7"
                            class="card-img-top workshop-img">
                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">28 Februari 2024</p>
                            <h5 class="card-title-color">Pelatihan Leadership Guru</h5>
                            <p class="text-muted flex-grow-1">Pengembangan karakter kepemimpinan guru dalam kegiatan
                                sekolah.</p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Extra Card 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7"
                            class="card-img-top workshop-img">
                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">3 Maret 2024</p>
                            <h5 class="card-title-color">Pelatihan Manajemen Sekolah</h5>
                            <p class="text-muted flex-grow-1">Peningkatan kemampuan manajemen administratif dan operasional
                                sekolah.</p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Extra Card 7 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b"
                            class="card-img-top workshop-img">
                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">6 Maret 2024</p>
                            <h5 class="card-title-color">Workshop Keterampilan Digital</h5>
                            <p class="text-muted flex-grow-1">Pembekalan keterampilan digital untuk menunjang pembelajaran
                                modern.</p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Extra Card 8 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7"
                            class="card-img-top workshop-img">
                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">9 Maret 2024</p>
                            <h5 class="card-title-color">Pelatihan Pengelolaan Kelas Digital</h5>
                            <p class="text-muted flex-grow-1">Strategi efektif mengelola kelas hybrid dan online.</p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Extra Card 9 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998"
                            class="card-img-top workshop-img">
                        <div class="card-body d-flex flex-column p-4">
                            <p class="date-text">11 Maret 2024</p>
                            <h5 class="card-title-color">Seminar Mindset Pengajar Modern</h5>
                            <p class="text-muted flex-grow-1">Membangun pola pikir positif dan adaptif pada guru.</p>
                            <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                class="btn btn-primary mt-3">
                                <i class="bi bi-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="#" id="loadMore" class="text-primary fw-bold" style="font-size: 18px;">
                        Load More &raquo;
                    </a>
                </div>

                <div class="row g-4 d-none" id="Workshops">
                    <!-- Extra Card 7 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1485846234645-a62644f84728"
                                class="card-img-top workshop-img">
                            <div class="card-body d-flex flex-column p-4">
                                <p class="date-text">13 Maret 2024</p>
                                <h5 class="card-title-color">Training Soft Skill Guru</h5>
                                <p class="text-muted flex-grow-1">Peningkatan komunikasi, empati, dan manajemen emosi guru.
                                </p>
                                <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                    class="btn btn-primary mt-3">
                                    <i class="bi bi-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Extra Card 8 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507537297725-24a1c029d3ca"
                                class="card-img-top workshop-img">
                            <div class="card-body d-flex flex-column p-4">
                                <p class="date-text">15 Maret 2024</p>
                                <h5 class="card-title-color">Workshop Creative Teaching</h5>
                                <p class="text-muted flex-grow-1">Teknik mengajar kreatif yang menarik bagi siswa.</p>
                                <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                    class="btn btn-primary mt-3">
                                    <i class="bi bi-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Extra Card 9 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                                class="card-img-top workshop-img">
                            <div class="card-body d-flex flex-column p-4">
                                <p class="date-text">18 Maret 2024</p>
                                <h5 class="card-title-color">Pelatihan Pengembangan Media Ajar</h5>
                                <p class="text-muted flex-grow-1">Membuat media pembelajaran yang menarik dan interaktif.
                                </p>
                                <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                    class="btn btn-primary mt-3">
                                    <i class="bi bi-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Extra Card 10 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765"
                                class="card-img-top workshop-img">
                            <div class="card-body d-flex flex-column p-4">
                                <p class="date-text">20 Maret 2024</p>
                                <h5 class="card-title-color">Workshop Evaluasi Pembelajaran</h5>
                                <p class="text-muted flex-grow-1">Teknik evaluasi pembelajaran yang efektif dan efisien.
                                </p>
                                <a href="{{ route('partnership.show', 'workshop-digital-learning') }}"
                                    class="btn btn-primary mt-3">
                                    <i class="bi bi-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
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
