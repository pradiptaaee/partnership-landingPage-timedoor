@extends('layouts.admin')

@section('title', 'Manajemen Kegiatan Partner')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Kegiatan Partner</h1>
                <p class="text-gray-600">Kelola seluruh kegiatan dan aktivitas partner</p>
            </div>
            <div class="flex flex-wrap gap-3">
                {{-- Tombol Kembali ke Partner --}}
                <a href="{{ route('admin.partners.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Partner
                </a>
                {{-- Tombol Tambah Kegiatan --}}
                <a href="{{ route('admin.activity.create') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-indigo-800 shadow-md hover:shadow-lg transition-all duration-200">
                    <i class="bi bi-plus-circle-fill"></i>
                    Tambah Kegiatan
                </a>
            </div>
        </div>

        {{-- Success Alert --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3 animate-slideDown">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-check-circle-fill text-white text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" 
                        class="text-green-600 hover:text-green-800 transition-colors">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        {{-- Livewire Component --}}
        @livewire('admin.activity-table')
    </div>

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideDown {
            animation: slideDown 0.3s ease-out;
        }
    </style>
@endsection