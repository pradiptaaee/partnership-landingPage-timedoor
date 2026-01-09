@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-6 md:p-8 bg-gray-50 min-h-screen">
    
    <div class="max-w-7xl mx-auto">

        {{-- HEADER PAGE --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Student Projects</h1>
                <p class="text-gray-500 mt-1 text-sm">Manage showcase karya murid</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl shadow-sm hover:bg-blue-700 transition transform hover:-translate-y-0.5">
                <i class="bi bi-plus-lg"></i> <span>Tambah Project</span>
            </a>
        </div>

        {{-- FILTER SECTION --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
            <form action="{{ route('admin.projects.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    {{-- Search --}}
                    <div class="md:col-span-8">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">CARI PROJECT</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="bi bi-search text-gray-400"></i></div>
                            <input type="text" name="search" value="{{ request('search') }}" oninput="searchWithDebounce(this)" onfocus="var val=this.value; this.value=''; this.value= val;"
                                   class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition" 
                                   placeholder="Cari nama murid atau tipe project..." {{ request('search') ? 'autofocus' : '' }}>
                        </div>
                    </div>
                    {{-- Sort --}}
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">URUTKAN</label>
                        <select name="sort" onchange="this.form.submit()" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition cursor-pointer">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama Murid (A-Z)</option>
                            <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama Murid (Z-A)</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="mb-8 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3 animate-fade-in-down">
                <i class="bi bi-check-circle-fill text-xl"></i> <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- GRID SYSTEM --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
            
            {{-- CARD START --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg transition duration-300 flex flex-col h-full overflow-hidden group">
                
                {{-- 1. IMAGE AREA --}}
                <div class="relative w-full aspect-[4/3] bg-gray-100 overflow-hidden border-b border-gray-100">
                    <img src="{{ Storage::url($project->project_image) }}" alt="{{ $project->student_name }}" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    
                    {{-- Badge di Pojok Kiri Atas --}}
                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-sm flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-xs font-bold text-gray-700 tracking-wide">{{ $project->project_type }}</span>
                    </div>
                </div>

                {{-- 2. CONTENT AREA --}}
                <div class="p-5 flex-1 flex flex-col justify-center">
                    {{-- Judul (Nama Murid) --}}
                    <h3 class="text-lg font-bold text-gray-900 line-clamp-1 group-hover:text-blue-600 transition">
                        {{ $project->student_name }}
                    </h3>
                    
                    {{-- Meta Info --}}
                    <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider mt-2">
                        Diupdate {{ $project->updated_at->diffForHumans() }}
                    </p>
                </div>

                {{-- 3. ACTION BUTTONS  --}}
                <div class="p-5 pt-0 mt-auto flex gap-3">
                    {{-- Tombol Edit --}}
                    <a href="{{ route('admin.projects.edit', $project->id) }}" 
                    class="flex-1 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-yellow-50 hover:text-yellow-600 hover:border-yellow-200 transition text-center">
                        Edit
                    </a>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus project ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="w-full py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            {{-- CARD END --}}

            @empty
            <div class="col-span-full py-12 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-laptop text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada Project</h3>
                <p class="text-gray-500">Tambahkan showcase karya murid sekarang.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    let debounceTimer;
    function searchWithDebounce(input) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => { input.form.submit(); }, 800); 
    }
</script>
@endsection