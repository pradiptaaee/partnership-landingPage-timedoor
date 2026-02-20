/**
 * Konfigurasi Field Wajib (Required)
 */
const ACTIVITY_REQUIRED_FIELDS = {
    seminar: ['extra[speaker_name]', 'extra[speaker_about]'],
    workshop: ['extra[mentor_name]']
};

/**
 * Inisialisasi Event Listener Utama
 */
document.addEventListener('DOMContentLoaded', () => {
    const categoryInput = document.getElementById('category_activity');
    const extraForms = document.querySelectorAll('.extra-form');

    // --- Logika Kategori & Form Tambahan ---
    if (categoryInput && extraForms.length > 0) {
        function activateForm(val) {
            const category = val.trim().toLowerCase();

            extraForms.forEach(f => {
                f.classList.add('hidden');
                f.querySelectorAll('input, textarea').forEach(i => i.required = false);
            });
            
            const target = document.querySelector(`.extra-form[data-category="${category}"]`);
            if (target) {
                target.classList.remove('hidden');
                const fields = ACTIVITY_REQUIRED_FIELDS[category] || [];
                fields.forEach(name => {
                    const el = target.querySelector(`[name="${name}"]`);
                    if (el) el.required = true;
                });
            }
        }

        categoryInput.addEventListener('input', (e) => activateForm(e.target.value));
        if (categoryInput.value) activateForm(categoryInput.value);
    }

    // --- Logika Hitung Karakter ---
    const shortDesc = document.getElementById('short_description');
    const charCount = document.getElementById('char_count');
    if (shortDesc && charCount) {
        shortDesc.addEventListener('input', function () {
            const length = this.value.length;
            charCount.textContent = length;
            if (length >= 200) {
                charCount.classList.add('text-red-500', 'font-bold');
            } else {
                charCount.classList.remove('text-red-500', 'font-bold');
            }
        });
    }
});

/**
 * Preview Gambar (Dipasang di window agar bisa diakses HTML)
 */

// 1. Featured Image Preview
window.previewFeaturedImage = function (event) {
    const file = event.target.files[0];
    // Mendukung ID lama (Create) dan ID baru (Edit)
    const previewImg = document.getElementById('featured_preview_img') || document.getElementById('new_featured_preview_img');
    const prompt = document.getElementById('featured_prompt');

    if (file && previewImg) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            previewImg.classList.remove('hidden');
            if (prompt) prompt.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
};

// 2. Multiple Images (Gallery) Preview
window.previewMultipleImages = function (event) {
    const container = document.getElementById('gallery_preview_container') || document.getElementById('photos_preview');
    const files = event.target.files;

    if (!container) return;
    container.innerHTML = '';

    if (files.length > 0) {
        container.classList.remove('hidden');
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement('div');
                div.className = 'relative aspect-square rounded-lg overflow-hidden border border-gray-200 bg-white shadow-sm group';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/20 hidden group-hover:flex items-center justify-center">
                        <i class="bi bi-check-circle-fill text-white text-xl"></i>
                    </div>
                `;
                container.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }
};

// 3. Speaker Photo Preview (Seminar)
window.previewSpeakerPhoto = function (event) {
    const file = event.target.files[0];
    const previewDiv = document.getElementById('newSpeakerPreview');
    const previewImg = document.getElementById('speaker_preview_img');
    const oldPhoto = document.getElementById('oldSpeakerPhoto');

    if (file && previewImg) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            if (previewDiv) previewDiv.classList.remove('hidden');
            if (oldPhoto) oldPhoto.classList.add('hidden'); 
        };
        reader.readAsDataURL(file);
    }
};

/**
 * Modal Konfirmasi Hapus
 */
window.confirmDeleteGallery = function (actionUrl) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');

    if (modal && form) {
        form.action = actionUrl;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
};

window.closeDeleteModal = function () {
    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
};