/**
 * Partner Module Scripts
 */

// 1. Preview Logo (digunakan pada Create Partner)
window.previewImage = function (event) {
    const preview = document.getElementById('preview');
    const prompt = document.getElementById('upload-prompt');
    const removeBtn = document.getElementById('remove-btn');
    const file = event.target.files[0];

    if (file && preview) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (prompt) prompt.classList.add('hidden');
            if (removeBtn) removeBtn.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
};

// 2. Remove Logo Preview
window.removePreview = function () {
    const input = document.getElementById('logo');
    const preview = document.getElementById('preview');
    const prompt = document.getElementById('upload-prompt');
    const removeBtn = document.getElementById('remove-btn');

    if (input) input.value = '';
    if (preview) {
        preview.src = '';
        preview.classList.add('hidden');
    }
    if (prompt) prompt.classList.remove('hidden');
    if (removeBtn) removeBtn.classList.add('hidden');
};

// 3. Preview Logo Edit (Menggunakan ID berbeda: preview-image)
// Fungsi ini saya ganti namanya menjadi previewEditImage agar tidak bentrok dengan previewImage
window.previewEditImage = function (event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const img = document.getElementById('preview-image');
            const placeholder = document.getElementById('no-logo-placeholder');

            if (placeholder) placeholder.classList.add('hidden');
            if (img) {
                img.classList.remove('hidden');
                img.src = e.target.result;
            }
        }

        reader.readAsDataURL(input.files[0]);
    }
};

// 4. Konfirmasi Hapus Partner (Alert Standard)
window.confirmDelete = function () {
    if (confirm(
        'Apakah Anda yakin ingin menghapus partner ini?\n\nSemua kegiatan terkait juga akan terhapus permanen!'
    )) {
        const deleteForm = document.getElementById('deleteForm');
        if (deleteForm) {
            deleteForm.submit();
        } else {
            console.error('Form dengan ID deleteForm tidak ditemukan');
        }
    }
};