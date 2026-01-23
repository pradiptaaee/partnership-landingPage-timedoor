<!DOCTYPE html>
<html lang="en">

@livewireStyles

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Timedoor Academy')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            padding-top: 80px;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand img {
            height: 40px;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .navbar-custom .nav-link {
            color: #505050;
            font-weight: 500;
            font-size: 13px;
            padding: 8px 12px !important;
            margin: 0 5px;
            border-radius: 6px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-custom .nav-link:hover {
            color: #22c55e;

        }

        .navbar-custom .nav-link.active {
            color: #22c55e;
            font-weight: 600;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 10px;
            margin-top: 10px;
        }

        .dropdown-item {
            padding: 10px 20px;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .dropdown-item:hover {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            transform: translateX(5px);
        }

        /* Language Selector */
        .lang-selector {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .lang-selector:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .lang-flag {
            width: 24px;
            height: 16px;
            border-radius: 2px;
        }

        /* CTA Button */
        .btn-trial {
            background: #22c55e;
            color: white;
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .btn-trial:hover {
            background: #16a34a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
            color: white;
        }

        /* Partnership Link Highlight */
        .nav-link.partnership {
            color: #22c55e !important;
            font-weight: 600;
        }

        /* Mobile Menu Toggle */
        .navbar-toggler {
            border: none;
            padding: 8px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2833, 33, 33, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Dropdown Arrow */
        .dropdown-toggle::after {
            margin-left: 6px;
            vertical-align: middle;
        }

        .nav-bottom h5 {
            font-size: 14px
        }

        .nav-link-bottom li {
            font-size: 12px;

        }

        /* Branch Section */
        .branch-section {
            background: linear-gradient(135deg, #1e2749 0%, #2a3154 50%, #1e2749 100%);
            padding: 40px 0;
            position: relative;
            overflow: hidden;
        }

        /* Decorative Background Elements */
        .branch-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            z-index: 0;
        }

        .branch-section::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -150px;
            left: -150px;
            z-index: 0;
        }

        .branch-section .container {
            position: relative;
            z-index: 1;
        }

        /* Section Title */
        .section-title {
            color: #22c55e;
            font-size: 30px;
            font-weight: 800;
            /* margin-bottom: 70px; */
            letter-spacing: -0.5px;
        }

        /* Branch Card */
        .branch-card {
            padding: 35px 32px;
            margin-bottom: 30px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;

        }

        /* .branch-card:hover {
            background: rgba(255, 255, 255, 0.06);
            transform: translateY(-8px);
            border-color: rgba(34, 197, 94, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2),
                        0 0 0 1px rgba(34, 197, 94, 0.2);
        } */

        /* Country Header */
        .country-header {
            display: flex;
            align-items: center;
            /* gap: 5px; */
            /* margin-bottom: 28px; */
            padding-bottom: 20px;
            /* border-bottom: 1px solid rgba(255, 255, 255, 0.06); */
        }

        .country-flag {
            width: 18px;
            height: 10px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .country-name {
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            letter-spacing: -0.3px;
        }

        /* Admin Label */
        .admin-label {
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            /* margin-bottom: 18px; */
            letter-spacing: 0.3px;
        }

        /* Contact Item */
        .contact-item {
            display: flex;
            align-items: center;
            /* gap: 14px; */
            /* margin-bottom: 5px; */
            color: #e2e8f0;
            font-size: 12px;
            padding: 3px 0;
            transition: all 0.3s ease;
        }

        /* .contact-item:hover {
            padding-left: 8px;
        } */

        .contact-item i {
            color: #22c55e;
            font-size: 12px;
            width: 24px;
            text-align: center;
            transition: all 0.3s ease;
        }

        /* .contact-item:hover i {
            transform: scale(1.2);
            color: #2dd36f;
        } */

        .contact-item a {
            color: #e2e8f0;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 400;
        }

        /* .contact-item a:hover {
            color: #22c55e;
            letter-spacing: 0.3px;
        } */

        .contact-item span {
            font-weight: 400;
        }

        /* Offline Branch Section */
        .offline-branch {
            /* margin-top: 28px; */
            padding-top: 15px;
            /* border-top: 1px solid rgba(255, 255, 255, 0.08); */
        }

        .offline-toggle {
            display: flex;
            align-items: center;
            /* justify-content: space-between; */
            gap: 5px;
            cursor: pointer;
            color: #94a3b8;
            font-size: 14px;
            font-weight: 500;
            padding: 0px 8px;
            border-radius: 10px;
            transition: all 0.3s ease;
            user-select: none;
        }

        .offline-toggle:hover {
            color: #ffffff;

            padding-left: 12px;
        }

        .offline-toggle i {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 10px;
        }

        .offline-toggle.active {
            color: #22c55e;
        }

        .offline-toggle.active i {
            transform: rotate(180deg);
            color: #22c55e;
        }

        /* Offline Content */
        .offline-content {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding-top: 0;
        }

        .offline-content.show {
            max-height: 200px;
            opacity: 1;
            padding-top: 16px;
        }

        .offline-content .contact-item {
            animation: slideIn 0.4s ease forwards;
        }

        .footer-info {
            padding: 50px 0;
            background-color: #1a1d3f;
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                padding: 20px 0;
            }

            .btn-trial {
                width: 100%;
                margin-top: 15px;
            }

            .navbar-custom .nav-link {
                margin: 5px 0;
            }
        }
    </style>

    @stack('styles')
</head>
@livewireScripts

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container d-flex justify-content-between px-5">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-TA.svg') }}" alt="Timedoor Academy">
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="d-flex" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- About Us -->
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle {{ request()->is('about*') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown">
                            About Us
                        </a>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="{{ url('/about') }}">Our Story</a></li>
                            <li><a class="dropdown-item" href="{{ url('/about/team') }}">Our Team</a></li>
                            <li><a class="dropdown-item" href="{{ url('/about/testimonials') }}">Testimonials</a></li>
                        </ul>
                    </li>

                    <!-- Our Courses -->
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle {{ request()->is('courses*') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown">
                            Our Courses
                        </a>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="{{ url('/courses/programming') }}">Programming</a></li>
                            <li><a class="dropdown-item" href="{{ url('/courses/design') }}">Design</a></li>
                            <li><a class="dropdown-item" href="{{ url('/courses/digital-marketing') }}">Digital
                                    Marketing</a></li>
                            <li><a class="dropdown-item" href="{{ url('/courses/data-science') }}">Data Science</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Blog -->
                    <li class="nav-item">
                        <a class="nav-link  {{ request()->is('blog*') ? 'active' : '' }}" href="{{ url('/blog') }}">
                            Blog
                        </a>
                    </li>

                    <!-- Partnership (Highlighted) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle partnership {{ request()->is('partnership*') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown">
                            Partnership
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/partnership') }}">Our Partners</a></li>
                            <li><a class="dropdown-item" href="{{ url('/partnership/activities') }}">Activities</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/partnership/apply') }}">Become a Partner</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Contact -->
                    <li class="nav-item">
                        <a class="nav-link  {{ request()->is('contact*') ? 'active' : '' }}"
                            href="{{ url('/contact') }}">
                            Contact
                        </a>
                    </li>
                </ul>

                <!-- Right Side: Language & CTA -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Language Selector -->
                    <div class="dropdown">
                        <a class="nav-link  lang-selector dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <img src="https://flagcdn.com/w40/gb.png" alt="EN" class="lang-flag">
                            <span>EN</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <img src="https://flagcdn.com/w40/gb.png" alt="EN" class="lang-flag me-2">
                                    English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <img src="https://flagcdn.com/w40/id.png" alt="ID" class="lang-flag me-2">
                                    Indonesia
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('change.language', 'ja') }}">
                                    <img src="https://flagcdn.com/w20/jp.png" class="me-2" width="20" alt="JA">
                                    日本語 (Japanese)</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('change.language', 'ar') }}">
                                    <img src="https://flagcdn.com/w20/sa.png" class="me-2" width="20" alt="AR"> العربية (Arabic)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('change.language', 'hi') }}">
                                    <img src="https://flagcdn.com/w20/in.png" class="me-2" width="20" alt="HI">
                                    हिन्दी (Hindi)</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('change.language', 'tl') }}">
                                    <img src="https://flagcdn.com/w20/ph.png" class="me-2" width="20" alt="TL">
                                    Filipino</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('change.language', 'ms') }}">
                                    <img src="https://flagcdn.com/w20/my.png" class="me-2" width="20" alt="MS">
                                    Bahasa Melayu</a>
                            </li>
                        </ul>
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ url('/book-trial') }}" class="btn btn-trial">
                        Book Free Trial
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="main-footer " style="">
        <!--footer-branchs-->
        <section class="branch-section">
            <div class="container">
                <h2 class="section-title">Our Branch</h2>

                <div class="row">
                    <!-- Indonesia -->
                    <div class="col-lg-3 col-md-4">
                        <div class="branch-card">
                            <div class="country-header">
                                <img src="https://flagcdn.com/w40/id.png" alt="Indonesia" class="country-flag">
                                <h3 class="country-name">Indonesia</h3>
                            </div>

                            <p class="admin-label">Online Admin</p>

                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/628814677923">+628814677923</a>
                            </div>

                            <div class="contact-item">
                                <i class="far fa-envelope"></i>
                                <a href="mailto:id@timedooracademy.com">id@timedooracademy.com</a>
                            </div>

                            <div class="offline-branch">
                                <div class="offline-toggle" onclick="toggleOffline(this)">
                                    <span>Offline Branch</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="offline-content">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Jakarta, Surabaya, Bali</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Malaysia -->
                    <div class="col-lg-3 col-md-6">
                        <div class="branch-card">
                            <div class="country-header">
                                <img src="https://flagcdn.com/w40/my.png" alt="Malaysia" class="country-flag">
                                <h3 class="country-name">Malaysia</h3>
                            </div>

                            <p class="admin-label">Online Admin</p>

                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/60112188022">+60112188022</a>
                            </div>

                            <div class="contact-item">
                                <i class="far fa-envelope"></i>
                                <a href="mailto:my@timedooracademy.com">my@timedooracademy.com</a>
                            </div>

                            <div class="offline-branch">
                                <div class="offline-toggle" onclick="toggleOffline(this)">
                                    <span>Offline Branch</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="offline-content">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Kuala Lumpur</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Philippines -->
                    <div class="col-lg-3 col-md-6">
                        <div class="branch-card">
                            <div class="country-header">
                                <img src="https://flagcdn.com/w40/ph.png" alt="Philippines" class="country-flag">
                                <h3 class="country-name">Philippines</h3>
                            </div>

                            <p class="admin-label">Online Admin</p>

                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <span>timedooracademy.philippines</span>
                            </div>

                            <div class="contact-item">
                                <i class="far fa-envelope"></i>
                                <a href="mailto:ph@timedooracademy.com">ph@timedooracademy.com</a>
                            </div>

                            <div class="offline-branch">
                                <div class="offline-toggle" onclick="toggleOffline(this)">
                                    <span>Offline Branch</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="offline-content">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Manila</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Egypt -->
                    <div class="col-lg-3 col-md-6">
                        <div class="branch-card">
                            <div class="country-header">
                                <img src="https://flagcdn.com/w40/eg.png" alt="Egypt" class="country-flag">
                                <h3 class="country-name">Egypt</h3>
                            </div>

                            <p class="admin-label">Online Admin</p>

                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/201022439691">+201022439691</a>
                            </div>

                            <div class="contact-item">
                                <i class="far fa-envelope"></i>
                                <a href="mailto:eg@timedooracademy.com">eg@timedooracademy.com</a>
                            </div>

                            <div class="offline-branch">
                                <div class="offline-toggle" onclick="toggleOffline(this)">
                                    <span>Offline Branch</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="offline-content">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Cairo</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Japan -->
                    <div class="col-lg-3 col-md-6">
                        <div class="branch-card">
                            <div class="country-header">
                                <img src="https://flagcdn.com/w40/jp.png" alt="Japan" class="country-flag">
                                <h3 class="country-name">Japan</h3>
                            </div>

                            <p class="admin-label">Online Admin</p>

                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/628214420385">+628214420385</a>
                            </div>

                            <div class="contact-item">
                                <i class="far fa-envelope"></i>
                                <a href="mailto:info@timedooracademy.com">info@timedooracademy.com</a>
                            </div>

                            <div class="offline-branch">
                                <div class="offline-toggle" onclick="toggleOffline(this)">
                                    <span>Offline Branch</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="offline-content">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Tokyo</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Syria -->
                    <div class="col-lg-3 col-md-6">
                        <div class="branch-card">
                            <div class="country-header">
                                <img src="https://flagcdn.com/w40/sy.png" alt="Syria" class="country-flag">
                                <h3 class="country-name">Syria</h3>
                            </div>

                            <p class="admin-label">Online Admin</p>

                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/963934354199">+963934354199</a>
                            </div>

                            <div class="contact-item">
                                <i class="far fa-envelope"></i>
                                <a href="mailto:sy@timedooracademy.com">sy@timedooracademy.com</a>
                            </div>

                            <div class="offline-branch">
                                <div class="offline-toggle" onclick="toggleOffline(this)">
                                    <span>Offline Branch</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="offline-content">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Damascus</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bangladesh -->
                    <div class="col-lg-3 col-md-6">
                        <div class="branch-card">
                            <div class="country-header">
                                <img src="https://flagcdn.com/w40/bd.png" alt="Bangladesh" class="country-flag">
                                <h3 class="country-name">Bangladesh</h3>
                            </div>

                            <p class="admin-label">Online Admin</p>

                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/8801779800142">+8801779800142</a>
                            </div>

                            <div class="contact-item">
                                <i class="far fa-envelope"></i>
                                <a href="mailto:bg@timedooracademy.com">bg@timedooracademy.com</a>
                            </div>

                            <div class="offline-branch">
                                <div class="offline-toggle" onclick="toggleOffline(this)">
                                    <span>Offline Branch</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="offline-content">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Dhaka</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- United States -->
                    <div class="col-lg-3 col-md-6">
                        <div class="branch-card">
                            <div class="country-header">
                                <img src="https://flagcdn.com/w40/us.png" alt="United States" class="country-flag">
                                <h3 class="country-name">United States</h3>
                            </div>

                            <p class="admin-label">Online Admin</p>

                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/818080667680">+818080667680</a>
                            </div>

                            <div class="contact-item">
                                <i class="far fa-envelope"></i>
                                <a href="mailto:info@timedooracademy.com">info@timedooracademy.com</a>
                            </div>

                            <div class="offline-branch">
                                <div class="offline-toggle" onclick="toggleOffline(this)">
                                    <span>Offline Branch</span>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                                <div class="offline-content">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>New York, California</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--footer-info -->
        <section class="footer-info">
            <div class="container px-0">
                <div class="row">
                    <!-- Logo & Social Media -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="footer-logo mb-4">
                            <img src="https://spcdn.shortpixel.ai/spio/ret_img,q_cdnize/timedooracademy.com/wp-content/uploads/2022/09/timedoor-academy-2022-white-only.svg"
                                alt="Timedoor Indonesia" width="200">
                        </div>
                        <div class="social-icons">
                            <a href="#" class="btn btn-success rounded-circle me-2"
                                style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="#" class="btn btn-primary rounded-circle"
                                style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-3 col-md-6 mb-4 nav-bottom">
                        <h5 class="text-success fw-bold mb-3">Quick Links</h5>
                        <ul class="list-unstyled nav-link-bottom">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">About Us</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Career</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Our Course -->
                    <div class="col-lg-3 col-md-6 mb-4 nav-bottom">
                        <h5 class="text-success fw-bold mb-3">Our Course</h5>
                        <ul class="list-unstyled nav-link-bottom">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Junior
                                    Coder</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Code
                                    Adventure</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Python
                                    Developer</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">IoT
                                    Developer</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Software
                                    Developer</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">AI
                                    Engineer</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Professional
                                    Coder (Online)</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Math,
                                    English,
                                    Science</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Students
                                    Portfolio</a></li>
                        </ul>
                    </div>

                    <!-- Partnership -->
                    <div class="col-lg-3 col-md-6 mb-4 nav-bottom">
                        <h5 class="text-success fw-bold mb-3">Partnership</h5>
                        <ul class="list-unstyled nav-link-bottom">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Franchise &
                                    Investment</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">School
                                    Partnership</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Privat
                                    Individu</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom Footer -->
        <div class="bottom-footer py-3" style="background-color: #0f1128; border-top: 1px solid #2a2d4f;">
            <div class="container-fluid px-0">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="language-selector">
                            <span class="text-white me-3">Indonesia</span>
                            <span class="text-white me-3">English</span>
                            <span class="text-white me-3">العربية</span>
                            <span class="text-white">日本</span>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="text-white mb-0">Copyright © CBHKIDS DIGITAL INDONESIA © 2015. All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.12)';
            } else {
                navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.08)';
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar-collapse');
            const toggler = document.querySelector('.navbar-toggler');

            if (!navbar.contains(event.target) && !toggler.contains(event.target)) {
                const bsCollapse = bootstrap.Collapse.getInstance(navbar);
                if (bsCollapse && navbar.classList.contains('show')) {
                    bsCollapse.hide();
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>