{{-- Form --}}
<form wire:submit.prevent="login" method="POST">
    {{-- Input Username or Email --}}
    <div class="mb-3">
        <label for="username" class="form-label fw-semibold">Username or Email</label>
        <input type="text" wire:model.live="username_or_email"
            class="form-control form-control-lg @error('username_or_email') is-invalid @enderror"
            placeholder="Enter your username or email" required autofocus>
        @error('username_or_email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Input Password --}}
    <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" wire:model.live="password"
            class="form-control form-control-lg @error('password') is-invalid @enderror"
            placeholder="Enter your password" required>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Remember Me & Forgot Password --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" wire:model="remember" id="remember">
            <label class="form-check-label text-muted" for="remember">
                Remember Me
            </label>
        </div>
        <a href="#" class="text-primary text-decoration-none small">
            Forgot Password?
        </a>
    </div>

    {{-- Login Button --}}
    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-lg">
            <span wire:loading wire:target="login" class="spinner-border spinner-border-sm me-2"></span>
            <span wire:loading.remove wire:target="login">Login</span>
            <span wire:loading wire:target="login">Logging in...</span>
        </button>
    </div>

    {{-- Divider --}}
    <div class="text-center">
        <hr class="my-4">
    </div>

    {{-- Back Link --}}
    <div class="text-center">
        <a href="{{ route('partners.index') }}"
            class="text-muted text-decoration-none d-inline-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
            Go to Timedoor Academy
        </a>
    </div>
</form>
