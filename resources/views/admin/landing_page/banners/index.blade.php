@extends('layouts.admin') 

@section('content')
<div class="w-full p-6 bg-gray-50 min-h-screen">
    
    {{-- 1. HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Manajemen Banner
            </h1>
            <p class="text-gray-500 mt-2 text-sm">
                Kelola tampilan banner slide pada halaman utama
            </p>
        </div>

        <a href="{{ route('admin.banners.create') }}" 
           class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-700 transition duration-300 transform hover:-translate-y-0.5">
            Tambah Banner
        </a>
    </div>

    {{-- 2. FILTER SECTION (Mirip Screenshot) --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        {{-- Form Pencarian (Action ke Index lagi) --}}
        <form action="{{ route('admin.banners.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Input Cari --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        CARI BANNER
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="w-full pl-4 pr-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition" 
                               placeholder="Cari judul banner...">
                    </div>
                </div>

                {{-- Input Sort (Hiasan UI dulu) --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        URUTKAN
                    </label>
                    <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition bg-white">
                        <option>Terbaru</option>
                        <option>Terlama</option>
                        <option>Nama (A-Z)</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3">
            <i class="bi bi-check-circle-fill text-xl"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- 3. CARD GRID SYSTEM --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        @forelse($banners as $banner)
        {{-- ITEM CARD --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition duration-300 flex flex-col h-full">
            
            {{-- Bagian Atas: Gambar (Aspect Ratio Video agar rapi) --}}
            <div class="relative w-full aspect-video bg-gray-100 overflow-hidden group">
                <img src="{{ Storage::url($banner->image) }}" 
                     alt="{{ $banner->title }}" 
                     class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                
                {{-- Badge Status (Contoh Hiasan: Active) --}}
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full shadow-sm">
                        Active
                    </span>
                </div>
            </div>

            {{-- Bagian Tengah: Konten --}}
            <div class="p-6 flex-1 flex flex-col">
                <h3 class="text-lg font-bold text-gray-900 line-clamp-2 mb-2">
                    {{ $banner->title }}
                </h3>
                
                <div class="mt-auto pt-4 flex items-center gap-2 text-gray-500 text-sm">
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <span>{{ $banner->created_at->format('d M Y') }}</span>
                </div>
            </div>

            {{-- Bagian Bawah: Tombol Aksi (Mirip Screenshot) --}}
            <div class="p-6 pt-0 mt-auto grid grid-cols-2 gap-3">
                {{-- Tombol Edit (Kuning Outline) --}}
                <a href="{{ route('admin.banners.edit', $banner->id) }}" 
                   class="flex items-center justify-center px-4 py-2 rounded-lg border border-yellow-300 text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition duration-200 font-semibold text-sm">
                    Edit
                </a>

                {{-- Tombol Hapus (Merah Outline) --}}
                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Yakin hapus banner ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full flex items-center justify-center px-4 py-2 rounded-lg border border-red-200 text-red-600 bg-red-50 hover:bg-red-100 transition duration-200 font-semibold text-sm">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        
        @empty
        {{-- Empty State (Jika tidak ada data) --}}
        <div class="col-span-1 md:col-span-2 lg:col-span-3">
            <div class="flex flex-col items-center justify-center p-12 bg-white rounded-xl border border-dashed border-gray-300 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <i class="bi bi-image text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Belum ada Banner</h3>
                <p class="text-gray-500 mb-6">Silakan tambahkan banner baru untuk ditampilkan.</p>
                <a href="{{ route('admin.banners.create') }}" class="text-blue-600 font-semibold hover:underline">
                    + Tambah Banner Sekarang
                </a>
            </div>
        </div>
        @endforelse

    </div>
</div>
@endsection