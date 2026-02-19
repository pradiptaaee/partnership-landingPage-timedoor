<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Landing Pag & Partnership</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon-180x180.png') }}">

    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon-192x192.png') }}">

    <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}">

    {{-- SweetAlert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- CDN Font Awesome (Agar icon muncul) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Tailwind via Vite --}}
    @vite(['resources/css/admin.css'])

    {{-- js --}}
    @vite('resources/js/admin/partnership/app.js')
    @vite('resources/js/admin/partnership/partner.js')
    @vite('resources/js/admin/partnership/activity.js')

    @livewireStyles
</head>


<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Main Content --}}
        <main class="flex-1 ml-65 bg-gray-100">
            <div class="p-6">
                @yield('content')
            </div>
        </main>

    </div>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    @livewireScripts

    {{-- Livewire & Session Alert --}}
    <script>
        window.flashMessages = {
            loginSuccess: "{{ session('login_success') }}",
            successMessage: "{{ session('success_message') }}"
        };

        
    </script>
    @stack('scripts') {{-- Pastikan ini ada --}}
</body>

</html>
