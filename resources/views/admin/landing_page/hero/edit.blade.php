@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Hero Section</h1>
            <p class="text-gray-500 mt-1 text-sm">Upload gambar banner untuk 7 bahasa.</p>
        </div>
        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.hero.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-50 hover:text-[#0f5132] transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="w-full">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center">
                        <span class="bg-white border border-gray-200 text-[#0f5132] w-8 h-8 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-images text-sm"></i>
                        </span>
                        Upload Gambar Per Bahasa
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($hero->language_data as $lang)
                        <div class="border border-gray-200 rounded-xl p-4 hover:border-[#0f5132]/50 transition-colors bg-gray-50/30 group">
                            <div class="flex justify-between items-center mb-3">
                                <label for="{{ $lang->input_id }}" class="font-bold text-gray-700 text-sm cursor-pointer hover:text-[#0f5132]">
                                    <span class="text-lg mr-1">{{ $lang->flag }}</span> {{ $lang->name }}
                                </label>
                                <span class="text-[10px] font-mono text-gray-400 uppercase bg-gray-100 px-1.5 py-0.5 rounded">{{ $lang->code }}</span>
                            </div>
                            
                            <div class="aspect-video bg-gray-200 rounded-lg overflow-hidden mb-3 relative border border-gray-300 shadow-inner">
                                @if ($lang->value)
                                    <img id="{{ $lang->preview_id }}" src="{{ asset('storage/' . $lang->value) }}" class="w-full h-full object-cover">
                                @else
                                    <img id="{{ $lang->preview_id }}" src="" class="w-full h-full object-cover hidden">
                                    <div id="{{ $lang->preview_id }}_placeholder" class="flex flex-col items-center justify-center h-full text-gray-400 p-4 text-center">
                                        <i class="fas fa-image text-2xl mb-2 opacity-50"></i>
                                        <span class="text-[10px]">Belum ada gambar.</span>
                                    </div>
                                @endif
                            </div>

                            <input type="file" 
                                   id="{{ $lang->input_id }}" 
                                   name="{{ $lang->col }}" 
                                   accept="image/*"
                                   class="block w-full text-xs text-slate-500
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-full file:border-0
                                   file:text-xs file:font-semibold
                                   file:bg-[#0f5132]/10 file:text-[#0f5132]
                                   hover:file:bg-[#0f5132]/20 cursor-pointer"
                                   onchange="LandingPage.previewHero(event, '{{ $lang->preview_id }}')">
                        </div>
                    @endforeach
                </div>

                <div class="p-6 border-t border-gray-100">
                    <button type="submit" class="w-full text-white bg-[#0f5132] hover:bg-[#0a3622] font-bold rounded-xl text-sm px-5 py-3.5 shadow-md flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Simpan Gambar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @vite('resources/js/admin/landing_page/app.js')
@endpush