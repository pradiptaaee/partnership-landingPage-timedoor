@extends('layouts.admin')

@section('title', $activity->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="bi bi-calendar-event text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $activity->title }}</h1>
                    <p class="text-gray-600 mt-1">Detail kegiatan partner</p>
                </div>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.activity.edit', $activity->id) }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold rounded-lg transition-all duration-200 border border-amber-200 hover:border-amber-300 shadow-sm hover:shadow-md">
                <i class="bi bi-pencil-square"></i>
                Edit
            </a>
            <a href="{{ route('admin.activity.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Featured Image --}}
            @if($activity->featured_image)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-6 py-4 border-b border-purple-200">
                    <h3 class="text-lg font-semibold text-purple-900 flex items-center">
                        <i class="bi bi-image-fill mr-2"></i>
                        Gambar Utama
                    </h3>
                </div>
                <div class="p-6">
                    <div class="relative group">
                        <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}"
                             class="w-full rounded-xl shadow-md"
                             alt="{{ $activity->title }}">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-300 rounded-xl"></div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Deskripsi Lengkap --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-900 flex items-center">
                        <i class="bi bi-file-text-fill mr-2"></i>
                        Deskripsi Lengkap
                    </h3>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($activity->full_description)) !!}
                    </div>
                </div>
            </div>

            {{-- Gallery Photos --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-50 to-green-100 px-6 py-4 border-b border-green-200">
                    <h3 class="text-lg font-semibold text-green-900 flex items-center">
                        <i class="bi bi-images mr-2"></i>
                        Foto Kegiatan ({{ $activity->photos->count() }})
                    </h3>
                </div>
                <div class="p-6">
                    @if($activity->photos->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($activity->photos as $photo)
                                <div class="relative group cursor-pointer">
                                    <img src="{{ asset('storage/activity/photos/' . $photo->image_path) }}"
                                         class="w-full h-48 object-cover rounded-xl border-2 border-gray-200 group-hover:border-green-300 transition-all duration-300 shadow-sm group-hover:shadow-md"
                                         alt="Photo {{ $loop->iteration }}"
                                         onclick="openLightbox('{{ asset('storage/activity/photos/' . $photo->image_path) }}')">
                                    
                                    {{-- Overlay on hover --}}
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 rounded-xl flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <div class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                <i class="bi bi-zoom-in text-gray-800 text-xl"></i>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Photo number badge --}}
                                    <div class="absolute top-2 left-2 bg-gray-900/80 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs font-semibold">
                                        {{ $loop->iteration }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-3">
                                <i class="bi bi-image text-3xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-500">Tidak ada foto tambahan</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1 space-y-6">
            
            {{-- Informasi Utama --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 border-b border-indigo-200">
                    <h3 class="text-lg font-semibold text-indigo-900 flex items-center">
                        <i class="bi bi-info-circle-fill mr-2"></i>
                        Informasi Kegiatan
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    {{-- Partner --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Partner</label>
                        <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg border border-green-200">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-building text-white text-lg"></i>
                            </div>
                            <span class="font-semibold text-green-900">{{ $activity->partner->name ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal Kegiatan</label>
                        <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-calendar-event text-white text-lg"></i>
                            </div>
                            <span class="font-semibold text-blue-900">{{ \Carbon\Carbon::parse($activity->activity_date)->format('d F Y') }}</span>
                        </div>
                    </div>

                    {{-- Deskripsi Singkat --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi Singkat</label>
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-700 leading-relaxed">{{ $activity->short_description }}</p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-200 my-4"></div>

                    {{-- Metadata --}}
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Dibuat:</span>
                            <span class="font-medium text-gray-900">{{ $activity->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Diupdate:</span>
                            <span class="font-medium text-gray-900">{{ $activity->updated_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Jumlah Foto:</span>
                            <span class="inline-flex items-center px-2.5 py-1 bg-purple-100 text-purple-700 font-semibold rounded-lg text-xs">
                                {{ $activity->photos->count() }} foto
                            </span>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                    <a href="{{ route('admin.activity.edit', $activity->id) }}" 
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-lg hover:from-amber-600 hover:to-amber-700 shadow-md hover:shadow-lg transition-all duration-200">
                        <i class="bi bi-pencil-square"></i>
                        Edit Kegiatan
                    </a>
                    
                    <button type="button"
                            onclick="confirmDelete()"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 shadow-md hover:shadow-lg transition-all duration-200">
                        <i class="bi bi-trash3-fill"></i>
                        Hapus Kegiatan
                    </button>
                </div>
                </div>
            </div>

            {{-- Quick Actions --}}


        </div>
    </div>
</div>

{{-- Lightbox Modal --}}
<div id="lightbox" class="hidden fixed inset-0 bg-black/90 backdrop-blur-sm z-50 flex items-center justify-center p-4" onclick="closeLightbox()">
    <button class="absolute top-6 right-6 w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white rounded-full flex items-center justify-center transition-colors duration-200">
        <i class="bi bi-x-lg text-2xl"></i>
    </button>
    <img id="lightbox-img" src="" class="max-w-full max-h-full rounded-lg shadow-2xl" onclick="event.stopPropagation()">
</div>

{{-- Delete Form --}}
<form id="deleteForm" action="{{ route('admin.activity.destroy', $activity->id) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endsection