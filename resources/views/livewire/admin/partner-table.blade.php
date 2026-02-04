<div class="flex-1 p-8 bg-white min-h-screen font-sans">
    

    <div class="max-w-7xl mx-auto space-y-8">

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Total Partner --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Partner</p>
                    <h3 class="text-3xl font-bold text-[#0f5132]">{{ $totalPartners ?? 0 }}</h3>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <i class="bi bi-check-circle-fill text-emerald-500"></i> Terdaftar aktif
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-[#0f5132]">
                    <i class="bi bi-people-fill text-2xl"></i>
                </div>
            </div>

            {{-- Jumlah Kategori --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Kategori</p>
                    <h3 class="text-3xl font-bold text-[#0f5132]">{{ $totalCategories ?? 0 }}</h3>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <i class="bi bi-tag-fill text-emerald-500"></i> Jenis industri
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-[#0f5132]">
                    <i class="bi bi-grid-fill text-2xl"></i>
                </div>
            </div>

            {{-- Total Kegiatan --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Kegiatan</p>
                    <h3 class="text-3xl font-bold text-[#0f5132]">{{ $totalActivities ?? 0 }}</h3>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <i class="bi bi-lightning-charge-fill text-emerald-500"></i> Sedang berjalan
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-[#0f5132]">
                    <i class="bi bi-calendar-event-fill text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- HEADER & ACTIONS --}}
        <div class="flex flex-col md:flex-row justify-between items-end md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight">Data Partner</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola daftar perusahaan dan institusi yang bekerjasama.</p>
            </div>
            
            <a href="{{ route('admin.partners.create') }}" 
               class="group inline-flex items-center gap-2 px-5 py-2.5 bg-[#0f5132] text-white text-sm font-semibold rounded-lg hover:bg-[#0b3d26] transition-all shadow-md hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Partner Baru</span>
            </a>
        </div>

        {{-- TOOLBAR (Search & Filters) --}}
        <div class="bg-gray-50 p-2 rounded-xl border border-gray-100 flex flex-col md:flex-row gap-3">
            
            {{-- Search Input --}}
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-search text-gray-400"></i>
                </div>
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       placeholder="Cari nama partner..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] outline-none transition placeholder-gray-400">
            </div>

            <div class="flex gap-3 overflow-x-auto pb-1 md:pb-0 no-scrollbar">
                {{-- Sort By --}}
                <div class="relative min-w-[140px]">
                    <select wire:model.live="sortBy" 
                            class="w-full appearance-none pl-3 pr-8 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] cursor-pointer outline-none">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="name_asc">Nama (A-Z)</option>
                        <option value="name_desc">Nama (Z-A)</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>

                {{-- Per Page --}}
                <div class="relative min-w-[100px]">
                    <select wire:model.live="perPage" 
                            class="w-full appearance-none pl-3 pr-8 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] cursor-pointer outline-none">
                        <option value="5">5 Baris</option>
                        <option value="10">10 Baris</option>
                        <option value="25">25 Baris</option>
                        <option value="50">50 Baris</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>

                {{-- Reset Button --}}
                @if ($search !== '' || $sortBy !== 'latest')
                    <button wire:click="resetFilters" 
                            class="px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-gray-500 hover:text-red-500 hover:border-red-200 transition text-sm"
                            title="Reset Filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                @endif
            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_rgba(0,0,0,0.03)] overflow-hidden">
            @if ($partners->count())
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Info Partner</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Deskripsi Singkat</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">No Telepon</th>
                                <th class="px-6 py-4 text-center text-[11px] font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50">
                            @foreach ($partners as $partner)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    {{-- No --}}
                                    <td class="px-6 py-4 text-sm text-gray-400 font-mono">
                                        {{ $loop->iteration + $partners->firstItem() - 1 }}
                                    </td>

                                    {{-- Partner --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-lg bg-white border border-gray-100 p-1 shadow-sm flex items-center justify-center shrink-0">
                                                @if ($partner->logo)
                                                    <img src="{{ asset('storage/' . $partner->logo) }}"
                                                         alt="{{ $partner->name }}"
                                                         class="w-full h-full object-contain rounded-md">
                                                @else
                                                    <i class="bi bi-building text-gray-300 text-xl"></i>
                                                @endif
                                            </div>
                                            <span class="font-bold text-gray-800 text-sm group-hover:text-[#0f5132] transition-colors">
                                                {{ $partner->name }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Description --}}
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-500 line-clamp-2 max-w-xs leading-relaxed">
                                            {{ Str::limit($partner->description, 70) ?: '-' }}
                                        </p>
                                    </td>

                                    {{-- Category --}}
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            {{ $partner->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs  text-grey-500 ">
                                            {{ $partner->email }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1  text-xs  text-grey-500 ">
                                            {{ $partner->no_telepon}}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                            {{-- Activities --}}
                                            <a href="{{ route('admin.activity.index', ['partner_id' => $partner->id]) }}"
                                               class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                               title="Lihat Kegiatan">
                                                <i class="bi bi-calendar-range text-lg"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                               class="p-2 text-gray-400 hover:text-[#0f5132] hover:bg-emerald-50 rounded-lg transition"
                                               title="Edit">
                                                <i class="bi bi-pencil-square text-lg"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <button wire:click="confirmPartnerDeletion({{ $partner->id }})"
                                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                    title="Hapus">
                                                <i class="bi bi-trash3 text-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-50 bg-white">
                    {{ $partners->links('component.pagination') }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-20">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                        <i class="bi bi-inbox text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Belum Ada Partner</h3>
                    <p class="text-gray-500 text-sm mt-1">Silakan tambahkan data partner baru.</p>
                </div>
            @endif
        </div>

    </div>

    {{-- DELETE MODAL --}}
    @if ($confirmingPartnerDeletion)
       
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-white/80 backdrop-blur-sm animate-fadeIn">
            <div class="bg-white w-full max-w-sm p-8 border border-gray-200 shadow-2xl animate-scaleIn text-center rounded-none">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Item?</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-8">
                    Tindakan ini permanen. Lanjutkan?
                </p>
                <div class="flex flex-col gap-3">
                    <button wire:click="deletePartner"
                            class="w-full px-4 py-3 bg-red-600 text-white text-sm font-bold hover:bg-red-700 transition">
                        YA, HAPUS
                    </button>
                    <button wire:click="$set('confirmingPartnerDeletion', false)" 
                            class="w-full px-4 py-3 bg-white border border-gray-200 text-gray-900 text-sm font-bold hover:bg-gray-50 transition">
                        BATAL
                    </button>
                </div>
            </div>
        </div>
   
    @endif

    {{-- STYLE: Dipindah ke dalam DIV utama agar menjadi 1 root element --}}
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        
        .animate-fadeIn { animation: fadeIn 0.2s ease-out; }
        .animate-scaleIn { animation: scaleIn 0.2s ease-out; }
    </style>

</div>