@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-6 md:p-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">

        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                    Manajemen Banner
                </h1>
                <p class="text-gray-500 mt-1 text-sm">
                    Kelola tampilan banner slide pada halaman utama website
                </p>
            </div>

            <a href="{{ route('admin.banners.create') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl shadow-sm hover:bg-blue-700 transition duration-200 transform hover:-translate-y-0.5">
                <i class="bi bi-plus-lg text-lg"></i>
                <span>Tambah Banner</span>
            </a>
        </div>

        {{-- 2. FILTER SECTION --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
            <form action="{{ route('admin.banners.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    
                    {{-- Input Cari --}}
                    <div class="md:col-span-8">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                            CARI BANNER
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-search text-gray-400 group-focus-within:text-blue-500 transition"></i>
                            </div>
                            
                            <input type="text" 
                                name="search" 
                                id="searchInput"
                                value="{{ request('search') }}"
                                oninput="searchWithDebounce(this)" 
                                onfocus="var val=this.value; this.value=''; this.value= val;"
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition duration-200" 
                                placeholder="Ketik judul banner..."
                                {{ request('search') ? 'autofocus' : '' }}>
                            {{-- 'autofocus' agar kursor kembali ke sini setelah reload --}}
                        </div>
                    </div>

                    {{-- Input Sort --}}
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                            URUTKAN
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-sort-down text-gray-400"></i>
                            </div>
                            <select name="sort" onchange="this.form.submit()" class="w-full pl-11 pr-10 py-3 rounded-xl border border-gray-200 text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition duration-200 appearance-none cursor-pointer">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama (A-Z)</option>
                                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama (Z-A)</option>
                            </select>
                            
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="bi bi-chevron-down text-xs text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="mb-8 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-start gap-3 animate-fade-in-down">
                <i class="bi bi-check-circle-fill text-xl mt-0.5"></i>
                <div>
                    <h4 class="font-bold">Berhasil!</h4>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- 3. CARD GRID SYSTEM --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse($banners as $banner)
            {{-- ITEM CARD --}}
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-blue-200 transition duration-300 flex flex-col h-full">
                
                {{-- Bagian Atas: Gambar --}}
                <div class="relative w-full aspect-[16/9] bg-gray-100 overflow-hidden">
                    <img src="{{ Storage::url($banner->image) }}" 
                         alt="{{ $banner->title }}" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    
                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                    {{-- Badge Status --}}
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-green-600 text-xs font-bold rounded-full shadow-sm flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Active
                        </span>
                    </div>
                </div>

                {{-- Bagian Tengah: Konten --}}
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 line-clamp-2 mb-3 group-hover:text-blue-600 transition">
                        {{ $banner->title }}
                    </h3>
                    
                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center gap-2 text-gray-500 text-xs font-medium uppercase tracking-wide">
                        <i class="bi bi-clock-history"></i>
                        <span>Diupdate {{ $banner->updated_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Bagian Bawah: Tombol Aksi --}}
                <div class="p-6 pt-0 mt-auto grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.banners.edit', $banner->id) }}" 
                       class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-yellow-50 hover:text-yellow-700 hover:border-yellow-200 transition duration-200 font-semibold text-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Yakin hapus banner ini?')" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition duration-200 font-semibold text-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            
            @empty
            {{-- Empty State --}}
            <div class="col-span-1 md:col-span-2 lg:col-span-3 py-12">
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <i class="bi bi-images text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada Banner</h3>
                    <p class="text-gray-500 mb-8 max-w-sm mx-auto">Data banner masih kosong. Silakan tambahkan banner baru untuk mempercantik halaman depan.</p>
                    <a href="{{ route('admin.banners.create') }}" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        + Buat Banner Pertama
                    </a>
                </div>
            </div>
            @endforelse

        </div>
    </div>
</div>

<script>
    // Variabel untuk menyimpan timer
    let debounceTimer;

    function searchWithDebounce(input) {
        // 1. Hapus timer sebelumnya jika user masih mengetik
        clearTimeout(debounceTimer);

        // 2. Buat timer baru (tunggu 800ms atau 0.8 detik)
        debounceTimer = setTimeout(() => {
            // 3. Submit form secara otomatis
            input.form.submit();
        }, 800); 
    }
</script>
@endsection
