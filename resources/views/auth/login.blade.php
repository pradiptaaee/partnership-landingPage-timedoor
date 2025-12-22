<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Timedoor Academy</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-sm">
        
        {{-- Login Card --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            
            {{-- Logo Header --}}
            <div class="flex justify-center align-center px-8 py-8  bg-white">
                {{-- Ganti dengan logo Timedoor Academy --}}
                <div class="mb-2 text-center px-auto">
                    <img src="{{ asset('images/logo-TA.svg') }}" alt="Logo Timedoor" width="200">
                </div>
            </div>

            {{-- Form --}}
            <div class="px-8 pb-8">
                
                {{-- Error Alert --}}
                @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <i class="bi bi-exclamation-circle text-red-500"></i>
                        <div class="flex-1">
                            <ul class="text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Success Alert --}}
                @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <i class="bi bi-check-circle text-green-500"></i>
                        <p class="text-sm text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- Email / Username --}}
                    <div class="mb-5">
                        <label for="email" class="block text-xs font-normal text-gray-700 mb-2">
                            Username or Email Address
                        </label>
                        <input type="text" 
                               id="username_or_email" 
                               name="username_or_email" 
                               value="{{ old('email') }}"
                               class="w-full px-1 py-1 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-500 @enderror" 
                               required
                               autofocus>
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="block text-xs font-normal text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="w-full px-1 py-1 pr-11 rounded border border-gray-300 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('password') border-red-500 @enderror" 
                                   required>
                            <button type="button" 
                                    onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <i id="toggleIcon" class="bi bi-eye text-lg"></i>
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="remember" 
                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-xs text-gray-700">Remember Me</span>
                        </label>
                    </div>

                    {{-- Login Button --}}
                    <button type="submit" 
                            class="w-full px-5 py-2 bg-blue-400 hover:bg-blue-600 text-white font-medium rounded transition-colors duration-200">
                        Log In
                    </button>

                    {{-- Lost Password Link --}}
                    <div class="mt-2 text-center">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                           class="text-sm text-gray-600 hover:text-gray-900">
                            Lost your password?
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Footer Link --}}
            <div class="px-8 pb-8 text-center border-t border-gray-100 pt-6">
                <a href="/" class="text-sm text-blue-600 hover:text-blue-700 flex items-center justify-center gap-1">
                    <i class="bi bi-arrow-left"></i>
                    Go to Timedoor Academy
                </a>
            </div>

            {{-- Language Selector (Optional) --}}
            <div class="px-8 pb-6 flex items-center justify-center gap-3">
                <div class="flex items-center text-gray-500">
                    <i class="bi bi-translate mr-2"></i>
                    <span class="text-sm">English (United States)</span>
                </div>
                <button class="text-sm text-blue-600 hover:text-blue-700">
                    Change
                </button>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>