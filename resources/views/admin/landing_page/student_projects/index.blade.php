@extends('layouts.admin')

@section('content')
<div class="flex-1 p-8 bg-white min-h-screen font-sans">
    {{-- Komponen Livewire --}}
    @livewire('admin.project-index')
</div>

{{-- MODAL HAPUS: Gaya Konsisten --}}
<div id="deleteModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-white w-full max-w-sm p-10 text-center animate-fadeIn shadow-2xl rounded-none">
        
        <h3 id="deleteModalTitle" class="text-xl font-black text-[#0f172a] mb-2 uppercase tracking-tight">Hapus Project?</h3>
        <p class="text-sm text-gray-400 mb-8 font-medium">Tindakan ini permanen. Lanjutkan?</p>

        <div class="flex flex-col gap-3">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-4 bg-[#e10000] text-white text-xs font-black tracking-[0.2em] uppercase hover:bg-red-700 transition-colors rounded-none">
                    YA, HAPUS
                </button>
            </form>

            <button onclick="BannerManager.closeModal()" class="w-full py-4 border border-gray-100 text-[#0f172a] text-xs font-black tracking-[0.2em] uppercase hover:bg-gray-50 transition-colors rounded-none">
                BATAL
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/admin/landing_page/app.js')
@endpush