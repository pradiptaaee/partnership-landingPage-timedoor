{{-- Ganti semua konten di sini dengan form login Anda --}}



<form wire:submit.prevent="login" method="POST">
    

    {{-- Input Username or Email --}}
    <div class="mb-3">
        <label for="username">Username or Email Address</label>
        <input type="text" wire:model.live="username_or_email" {{-- PENTING: Mengikat ke properti Livewire --}}
            class="form-control @error('username_or_email') is-invalid @enderror"
            placeholder="Username or Email Address" required autofocus>
        @error('username_or_email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Input Password --}}
    <div class="mb-3">
        {{-- Hapus logika JS toggle manual, atau pertahankan JS manual jika ingin toggle password --}}
        <label for="password">Password</label>
        <input type="password" wire:model.live="password" {{-- PENTING: Mengikat ke properti Livewire --}}
            class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Remember Me & Login Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" wire:model="remember" id="remember">
            <label class="form-check-label" for="remember">
                Remember Me
            </label>
        </div>
        {{-- Livewire akan menonaktifkan tombol secara otomatis saat loading --}}
        <button type="submit" class="btn btn-primary px-4">
            <span wire:loading wire:target="login" class="spinner-border spinner-border-sm me-1"></span>
            Login
        </button>
    </div>

    {{-- ... (Lost password dan lain-lain) ... --}}
    <div class="text-center mt-4">
        <p class="text-muted small">Lost your password?</p>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('partners.index') }}" class="text-muted small"><- Go to Timedoor Academy</a>
    </div>
</form>
