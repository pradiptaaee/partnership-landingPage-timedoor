@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-6 md:p-8 bg-gray-50 min-h-screen">
    
    <div class="max-w-7xl mx-auto">

        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Testimoni Orang Tua</h1>
                <p class="text-gray-500 mt-1 text-sm">Apa kata mereka tentang Timedoor Academy?</p>
            </div>

            <a href="{{ route('admin.testimonials.create') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl shadow-sm hover:bg-blue-700 transition transform hover:-translate-y-0.5">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Testimoni</span>
            </a>
        </div>

        {{-- 2. FILTER SECTION (SEARCH & SORT) --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
            <form action="{{ route('admin.testimonials.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    
                    {{-- Input Cari --}}
                    <div class="md:col-span-8">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                            CARI TESTIMONI
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-search text-gray-400 group-focus-within:text-blue-500 transition"></i>
                            </div>
                            
                            {{-- Input Search dengan Debounce JS --}}
                            <input type="text" 
                                   name="search" 
                                   id="searchInput"
                                   value="{{ request('search') }}"
                                   oninput="searchWithDebounce(this)" 
                                   onfocus="var val=this.value; this.value=''; this.value= val;"
                                   class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition duration-200" 
                                   placeholder="Cari nama orang tua atau murid..."
                                   {{ request('search') ? 'autofocus' : '' }}>
                        </div>
                    </div>

                    {{-- Input Sort  --}}
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                            URUTKAN
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="bi bi-sort-down text-gray-400"></i>
                            </div>
                            
                            {{-- Dropdown Sort --}}
                            <select name="sort" onchange="this.form.submit()" class="w-full pl-11 pr-10 py-3 rounded-xl border border-gray-200 text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition duration-200 appearance-none cursor-pointer">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama (A-Z)</option>
                                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama (Z-A)</option>
                            </select>
                            
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="bi bi-chevron-down text-xs text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="mb-8 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3 animate-fade-in-down">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- 3. GRID CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @forelse($testimonials as $item)
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-lg hover:border-blue-200 transition duration-300 flex flex-col h-full">
                
                {{-- BAGIAN 1: HEADER & PROFIL --}}
                <div class="p-6 pb-0">
                    <div class="flex items-center gap-4 mb-4">
                        {{-- Foto Profil --}}
                        <div class="w-14 h-14 shrink-0 rounded-full border-2 border-gray-100 overflow-hidden group-hover:border-blue-200 transition">
                            <img src="{{ Storage::url($item->parent_image) }}" class="w-full h-full object-cover">
                        </div>
                        {{-- Nama & Info --}}
                        <div>
                            <h4 class="font-bold text-gray-900 line-clamp-1 group-hover:text-blue-600 transition">
                                {{ $item->parent_name }}
                            </h4>
                            <p class="text-xs text-gray-500">{{ $item->student_name ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- BAGIAN 2: CONTENT & BADGE --}}
                <div class="px-6 flex-1 flex flex-col">
                    {{-- Review Text --}}
                    <div class="relative pl-4 border-l-2 border-blue-100 mb-4">
                        <i class="bi bi-quote text-2xl text-blue-100 absolute -top-3 -left-2"></i>
                        <p class="text-gray-600 text-sm italic line-clamp-3 leading-relaxed relative z-10">
                            "{{ $item->review }}"
                        </p>
                    </div>

                    {{-- Badge Course (Dipindah ke sini agar rapi) --}}
                    <div class="mt-auto mb-6">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 text-gray-600 text-[10px] font-bold uppercase rounded-lg tracking-wide group-hover:bg-blue-50 group-hover:text-blue-600 transition">
                            <i class="bi bi-mortarboard-fill"></i>
                            {{ $item->course_name ?? 'General' }}
                        </span>
                    </div>
                </div>

                {{-- BAGIAN 3: TOMBOL AKSI  --}}
                <div class="p-6 pt-0 mt-auto grid grid-cols-2 gap-3">
                    
                    {{-- Tombol Edit --}}
                    <a href="{{ route('admin.testimonials.edit', $item->id) }}" 
                    class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-yellow-50 hover:text-yellow-700 hover:border-yellow-200 transition duration-200 font-semibold text-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus testimoni dari {{ $item->parent_name }}?')" class="w-full">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition duration-200 font-semibold text-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>

            </div>
            @empty
            {{-- Empty State --}}
            <div class="col-span-full py-12 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-chat-quote text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada Testimoni</h3>
                <p class="text-gray-500 mb-6">Data tidak ditemukan. Silakan tambah data baru.</p>
                @if(request('search'))
                    <a href="{{ route('admin.testimonials.index') }}" class="text-blue-600 hover:underline text-sm">Reset Pencarian</a>
                @endif
            </div>
            @endforelse

        </div>
    </div>
</div>

{{-- SCRIPT DEBOUNCE UNTUK SEARCH --}}
<script>
    let debounceTimer;
    function searchWithDebounce(input) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            input.form.submit();
        }, 800); 
    }
</script>
@endsection