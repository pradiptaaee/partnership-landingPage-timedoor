<div class="flex-1 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Total Leads --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Leads</p>
                    <h3 class="text-3xl font-bold text-[#0f5132]">{{ $trials->total() }}</h3>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <i class="bi bi-check-circle-fill text-emerald-500"></i> Terdaftar aktif
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-[#0f5132]">
                    <i class="bi bi-people-fill text-2xl"></i>
                </div>
            </div>

            {{-- Negara Aktif --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Negara</p>
                    <h3 class="text-3xl font-bold text-[#0f5132]">{{ $totalCountries ?? 1 }}</h3>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <i class="bi bi-globe-americas text-emerald-500"></i> Region jangkauan
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-[#0f5132]">
                    <i class="bi bi-grid-fill text-2xl"></i>
                </div>
            </div>

            {{-- Belum Diproses (Optional Stats) --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Terbaru</p>
                    <h3 class="text-3xl font-bold text-[#0f5132]">{{ $newLeadsToday ?? 0 }}</h3>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                        <i class="bi bi-lightning-charge-fill text-emerald-500"></i> Hari ini
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-[#0f5132]">
                    <i class="bi bi-calendar-event-fill text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- HEADER --}}
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight">Data Trial</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola daftar calon siswa yang mendaftar melalui website.</p>
        </div>

        {{-- TOOLBAR --}}
        <div class="bg-gray-50 p-2 rounded-xl border border-gray-100 flex flex-col md:flex-row gap-3">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-search text-gray-400"></i>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" 
                       placeholder="Cari nama atau email..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] outline-none transition placeholder-gray-400">
            </div>

            <div class="flex gap-3">
                <div class="relative min-w-[140px]">
                    <select wire:model.live="sortBy" class="w-full appearance-none pl-3 pr-8 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] cursor-pointer outline-none">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>

                <div class="relative min-w-[100px]">
                    <select wire:model.live="perPage" class="w-full appearance-none pl-3 pr-8 py-2.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] cursor-pointer outline-none">
                        <option value="10">10 Baris</option>
                        <option value="25">25 Baris</option>
                        <option value="50">50 Baris</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_rgba(0,0,0,0.03)] overflow-hidden">
            @if ($trials->count())
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Info Pendaftar</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Detail Kids</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Negara</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">No Telepon</th>
                                <th class="px-6 py-4 text-center text-[11px] font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50">
                            @foreach ($trials as $item)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-6 py-4 text-sm text-gray-400 font-mono">
                                        {{ $loop->iteration + $trials->firstItem() - 1 }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-[#0f5132] flex items-center justify-center font-bold text-xs shrink-0 border border-emerald-100 uppercase">
                                                {{ substr($item->name, 0, 1) }}
                                            </div>
                                            <span class="font-bold text-gray-800 text-sm group-hover:text-[#0f5132] transition-colors">
                                                {{ $item->prefix }} {{ $item->name }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-500 line-clamp-1 max-w-xs leading-relaxed">
                                            {{ $item->kids_list ?: '-' }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase">
                                            {{ $item->country }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-xs text-gray-500">
                                        {{ $item->email }}
                                    </td>

                                    <td class="px-6 py-4 text-xs text-gray-500">
                                        {{ $item->phone }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <button wire:click="confirmTrialDeletion({{ $item->id }})"
                                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                            <i class="bi bi-trash3 text-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-50 bg-white">
                    {{ $trials->links() }}
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-20">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                        <i class="bi bi-inbox text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Belum Ada Pendaftar</h3>
                </div>
            @endif
        </div>
        
    </div>

    {{-- DELETE MODAL (Livewire Style) --}}
        @if ($confirmingTrialDeletion)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/20 backdrop-blur-[2px] animate-fadeIn">
        <div class="bg-white w-full max-w-sm p-8 border border-gray-100 shadow-2xl text-center rounded-none animate-scaleIn">
            
            {{-- Header --}}
            <h3 class="text-lg font-bold text-gray-900 mb-2 uppercase tracking-widest">Konfirmasi Hapus</h3>
            <p class="text-xs text-gray-400 leading-relaxed mb-8 uppercase font-bold tracking-tighter">Data akan dihapus permanen dari sistem.</p>
            
            <div class="space-y-3">
                {{-- Tombol Utama --}}
                <button wire:click="deleteTrial" 
                        wire:loading.attr="disabled" 
                        class="w-full px-4 py-3 bg-red-600 text-white text-xs font-black tracking-widest hover:bg-red-700 transition-all disabled:opacity-50 disabled:cursor-wait uppercase">
                    
                    {{-- Tampilan Normal --}}
                    <span wire:loading.remove wire:target="deleteTrial">
                        Ya, Hapus Sekarang
                    </span>
                    
                    {{-- Tampilan Loading Simpel --}}
                    <span wire:loading wire:target="deleteTrial" class="animate-pulse">
                        Menghapus...
                    </span>
                </button>

                {{-- Tombol Batal --}}
                <button wire:click="$set('confirmingTrialDeletion', false)" 
                        wire:loading.attr="disabled"
                        class="w-full px-4 py-3 bg-white border border-gray-200 text-gray-400 text-xs font-black tracking-widest hover:bg-gray-50 hover:text-gray-900 transition-all uppercase">
                    Batal
                </button>
            </div>
        </div>
    </div>
@endif

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        .animate-fadeIn { animation: fadeIn 0.2s ease-out; }
        .animate-scaleIn { animation: scaleIn 0.2s ease-out; }
    </style>
</div>