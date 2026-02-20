<div class="bg-[#EDFFF3]">
    <div class="max-w-7xl mx-auto my-12 px-4">
        <div class="mx-auto py-3 px-4 shadow-sm rounded-[15px] bg-white">

            <div class="flex lg:flex-row gap-3">

                {{-- SEARCH INPUT --}}
                <div class="flex flex-1">
                    <span class="flex items-center px-3 border border-r-0 border-gray-300 bg-white rounded-l-md">
                        <i class="bi bi-search text-gray-400"></i>
                    </span>
                    <input type="text"
                           wire:model.live.debounce.300ms="search"
                           placeholder="Cari kegiatan spesifik..."
                           class="w-full border border-gray-300 border-l-0 rounded-r-md px-3 py-2 focus:outline-none">
                </div>

                {{-- FILTER DROPDOWN --}}
                <div x-data="{ open:false }" class="relative">
                    <button @click="open=!open"
                        class="px-4 py-2 border rounded-[10px] text-[#10A300] border-[#10A300]">
                        Filter
                    </button>

                    <div x-show="open" @click.away="open=false"
                        class="absolute right-0 mt-2 w-[250px] bg-white p-3 rounded-md shadow-sm z-20">

                        <div class="mb-3">
                            <label class="font-semibold block mb-1">Jenis Kegiatan</label>
                            <select wire:model.live="category"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2">
                                <option value="">Semua</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Pelatihan">Pelatihan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="font-semibold block mb-1">Tahun Kegiatan</label>
                            <select wire:model.live="year"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2">
                                <option value="">Semua Tahun</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>

                        <div class="text-right">
                            <button type="button"
                                wire:click="resetFilters"
                                class="text-sm border border-gray-400 px-3 py-1 rounded-[10px]">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- LOADING --}}
    <div wire:loading class="text-center my-8">
        <div class="w-10 h-10 border-4 border-green-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
    </div>

    {{-- CARDS GRID --}}
    <div class="max-w-7xl mx-auto px-4" wire:loading.remove>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse ($activities as $activity)

                <div class="bg-white shadow-sm rounded-2xl overflow-hidden flex flex-col">

                    <!-- IMAGE + BADGE -->
                    <div class="relative">
                        <div class="absolute top-0 left-0 m-3 z-10">
                            <span class="px-3 py-2 rounded-[10px] shadow-sm font-semibold text-sm
                                         bg-[rgba(144,249,163,0.442)] backdrop-blur">
                                <i class="bi bi-building mr-1"></i>
                                {{ $activity->partner->name ?? '' }}
                            </span>
                        </div>

                        @if ($activity->featured_image_url)
                            <img src="{{ $activity->featured_image_url }}"
                                 alt="{{ $activity->title }}"
                                 class="w-full h-[200px] object-cover">
                        @else
                            <div class="w-full h-[200px] flex items-center justify-center bg-gray-100 border-b">
                                <div class="text-center">
                                    <i class="bi bi-image text-gray-400 text-5xl"></i>
                                    <p class="text-gray-500 text-sm mb-0">No Image</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- BODY -->
                    <div class="flex flex-col p-6 flex-grow">

                        <div>
                            <p class="text-[#10A300] text-sm font-semibold">
                                {{ $activity->activity_date->translatedFormat('d F Y') }}
                            </p>

                            <h5 class="font-bold text-lg text-[#0C3D8F]">
                                {{ $activity->title }}
                            </h5>

                            <p class="text-gray-500">
                                {{ \Illuminate\Support\Str::words(strip_tags($activity->full_description), 8, '...') }}
                            </p>
                        </div>

                        <div class="mt-auto">
                            <a href="{{ route('partnership.show', $activity->slug) }}"
                               class="block mt-3 w-full text-center text-white
                                      rounded-full px-6 py-2
                                      bg-gradient-to-r from-[#10A300] to-[#0d8500]">
                                <i class="bi bi-eye mr-2"></i>
                                Lihat Detail
                            </a>
                        </div>

                    </div>
                </div>

            @empty

                <div class="col-span-full text-center py-12">
                    <i class="bi bi-inbox text-5xl text-gray-300"></i>
                    <p class="text-gray-500 mt-3">
                        Tidak ada kegiatan ditemukan.
                    </p>
                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
        @if ($activities->hasPages())
            <div class="mt-12 flex justify-between">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

</div>
