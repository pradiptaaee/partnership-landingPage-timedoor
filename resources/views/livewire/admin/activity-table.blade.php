<div class="flex-1 p-8 bg-white min-h-screen font-sans">
    
    <div class="max-w-7xl mx-auto space-y-10">

        {{-- 1. HEADER & STATS (Clean Layout) --}}
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8 pb-8 border-b border-gray-100">
            
            {{-- Title & Stats Text --}}
            <div class="space-y-4">
            
                
                {{-- Simple Stats Row --}}
                <div class="flex items-center gap-8">
                    <div>
                        <span class="block text-2xl font-bold text-gray-900">{{ $totalActivities ?? 0 }}</span>
                        <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total</span>
                    </div>
                    <div class="w-px h-8 bg-gray-100"></div> {{-- Divider --}}
                    <div>
                        <span class="block text-2xl font-bold text-gray-900">{{ $partners->count() }}</span>
                        <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Partners</span>
                    </div>
                    <div class="w-px h-8 bg-gray-100"></div> {{-- Divider --}}
                    <div>
                        <span class="block text-2xl font-bold text-gray-900">{{ $activities->sum(fn($a) => $a->photos ? $a->photos->count() : 0) }}</span>
                        <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">Photos</span>
                    </div>
                </div>
            </div>

            {{-- Action & Search --}}
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                {{-- Search Input (Minimalist) --}}
                <div class="relative group">
                    <input type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Cari kegiatan..."
                        class="w-full sm:w-64 pl-3 pr-10 py-2.5 bg-white border-b-2 border-gray-100 focus:border-[#0f5132] outline-none text-sm transition-colors placeholder-gray-400 group-hover:border-gray-300">
                    <i class="bi bi-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>

                {{-- Add Button --}}
                <a href="{{ route('admin.activity.create') }}" 
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0f5132] text-white text-sm font-semibold rounded-lg hover:bg-[#0b3d26] transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="bi bi-plus-lg"></i>
                        <span>Tambah Kegiatan</span>
                    </a>
            </div>
        </div>

        {{-- 2. FILTERS (Simple Tags) --}}
        <div class="flex flex-wrap items-center gap-3">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mr-2">Filter:</span>
            
            {{-- Partner Filter --}}
            <select wire:model.live="partnerFilter" 
                    class="px-4 py-2 bg-gray-50 border border-gray-100 rounded-full text-sm text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] outline-none cursor-pointer hover:bg-gray-100 transition">
                <option value="all">Semua Partner</option>
                @foreach ($partners as $partner)
                    <option value="{{ $partner->id }}">{{ Str::limit($partner->name, 20) }}</option>
                @endforeach
            </select>

            {{-- Sort Filter --}}
            <select wire:model.live="sortBy" 
                    class="px-4 py-2 bg-gray-50 border border-gray-100 rounded-full text-sm text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] outline-none cursor-pointer hover:bg-gray-100 transition">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="title">Judul (A-Z)</option>
            </select>

            {{-- Reset --}}
            @if ($search !== '' || $partnerFilter !== 'all' || $sortBy !== 'latest')
                <button wire:click="resetFilters" class="text-xs text-red-500 font-medium hover:underline ml-2">
                    Clear Filters
                </button>
            @endif
        </div>

        {{-- 3. CONTENT GRID (Flat Cards) --}}
        <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            @forelse ($activities as $activity)
                {{-- CARD --}}
                <div class="group flex flex-col h-full">
                    {{-- Image --}}
                    <div class="relative aspect-[3/2] overflow-hidden rounded-xl bg-gray-100 mb-4">
                        <a href="{{ route('admin.activity.show', $activity->slug) }}">
                            @if ($activity->featured_image)
                                <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                                    alt="{{ $activity->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="bi bi-image text-3xl"></i>
                                </div>
                            @endif
                        </a>
                        
                        {{-- Date Overlay (Minimalist) --}}
                        <div class="absolute top-3 left-3 px-2 py-1 bg-white/95 backdrop-blur rounded text-[10px] font-bold uppercase tracking-wider text-gray-800">
                            {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="flex flex-col flex-grow">
                        {{-- Meta --}}
                        <div class="flex items-center gap-2 mb-2 text-xs text-gray-500">
                            <span class="font-semibold text-[#0f5132]">{{ Str::limit($activity->partner->name, 20) }}</span>
                            <span class="text-gray-300">•</span>
                            <span>{{ $activity->photos_count ?? 0 }} Photos</span>
                        </div>

                        {{-- Title --}}
                        <h3 class="text-lg font-bold text-gray-900 leading-snug mb-2 group-hover:text-[#0f5132] transition-colors">
                            <a href="{{ route('admin.activity.show', $activity->slug) }}">
                                {{ $activity->title }}
                            </a>
                        </h3>

                        {{-- Description --}}
                        <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed mb-4">
                            {{ $activity->short_description ?? '-' }}
                        </p>

                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <a href="{{ route('admin.activity.show', $activity->slug) }}" class="text-xs font-bold text-gray-900 border-b border-transparent hover:border-gray-900 transition-all pb-0.5">
                                READ MORE
                            </a>
                            
                            {{-- Actions --}}
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.activity.edit', $activity->id) }}" class="text-gray-400 hover:text-gray-900 transition">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button wire:click.prevent="confirmActivityDeletion({{ $activity->id }})" class="text-gray-400 hover:text-red-600 transition">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- EMPTY STATE --}}
                <div class="col-span-full py-20 border-t border-gray-100 text-center">
                    <p class="text-gray-400 text-sm">Tidak ada kegiatan ditemukan.</p>
                </div>
            @endforelse
        </div>

        {{-- Loading --}}
        <div wire:loading class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-black text-white px-4 py-2 rounded-full text-xs font-bold shadow-lg z-50">
            Loading...
        </div>

        {{-- Pagination --}}
        @if ($activities->hasPages())
            <div class="pt-8 border-t border-gray-100">
                {{ $activities->links('pagination') }}
            </div>
        @endif

    </div>

    {{-- DELETE MODAL (Ultra Clean) --}}
    @if ($confirmingActivityDeletion)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-white/80 backdrop-blur-sm animate-fadeIn">
            <div class="bg-white w-full max-w-sm p-8 border border-gray-200 shadow-2xl animate-scaleIn text-center rounded-none">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Item?</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-8">
                    Tindakan ini permanen. Lanjutkan?
                </p>
                <div class="flex flex-col gap-3">
                    <button wire:click="deleteActivity"
                            class="w-full px-4 py-3 bg-red-600 text-white text-sm font-bold hover:bg-red-700 transition">
                        YA, HAPUS
                    </button>
                    <button wire:click="$set('confirmingActivityDeletion', false)" 
                            class="w-full px-4 py-3 bg-white border border-gray-200 text-gray-900 text-sm font-bold hover:bg-gray-50 transition">
                        BATAL
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.98); } to { opacity: 1; transform: scale(1); } }
        .animate-fadeIn { animation: fadeIn 0.15s ease-out; }
        .animate-scaleIn { animation: scaleIn 0.15s ease-out; }
    </style>

</div>