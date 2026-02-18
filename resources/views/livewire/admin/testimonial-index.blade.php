<div class="max-w-7xl mx-auto space-y-8">
    {{-- 1. HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-end gap-4 pb-6 border-b border-gray-100">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight">Testimoni</h1>
            <p class="text-gray-500 text-sm mt-1">Apa kata orang tua tentang pengalaman belajar di Academy?</p>
        </div>

        <a href="{{ route('admin.testimonials.create') }}"
            class="group inline-flex items-center gap-2 px-6 py-2.5 bg-[#0f5132] text-white text-sm font-semibold rounded-full shadow-lg transition-all duration-300">
            <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="bi bi-plus text-white"></i>
            </div>
            <span>Tambah Testimoni</span>
        </a>
    </div>

    {{-- 2. TOOLBAR --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
        <div class="relative w-full sm:w-72">
            <input wire:model.live.debounce.300ms="search" type="text"
                placeholder="Cari nama orang tua atau review..."
                class="w-full pl-0 pr-8 py-2 bg-transparent border-b-2 border-gray-100 focus:border-[#0f5132] outline-none text-sm transition-colors placeholder-gray-400">
            <i class="bi bi-search absolute right-0 top-1/2 -translate-y-1/2 text-gray-400"></i>
        </div>

        <div class="relative">
            <select wire:model.live="sort"
                class="appearance-none pl-4 pr-10 py-2 bg-gray-50 border border-gray-100 rounded-full text-sm font-medium text-gray-600 focus:ring-1 focus:ring-[#0f5132] outline-none cursor-pointer">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="az">Nama (A-Z)</option>
                <option value="za">Nama (Z-A)</option>
            </select>
            <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
        </div>
    </div>

    {{-- 3. GRID CONTENT --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($testimonials as $item)
            <div wire:key="testi-{{ $item->id }}"
                class="group relative bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_30px_rgba(0,0,0,0.06)] transition-all duration-300 flex flex-col h-full">

                {{-- Quick Actions --}}
                <div class="absolute top-4 right-4 z-10 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="{{ route('admin.testimonials.edit', $item->id) }}"
                        class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-600 rounded-full hover:bg-[#0f5132] hover:text-white transition shadow-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <button type="button" 
                    onclick="BannerManager.prepareDelete('{{ route('admin.testimonials.destroy', $item->id) }}', 'Testimoni')"
                        class="w-8 h-8 flex items-center justify-center bg-gray-50 text-red-500 rounded-full hover:bg-red-50 transition shadow-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>

                {{-- PROFILE HEADER --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="relative w-14 h-14 shrink-0">
                        <img src="{{ Storage::url($item->parent_image) }}" alt="{{ $item->parent_name }}"
                            class="w-full h-full object-cover rounded-full border-2 border-white shadow-sm ring-1 ring-gray-100 group-hover:ring-[#0f5132]/30 transition-all">
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base leading-tight group-hover:text-[#0f5132] transition-colors">
                            {{ $item->parent_name }}
                        </h4>
                        <div class="text-xs text-gray-500 mt-1">
                            Orang tua dari <span class="font-medium text-gray-700">{{ $item->student_name ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- QUOTE CONTENT --}}
                <div class="flex-1 relative mb-6 pl-2">
                    <i class="bi bi-quote absolute -top-3 -left-2 text-4xl text-gray-100"></i>
                    <p class="relative z-10 text-sm text-gray-600 italic leading-relaxed line-clamp-4">
                        "{{ $item->review[app()->getLocale()] ?? ($item->review['id'] ?? '-') }}"
                    </p>
                </div>

                {{-- FOOTER INFO --}}
                <div class="pt-4 border-t border-gray-50 flex items-center justify-between mt-auto">
                    <span class="inline-flex items-center px-2 py-1 rounded text-[10px] font-bold bg-emerald-50 text-[#0f5132] border border-emerald-100 uppercase">
                        {{ $item->course_name ?? 'General' }}
                    </span>
                    <span class="text-[10px] font-medium text-gray-300">#{{ $item->id }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <i class="bi bi-chat-left-quote text-4xl text-gray-200"></i>
                <h3 class="text-lg font-bold text-gray-800 mt-4">Belum ada Testimoni</h3>
                <p class="text-gray-500 text-sm">Gunakan kata kunci lain atau tambahkan data baru.</p>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-8">
        {{ $testimonials->links() }}
    </div>
</div>