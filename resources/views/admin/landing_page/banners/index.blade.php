@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans">
    
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-4 pb-6 border-b border-gray-100">
            <div>
                <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight">Manajemen Banner</h1>
                <p class="text-gray-500 text-sm mt-1">Atur slide promo yang tampil di halaman depan.</p>
            </div>
            
            {{-- Tombol Tambah (Tanpa efek naik) --}}
            <a href="{{ route('admin.banners.create') }}" 
               class="group inline-flex items-center gap-2 px-6 py-2.5 bg-[#0f5132] text-white text-sm font-semibold rounded-full shadow-lg shadow-emerald-900/10 hover:shadow-emerald-900/20 transition-all duration-300">
                <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <span>Tambah Banner</span>
            </a>
        </div>

        {{-- 2. TOOLBAR (Search & Filter) --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
            {{-- Search Input --}}
            <div class="relative w-full sm:w-72 group">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       oninput="searchWithDebounce(this)"
                       placeholder="Cari banner..."
                       class="w-full pl-0 pr-8 py-2 bg-transparent border-b-2 border-gray-100 focus:border-[#0f5132] outline-none text-sm transition-colors placeholder-gray-400 group-hover:border-gray-200">
                <i class="bi bi-search absolute right-0 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            {{-- Sort Dropdown --}}
            <div class="relative">
                <form id="sortForm" action="{{ route('admin.banners.index') }}" method="GET">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <select name="sort" onchange="this.form.submit()" 
                            class="appearance-none pl-4 pr-10 py-2 bg-gray-50 border border-gray-100 rounded-full text-sm font-medium text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] cursor-pointer outline-none hover:bg-gray-100 transition">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </form>
            </div>
        </div>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 flex items-center gap-3 animate-fadeIn">
                <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>
                <div>
                    <h4 class="text-sm font-bold">Berhasil</h4>
                    <p class="text-xs opacity-90">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-600 hover:text-emerald-800 transition">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @endif

        {{-- 3. BANNER GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($banners as $banner)
            
            {{-- CARD ITEM (Tanpa hover:-translate-y) --}}
            <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_30px_rgba(0,0,0,0.06)] transition-all duration-300 flex flex-col overflow-hidden">
                
                {{-- IMAGE AREA --}}
                <div class="relative aspect-[16/9] overflow-hidden bg-gray-100">
                    <img src="{{ Storage::url($banner->image) }}" alt="Banner Image" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    
                    {{-- Gradient Overlay (Bottom) --}}
                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/60 to-transparent opacity-60 pointer-events-none"></div>

                    {{-- Status Badge --}}
                    <div class="absolute top-3 left-3 z-10">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white/90 backdrop-blur-md text-[10px] font-bold tracking-wider text-[#0f5132] shadow-sm uppercase border border-gray-100">
                            Active
                        </span>
                    </div>

                    {{-- Floating Actions (Edit & Delete) - Muncul diam (fade in) --}}
                    <div class="absolute top-3 right-3 z-20 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        {{-- Edit --}}
                        <a href="{{ route('admin.banners.edit', $banner->id) }}" 
                           class="w-9 h-9 flex items-center justify-center bg-white text-gray-700 rounded-full hover:text-[#0f5132] hover:bg-emerald-50 shadow-md transition" 
                           title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                        {{-- Delete --}}
                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="w-9 h-9 flex items-center justify-center bg-white text-red-500 rounded-full hover:bg-red-50 shadow-md transition" 
                                    title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456-3.834a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- CONTENT BODY --}}
                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                            {{ $banner->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 leading-tight mb-2 line-clamp-1 group-hover:text-[#0f5132] transition-colors">
                        {{ $banner->title['en'] ?? 'Untitled Banner' }}
                    </h3>
                    
                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                        {{ $banner->description['en'] ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>
            </div>
            
            @empty
            {{-- EMPTY STATE --}}
            <div class="col-span-full py-20 text-center mt-4">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full text-gray-300 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Belum ada Banner</h3>
                <p class="text-gray-500 text-sm mt-1">Tambahkan banner untuk mempercantik halaman depan.</p>
            </div>
            @endforelse
        </div>

    </div>
</div>

<script>
    let debounceTimer;
    function searchWithDebounce(input) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => { 
            const form = document.getElementById('sortForm');
            let hiddenInput = form.querySelector('input[name="search"]');
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'search';
                form.appendChild(hiddenInput);
            }
            hiddenInput.value = input.value;
            form.submit(); 
        }, 600); 
    }
</script>

<style>
    /* Hapus translate-y dari animasi */
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
</style>
@endsection