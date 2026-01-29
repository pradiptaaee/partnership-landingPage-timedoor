 <section>
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
                                     <img src="https://flagcdn.com/w20/jp.png" class="me-2" width="20"
                                         alt="JA">
                                     日本語 (Japanese)</a>
                             </li>
                             <li>
                                 <a class="dropdown-item" href="{{ route('change.language', 'ar') }}">
                                     <img src="https://flagcdn.com/w20/sa.png" class="me-2" width="20"
                                         alt="AR"> العربية (Arabic)
                                 </a>
                             </li>
                             <li>
                                 <a class="dropdown-item" href="{{ route('change.language', 'hi') }}">
                                     <img src="https://flagcdn.com/w20/in.png" class="me-2" width="20"
                                         alt="HI">
                                     हिन्दी (Hindi)</a>
                             </li>
                             <li>
                                 <a class="dropdown-item" href="{{ route('change.language', 'tl') }}">
                                     <img src="https://flagcdn.com/w20/ph.png" class="me-2" width="20"
                                         alt="TL">
                                     Filipino</a>
                             </li>
                             <li>
                                 <a class="dropdown-item" href="{{ route('change.language', 'ms') }}">
                                     <img src="https://flagcdn.com/w20/my.png" class="me-2" width="20"
                                         alt="MS">
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
 </section>
