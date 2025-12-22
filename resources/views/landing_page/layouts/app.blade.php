<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timedoor Academy</title>

    <!-- Memuat Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <!-- <link href="src/output.css" rel="stylesheet"> -->
    @vite('resources/css/app.css')

    <!-- Swiper -->
    @vite('resources/js/landing_page/swiper-init.js')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-white text-gray-800">

    @yield('content')

</body>
</html>