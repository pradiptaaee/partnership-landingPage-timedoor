@extends('layouts.app')

@section('content')

<!-- Hero Section with Overlay -->
<section class="hero-detail position-relative mb-5" style="height: 500px; overflow: hidden;">
    <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
        alt="Workshop"
        class="w-100 h-100"
        style="object-fit: cover; position: absolute;">
    <div class="overlay position-absolute w-100 h-100 d-flex align-items-end"
        style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 60%, transparent 100%);">
        <div class="container pb-5">
            <span class="badge px-3 py-2 mb-3" style="background-color: #10A300; font-size: 14px;">
                <i class="bi bi-calendar-event me-1"></i> 15 Januari 2024
            </span>
            <h1 class="text-white fw-bold display-4 mb-0">Workshop Digital Learning</h1>
        </div>
    </div>
</section>

<div class="container mb-5">

    <!-- Quick Info Bar -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
        <div class="card-body p-4">
            <div class="row text-center">
                <div class="col-md-4 border-end">
                    <i class="bi bi-calendar-check fs-3 mb-2" style="color: #10A300;"></i>
                    <h6 class="fw-bold mb-1">Tanggal</h6>
                    <p class="text-muted mb-0 small">15 Januari 2024</p>
                </div>
                <div class="col-md-4 border-end">
                    <i class="bi bi-envelope fs-3 mb-2" style="color: #10A300;"></i>
                    <h6 class="fw-bold mb-1">Email</h6>
                    <p class="text-muted mb-0 small">info@timedooracademy.com</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-telephone fs-3 mb-2" style="color: #10A300;"></i>
                    <h6 class="fw-bold mb-1">Telepon</h6>
                    <p class="text-muted mb-0 small">+62 888 947 793</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="row g-4 mb-5">

        <!-- Visual Highlight -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; overflow: hidden;">
                <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                    class="w-100"
                    style="height: 100%; object-fit: cover; min-height: 300px;">
            </div>
        </div>

        <!-- Profile Pembicara (Short Version) -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                <div class="card-body p-4 d-flex flex-column">

                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 50px; height: 50px; background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);">
                            <i class="bi bi-person-badge text-white fs-4"></i>
                        </div>

                        <h3 class="fw-bold mb-0" style="color: #001D7A;">Profil Pembicara</h3>
                    </div>

                    <p class="text-muted flex-grow-1 mb-2" style="font-size: 16px; line-height: 1.8;">
                        <strong>Dr. Jonathan Pratama</strong><br>
                        Kepala Divisi Kurikulum & Pelatihan – EduTech Indonesia
                    </p>

                    <p class="text-muted flex-grow-1 mb-4" style="font-size: 16px; line-height: 1.8;">
                        Berpengalaman lebih dari 12 tahun dalam transformasi pembelajaran digital,
                        memberikan pelatihan kepada guru, dan menjadi pembicara di berbagai konferensi nasional.
                    </p>

                    <a href="{{ route('partners.index') }}" class="btn text-white align-self-start"
                        style="background: linear-gradient(135deg, #10A300 0%, #0d8500 100%); border: none; border-radius: 25px; padding: 12px 30px;">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>

                </div>
            </div>
        </div>

    </div>

    <!-- Full Description Section -->
    <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px;">
        <div class="card-body p-5">
            <div class="row">
                <div class="col-md-2 text-center mb-4 mb-md-0">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);">
                        <i class="bi bi-book text-white fs-2"></i>
                    </div>
                </div>
                <div class="col-md-10">
                    <h4 class="fw-bold mb-4" style="color: #001D7A;">Deskripsi Lengkap</h4>
                    <div class="text-muted" style="font-size: 16px; line-height: 1.9;">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <p class="mb-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="mb-5">
        <h3 class="fw-bold mb-4 text-center" style="color: #001D7A;">
            <i class="bi bi-images me-2" style="color: #10A300;"></i>
            Galeri Kegiatan
        </h3>
        <div class="row g-3">
            <!-- Large Image -->
            <div class="col-md-8">
                <div class="position-relative overflow-hidden rounded shadow-sm" style="height: 400px;">
                    <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                        class="w-100 h-100 gallery-img"
                        style="object-fit: cover;">
                    <div class="overlay-hover position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center"
                        style="background: rgba(16, 163, 0, 0); transition: all 0.3s ease;">
                        <i class="bi bi-zoom-in text-white fs-1" style="opacity: 0; transition: opacity 0.3s ease;"></i>
                    </div>
                </div>
            </div>

            <!-- Side Images -->
            <div class="col-md-4">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="position-relative overflow-hidden rounded shadow-sm" style="height: 193px;">
                            <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                                class="w-100 h-100 gallery-img"
                                style="object-fit: cover;">
                            <div class="overlay-hover position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center"
                                style="background: rgba(16, 163, 0, 0); transition: all 0.3s ease;">
                                <i class="bi bi-zoom-in text-white fs-1" style="opacity: 0; transition: opacity 0.3s ease;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="position-relative overflow-hidden rounded shadow-sm" style="height: 193px;">
                            <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                                class="w-100 h-100 gallery-img"
                                style="object-fit: cover;">
                            <div class="overlay-hover position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center"
                                style="background: rgba(16, 163, 0, 0); transition: all 0.3s ease;">
                                <i class="bi bi-zoom-in text-white fs-1" style="opacity: 0; transition: opacity 0.3s ease;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="col-md-4">
                <div class="position-relative overflow-hidden rounded shadow-sm" style="height: 250px;">
                    <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                        class="w-100 h-100 gallery-img"
                        style="object-fit: cover;">
                    <div class="overlay-hover position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center"
                        style="background: rgba(16, 163, 0, 0); transition: all 0.3s ease;">
                        <i class="bi bi-zoom-in text-white fs-1" style="opacity: 0; transition: opacity 0.3s ease;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative overflow-hidden rounded shadow-sm" style="height: 250px;">
                    <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                        class="w-100 h-100 gallery-img"
                        style="object-fit: cover;">
                    <div class="overlay-hover position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center"
                        style="background: rgba(16, 163, 0, 0); transition: all 0.3s ease;">
                        <i class="bi bi-zoom-in text-white fs-1" style="opacity: 0; transition: opacity 0.3s ease;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative overflow-hidden rounded shadow-sm" style="height: 250px;">
                    <img src="https://wallpapers.com/images/hd/teacher-class-recitation-students-raising-hands-hnlnd76tuq5wxeaz.jpg"
                        class="w-100 h-100 gallery-img"
                        style="object-fit: cover;">
                    <div class="overlay-hover position-absolute w-100 h-100 top-0 start-0 d-flex align-items-center justify-content-center"
                        style="background: rgba(16, 163, 0, 0); transition: all 0.3s ease;">
                        <i class="bi bi-zoom-in text-white fs-1" style="opacity: 0; transition: opacity 0.3s ease;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Share Section -->
    <div class="text-center">
        <h5 class="fw-bold mb-3" style="color: #001D7A;">Bagikan Workshop Ini</h5>
        <div class="d-flex gap-3 justify-content-center">
            <a href="#" class="btn rounded-circle"
                style="background-color:#E1306C; width: 55px; height: 55px; display:flex; align-items:center; justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
            </a>
            <a href="#" class="btn rounded-circle"
                style="background-color:#000; width:55px; height:55px; display:flex; align-items:center; justify-content:center;">

                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                    viewBox="0 0 1200 1227" fill="#ffffff">
                    <path d="M714.163 519.284L1160.89 0H1050.45L667.137 442.632L356.724 0H0L468.288 681.329L0 1226.98H110.451L513.219 751.911L843.275 1226.98H1200L714.163 519.284ZM563.556 687.92L517.62 620.38L156.432 94.5713H301.306L600.036 521.657L645.972 589.196L1023.67 1132.41H878.792L563.556 687.92Z" />
                </svg>

            </a>
            <a href="#" class="btn rounded-circle"
                style="background-color:#25D366; width:55px; height:55px; display:flex; align-items:center; justify-content:center;">

                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 32 32" fill="#ffffff">
                    <path d="M16.001 3.2c-7.03 0-12.8 5.771-12.8 12.8 0 2.257.589 4.461 1.707 6.4L3.2 28.8l6.593-1.729c1.843.992 3.921 1.529 6.208 1.529 7.029 0 12.8-5.771 12.8-12.8s-5.771-12.8-12.8-12.8zm0 23.04c-1.92 0-3.84-.512-5.504-1.536l-.395-.237-3.904 1.024 1.045-3.776-.257-.416c-1.024-1.664-1.536-3.584-1.536-5.504 0-5.688 4.864-10.24 10.24-10.24 2.72 0 5.376 1.088 7.296 3.008 1.92 1.92 3.008 4.576 3.008 7.296.032 5.688-4.832 10.24-10.256 10.24zm5.76-7.552c-.32-.16-1.92-.96-2.24-1.088-.32-.128-.544-.192-.768.192-.224.384-.896 1.088-1.088 1.28-.192.192-.352.224-.672.064s-1.28-.48-2.433-1.536c-.896-.8-1.504-1.792-1.696-2.08-.192-.32-.016-.512.144-.672.16-.16.384-.416.544-.64.192-.224.256-.384.384-.64.128-.256.064-.48-.032-.672-.096-.192-.8-1.92-1.088-2.624-.288-.64-.576-.544-.8-.544h-.672c-.224 0-.608.096-.928.448-.32.352-1.216 1.184-1.216 2.88s1.28 3.328 1.472 3.584c.192.256 2.528 3.904 6.144 5.44.864.384 1.536.608 2.08.8.896.288 1.728.256 2.368.16.672-.096 2.08-.832 2.368-1.632.288-.8.288-1.472.192-1.632-.096-.16-.352-.256-.736-.416z" />
                </svg>

            </a>

            <a href="#" class="btn rounded-circle"
                style="background-color:#D44638; width:55px; height:55px; display:flex; align-items:center; justify-content:center;">

                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                    viewBox="0 0 24 24">
                    <path fill="#FFF" d="M20 4H4C2.9 4 2 4.9 2 6v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2Zm-.4 3.25-7.2 4.5-7.2-4.5V6.5l7.2 4.5 7.2-4.5v.75Z" />
                </svg>

            </a>


        </div>
    </div>

</div>
<section class="workshop-section py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Keep Reading</h2>

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
    </div>
</section>

<!-- Custom CSS -->
<style>
    /* Hero zoom effect only */
    .hero-detail img {
        transition: transform 0.5s ease;
    }

    .hero-detail:hover img {
        transform: scale(1.05);
    }

    /* Remove zoom from gallery */
    .gallery-img {
        transition: opacity 0.3s ease;
    }

    /* Subtle hover for gallery */
    .position-relative:hover .overlay-hover {
        background: rgba(16, 163, 0, 0.7) !important;
    }

    .position-relative:hover .overlay-hover i {
        opacity: 1 !important;
    }

    /* Remove card zoom, just shadow */
    .card {
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
    }

    /* Button zoom only */
    .btn:hover {
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

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

    @media (max-width: 768px) {
        .hero-detail {
            height: 350px !important;
        }

        .border-end {
            border-right: none !important;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
    }
</style>

@endsection