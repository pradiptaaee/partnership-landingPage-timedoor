<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Partnership</title>

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    {{-- SweetAlert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- Bootstrap Icons (boleh tetap dipakai) --}}
    {{-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}

    {{-- Tailwind via Vite --}}
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

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
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('success-alert', (data) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
            });
        });

        window.onload = function() {

            @if(Session::has('login_success'))
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: "{{ Session::get('login_success') }}",
                showConfirmButton: true,
                confirmButtonText: 'Lanjutkan',
            });
            @endif

            @if(Session::has('success_message'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ Session::get('success_message') }}",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
            @endif
        }
    </script>

</body>

</html>