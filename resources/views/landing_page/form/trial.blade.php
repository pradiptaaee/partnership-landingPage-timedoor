@extends('landing_page.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white rounded-3xl overflow-hidden mb-10 mx-4">
    <div class="grid lg:grid-cols-2 min-h-[calc(100vh-200px)]">

        <!-- Left Section -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-200 p-8 md:p-16 lg:p-20 flex flex-col justify-center">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-[#1e3a5f] mb-3">
                {{ __('Book a Free Trial') }}
            </h1>
            <p class="text-base text-gray-600 mb-12 leading-relaxed">
                {{ __('Trial Desc') }}
            </p>

            <div class="relative w-full max-w-lg mx-auto">
                <img src="images/trial-image.png" alt="trial img">
            </div>
        </div>

        <!-- Right Section - Form -->
        <div class="bg-white p-8 md:p-16 lg:p-20 overflow-y-auto">

            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl flex items-center gap-3">
                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl flex items-center gap-3">
                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                <p class="font-semibold mb-2">{{ __('Please fix the following errors:') }}</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="trialForm" action="" method="POST">
                @csrf

                <!-- Prefix & Name -->
                <div class="grid md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="prefix">
                            {{ __('Prefix') }}
                        </label>
                        <select class="w-full px-5 py-2 text-base border-2 @error('prefix') border-red-500 @else border-gray-200 @enderror rounded-xl bg-gray-50 focus:outline-none focus:border-teal-400 focus:bg-white transition-all duration-300 cursor-pointer appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIiIGhlaWdodD0iOCIgdmlld0JveD0iMCAwIDEyIDgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEgMUw2IDZMMTEgMSIgc3Ryb2tlPSIjNDk1MDU3IiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvc3ZnPg==')] bg-[right_1.25rem_center] bg-no-repeat"
                            id="prefix" name="prefix" required>
                            <option value="Mr." {{ old('prefix') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                            <option value="Mrs." {{ old('prefix') == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                            <option value="Ms." {{ old('prefix') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="name">
                            {{ __('Name') }}
                        </label>
                        <input type="text"
                            class="w-full px-5 py-2 text-base border-2 @error('name') border-red-500 @else border-gray-200 @enderror rounded-xl bg-gray-50 focus:outline-none focus:border-teal-400 focus:bg-white transition-all duration-300"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('Your Name') }}"
                            required>
                    </div>
                </div>

                <!-- Country -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="country">
                        {{ __('Country') }}
                    </label>
                    <select class="w-full px-5 py-2 text-base border-2 @error('country') border-red-500 @else border-gray-200 @enderror rounded-xl bg-gray-50 focus:outline-none focus:border-teal-400 focus:bg-white transition-all duration-300 cursor-pointer appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIiIGhlaWdodD0iOCIgdmlld0JveD0iMCAwIDEyIDgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEgMUw2IDZMMTEgMSIgc3Ryb2tlPSIjNDk1MDU3IiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvc3ZnPg==')] bg-[right_1.25rem_center] bg-no-repeat"
                        id="country" name="country" required>
                        <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="Singapore" {{ old('country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                        <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                        <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                        <option value="Philippines" {{ old('country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                        <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                        <option value="Other" {{ old('country') == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                    </select>
                </div>

                <!-- WhatsApp & Email -->
                <div class="grid md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="whatsapp">
                            {{ __('Whatsapp / Phone Number') }}
                        </label>
                        <input type="tel"
                            class="w-full px-5 py-2 text-base border-2 @error('whatsapp') border-red-500 @else border-gray-200 @enderror rounded-xl bg-gray-50 focus:outline-none focus:border-teal-400 focus:bg-white transition-all duration-300"
                            id="whatsapp"
                            name="whatsapp"
                            value="{{ old('whatsapp') }}"
                            placeholder="62812..."
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">
                            {{ __('Email') }}
                        </label>
                        <input type="email"
                            class="w-full px-5 py-2 text-base border-2 @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl bg-gray-50 focus:outline-none focus:border-teal-400 focus:bg-white transition-all duration-300"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="your@email.com"
                            required>
                    </div>
                </div>

                <!-- Kids List -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="kids">
                        {{ __('Kids List') }}
                    </label>
                    <textarea class="w-full px-5 py-2 text-base border-2 @error('kids') border-red-500 @else border-gray-200 @enderror rounded-xl bg-gray-50 focus:outline-none focus:border-teal-400 focus:bg-white transition-all duration-300 resize-y min-h-[120px]"
                        id="kids"
                        name="kids"
                        placeholder="{{ __('Please list all the kids that want to join free trial following this format') }}&#10;[Name - Age]&#10;eg: Jhon - 12"
                        required>{{ old('kids') }}</textarea>
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="message">
                        {{ __('Message') }}
                    </label>
                    <textarea class="w-full px-5 py-2 text-base border-2 border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-teal-400 focus:bg-white transition-all duration-300 resize-y min-h-[120px]"
                        id="message"
                        name="message"
                        placeholder="{{ __('Tuliskan pesan Anda di sini...') }}">{{ old('message') }}</textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-[#10AF13] text-white shadow-[0_7px_0_#0E8E10] hover:shadow-[0_5px_0_#0E8E10] active:shadow-[0_2px_0_#0E8E10] font-bold py-2.5 rounded-xl uppercase text-base sm:text-sm transition-all duration-150 hover:translate-y-[5px] active:translate-y-[7px]">
                    {{ __('Send Message') }}
                </button>
            </form>
        </div>

    </div>
</div>

@endsection