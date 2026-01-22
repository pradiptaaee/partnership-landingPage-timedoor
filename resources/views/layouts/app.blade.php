<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Timedoor Academy')</title>

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

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
                        </ul>
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ url('/book-trial') }}" class="btn btn-trial" style="background: #22c55e; hover:background: #16a34a;" >
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
        <div class="bottom-footer py-3" style="background-color: #1a1d45; border-top: 1px solid #2a2d4f;">
            <div class="container px-0">
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