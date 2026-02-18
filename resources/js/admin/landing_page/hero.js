export function previewHero(event, previewId) {
    const file = event.target.files[0];
    const previewImg = document.getElementById(previewId);
    const placeholder = document.getElementById(previewId + '_placeholder');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
}