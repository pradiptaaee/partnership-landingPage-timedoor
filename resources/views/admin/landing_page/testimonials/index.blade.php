@extends('layouts.admin') 

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans">
    
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-4 pb-6 border-b border-gray-100">
            <div>
                <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight">Testimoni</h1>
                <p class="text-gray-500 text-sm mt-1">Apa kata orang tua tentang pengalaman belajar di Academy?</p>
            </div>
            
            <a href="{{ route('admin.testimonials.create') }}" 
               class="group inline-flex items-center gap-2 px-6 py-2.5 bg-[#0f5132] text-white text-sm font-semibold rounded-full shadow-lg shadow-emerald-900/10 hover:shadow-emerald-900/20 transition-all duration-300">
                <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <span>Tambah Testimoni</span>
            </a>
        </div>

        {{-- 2. TOOLBAR (Search & Sort) --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
            
            {{-- Search Input --}}
            <div class="relative w-full sm:w-72 group">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       oninput="searchWithDebounce(this)"
                       placeholder="Cari nama orang tua..."
                       class="w-full pl-0 pr-8 py-2 bg-transparent border-b-2 border-gray-100 focus:border-[#0f5132] outline-none text-sm transition-colors placeholder-gray-400 group-hover:border-gray-200">
                <i class="bi bi-search absolute right-0 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            {{-- Sort Dropdown --}}
            <div class="relative">
                <form id="sortForm" action="{{ route('admin.testimonials.index') }}" method="GET">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <select name="sort" onchange="this.form.submit()" 
                            class="appearance-none pl-4 pr-10 py-2 bg-gray-50 border border-gray-100 rounded-full text-sm font-medium text-gray-600 focus:ring-1 focus:ring-[#0f5132] focus:border-[#0f5132] cursor-pointer outline-none hover:bg-gray-100 transition">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama (Z-A)</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </form>
            </div>
        </div>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 flex items-center gap-3 animate-fadeIn">
                <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>
                <div>
                    <h4 class="text-sm font-bold">Berhasil</h4>
                    <p class="text-xs opacity-90">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-600 hover:text-emerald-800 transition">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @endif

        {{-- 3. TESTIMONIAL GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse($testimonials as $item)
            {{-- CARD ITEM --}}
            <div class="group relative bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_30px_rgba(0,0,0,0.06)] transition-all duration-300 flex flex-col h-full">
                
                {{-- Quick Actions (Floating Top Right) --}}
                <div class="absolute top-4 right-4 z-10 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="{{ route('admin.testimonials.edit', $item->id) }}" 
                       class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-600 rounded-full hover:bg-[#0f5132] hover:text-white transition shadow-sm"
                       title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                    </a>
                    
                    <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="w-8 h-8 flex items-center justify-center bg-gray-50 text-red-400 rounded-full hover:bg-red-50 hover:text-red-600 transition shadow-sm"
                                title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456-3.834a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                        </button>
                    </form>
                </div>

                {{-- PROFILE HEADER --}}
                <div class="flex items-center gap-4 mb-6 relative">
                    <div class="relative w-14 h-14 shrink-0">
                        <img src="{{ Storage::url($item->parent_image) }}" 
                             alt="{{ $item->parent_name }}"
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
                    {{-- Decorative Icon --}}
                    <svg class="absolute -top-3 -left-1 w-8 h-8 text-gray-100 transform -scale-x-100" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z" />
                    </svg>
                    
                    <p class="relative z-10 text-sm text-gray-600 italic leading-relaxed line-clamp-4">
                        "{{ $item->review }}"
                    </p>
                </div>

                {{-- FOOTER INFO --}}
                <div class="pt-4 border-t border-gray-50 flex items-center justify-between mt-auto">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2 py-1 rounded text-[10px] font-bold bg-emerald-50 text-[#0f5132] border border-emerald-100 uppercase tracking-wide">
                            {{ $item->course_name ?? 'General' }}
                        </span>
                    </div>
                    <span class="text-[10px] font-medium text-gray-300">#{{ $item->id }}</span>
                </div>
            </div>
            
            @empty
            {{-- EMPTY STATE --}}
            <div class="col-span-full py-20 text-center mt-4">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full text-gray-300 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-1">Belum ada Testimoni</h3>
                <p class="text-gray-500 text-sm">Silakan tambahkan data baru.</p>
                @if(request('search'))
                    <a href="{{ route('admin.testimonials.index') }}" class="mt-4 text-[#0f5132] font-semibold text-sm hover:underline block">Reset Pencarian</a>
                @endif
            </div>
            @endforelse

        </div>
    </div>
</div>

<script>
    let debounceTimer;
    function searchWithDebounce(input) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => { 
            const form = document.getElementById('sortForm');
            let hiddenInput = form.querySelector('input[name="search"]');
            if (!hiddenInput) {
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'search';
                form.appendChild(hiddenInput);
            }
            hiddenInput.value = input.value;
            form.submit(); 
        }, 600); 
    }
</script>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
</style>
@endsection