<div class="extra-form hidden space-y-6 animate-fade-in" data-category="workshop">
    <div class="p-6 bg-purple-50/50 rounded-2xl border border-purple-100/50 space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
            <i class="bi bi-tools"></i> Detail Workshop
        </h3>

        <div class="grid grid-cols-1 gap-4">
            {{-- Nama Mentor --}}
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Nama Mentor <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="mentor_name"
                    value="{{ old('mentor_name') }}"
                    class="w-full px-4 py-3 rounded-xl bg-white border border-purple-200 focus:ring-2 focus:ring-purple-500 text-sm"
                    placeholder="Masukkan nama mentor workshop"
                >
            </div>

            {{-- Catatan Workshop --}}
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Catatan Workshop
                </label>
                <textarea
                    name="description"
                    rows="3"
                    class="w-full px-4 py-3 rounded-xl bg-white border border-purple-200 focus:ring-2 focus:ring-purple-500 text-sm"
                    placeholder="Contoh: Peserta wajib membawa laptop..."
                >{{ old('description') }}</textarea>
            </div>
        </div>
    </div>
</div>
