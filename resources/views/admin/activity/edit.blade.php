@extends('layouts.admin')

@section('title', 'Edit Kegiatan Partner')

@section('content')
    {{-- CDN Font Awesome (Agar icon muncul) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <nav class="flex text-sm text-gray-500 mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            {{-- UBAH HOVER LINK BREADCRUMB --}}
                            <a href="{{ route('admin.activity.index') }}"
                                class="hover:text-[#0f5132] transition-colors flex items-center">
                                <i class="fas fa-home mr-2"></i> Kegiatan
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-xs mx-1"></i>
                                <span class="ml-1 font-medium text-gray-800">Edit Kegiatan</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Kegiatan</h1>
                <p class="text-gray-500 mt-1 text-sm">Perbarui detail, gambar utama, dan galeri kegiatan partner.</p>
            </div>

            {{-- UBAH HOVER & FOCUS TOMBOL KEMBALI --}}
            <a href="{{ route('admin.activity.index') }}"
                class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-[#0f5132] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0f5132] shadow-sm transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        {{-- Alert Success (GUNAKAN OPASITAS UNTUK BG TERANG) --}}
        @if (session('success'))
            <div class="flex items-center p-4 mb-6 text-[#0f5132] rounded-xl bg-[#0f5132]/10 border border-[#0f5132]/20 shadow-sm"
                role="alert">
                <div class="flex-shrink-0 bg-[#0f5132]/20 rounded-full p-2">
                    <i class="fas fa-check text-[#0f5132]"></i>
                </div>
                <div class="ml-3 text-sm font-medium">{{ session('success') }}</div>
                <button type="button"
                    class="ml-auto bg-transparent text-[#0f5132] rounded-lg focus:ring-2 focus:ring-[#0f5132]/50 p-1.5 hover:bg-[#0f5132]/20 inline-flex h-8 w-8 justify-center items-center"
                    onclick="this.parentElement.remove()">
                    <span class="sr-only">Close</span>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <form action="{{ route('admin.activity.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- KOLOM KIRI --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- CARD INFORMASI DASAR --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                {{-- WARNA ICON KOTAK --}}
                                <span
                                    class="bg-white border border-gray-200 text-[#0f5132] w-10 h-10 rounded-lg flex items-center justify-center mr-3 text-lg shadow-sm">
                                    <i class="fas fa-pen"></i>
                                </span>
                                Informasi Dasar
                            </h2>
                        </div>

                        <div class="p-8 space-y-6">
                            {{-- SEMUA INPUT MENGGUNAKAN focus:ring-[#0f5132] dan focus:border-[#0f5132] --}}
                            <div>
                                <label for="partner_id" class="block mb-2 text-sm font-bold text-gray-700">
                                    Partner Terkait <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-building text-gray-400"></i>
                                    </div>
                                    <select id="partner_id" name="partner_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-[#0f5132] focus:border-[#0f5132] block w-full pl-10 p-3 transition-colors @error('partner_id') border-red-500 bg-red-50 @enderror"
                                        required>
                                        <option value="">-- Pilih Partner --</option>
                                        @foreach ($partners as $partner)
                                            <option value="{{ $partner->id }}"
                                                {{ old('partner_id', $activity->partner_id) == $partner->id ? 'selected' : '' }}>
                                                {{ $partner->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('partner_id')
                                    <p class="mt-2 text-sm text-red-600 flex items-center"><i
                                            class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="md:col-span-2">
                                    <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Judul Kegiatan
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="title" name="title"
                                        value="{{ old('title', $activity->title) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-[#0f5132] focus:border-[#0f5132] block w-full p-3 transition-shadow @error('title') border-red-500 bg-red-50 @enderror"
                                        placeholder="Contoh: Kunjungan Industri..." required>
                                    @error('title')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="activity_date" class="block mb-2 text-sm font-bold text-gray-700">Tanggal
                                        <span class="text-red-500">*</span></label>
                                    <input type="date" id="activity_date" name="activity_date"
                                        value="{{ old('activity_date', \Carbon\Carbon::parse($activity->activity_date)->format('Y-m-d')) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-[#0f5132] focus:border-[#0f5132] block w-full p-3 @error('activity_date') border-red-500 bg-red-50 @enderror"
                                        required>
                                    @error('activity_date')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="category_activity" class="block mb-2 text-sm font-bold text-gray-700">
                                    Kategori Kegiatan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="category_activity" name="category_activity"
                                    value="{{ old('category_activity', $activity->category_activity) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-[#0f5132] focus:border-[#0f5132] block w-full p-3"
                                    placeholder="contoh: seminar, workshop" required>
                                @error('category_activity')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label for="short_description" class="text-sm font-bold text-gray-700">Deskripsi Singkat
                                        <span class="text-red-500">*</span></label>
                                    <span class="text-xs text-gray-500 font-medium"><span
                                            id="char_count">{{ strlen($activity->short_description) }}</span>/200
                                        Karakter</span>
                                </div>
                                <textarea id="short_description" name="short_description" rows="3" maxlength="200"
                                    class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border border-gray-300 focus:ring-[#0f5132] focus:border-[#0f5132] transition-all resize-none @error('short_description') border-red-500 bg-red-50 @enderror"
                                    placeholder="Tulis ringkasan singkat untuk tampilan kartu..." required>{{ old('short_description', $activity->short_description) }}</textarea>
                                @error('short_description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="full_description" class="block mb-2 text-sm font-bold text-gray-700">Deskripsi
                                    Lengkap <span class="text-red-500">*</span></label>
                                <textarea id="full_description" name="full_description" rows="8"
                                    class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border border-gray-300 focus:ring-[#0f5132] focus:border-[#0f5132] transition-all @error('full_description') border-red-500 bg-red-50 @enderror"
                                    placeholder="Jelaskan detail lengkap kegiatan..." required>{{ old('full_description', $activity->full_description) }}</textarea>
                                @error('full_description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- EXTRA FIELD DINAMIS --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-xl font-bold text-gray-800">Informasi Tambahan</h2>
                        </div>

                        <div class="p-8 space-y-6">

                            {{-- SEMINAR --}}
                            <div class="extra-form hidden" data-category="seminar">
                                {{-- <pre class="text-xs bg-gray-100 p-2">
{{ json_encode($activity->extra_attributes, JSON_PRETTY_PRINT) }}
</pre> --}}
                                <div>
                                    <label class="block mb-2 text-sm font-bold text-gray-700">Nama Pembicara</label>
                                    <input type="text" name="extra[speaker_name]"
                                        value="{{ old('extra.speaker_name', $activity->extra_attributes['speaker_name'] ?? '') }}"
                                        class="bg-gray-50 border border-gray-300 rounded-xl p-3 w-full">
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-bold text-gray-700">Foto Pembicara</label>
                                    <input type="file" name="extra[speaker_photo]" class="block w-full text-sm">
                                    @if (!empty($activity->extra_attributes['speaker_photo']))
                                        <p class="text-xs text-gray-500 mt-1">
                                            File saat ini: {{ $activity->extra_attributes['speaker_photo'] }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- WORKSHOP --}}
                            <div class="extra-form hidden" data-category="workshop">
                                <div>
                                    <label class="block mb-2 text-sm font-bold text-gray-700">Nama Mentor</label>
                                    <input type="text" name="extra[mentor_name]"
                                        value="{{ old('extra.mentor_name', $activity->extra_attributes['mentor_name'] ?? '') }}"
                                        class="bg-gray-50 border border-gray-300 rounded-xl p-3 w-full">
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-bold text-gray-700">Tools</label>
                                    <input type="text" name="extra[tools]"
                                        value="{{ old('extra.tools', $activity->extra_attributes['tools'] ?? '') }}"
                                        class="bg-gray-50 border border-gray-300 rounded-xl p-3 w-full">
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- CARD MEDIA & GALERI --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                {{-- WARNA ICON KOTAK --}}
                                <span
                                    class="bg-white border border-gray-200 text-[#0f5132] w-10 h-10 rounded-lg flex items-center justify-center mr-3 text-lg shadow-sm">
                                    <i class="fas fa-images"></i>
                                </span>
                                Media & Galeri
                            </h2>
                        </div>

                        <div class="p-8 space-y-8">

                            <div class="p-5 rounded-xl bg-gray-50 border border-gray-200 border-dashed">
                                <label class="block mb-4 text-sm font-bold text-gray-700">Gambar Utama (Thumbnail)</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                                    <div
                                        class="aspect-video bg-gray-200 rounded-lg overflow-hidden relative shadow-inner group">
                                        @if ($activity->featured_image)
                                            <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}"
                                                id="current_featured_preview"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <div class="flex flex-col items-center justify-center h-full text-gray-400">
                                                <i class="fas fa-image text-3xl mb-2"></i>
                                                <span class="text-xs">Tidak ada gambar</span>
                                            </div>
                                        @endif
                                        <img id="new_featured_preview_img"
                                            class="absolute inset-0 w-full h-full object-cover hidden">
                                    </div>

                                    <div>
                                        {{-- UBAH FOCUS RING TOMBOL UPLOAD --}}
                                        <label for="featured_image"
                                            class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#0f5132] focus:ring-offset-2 transition ease-in-out duration-150">
                                            <i class="fas fa-upload mr-2"></i> Pilih Gambar Baru
                                        </label>
                                        <input id="featured_image" name="featured_image" type="file" class="hidden"
                                            accept="image/*" onchange="previewFeaturedImage(event)">

                                        {{-- UBAH WARNA ICON CHECKLIST --}}
                                        <div class="mt-4 text-xs text-gray-500 space-y-1">
                                            <p><i class="fas fa-check-circle text-[#0f5132] mr-1"></i> Format: JPG, PNG,
                                                WEBP</p>
                                            <p><i class="fas fa-check-circle text-[#0f5132] mr-1"></i> Max Size: 2MB</p>
                                            <p><i class="fas fa-check-circle text-[#0f5132] mr-1"></i> Rasio: 16:9
                                                (Disarankan)</p>
                                        </div>
                                        @error('featured_image')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between items-end mb-4">
                                    <label class="text-sm font-bold text-gray-700">Galeri Foto</label>
                                    {{-- UBAH WARNA LINK TAMBAH FOTO --}}
                                    <label for="photos"
                                        class="cursor-pointer text-sm font-semibold text-[#0f5132] hover:text-[#0a3622] hover:underline">
                                        + Tambah Foto
                                    </label>
                                    <input id="photos" name="photos[]" type="file" multiple class="hidden"
                                        accept="image/*" onchange="previewMultipleImages(event)">
                                </div>

                                <div id="photos_preview" class="grid grid-cols-4 sm:grid-cols-5 gap-3 mb-4 empty:hidden">
                                </div>

                                @if ($activity->photos->isEmpty())
                                    <div
                                        class="text-center py-8 rounded-xl bg-gray-50 border border-gray-200 border-dashed">
                                        <i class="fas fa-camera text-gray-300 text-3xl mb-2"></i>
                                        <p class="text-gray-500 text-sm">Belum ada foto galeri.</p>
                                    </div>
                                @else
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                        @foreach ($activity->photos as $photo)
                                            <div class="group relative aspect-square bg-gray-100 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all"
                                                id="photo-card-{{ $photo->id }}">
                                                <img src="{{ asset('storage/activity/photos/' . $photo->image_path) }}"
                                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">

                                                <div
                                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[1px]">
                                                    <button type="button" onclick="deletePhoto({{ $photo->id }})"
                                                        class="w-9 h-9 flex items-center justify-center bg-white text-red-500 rounded-full hover:bg-red-500 hover:text-white transition-colors shadow-lg"
                                                        title="Hapus Foto">
                                                        <i class="fas fa-trash-alt text-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: SIDEBAR PUBLIKASI --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-lg font-bold text-gray-800 flex items-center">
                                {{-- UBAH ICON ROKET --}}
                                <i class="fas fa-rocket mr-3 text-[#0f5132]"></i> Publikasi
                            </h2>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="space-y-3 mb-6 text-sm text-gray-600">
                                <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                    <span><i class="far fa-calendar-alt mr-2 text-gray-400"></i> Dibuat</span>
                                    <span
                                        class="font-medium text-gray-900">{{ $activity->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                                    <span><i class="far fa-clock mr-2 text-gray-400"></i> Update</span>
                                    <span
                                        class="font-medium text-gray-900">{{ $activity->updated_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span><i class="far fa-eye mr-2 text-gray-400"></i> Status</span>
                                    {{-- UBAH BADGE STATUS (BG Opacity, Text, Border) --}}
                                    <span
                                        class="px-2.5 py-0.5 rounded text-xs font-bold bg-[#0f5132]/10 text-[#0f5132] border border-[#0f5132]/20">PUBLISHED</span>
                                </div>
                            </div>

                            {{-- TOMBOL SIMPAN SUDAH BENAR --}}
                            <button type="submit"
                                class="w-full text-white bg-[#0f5132] hover:bg-[#0a3622] focus:ring-4 focus:ring-[#0f5132]/50 font-bold rounded-xl text-sm px-5 py-3.5 focus:outline-none transition-all shadow-md transform hover:-translate-y-0.5 flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>

                            <button type="button" onclick="deleteActivity()"
                                class="w-full text-red-600 bg-white border border-red-200 hover:bg-red-50 hover:border-red-300 focus:ring-4 focus:ring-red-100 font-medium rounded-xl text-sm px-5 py-3 focus:outline-none transition-all flex items-center justify-center mt-3">
                                <i class="fas fa-trash-alt mr-2"></i> Hapus Kegiatan
                            </button>
                        </div>

                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-xs text-gray-500 leading-relaxed">
                            <i class="fas fa-info-circle mr-1 text-gray-400"></i>
                            Pastikan data benar. Foto yang dihapus tidak dapat dikembalikan.
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <form id="deleteActivityForm" action="{{ route('admin.activity.destroy', $activity->id) }}" method="POST"
        class="hidden">
        @csrf
        @method('DELETE')
    </form>

    {{-- Script JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categoryInput = document.getElementById('category_activity')
            const forms = document.querySelectorAll('.extra-form')

            function toggleExtraForms(category) {
                const value = category.trim().toLowerCase()

                forms.forEach(form => {
                    form.classList.add('hidden')
                    form.querySelectorAll('input').forEach(i => i.required = false)
                })

                const active = document.querySelector(`[data-category="${value}"]`)
                if (active) {
                    active.classList.remove('hidden')
                    active.querySelectorAll('input').forEach(i => {
                        if (!i.name.includes('tools')) i.required = true
                    })
                }
            }

            if (categoryInput && categoryInput.value) {
                toggleExtraForms(categoryInput.value)
            }

            categoryInput.addEventListener('input', e => {
                toggleExtraForms(e.target.value)
            })
        })
        // Hitung Karakter
        const shortDesc = document.getElementById('short_description');
        const charCount = document.getElementById('char_count');
        if (shortDesc && charCount) {
            shortDesc.addEventListener('input', function() {
                charCount.textContent = this.value.length;
                if (this.value.length >= 200) {
                    charCount.classList.add('text-red-500', 'font-bold');
                } else {
                    charCount.classList.remove('text-red-500', 'font-bold');
                }
            });
        }

        // Preview Featured
        function previewFeaturedImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('new_featured_preview_img');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        // Preview Gallery
        function previewMultipleImages(event) {
            const container = document.getElementById('photos_preview');
            const files = event.target.files;
            container.innerHTML = '';

            if (files.length > 0) {
                container.classList.remove('hidden');
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className =
                            'aspect-square rounded-lg overflow-hidden border border-gray-200 shadow-sm relative';
                        {{-- UBAH WARNA BORDER & BG OVERLAY PREVIEW JS --}}
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-[#0f5132]/20 border-2 border-[#0f5132] rounded-lg"></div>
                        `;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        // Delete Logic
        function deleteActivity() {
            if (confirm(
                    'PERINGATAN: Apakah Anda yakin ingin menghapus kegiatan ini secara permanen? Data yang dihapus tidak bisa dikembalikan.'
                )) {
                document.getElementById('deleteActivityForm').submit();
            }
        }

        function deletePhoto(photoId) {
            if (!confirm('Hapus foto ini dari galeri?')) return;

            const card = document.getElementById(`photo-card-${photoId}`);
            if (card) {
                card.style.opacity = '0.5';
                card.style.pointerEvents = 'none';
            }

            fetch(`/admin/activity/photo/${photoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (res.ok) {
                        if (card) {
                            card.classList.add('scale-0');
                            setTimeout(() => card.remove(), 300);
                        }
                    } else {
                        alert('Gagal menghapus foto.');
                        if (card) {
                            card.style.opacity = '1';
                            card.style.pointerEvents = 'auto';
                        }
                    }
                })
                .catch(err => {
                    alert('Terjadi kesalahan koneksi.');
                    if (card) {
                        card.style.opacity = '1';
                        card.style.pointerEvents = 'auto';
                    }
                });
        }
    </script>
@endsection
