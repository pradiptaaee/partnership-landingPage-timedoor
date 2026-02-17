export function previewTestimonialImage(event) {
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