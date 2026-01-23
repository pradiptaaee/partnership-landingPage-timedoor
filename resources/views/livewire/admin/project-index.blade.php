<div class="max-w-7xl mx-auto space-y-8">
    {{-- 1. HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-end gap-4 pb-6 border-b border-gray-100">
        <div>
            <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight">Student Projects</h1>
            <p class="text-gray-500 text-sm mt-1">Showcase karya terbaik dari para siswa.</p>
        </div>

        <a href="{{ route('admin.projects.create') }}"
            class="group inline-flex items-center gap-2 px-6 py-2.5 bg-[#0f5132] text-white text-sm font-semibold rounded-full shadow-lg transition-all duration-300">
            <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                <i class="bi bi-plus text-white"></i>
            </div>
            <span>Tambah Project</span>
        </a>
    </div>

    {{-- 2. TOOLBAR --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
        <div class="relative w-full sm:w-72 group">
            <input wire:model.live.debounce.300ms="search" type="text"
                placeholder="Cari project atau siswa..."
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
        @forelse($projects as $project)
            <div wire:key="project-{{ $project->id }}"
                class="group relative bg-white rounded-2xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_30px_rgba(0,0,0,0.06)] transition-all duration-300 flex flex-col overflow-hidden">
                
                <div class="relative w-full aspect-[4/3] bg-gray-100 overflow-hidden">
                    <img src="{{ Storage::url($project->project_image) }}" alt="{{ $project->student_name }}"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60 pointer-events-none"></div>

                    <div class="absolute top-3 left-3 z-10">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white/90 backdrop-blur-md text-[10px] font-bold text-[#0f5132] uppercase border border-gray-100">
                            {{ $project->project_type }}
                        </span>
                    </div>

                    <div class="absolute top-3 right-3 z-20 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="w-9 h-9 flex items-center justify-center bg-white text-gray-700 rounded-full hover:text-[#0f5132] shadow-md transition">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" onclick="prepareDelete('{{ route('admin.projects.destroy', $project->id) }}')"
                            class="w-9 h-9 flex items-center justify-center bg-white text-red-500 rounded-full hover:bg-red-50 shadow-md transition">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                            {{ $project->created_at->format('d M Y') }}
                        </span>
                        <span class="text-[10px] text-gray-300 font-mono">#{{ $project->id }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-[#0f5132] transition-colors line-clamp-1">
                        {{ $project->student_name }}
                    </h3>
                    <p class="text-xs text-gray-500 mt-1 line-clamp-1">
                        {{ $project->getTranslation('project_type', 'id') }}
                    </p>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <i class="bi bi-code-slash text-4xl text-gray-200"></i>
                <h3 class="text-lg font-bold text-gray-800 mt-4">Belum ada Project</h3>
                <p class="text-gray-500 text-sm mt-1">Gunakan kata kunci lain atau tambah project baru.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $projects->links() }}
    </div>
</div>