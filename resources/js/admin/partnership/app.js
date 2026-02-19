// app.js

document.addEventListener('livewire:initialized', () => {
    Livewire.on('success-alert', (data) => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: data.message,
            position: 'center',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
    });
});

window.onload = function () {
    // Ambil data yang dikirim dari Blade
    const flash = window.flashMessages;

    if (flash && flash.loginSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: flash.loginSuccess,
            showConfirmButton: true,
            confirmButtonText: 'Lanjutkan',
        });
    }

    if (flash && flash.successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: flash.successMessage,
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
    }
};

window.viewImage = function (url) {
    Swal.fire({
        imageUrl: url,
        imageAlt: 'Dokumentasi Kegiatan',
        showConfirmButton: false,
        showCloseButton: true,
        background: 'transparent',
        customClass: {
            popup: 'border-none shadow-none'
        }
    });
};