/**
 * Menampilkan preview gambar untuk halaman Create Banner.
 */
export function previewBanner(event) {
    const input = event.target;
    const promptDiv = document.getElementById('upload-prompt');
    const previewDiv = document.getElementById('preview-container');
    const previewImg = document.getElementById('preview-image');
    const fileNameTxt = document.getElementById('file-name');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            if (previewImg) previewImg.src = e.target.result;
            if (fileNameTxt) fileNameTxt.textContent = input.files[0].name;

            if (promptDiv) promptDiv.classList.add('hidden');
            if (previewDiv) previewDiv.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * Memperbarui preview gambar dengan efek transisi untuk halaman Edit Banner.
 */
export function updatePreviewBanner(event) {
    const input = event.target;
    const img = document.getElementById('preview-image');

    if (input.files && input.files[0] && img) {
        const reader = new FileReader();
        reader.onload = (e) => {
            img.style.opacity = '0.5';
            setTimeout(() => {
                img.src = e.target.result;
                img.style.opacity = '1';
            }, 200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * Menyiapkan URL aksi dan menampilkan modal konfirmasi hapus.
 */
export function prepareDelete(actionUrl) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    
    if (modal && form) {
        form.action = actionUrl; 
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

/**
 * Menutup modal konfirmasi hapus.
 */
export function closeModal() {
    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

/**
 * Event listener global untuk menutup modal saat area luar (backdrop) diklik.
 */
window.addEventListener('click', (event) => {
    const modal = document.getElementById('deleteModal');
    if (event.target === modal) {
        closeModal();
    }
});