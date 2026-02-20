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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    @vite([
    'resources/css/app.css', 
    'resources/js/app.js', 
    ])

    @stack('styles')
</head>
@livewireScripts

<body>
    <!-- Navbar -->
   @include('component.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
  @include('component.footer')



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