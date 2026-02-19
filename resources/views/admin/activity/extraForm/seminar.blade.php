<div class="extra-form hidden space-y-6 animate-fade-in" data-category="seminar">
    <div class="p-6 bg-blue-50/50 rounded-2xl border border-blue-100/50 space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
            <i class="bi bi-person-badge"></i> Detail Seminar
        </h3>

        <div class="grid grid-cols-1 gap-4">
            {{-- Nama Pembicara --}}
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Nama Pembicara <span class="text-red-500">*</span>
                </label>
                <input type="text" name="speaker_name" value="{{ old('speaker_name') }}"
                    class="w-full px-4 py-3 rounded-xl bg-white border border-blue-200 focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Masukkan nama lengkap pembicara">
            </div>

            {{-- Tentang Pembicara --}}
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Tentang Pembicara <span class="text-red-500">*</span>
                </label>
                <textarea name="speaker_about" rows="3"
                    class="w-full px-4 py-3 rounded-xl bg-white border border-blue-200 focus:ring-2 focus:ring-blue-500 text-sm"
                    placeholder="Biografi singkat pembicara...">{{ old('speaker_about') }}</textarea>
            </div>

            {{-- Foto Pembicara --}}
            <div>
                <label for="speaker_photo"
                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                    <i class="fas fa-upload mr-2"></i> Tambahkan Foto Pembicara
                </label>

                <input type="file" name="speaker_photo" id="speaker_photo" accept="image/*" class="hidden">

                {{-- Area Preview --}}
                <div id="preview-container" class="mt-3 hidden w-32 overflow-hidden">
                    <img id="image-preview" alt="Preview"
                        class="w-full object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                </div>

                <p class="text-[10px] text-blue-400 mt-1 italic">
                    *Format: JPG, PNG (Max 1MB)
                </p>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("speaker_photo");
    const previewContainer = document.getElementById("preview-container");
    const imagePreview = document.getElementById("image-preview");

    if (!input) return;

    input.addEventListener("change", function () {

        if (!this.files || !this.files[0]) {
            previewContainer.classList.add("hidden");
            return;
        }

        const file = this.files[0];

        // Validasi sederhana
        if (!file.type.startsWith("image/")) {
            alert("File harus berupa gambar.");
            this.value = "";
            previewContainer.classList.add("hidden");
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            previewContainer.classList.remove("hidden");
        };

        reader.readAsDataURL(file);
    });
});
</script>

