@extends('layouts.admin')

@section('title', 'Tambah Kegiatan Partner')

@section('content')
    {{-- CONTAINER UTAMA --}}
    <div class="flex-1 p-8 bg-white min-h-screen font-sans flex flex-col">

        {{-- HEADER PAGE --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 shrink-0">
            <div>
                <nav class="flex mb-1" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.activity.index') }}"
                                class="text-xs font-medium text-gray-500 hover:text-[#0f5132]">
                                Kegiatan
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-gray-400 text-xs mx-1"></i>
                                <span class="text-xs font-medium text-gray-400">Buat Baru</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-bold text-[#0f5132] tracking-tight">Tambah Kegiatan</h1>
                <p class="text-gray-500 text-sm mt-1">Dokumentasikan aktivitas partner secara detail.</p>
            </div>

            <a href="{{ route('admin.activity.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-50 hover:text-[#0f5132] transition shadow-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- CARD FORM WRAPPER --}}
        <div
            class="flex-grow bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col">

            <form action="{{ route('admin.activity.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col lg:flex-row h-full">
                @csrf

                {{-- KOLOM KIRI: Input Form --}}
                <div
                    class="w-full lg:w-7/12 p-8 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col h-full bg-white">

                    <div class="space-y-6 flex-grow overflow-y-auto pr-2 custom-scrollbar">

                        {{-- 1. Partner Selection -path: --}}
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                Pilih Partner <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="partner_id"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium appearance-none cursor-pointer"
                                    required>
                                    <option value="">-- Pilih Partner --</option>
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}"
                                            {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                                            {{ $partner->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i
                                    class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>
                            @error('partner_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 2. Judul & Tanggal (Grid) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                    Judul Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium"
                                    placeholder="Contoh: Workshop Digital" required>
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                    Tanggal Pelaksanaan <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="activity_date" value="{{ old('activity_date') }}"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm font-medium"
                                    required>
                                @error('activity_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="category_activity" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kategori Kegiatan <span class="text-red-500">*</span>
                            </label>

                            <input type="text" id="category_activity" name="category_activity"
                                value="{{ old('category_activity') }}" placeholder="contoh: seminar, workshop, event"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800
               focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132]
               outline-none transition text-sm font-medium"
                                required>

                            @error('category_activity')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EXTRA FIELD: SEMINAR --}}
                        @include('admin.activity.extraForm.seminar')
                        @include('admin.activity.extraForm.workshop')



                        {{-- 4. Deskripsi Lengkap --}}
                        <div>
                            <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-2">
                                Deskripsi Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea name="full_description" id="full_description" rows="6"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0f5132] focus:ring-1 focus:ring-[#0f5132] outline-none transition text-sm leading-relaxed"
                                placeholder="Jelaskan detail kegiatan, tujuan, dan hasil yang dicapai..." required>{{ old('full_description') }}</textarea>
                            @error('full_description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- INFO BOX: PANDUAN --}}
                        <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex gap-3 items-start">
                            <i class="bi bi-info-circle-fill text-[#0f5132] mt-0.5"></i>
                            <div>
                                <h4 class="text-[#0f5132] font-bold text-sm mb-1">Tips Pengisian</h4>
                                <p class="text-xs text-emerald-700 leading-relaxed">
                                    Pastikan deskripsi menarik dan informatif. Foto yang diupload sebaiknya memiliki
                                    orientasi landscape (16:9) untuk hasil terbaik.
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="pt-6 mt-6 border-t border-gray-100 flex gap-3 shrink-0">
                        <a href="{{ route('admin.activity.index') }}"
                            class="flex-1 px-4 py-3 rounded-lg border border-gray-200 text-gray-600 text-sm font-bold text-center hover:bg-gray-50 hover:text-gray-800 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 px-4 py-3 rounded-lg bg-[#0f5132] text-white text-sm font-bold shadow-md hover:bg-[#0b3d26] transition flex items-center justify-center gap-2">
                            <i class="bi bi-save"></i> Simpan Kegiatan
                        </button>
                    </div>

                </div>

                {{-- KOLOM KANAN: Upload Media --}}
                <div
                    class="w-full lg:w-5/12 bg-gray-50 border-l border-gray-100 overflow-y-auto custom-scrollbar flex flex-col">

                    {{-- 1. FEATURED IMAGE --}}
                    <div class="p-8 border-b border-gray-100">
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-4">
                            Gambar Utama (Cover)
                        </label>

                        <div
                            class="relative group w-full aspect-video bg-white rounded-2xl border-2 border-dashed border-gray-300 hover:border-[#0f5132] hover:bg-emerald-50/30 transition-all duration-300 overflow-hidden flex items-center justify-center">

                            <input type="file" id="featured_image" name="featured_image" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
                                onchange="previewFeaturedImage(event)">

                            {{-- Prompt --}}
                            <div id="featured_prompt" class="text-center p-6">
                                <div
                                    class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400 group-hover:bg-white group-hover:text-[#0f5132] transition shadow-sm">
                                    <i class="bi bi-image text-3xl"></i>
                                </div>
                                <p class="text-sm font-semibold text-gray-600 group-hover:text-[#0f5132]">Upload Cover</p>
                                <p class="text-[10px] text-gray-400 mt-1">JPG/PNG, Max 2MB</p>
                            </div>

                            {{-- Preview --}}
                            <img id="featured_preview_img" src="#" class="hidden w-full h-full object-cover z-10">
                        </div>
                        @error('featured_image')
                            <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 2. GALLERY PHOTOS --}}
                    <div class="p-8 flex-grow">
                        <label class="block text-xs font-bold text-[#0f5132] uppercase tracking-wider mb-4">
                            Galeri Foto (Multiple)
                        </label>

                        <div class="relative">
                            <label for="photos"
                                class="flex flex-col items-center justify-center w-full h-32 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-emerald-50/30 hover:border-[#0f5132] transition">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="bi bi-images text-2xl text-gray-400 mb-2"></i>
                                    <p class="text-xs text-gray-500"><span class="font-semibold">Klik untuk tambah</span>
                                        beberapa foto</p>
                                </div>
                                <input id="photos" name="photos[]" type="file" multiple accept="image/*"
                                    class="hidden" onchange="previewMultipleImages(event)" />
                            </label>
                        </div>
                        @error('photos.*')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror

                        {{-- Gallery Grid Preview --}}
                        <div id="gallery_preview_container" class="grid grid-cols-3 gap-2 mt-4">
                            {{-- JS will populate this --}}
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    <script>
        // document.addEventListener('DOMContentLoaded', () => {
        //     const categoryInput = document.getElementById('category_activity');
        //     const extraForms = document.querySelectorAll('.extra-form');

        //     // Definisi field mana saja yang wajib diisi (required) saat kategori dipilih
        //     const REQUIRED_FIELDS = {
        //         seminar: ['extra[speaker_name]', 'extra[speaker_about]'],
        //         workshop: ['extra[mentor_name]']
        //     };

        //     /**
        //      * Fungsi untuk menampilkan form tambahan berdasarkan kategori
        //      */
        //     function activateCategoryForm(category) {
        //         const cleanCategory = category.trim().toLowerCase();

        //         // 1. Sembunyikan semua extra form dan matikan status 'required' semua input di dalamnya
        //         extraForms.forEach(form => {
        //             form.classList.add('hidden');
        //             form.querySelectorAll('input, textarea').forEach(el => {
        //                 el.required = false;
        //             });
        //         });

        //         // 2. Cari form yang sesuai dengan data-category
        //         const targetForm = document.querySelector(`.extra-form[data-category="${cleanCategory}"]`);

        //         if (targetForm) {
        //             // Tampilkan form dengan animasi (pastikan class animate-fade-in ada di CSS)
        //             targetForm.classList.remove('hidden');

        //             // 3. Aktifkan 'required' hanya untuk field spesifik di kategori tersebut
        //             const fieldsToRequire = REQUIRED_FIELDS[cleanCategory] || [];
        //             fieldsToRequire.forEach(name => {
        //                 const field = targetForm.querySelector(`[name="${name}"]`);
        //                 if (field) {
        //                     field.required = true;

        //                     // Opsional: Tambahkan indikator visual (border merah jika kosong)
        //                     field.classList.add('border-emerald-200');
        //                 }
        //             });
        //         }
        //     }

        //     // Listener saat user mengetik kategori
        //     categoryInput.addEventListener('input', (e) => {
        //         activateCategoryForm(e.target.value);
        //     });

        //     // Jalankan saat pertama kali halaman dimuat (untuk menangani 'old' value setelah reload/error)
        //     if (categoryInput.value) {
        //         activateCategoryForm(categoryInput.value);
        //     }
        // });


        // // Preview Featured Image
        // function previewFeaturedImage(event) {
        //     const file = event.target.files[0];
        //     const prompt = document.getElementById('featured_prompt');
        //     const img = document.getElementById('featured_preview_img');

        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             img.src = e.target.result;
        //             img.classList.remove('hidden');
        //             prompt.classList.add('hidden');
        //         }
        //         reader.readAsDataURL(file);
        //     }
        // }

        // // Preview Multiple Images
        // function previewMultipleImages(event) {
        //     const container = document.getElementById('gallery_preview_container');
        //     const files = event.target.files;

        //     container.innerHTML = ''; // Reset preview

        //     if (files.length > 0) {
        //         Array.from(files).forEach(file => {
        //             const reader = new FileReader();
        //             reader.onload = function(e) {
        //                 const div = document.createElement('div');
        //                 div.className =
        //                     'relative aspect-square rounded-lg overflow-hidden border border-gray-200 bg-white shadow-sm group';
        //                 div.innerHTML = `
        //                 <img src="${e.target.result}" class="w-full h-full object-cover">
        //                 <div class="absolute inset-0 bg-black/20 hidden group-hover:flex items-center justify-center">
        //                     <i class="bi bi-check-circle-fill text-white text-xl"></i>
        //                 </div>
        //             `;
        //                 container.appendChild(div);
        //             }
        //             reader.readAsDataURL(file);
        //         });
        //     }
        // }
    </script>

    
@endsection
