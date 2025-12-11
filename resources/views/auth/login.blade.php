{{-- resources/views/auth/login.blade.php (Simplified) --}}

<!DOCTYPE html>
<html lang="en">

<head>
    @livewireStyles
</head>
<style>
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
    <div class="login-container">
        <div class="login-card bg-white">
            <div class="text-center mb-4">
                {{-- Ganti dengan Logo Timedoor Academy Anda --}}
                <img src="{{ asset('images/logo-TA.svg') }}" alt="Logo" height="50" class="mb-3">

            </div>
            {{-- Panggil Komponen Livewire --}}
            @livewire('auth.login')

        </div>
    </div>

    @livewireScripts
</body>

</html>
