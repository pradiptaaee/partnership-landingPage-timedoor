@extends('layouts.admin')

@section('title', 'Manajemen Kegiatan Partner')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 pb-2 border-b border-gray-100">
        

        {{-- Tombol Aksi --}}
        <nav class="text-sm text-gray-500">
            <ol class="flex items-center gap-2">
                <li>
                    <a href="#" class="hover:text-gray-700">Dashboard</a>
                </li>
                <li>/</li>
                <li class="text-gray-700 font-medium">
                    Daftar Kegiatan
                </li>
            </ol>
        </nav>
    </div>
    
        @livewire('admin.activity-table')

    
@endsection
