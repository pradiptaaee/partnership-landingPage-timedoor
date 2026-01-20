@extends('layouts.admin')

@section('title', 'Manajemen Kegiatan Partner')

@section('content')
    {{-- CONTAINER UTAMA: Background Putih --}}
    <div class="flex-1 bg-white min-h-screen font-sans flex flex-col">
        
        {{-- 1. HEADER SECTION (Opsional: Jika di Livewire sudah ada header, bagian ini bisa dihapus) --}}
        <div class="max-w-7xl mx-auto px-8 pt-8 w-full">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 pb-6 border-b border-gray-100">
                
                {{-- Judul & Subjudul --}}
                <div>
                    <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Manajemen Kegiatan</h1>
                    <p class="text-gray-500 text-sm">Kelola seluruh aktivitas dan event partner.</p>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-wrap gap-3">
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('admin.partners.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-50 hover:text-[#0f5132] transition-colors duration-200 shadow-sm">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali ke Partner</span>
                    </a>

                    {{-- Tombol Tambah --}}
                    
                </div>
            </div>

            {{-- 2. SUCCESS ALERT (Emerald Style) --}}
            @if (session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 flex items-start gap-3 animate-fadeIn" role="alert">
                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="bi bi-check-lg text-emerald-600 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-bold text-emerald-900">Berhasil!</h3>
                        <p class="text-sm mt-0.5">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 transition">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif
        </div>

        {{-- 3. LIVEWIRE COMPONENT --}}
        {{-- Pastikan komponen Livewire Anda tidak memiliki container/padding ganda agar rapi --}}
        @livewire('admin.activity-table')
        
    </div>

    {{-- Styles untuk Animasi Alert --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection