<div class="extra-form hidden space-y-6 animate-fade-in" data-category="seminar">
    <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100/50 space-y-4">
        <h3 class="text-sm font-bold text-blue-800 flex items-center gap-2">
            <i class="bi bi-person-badge"></i> Detail Seminar
        </h3>

        <div class="grid grid-cols-1 gap-4">
            {{-- Nama Pembicara --}}
            <div>
                <label class="block text-xs font-bold text-blue-700 uppercase tracking-wider mb-2">
                    Nama Pembicara <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="speaker_name"
                    value="{{ old('speaker_name') }}"
                    class="w-full px-4 py-3 rounded-xl bg-white border border-blue-200 focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Masukkan nama lengkap pembicara"
                >
            </div>

            {{-- Tentang Pembicara --}}
            <div>
                <label class="block text-xs font-bold text-blue-700 uppercase tracking-wider mb-2">
                    Tentang Pembicara <span class="text-red-500">*</span>
                </label>
                <textarea
                    name="speaker_about"
                    rows="3"
                    class="w-full px-4 py-3 rounded-xl bg-white border border-blue-200 focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Biografi singkat pembicara..."
                >{{ old('speaker_about') }}</textarea>
            </div>

            {{-- Foto Pembicara --}}
            <div>
                <label class="block text-xs font-bold text-blue-700 uppercase tracking-wider mb-2">
                    Foto Pembicara
                </label>
                <input
                    type="file"
                    name="speaker_photo"
                    accept="image/*"
                    class="w-full text-xs text-gray-500"
                >
                <p class="text-[10px] text-blue-400 mt-1 italic">
                    *Format: JPG, PNG (Max 1MB)
                </p>
            </div>
        </div>
    </div>
</div>