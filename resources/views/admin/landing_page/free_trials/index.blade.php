@extends('layouts.admin')

@section('title', 'Manajemen Trial')

@section('content')
<div class="space-y-6">
    {{-- HEADER & BREADCRUMB --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <h1 class="text-2xl font-semibold text-gray-800">
            Manajemen Trial
        </h1>

        <nav class="text-sm text-gray-500">
            <ol class="flex items-center gap-2">
                <li>
                    <a href="#" class="hover:text-gray-700">Dashboard</a>
                </li>
                <li>/</li>
                <li class="text-gray-700 font-medium">
                    Trial Bookings
                </li>
            </ol>
        </nav>
    </div>

    {{-- LIVEWIRE COMPONENT --}}
    @livewire('admin.free-trial-index')
</div>
@endsection