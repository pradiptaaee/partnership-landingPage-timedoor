@extends('layouts.app')

@section('content')
    <section class="relative mb-12 h-[500px] overflow-hidden">

        <a href="{{ route('partnership.index') }}"
            class="absolute top-6 left-6 z-20
              flex items-center gap-2
              px-4 py-2
              bg-black/40 backdrop-blur-sm
              text-white text-sm font-medium
              rounded-full
              hover:bg-black/60 transition">

            <i class="bi bi-arrow-left"></i>
            {{ __('activity.back') }}
        </a>

        @if ($activity->featured_image_url)
            <img src="{{ $activity->featured_image_url }}" alt="{{ $activity->title }}" class="w-full h-full object-cover">
        @else
            <div class="flex items-center justify-center h-full bg-gray-100 border-b">
                <div class="text-center">
                    <i class="bi bi-image text-gray-400 text-5xl"></i>
                    <p class="text-gray-500 text-sm mt-2">{{ __('activity.no_image') }}</p>
                </div>
            </div>
        @endif

        <div
            class="absolute inset-0 flex items-end bg-gradient-to-t
                from-black/80 via-black/30 to-transparent">

            <div class="max-w-7xl mx-auto w-full px-4 pb-12">

                <span class="inline-block px-4 py-2 mb-4 text-sm text-white rounded" style="background-color:#10A300;">
                    <i class="bi bi-calendar-event mr-1"></i>
                    {{ $activity->activity_date->translatedFormat('d F Y') }}
                </span>

                <h1 class="text-white font-bold text-4xl md:text-5xl">
                    {{ $activity->title }}
                </h1>

            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 mb-12">
        <div class="shadow-sm mb-12 rounded-[15px]
            bg-gradient-to-br from-gray-100 to-white">
            <div class="p-8">
                <div class="grid md:grid-cols-3 text-center">

                    <div class="md:border-r border-gray-200">
                        <i class="bi bi-calendar-check text-3xl mb-2 text-[#10A300]"></i>
                        <h6 class="font-bold mb-1">{{ __('activity.date') }}</h6>
                        <p class="text-gray-500 text-sm">
                            {{ $activity->activity_date->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div class="md:border-r border-gray-200 mt-6 md:mt-0">
                        <i class="bi bi-envelope text-3xl mb-2 text-[#10A300]"></i>
                        <h6 class="font-bold mb-1">{{ __('activity.email') }}</h6>
                        <p class="text-gray-500 text-sm">
                            {{ $activity->partner->email ?? '-' }}
                        </p>
                    </div>

                    <div class="mt-6 md:mt-0">
                        <i class="bi bi-telephone text-3xl mb-2 text-[#10A300]"></i>
                        <h6 class="font-bold mb-1">{{ __('activity.phone') }}</h6>
                        <p class="text-gray-500 text-sm">
                            {{ $activity->partner->no_telepon ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>
        </div>


        {{-- KATEGORI SEMINAR --}}
        @if (strtolower($activity->category_activity) === 'seminar')
            <div class="shadow-sm mb-12 rounded-[15px] overflow-hidden">
                <div class="grid md:grid-cols-3">

                    <div>
                        @if (!empty($activity->seminarDetail->speaker_photo))
                            <img src="{{ asset('storage/activity/speakers/' . $activity->seminarDetail->speaker_photo) }}"
                                class="w-full h-full object-cover min-h-[300px]">
                        @else
                            <div class="bg-gray-100 flex items-center justify-center min-h-[300px]">
                                <i class="bi bi-person-circle text-gray-400 text-6xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-2 p-12">

                        <div class="flex items-center mb-4">
                            <div
                                class="w-[50px] h-[50px] rounded-full
                            flex items-center justify-center mr-4
                            bg-gradient-to-br from-[#10A300] to-[#0d8500]">
                                <i class="bi bi-person-badge text-white text-xl"></i>
                            </div>

                            <h3 class="font-bold text-xl text-[#001D7A]">
                                {{ __('activity.speaker_profile') }}
                            </h3>
                        </div>

                        <h4 class="font-bold text-lg mb-2">
                            {{ $activity->seminarDetail->speaker_name }}
                        </h4>

                        <p class="text-gray-500 italic text-lg leading-[1.8]">
                            "{{ $activity->seminarDetail->speaker_about ?? __('activity.speaker_not_available') }}"
                        </p>

                    </div>
                </div>
            </div>
        @endif

{{-- KATEGORI WORKSHOP --}}
        @if (strtolower($activity->category_activity) === 'workshop')
            <div class="shadow-sm mb-12 rounded-[15px] border-l-[10px] border-[#10A300]">
                <div class="p-12">

                    <div class="flex items-center mb-4">
                        <div
                            class="w-[50px] h-[50px] rounded-full
                        flex items-center justify-center mr-4
                        bg-gradient-to-br from-[#10A300] to-[#0d8500]">
                            <i class="bi bi-mortarboard text-white text-xl"></i>
                        </div>

                        <h3 class="font-bold text-xl text-[#001D7A]">
                            {{ __('activity.workshop_mentor') }}
                        </h3>
                    </div>

                    <h4 class="font-bold text-lg mb-2">
                        {{ $activity->workshopDetail->mentor_name ?? '-' }}
                    </h4>

                    <p class="text-gray-500 leading-[1.8] text-[17px]">
                        {{ $activity->workshopDetail->description }}
                    </p>

                </div>
            </div>
        @endif



        <div class="shadow-sm mb-12 rounded-[15px]">
            <div class="p-6 lg:p-12">
                <div class="flex flex-col gap-6">

                    <div class=" flex items-center gap-4">
                        <div
                            class="w-[50px] h-[50px] rounded-full
                            flex items-center justify-center
                            bg-gradient-to-br from-[#10A300] to-[#0d8500]">
                            <i class="bi bi-book text-white text-2xl"></i>
                        </div>

                        <h4 class="font-bold text-[#001D7A] text-lg text-center">
                            {{ __('activity.full_description') }}
                        </h4>
                    </div>

                    <div class="md:col-span-11">


                        <div class="text-gray-500 text-base leading-[1.9] text-justify">
                            {!! nl2br(e($activity->full_description)) !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <livewire:activity-gallery :activity="$activity" />


        <div class="text-center mt-12">
            <a href="{{ route('partnership.index') }}"
                class="inline-block px-8 py-4 mb-12 text-white font-bold rounded-full
              bg-gradient-to-br from-[#10A300] to-[#0d8500]">
                <i class="bi bi-arrow-left mr-2"></i>
                {{ __('activity.back_to_list') }}
            </a>
        </div>
    </div>
@endsection
