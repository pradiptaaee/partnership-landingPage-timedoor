<div class="max-w-7xl mx-auto space-y-8">
    {{-- 1. HEADER PAGE --}}
    <div class="flex flex-col md:flex-row justify-between items-end gap-4 pb-6 border-b border-gray-100">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight">Manajemen Banner</h1>
            <p class="text-gray-500 text-sm mt-1">Atur slide promo yang tampil di halaman depan.</p>
        </div>

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

    {{-- 2. TOOLBAR --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
        {{-- Search Input (Livewire Binding) --}}
        <div class="relative w-full sm:w-72 group">
            <input wire:model.live.debounce.300ms="search" type="text"
                placeholder="Cari banner..."
                class="w-full pl-0 pr-8 py-2 bg-transparent border-b-2 border-gray-100 focus:border-[#0f5132] outline-none text-sm transition-colors placeholder-gray-400 group-hover:border-gray-200">
            <i class="bi bi-search absolute right-0 top-1/2 -translate-y-1/2 text-gray-400"></i>
        </div>

        {{-- Sort Dropdown (Livewire Binding) --}}
        <div class="relative">
            <select wire:model.live="sort"
                class="appearance-none pl-4 pr-10 py-2 bg-gray-50 border border-gray-100 rounded-full text-sm font-medium text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] cursor-pointer outline-none hover:bg-gray-100 transition">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
            </select>
            <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
        </div>
    </div>

    {{-- 3. BANNER GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($banners as $banner)
            <div wire:key="banner-{{ $banner->id }}"
                class="group relative bg-white rounded-2xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_30px_rgba(0,0,0,0.06)] transition-all duration-300 flex flex-col overflow-hidden">
                
                <div class="relative aspect-[16/9] overflow-hidden bg-gray-100">
                    <img src="{{ Storage::url($banner->image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    
                    <div class="absolute top-3 right-3 z-20 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('admin.banners.edit', $banner->id) }}" class="w-9 h-9 flex items-center justify-center bg-white text-gray-700 rounded-full hover:text-[#0f5132] shadow-md transition">
                            <i class="bi bi-pencil"></i>
                        </a>
                        {{-- Tombol Hapus Tetap menggunakan JS Modal yang sudah Anda buat --}}
                        <button type="button" onclick="prepareDelete('{{ route('admin.banners.destroy', $banner->id) }}')" 
                            class="w-9 h-9 flex items-center justify-center bg-white text-red-500 rounded-full hover:bg-red-50 shadow-md transition">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-bold text-gray-800 leading-tight mb-2 line-clamp-1 group-hover:text-[#0f5132] transition-colors">
                        {{ $banner->title['en'] ?? 'Untitled' }}
                    </h3>
                    <p class="text-xs text-gray-500 line-clamp-2">
                        {{ $banner->description['en'] ?? '-' }}
                    </p>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-gray-500">Tidak ada banner ditemukan.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $banners->links() }}
    </div>
</div>