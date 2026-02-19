@extends('layouts.admin')

@section('content')
<div class="container py-4">
    {{-- Breadcrumb & Header --}}
    <div class="mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex items-center mb-2">
                <li class="breadcrumb-item"><a href="{{ route('admin.activity.index') }}" class="text-decoration-none text-[#0f5132]">Activities</a></li>
                <li> / </li>
                <li class="breadcrumb-item active text-gray-400" aria-current="page">Detail Kegiatan</li>
            </ol>
        </nav>
        <div class="w-full flex justify-between items-end">
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-0">{{ $activity->title }}</h2>
                <div class="flex gap-4 mt-2">
                    <span class="text-xs font-bold text-[#0f5132] uppercase tracking-wider bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100">
                        <i class="bi bi-tag-fill me-1"></i> {{ $activity->category_activity }}
                    </span>
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
                        <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($activity->activity_date)->format('d F Y') }}
                    </span>
                </div>
            </div>
            <a href="{{ route('admin.activity.index') }}" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-gray-600 text-sm font-bold shadow-sm hover:bg-gray-50 transition flex items-center gap-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden">
        <div class="flex flex-col lg:flex-row h-full">
            
            {{-- KOLOM KIRI: Informasi Detail --}}
            <div class="w-full lg:w-7/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">
                <div class="space-y-8 flex-grow custom-scrollbar">
                    
                    {{-- Detail Partner --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-3">Partner Pelaksana</label>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            @if($activity->partner && $activity->partner->logo)
                                <img src="{{ asset('storage/' . $activity->partner->logo) }}" class="w-12 h-12 rounded-lg object-contain bg-white p-1 border border-gray-200">
                            @else
                                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center border border-gray-200 text-gray-400">
                                    <i class="bi bi-building"></i>
                                </div>
                            @endif
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 mb-0">{{ $activity->partner->name ?? 'Internal / Partner Tidak Ditemukan' }}</h4>
                                <p class="text-[10px] text-gray-500 uppercase tracking-tighter">{{ $activity->partner->category ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi Tambahan Seminar --}}
@if($activity->seminarDetail)
<div>
    <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-3">
        Detail Seminar
    </label>

    <div class="p-6 bg-emerald-50 rounded-2xl border border-emerald-100">

        <div class="flex flex-col md:flex-row gap-6 items-start">

            {{-- FOTO --}}
            @if($activity->seminarDetail->speaker_photo)
                <div class="w-32 h-32 flex-shrink-0">
                    <img 
                        src="{{ asset('storage/activity/speakers/' . $activity->seminarDetail->speaker_photo) }}"
                        class="w-full h-full object-cover rounded-xl border border-emerald-200 shadow-sm"
                        alt="Foto Pembicara"
                    >
                </div>
            @endif

            {{-- INFO --}}
            <div class="flex-1 space-y-3">

                @if($activity->seminarDetail->speaker_name)
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase tracking-wider">
                            Pembicara
                        </span>
                        <p class="text-sm font-bold text-gray-800">
                            {{ $activity->seminarDetail->speaker_name }}
                        </p>
                    </div>
                @endif

                @if($activity->seminarDetail->speaker_about)
                    <div>
                        <span class="text-[10px] text-gray-400 uppercase tracking-wider">
                            Tentang Pembicara
                        </span>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            {{ $activity->seminarDetail->speaker_about }}
                        </p>
                    </div>
                @endif

            </div>

        </div>

    </div>
</div>
@endif
 

{{-- Deskripsi Tambahan Workshop --}}
@if($activity->workshopDetail)
<div>
    <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-3">
        Detail Workshop
    </label>

    <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100 space-y-3">
        
        @if($activity->workshopDetail->mentor_name)
            <div>
                <span class="text-[10px] text-gray-400 uppercase">Mentor</span>
                <p class="text-sm font-semibold text-gray-800">
                    {{ $activity->workshopDetail->mentor_name }}
                </p>
            </div>
        @endif

        @if($activity->workshopDetail->description)
            <div>
                <span class="text-[10px] text-gray-400 uppercase">Deskripsi Tambahan</span>
                <p class="text-sm text-gray-700">
                    {{ $activity->workshopDetail->description }}
                </p>
            </div>
        @endif

    </div>
</div>
@endif



                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-3">Deskripsi Lengkap</label>
                        <div class="text-sm text-gray-600 leading-relaxed space-y-4">
                            {!! nl2br(e($activity->full_description)) !!}
                        </div>
                    </div>

                    {{-- Info Tambahan (Sesuai extra form) --}}
                    @if(isset($activity->location) || isset($activity->speaker))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($activity->location)
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Lokasi</label>
                            <span class="text-sm font-semibold text-gray-800"><i class="bi bi-geo-alt me-2 text-[#0f5132]"></i>{{ $activity->location }}</span>
                        </div>
                        @endif
                        @if($activity->speaker)
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Pembicara / Mentor</label>
                            <span class="text-sm font-semibold text-gray-800"><i class="bi bi-person me-2 text-[#0f5132]"></i>{{ $activity->speaker }}</span>
                        </div>
                        @endif
                    </div>
                    @endif

                </div>

                {{-- ACTION BUTTONS --}}
                
            </div>

            {{-- KOLOM KANAN: Media (Cover & Gallery) --}}
            <div class="w-full lg:w-5/12 bg-gray-50 overflow-y-auto custom-scrollbar flex flex-col p-8">
                
                {{-- Featured Image --}}
                <div class="mb-8">
                    <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-4">Gambar Utama</label>
                    <div class="relative w-full aspect-video bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                        @if($activity->featured_image)
                            <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                <i class="bi bi-image text-4xl mb-2"></i>
                                <span class="text-xs uppercase font-bold tracking-widest">No Cover Image</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Gallery flex --}}
                <div>
                    <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-4">Galeri Dokumentasi</label>
                    @if($activity->photos && count($activity->photos) > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($activity->photos as $photo)
                                <div class="relative group w-20 h-20 bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm flex-shrink-0">
                                    <img src="{{ asset('storage/activity/photos/' . $photo->image_path) }}"
                                    onclick="viewImage('{{ asset('storage/activity/photos/' . $photo->image_path) }}')"
      
                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110 cursor-pointer">
                                </div>
                            @endforeach
                        </div>
                        <p class="mt-3 text-[10px] text-gray-400 italic font-medium">* Klik gambar untuk memperbesar (jika tersedia lightbox)</p>
                    @else
                        <div class="p-6 bg-white rounded-2xl border border-dashed border-gray-200 text-center">
                            <i class="bi bi-images text-gray-300 text-2xl mb-2"></i>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Belum ada foto galeri</p>
                        </div>
                    @endif
                </div>

                {{-- System Log Info --}}
                <div class="mt-auto pt-8">
                    <div class="p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[10px] font-bold text-gray-400 uppercase">Input Oleh</span>
                            <span class="text-xs font-bold text-gray-700">Administrator</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold text-gray-400 uppercase">ID System</span>
                            <span class="text-xs font-mono text-gray-500">ACT-{{ str_pad($activity->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


@endsection