@extends('layouts.admin')

@section('title', 'Manajemen Partner')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between gap-3">

        <nav class="text-sm text-gray-500">
            <ol class="flex items-center gap-2">
                <li>
                    <a href="#" class="hover:text-gray-700">Dashboard</a>
                </li>
                <li>/</li>
                <li class="text-gray-700 font-medium">
                    Partners
                </li>
            </ol>
        </nav>
    </div>

    {{-- Partner Table (Livewire) --}}
    @livewire('admin.partner-table')

   

</div>
@endsection
