@extends('layouts.admin')

@section('content')
<div class="p-6">
    
    {{-- HEADER: JUDUL & TOMBOL EDIT --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Preview Hero Section</h1>
            <p class="text-gray-500 text-sm mt-1">Tampilan data banner utama yang saat ini aktif di website.</p>
        </div>
        
        <a href="{{ route('admin.hero.edit') }}" 
           class="inline-flex items-center px-6 py-3 bg-[#0f5132] hover:bg-[#0a3622] text-white font-bold rounded-xl shadow-lg transform hover:-translate-y-0.5 transition-all">
            <i class="fas fa-edit mr-2"></i> Edit Gambar
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-6 text-[#0f5132] bg-[#0f5132]/10 border border-[#0f5132]/20 rounded-xl flex items-center">
            <i class="fas fa-check-circle mr-3 text-xl"></i> {{ session('success') }}
        </div>
    @endif

    {{-- KITA HAPUS GRID DAN KOLOM TEKS. LANGSUNG TAMPILKAN GAMBAR FULL WIDTH --}}
    
    <div class="w-full">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h2 class="font-bold text-gray-800 flex items-center">
                    <i class="fas fa-images mr-3 text-[#0f5132]"></i> Gambar Multi-Bahasa
                </h2>
                {{-- Menampilkan Info Update Terakhir disini --}}
                <span class="text-xs text-gray-400 font-mono">
                    Update Terakhir: {{ $hero->updated_at->format('d M Y, H:i') }}
                </span>
            </div>
            
            <div class="p-6">
                {{-- Grid diperbesar jadi 4 kolom karena layarnya sekarang full --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @php
                        $languages = [
                            ['code' => 'id', 'name' => 'Indonesia', 'flag' => '🇮🇩'],
                            ['code' => 'en', 'name' => 'Inggris (Default)', 'flag' => '🇺🇸'],
                            ['code' => 'ja', 'name' => 'Jepang', 'flag' => '🇯🇵'],
                            ['code' => 'ar', 'name' => 'Arab', 'flag' => '🇸🇦'],
                            ['code' => 'bn', 'name' => 'Bengali', 'flag' => '🇧🇩'],
                            ['code' => 'fil', 'name' => 'Filipino', 'flag' => '🇵🇭'],
                            ['code' => 'ms', 'name' => 'Melayu', 'flag' => '🇲🇾'],
                        ];
                    @endphp

                    @foreach ($languages as $lang)
                        @php 
                            $col = 'image_' . $lang['code']; 
                            $imagePath = $hero->{$col};
                            // Cek status strict (tanpa fallback) agar admin tahu mana yang kosong
                            $statusClass = $imagePath ? 'border-[#0f5132] bg-[#0f5132]/5' : 'border-gray-200 bg-gray-50';
                            $statusText = $imagePath ? 'Terupload' : 'Kosong (Akan pakai Placeholder)';
                            $statusColor = $imagePath ? 'text-[#0f5132]' : 'text-gray-300';
                        @endphp

                        <div class="border rounded-xl p-3 {{ $statusClass }} transition hover:shadow-md flex flex-col">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-700 text-sm flex items-center gap-2">
                                    <span class="text-lg">{{ $lang['flag'] }}</span> {{ $lang['name'] }}
                                </span>
                                <i class="fas fa-check-circle {{ $statusColor }} text-xs" title="{{ $statusText }}"></i>
                            </div>
                            
                            <div class="aspect-video bg-gray-200 rounded-lg overflow-hidden relative group border border-gray-300">
                                @if ($imagePath)
                                    {{-- Tampilkan Gambar --}}
                                    <img src="{{ asset('storage/' . $imagePath) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                    
                                    {{-- PERUBAHAN DISINI: --}}
                                    {{-- Kita ubah DIV overlay menjadi A (Link) agar bisa diklik --}}
                                    <a href="{{ asset('storage/' . $imagePath) }}" target="_blank" 
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center cursor-pointer z-10">
                                        <span class="text-white text-xs font-bold px-3 py-1.5 border border-white rounded-full hover:bg-white hover:text-black transition-colors">
                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Gambar
                                        </span>
                                    </a>

                                @else
                                    {{-- Tampilan jika kosong --}}
                                    <div class="flex flex-col items-center justify-center h-full text-gray-400 p-2 text-center">
                                        <i class="fas fa-image text-2xl mb-1 opacity-20"></i>
                                        <span class="text-[10px]">Belum ada gambar</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection