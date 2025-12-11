@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 mb-10">

    {{-- HERO SECTION --}}
    <div class="relative mb-10">
        @if ($activity->featured_image)
            <img 
                src="{{ asset('storage/' . $activity->featured_image) }}" 
                class="w-full h-72 object-cover rounded-xl shadow"
                alt="{{ $activity->title }}">
        @endif

        <div class="absolute bottom-4 left-6 bg-white/85 backdrop-blur-sm px-5 py-3 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-900">{{ $activity->title }}</h1>
            <p class="text-gray-600">
                {{ $activity->short_description }}
            </p>
            <p class="text-sm text-gray-500 mt-1">
                {{ $activity->activity_date->format('d M Y') }}
            </p>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- ARTICLE --}}
        <div class="lg:col-span-2">
            <div class="prose max-w-none">
                {!! $activity->full_description !!}
            </div>

            {{-- GALLERY --}}
            @if ($activity->photos->count() > 0)
                <h2 class="text-2xl font-semibold mt-10 mb-4">Galeri Kegiatan</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($activity->photos as $photo)
                        <a href="{{ asset('storage/' . $photo->image_path) }}" target="_blank">
                            <img 
                                src="{{ asset('storage/' . $photo->image_path) }}" 
                                class="rounded-lg shadow-sm hover:scale-105 transition"
                                alt="Activity Photo">
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- SIDEBAR --}}
        <div class="lg:col-span-1">

            <div class="bg-white p-5 rounded-xl shadow">
                <h3 class="text-xl font-semibold mb-3">Partner Terkait</h3>

                <div class="flex items-center gap-4 mb-4">
                    @if ($activity->partner->logo)
                        <img 
                            src="{{ asset('storage/' . $activity->partner->logo) }}" 
                            class="w-16 h-16 object-contain bg-gray-50 p-2 rounded-xl"
                            alt="">
                    @endif

                    <div>
                        <p class="text-lg font-bold">{{ $activity->partner->name }}</p>
                        <p class="text-sm text-gray-500">{{ $activity->partner->category }}</p>
                    </div>
                </div>

                <a href="{{ route('partner.show', $activity->partner->slug) }}"
                   class="text-blue-600 hover:underline">
                    Lihat profil partner →
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
