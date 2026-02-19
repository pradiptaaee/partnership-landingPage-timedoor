<div>
    <!-- ========== SEARCH & FILTER ========== -->
    <div class="w-full max-w-7xl mx-auto my-12 px-4">
        <div class="mx-auto py-3 px-4 shadow-sm rounded-[15px] bg-white max-w-4xl">

            <div class="flex items-center gap-3 md:flex-row">
                <!-- SEARCH INPUT -->
                <div class="flex-1 flex items-center border border-gray-300 rounded-lg overflow-hidden bg-white">
                    <span class="px-3">
                        <i class="bi bi-search text-gray-400"></i>
                    </span>
                    <input type="text"
                        wire:model.live.debounce.300ms="search"
                        class="flex-1 px-3 py-2 border-0 focus:outline-none focus:ring-0"
                        placeholder="Cari kegiatan...">
                </div>
                <!-- FILTER DROPDOWN -->
                <div class="relative flex flex-row items-center gap-3" >
                    <button class="px-4 py-2 rounded-[10px] border border-[#10A300] text-[#10A300] hover:bg-[#d2d2d2ff] transition-colors inline-flex items-center gap-2"
                        type="button"
                        onclick="this.nextElementSibling.classList.toggle('hidden')">
                        Filter
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg p-3 z-10"
                        onclick="event.stopPropagation()">
                        <div class="mb-3">
                            <label class="block text-sm font-semibold mb-2">Jenis Kegiatan</label>
                            <select wire:model.live="category"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10A300]">
                                <option value="">Semua</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Pelatihan">Pelatihan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-semibold mb-2">Tahun Kegiatan</label>
                            <select wire:model.live="year"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10A300]">
                                <option value="">Semua Tahun</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>

                        <div class="text-right mt-2">
                            <button type="button"
                                wire:click="resetFilters"
                                class="px-4 py-1.5 text-sm border border-gray-300 rounded-[10px] hover:bg-gray-100 transition-colors">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== LOADING INDICATOR ========== -->
    <div wire:loading class="text-center my-8">
        <div class="inline-block w-8 h-8 border-4 border-[#10A300] border-t-transparent rounded-full animate-spin"></div>
        <span class="sr-only">Loading...</span>
    </div>

    <!-- ========== CARDS GRID ========== -->
    <div class="w-full max-w-7xl mx-auto px-4" wire:loading.remove>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($activities as $activity)
            <div class="flex flex-col h-full bg-white shadow-sm rounded-2xl overflow-hidden">
                <div class="relative">
                    <div class="absolute top-0 left-0 m-3 z-10">
                        <span class="inline-block px-3 py-2 shadow-sm font-semibold rounded-[10px]"
                            style="background-color: rgba(144, 249, 163, 0.442); backdrop-filter: blur(4px);">
                            <i class="bi bi-building mr-1"></i>
                            {{ $activity->partner->name ?? '' }}
                        </span>
                    </div>

                    @if ($activity->featured_image_url)
                    <img src="{{ $activity->featured_image_url }}"
                        class="w-full h-[200px] object-cover"
                        alt="{{ $activity->title }}">
                    @else
                    <div class="w-full h-[200px] flex items-center justify-center bg-gray-100 border-b">
                        <div class="text-center">
                            <i class="bi bi-image text-gray-400 text-5xl"></i>
                            <p class="text-gray-500 text-sm mt-2 mb-0">No Image</p>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex flex-col flex-grow p-4">
                    <p class="text-[#10A300] text-sm font-semibold mb-2">
                        {{ $activity->activity_date->translatedFormat('d F Y') }}
                    </p>

                    <h5 class="font-bold text-lg text-[#0C3D8F] mb-3">
                        {{ $activity->title }}
                    </h5>

                    <p class="text-gray-500 mb-4 flex-grow line-clamp-3">
                        {{ \Illuminate\Support\Str::words(strip_tags($activity->full_description), 8, '...') }}
                    </p>

                    <a href="{{ route('partnership.show', $activity->slug) }}"
                        class="inline-block text-center text-white px-6 py-2.5 rounded-full transition-all hover:opacity-90"
                        style="background: linear-gradient(135deg, #10A300 0%, #0d8500 100%);">
                        <i class="bi bi-eye mr-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="bi bi-inbox text-gray-300 text-6xl"></i>
                <p class="text-gray-500 mt-4 mb-0">Tidak ada kegiatan ditemukan.</p>
            </div>
            @endforelse
        </div>

        <!-- ========== PAGINATION ========== -->
        @if ($activities->hasPages())
        <div class="mt-12 flex justify-between items-center">
            {{ $activities->links('component.pagination') }}
        </div>
        @endif
    </div>

    <script>
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const buttons = document.querySelectorAll('button[onclick*="nextElementSibling"]');
            buttons.forEach(button => {
                const dropdown = button.nextElementSibling;
                if (dropdown && !button.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>
</div>