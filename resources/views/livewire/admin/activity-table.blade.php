<div class="space-y-6">
    
    {{-- Filter Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            
            {{-- Search Input --}}
            <div class="lg:col-span-2">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">
                    Cari Kegiatan
                </label>
                <div class="relative">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                           placeholder="Cari judul kegiatan...">
                </div>
            </div>

            {{-- Filter Partner --}}
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">
                    Partner
                </label>
                <div class="relative">
                    <select wire:model.live="partnerFilter" 
                            class="w-full appearance-none px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white cursor-pointer">
                        <option value="all">Semua Partner</option>
                        @foreach ($partners as $partner)
                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            {{-- Sort By --}}
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">
                    Urutkan
                </label>
                <div class="relative">
                    <select wire:model.live="sortBy" 
                            class="w-full appearance-none px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white cursor-pointer">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="title">Judul A-Z</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            {{-- Reset Button --}}
            <div class="flex items-end">
                @if ($search !== '' || $partnerFilter !== 'all' || $sortBy !== 'latest')
                    <button wire:click="resetFilters"
                            class="w-full px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset
                    </button>
                @endif
            </div>
        </div>
    </div>

    {{-- Activities Grid --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($activities as $activity)
                <div class="group h-full">
                    <div class="flex flex-col bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-xl hover:border-indigo-300 transition-all duration-300 h-full">
                        
                        {{-- Image Section --}}
                        <div class="relative overflow-hidden h-48 flex-shrink-0">
                            @if ($activity->featured_image)
                                <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                     alt="{{ $activity->title }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i class="bi bi-image text-gray-400 text-5xl"></i>
                                </div>
                            @endif

                            {{-- Overlay Gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            {{-- Partner Badge --}}
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-500 text-white shadow-lg backdrop-blur-sm">
                                    <i class="bi bi-building mr-1.5"></i>
                                    {{ $activity->partner->name }}
                                </span>
                            </div>

                            {{-- Photo Count Badge --}}
                            @if ($activity->photos && $activity->photos->count() > 0)
                                <div class="absolute top-3 right-3 z-10">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-900/90 backdrop-blur-sm text-white shadow-lg">
                                        <i class="bi bi-images mr-1.5"></i>
                                        {{ $activity->photos->count() }}
                                    </span>
                                </div>
                            @endif

                            {{-- View Detail Badge on Hover --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                <a href="{{ route('admin.activity.show', $activity->slug) }}" 
                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/95 backdrop-blur-sm text-indigo-600 font-semibold rounded-lg shadow-lg hover:bg-white transition-colors">
                                    <i class="bi bi-eye-fill"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        {{-- Content Section --}}
                        <div class="p-5 flex flex-col flex-grow">
                            {{-- Title --}}
                            <a href="{{ route('admin.activity.show', $activity->slug) }}" 
                               class="block mb-3">
                                <h3 class="text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-indigo-600 transition-colors leading-snug">
                                    {{ $activity->title }}
                                </h3>
                            </a>

                            {{-- Description --}}
                            <p class="text-sm text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                {{ $activity->short_description }}
                            </p>

                            {{-- Spacer --}}
                            <div class="flex-grow"></div>

                            {{-- Date --}}
                            <div class="mb-4 pb-4 border-b border-gray-100">
                                <span class="inline-flex items-center text-sm font-medium text-gray-700">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-2.5">
                                        <i class="bi bi-calendar-event text-indigo-600"></i>
                                    </div>
                                    {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}
                                </span>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex gap-2.5 mb-4">
                                <a href="{{ route('admin.activity.edit', $activity->id) }}"
                                   class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold rounded-lg transition-all duration-200 border border-amber-200 hover:border-amber-300 hover:shadow-md group/edit">
                                    <i class="bi bi-pencil-square group-hover/edit:scale-110 transition-transform"></i>
                                    Edit
                                </a>
                                <button wire:click.prevent="confirmActivityDeletion({{ $activity->id }})"
                                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-700 font-semibold rounded-lg transition-all duration-200 border border-red-200 hover:border-red-300 hover:shadow-md group/delete">
                                    <i class="bi bi-trash3 group-hover/delete:scale-110 transition-transform"></i>
                                    Hapus
                                </button>
                            </div>

                            {{-- Footer --}}
                            <div class="pt-4 border-t border-gray-100">
                                <span class="text-xs text-gray-500 flex items-center">
                                    <i class="bi bi-clock-history mr-1.5 text-gray-400"></i>
                                    Dibuat {{ $activity->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full py-20 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-amber-100 to-amber-200 rounded-2xl mb-5 shadow-inner">
                        <i class="bi bi-inbox text-5xl text-amber-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Tidak Ada Kegiatan Ditemukan</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Coba ubah kata kunci pencarian atau filter Anda untuk menemukan kegiatan yang sesuai</p>
                    
                    @if ($search !== '' || $partnerFilter !== 'all' || $sortBy !== 'latest')
                        <button wire:click="resetFilters" 
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 shadow-md hover:shadow-lg">
                            <i class="bi bi-arrow-counterclockwise"></i>
                            Tampilkan Semua Kegiatan
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Loading State --}}
        <div wire:loading class="py-20 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4 animate-pulse">
                <i class="bi bi-hourglass-split text-2xl text-indigo-600 animate-spin"></i>
            </div>
            <p class="text-gray-600 font-medium">Memuat kegiatan...</p>
        </div>

        {{-- Pagination --}}
        @if ($activities->hasPages())
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-8 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $activities->firstItem() }}</span> - 
                    <span class="font-semibold text-gray-900">{{ $activities->lastItem() }}</span> dari 
                    <span class="font-semibold text-gray-900">{{ $activities->total() }}</span> kegiatan
                </div>
                <div>
                    {{ $activities->links() }}
                </div>
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    @if ($confirmingActivityDeletion)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4 animate-fadeIn">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 animate-scaleIn">
                {{-- Modal Header --}}
                <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mx-auto mb-4">
                    <i class="bi bi-trash3-fill text-3xl text-red-600"></i>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Konfirmasi Hapus Kegiatan</h3>
                <p class="text-gray-600 mb-6 text-center">
                    Apakah Anda yakin ingin menghapus kegiatan ini? Tindakan ini tidak dapat dibatalkan.
                </p>

                {{-- Modal Actions --}}
                <div class="flex gap-3">
                    <button wire:click="$set('confirmingActivityDeletion', false)" 
                            class="flex-1 px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </button>
                    <button wire:click="deleteActivity"
                            class="flex-1 px-5 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    

{{-- Custom Styles --}}
<style>
    /* Line Clamp Utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }

    .animate-scaleIn {
        animation: scaleIn 0.2s ease-out;
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }
</style>
@endif
</div>