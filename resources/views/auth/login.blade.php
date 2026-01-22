{{-- resources/views/auth/login.blade.php (Simplified) --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Timedoor Academy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons CSS (WAJIB DITAMBAHKAN) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @livewireStyles
</head>
<style>
    .min-vh-100 {
        min-height: 100vh;
    }

    .card {
        transition: transform 0.3s ease;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, #1bc060 0%, #4ba252 100%);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #30d876 0%, #5bc363 100%);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        padding: 30px;
        border: none;

    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-sm-5">
                        {{-- Ganti dengan Logo Timedoor Academy Anda --}}
                        <div class="text-center">
                            <img src="{{ asset('images/logo-TA.svg') }}" alt="Logo" height="50" class="mb-3">
                        </div>


                        {{-- Panggil Komponen Livewire --}}
                        @livewire('auth.login')
                    </div>
                </div>
            </div>
            {{-- Footer Text --}}
            <div class="text-center mt-3">
                <p class="text-muted small mb-0">
                    © 2024 Timedoor Academy. All rights reserved.
                </p>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        {{-- SWEETALERT2 JAVASCRIPT: URL TELAH DIKOREKSI --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @livewireScripts
        <script>
            window.onload = function() {
                @if (Session::has('login_success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: "{{ Session::get('login_success') }}",
                        position: 'center',
                        showConfirmButton: true, // WAJIB: Tampilkan tombol OK
                        confirmButtonText: 'Lanjutkan',
                        timer: 5000, // Opsional: Beri timer agar otomatis hilang setelah 5 detik
                        timerProgressBar: true,
                    });
                @endif
            };
        </script>
</body>

</html>
