<div class="space-y-6">

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Total Partner --}}
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl shadow-sm p-6 border border-green-200 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-xs uppercase font-bold text-green-700 tracking-wider mb-1">Total Partner</p>
                    <p class="text-3xl font-bold text-green-900">{{ $totalPartners ?? 0 }}</p>
                    
                </div>
                <div class="w-14 h-14 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="bi bi-people-fill text-white text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- Jumlah Kategori --}}
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-sm p-6 border border-blue-200 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-xs uppercase font-bold text-blue-700 tracking-wider mb-1">Jumlah Kategori</p>
                    <p class="text-3xl font-bold text-blue-900">{{ $totalCategories ?? 0 }}</p>
                    
                </div>
                <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="bi bi-tags-fill text-white text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Kegiatan --}}
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl shadow-sm p-6 border border-purple-200 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-xs uppercase font-bold text-purple-700 tracking-wider mb-1">Total Kegiatan</p>
                    <p class="text-3xl font-bold text-purple-900">{{ $totalActivities ?? 0 }}</p>
                </div>
                <div class="w-14 h-14 bg-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="bi bi-calendar-event-fill text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Actions Bar --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
        <div class="flex flex-col lg:flex-row gap-4 justify-between items-start lg:items-center">
            
            {{-- Left Side: Filters --}}
            <div class="flex flex-wrap gap-3 items-center w-full lg:w-auto">
                {{-- Search Input --}}
                <div class="relative flex-1 lg:flex-none lg:w-72">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           placeholder="Cari partner..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                </div>

                {{-- Sort By --}}
                <div class="relative">
                    <select wire:model.live="sortBy" 
                            class="appearance-none pl-4 pr-10 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white cursor-pointer">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="name_asc">Nama (A–Z)</option>
                        <option value="name_desc">Nama (Z–A)</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>

                {{-- Per Page --}}
                <div class="relative">
                    <select wire:model.live="perPage" 
                            class="appearance-none pl-4 pr-10 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white cursor-pointer">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>

                {{-- Reset Button --}}
                @if ($search !== '' || $sortBy !== 'latest')
                    <button wire:click="resetFilters" 
                            class="px-4 py-2.5 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors duration-200 flex items-center gap-2">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset
                    </button>
                @endif
            </div>

            {{-- Right Side: Add Button --}}
            <a href="{{ route('admin.partners.create') }}"
               class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold hover:from-indigo-700 hover:to-indigo-800 shadow-md hover:shadow-lg transition-all duration-200 w-full lg:w-auto">
                <i class="bi bi-plus-circle-fill text-lg"></i>
                Tambah Partner
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200">
        @if ($partners->count())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Partner</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Created at</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($partners as $partner)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                {{-- No --}}
                                <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                                    {{ $loop->iteration + $partners->firstItem() - 1 }}
                                </td>

                                {{-- Partner Name & Logo --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($partner->logo)
                                            <img src="{{ asset('storage/' . $partner->logo) }}"
                                                 alt="{{ $partner->name }}"
                                                 class="w-12 h-12 rounded-xl object-cover bg-gray-50 border border-gray-200 shadow-sm">
                                        @else
                                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center border border-gray-200">
                                                <i class="bi bi-image text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                        <span class="font-semibold text-gray-900">{{ $partner->name }}</span>
                                    </div>
                                </td>

                                {{-- Description --}}
                                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                                    <p class="line-clamp-2">{{ Str::limit($partner->description, 80) ?: '-' }}</p>
                                </td>

                                {{-- Category --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                       
                                        {{ $partner->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1  text-gray-600 rounded-full text-xs max-w-30  ">
                                       
                                        {{ $partner->created_at }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        {{-- View Activities --}}
                                        <a href="{{ route('admin.activity.index', ['partner_id' => $partner->id]) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-600 transition-all duration-200 group"
                                           title="Lihat Kegiatan">
                                            <i class="bi bi-calendar-check text-lg group-hover:scale-110 transition-transform"></i>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg bg-amber-100 hover:bg-amber-200 text-amber-600 transition-all duration-200 group"
                                           title="Edit Partner">
                                            <i class="bi bi-pencil-square text-lg group-hover:scale-110 transition-transform"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <button wire:click="confirmPartnerDeletion({{ $partner->id }})"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 hover:bg-red-200 text-red-600 transition-all duration-200 group"
                                                title="Hapus Partner">
                                            <i class="bi bi-trash3-fill text-lg group-hover:scale-110 transition-transform"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $partners->firstItem() }}</span> - 
                    <span class="font-semibold text-gray-900">{{ $partners->lastItem() }}</span> dari 
                    <span class="font-semibold text-gray-900">{{ $partners->total() }}</span> partner
                </div>
                {{ $partners->withPath('/admin/partners')->links('pagination') }}
            </div>
        @else
            {{-- Empty State --}}
            <div class="py-20 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <i class="bi bi-inbox text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Partner</h3>
                <p class="text-gray-500 mb-6">Mulai tambahkan partner untuk mengelola kegiatan</p>
                <a href="{{ route('admin.partners.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition-colors duration-200">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Partner Pertama
                </a>
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    @if ($confirmingPartnerDeletion)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4 animate-fadeIn">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 animate-scaleIn">
                {{-- Modal Header --}}
                <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mx-auto mb-4">
                    <i class="bi bi-exclamation-triangle-fill text-3xl text-red-600"></i>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Konfirmasi Hapus Partner</h3>
                <p class="text-gray-600 mb-6 text-center">
                    Apakah Anda yakin ingin menghapus partner ini? Tindakan ini tidak dapat dibatalkan.
                </p>

                {{-- Modal Actions --}}
                <div class="flex gap-3">
                    <button wire:click="$set('confirmingPartnerDeletion', false)" 
                            class="flex-1 px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </button>
                    <button wire:click="deletePartner"
                            class="flex-1 px-5 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
        {{-- Custom Styles --}}
<style>
    /* Animation Classes */
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

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }

    .animate-scaleIn {
        animation: scaleIn 0.2s ease-out;
    }

    /* Line Clamp for Description */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom Scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
    @endif
</div>

