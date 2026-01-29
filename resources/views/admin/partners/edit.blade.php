@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('content')
    {{-- CONTAINER UTAMA --}}
    <div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">

        {{-- HEADER PAGE --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
            <div>
                <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight mb-1">Edit Partner</h1>
                <p class="text-gray-500 text-sm">Perbarui informasi profil dan logo partner.</p>
            </div>

            <a href="{{ route('admin.partners.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-50 hover:text-[#0f5132] transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- CARD WRAPPER --}}
        <div
            class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
            <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col lg:flex-row h-full">
                @csrf
                @method('PUT')

                {{-- KOLOM KIRI: INPUT FORM --}}
                <div
                    class="w-full lg:w-7/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">

                    <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">

                        {{-- 1. Nama Partner --}}
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                Nama Partner <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $partner->name) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium"
                                placeholder="Masukkan nama partner" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 2. Kategori --}}
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="category" value="{{ old('category', $partner->category) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium"
                                placeholder="Contoh: Pemerintah, Swasta, NGO" required>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="email" value="{{ old('email', $partner->email) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                No Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $partner->no_telepon) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium">
                            @error('no_telepon')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 3. Deskripsi --}}
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                Deskripsi
                            </label>
                            <textarea name="description" rows="5"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm leading-relaxed resize-none"
                                placeholder="Jelaskan sedikit tentang partner ini...">{{ old('description', $partner->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- INFO BOX: KEGIATAN --}}
                        <div
                            class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center justify-between gap-4">
                            <div class="flex items-start gap-3">
                                <div class="shrink-0 mt-0.5 text-[#0f5132]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-[#0f5132] font-bold text-sm mb-0.5">Kegiatan Partner</h4>
                                    <p class="text-xs text-emerald-700">Lihat riwayat aktivitas partner ini.</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.activity.index', ['partner_id' => $partner->id]) }}"
                                class="text-xs font-bold text-[#0f5132] hover:underline whitespace-nowrap">
                                Lihat Kegiatan &rarr;
                            </a>
                        </div>

                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                        <a href="{{ route('admin.partners.index') }}"
                            class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 hover:text-gray-800 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>

                </div>

                {{-- KOLOM KANAN: LOGO & DANGER ZONE --}}
                {{-- Menggunakan background abu-abu muda agar logo (biasanya transparan/gelap) terlihat jelas --}}
                <div class="w-full lg:w-5/12 bg-gray-50 flex flex-col min-h-[400px] lg:min-h-auto border-l border-gray-100">

                    {{-- 1. UPLOAD AREA (Top Section) --}}
                    <div class="relative group flex-grow flex flex-col items-center justify-center p-8 overflow-hidden">

                        {{-- Hidden Input --}}
                        <input id="dropzone-file" name="logo" type="file" class="hidden" accept="image/*"
                            onchange="previewImage(event)" />

                        {{-- Trigger Label (Overlay) --}}
                        <label for="dropzone-file"
                            class="absolute inset-0 z-20 cursor-pointer flex flex-col items-center justify-center bg-white/80 opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm">
                            <div
                                class="w-16 h-16 mb-3 rounded-full bg-white shadow-md border border-gray-100 flex items-center justify-center text-[#0f5132] transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                            </div>
                            <span class="text-gray-800 font-bold text-lg tracking-tight">Ganti Logo</span>
                            <span class="text-gray-500 text-xs mt-1">Klik untuk upload file baru</span>
                        </label>

                        {{-- Image Container --}}
                        <div class="w-full h-full flex items-center justify-center p-4">
                            @if ($partner->logo)
                                <img id="preview-image" src="{{ asset('storage/' . $partner->logo) }}"
                                    class="max-w-full max-h-64 object-contain transition-all duration-500 group-hover:scale-95 group-hover:opacity-50">
                            @else
                                {{-- Placeholder jika tidak ada logo --}}
                                <div id="no-logo-placeholder" class="text-gray-300 flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    <span class="text-sm font-medium mt-2">Belum ada logo</span>
                                </div>
                                <img id="preview-image" src="" class="hidden max-w-full max-h-64 object-contain">
                            @endif
                        </div>

                        {{-- Status Indicator --}}
                        <div class="absolute bottom-6 left-0 right-0 text-center pointer-events-none">
                            <p
                                class="text-[10px] text-[#0f5132] font-bold uppercase tracking-wider inline-flex items-center gap-1 bg-white/50 px-2 py-1 rounded-full backdrop-blur-sm border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#0f5132] animate-pulse"></span>
                                Logo Saat Ini
                            </p>
                        </div>
                    </div>

                    {{-- 2. DANGER ZONE (Bottom Section) --}}
                    <div class="p-6 bg-white border-t border-gray-100">
                        <h4 class="text-xs font-bold text-red-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                            Danger Zone
                        </h4>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">
                            Menghapus partner akan menghapus semua <strong>kegiatan</strong> yang terkait secara permanen.
                        </p>
                        <button type="button" onclick="confirmDelete()"
                            class="w-full px-4 py-2.5 rounded-lg border border-red-100 bg-red-50 text-red-600 text-sm font-bold hover:bg-red-100 hover:text-red-700 transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456-3.834a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Hapus Partner
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>

    {{-- Hidden Delete Form --}}
    <form id="deleteForm" action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="hidden">
        @csrf @method('DELETE')
    </form>

    {{-- SCRIPT --}}
    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.getElementById('preview-image');
                    const placeholder = document.getElementById('no-logo-placeholder');

                    if (placeholder) placeholder.classList.add('hidden');

                    img.classList.remove('hidden');
                    img.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmDelete() {
            if (confirm(
                    'Apakah Anda yakin ingin menghapus partner ini?\n\nSemua kegiatan terkait juga akan terhapus permanen!'
                    )) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #e5e7eb;
            border-radius: 20px;
        }
    </style>
@endsection
