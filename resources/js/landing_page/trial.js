document.addEventListener('DOMContentLoaded', function () {

    const inputPhone = document.querySelector('#phone');
    const form = document.getElementById('trialForm');

    if (!inputPhone || !form) return;

    // ================================================
    // Inisialisasi intl-tel-input
    // ================================================
    const iti = window.intlTelInput(inputPhone, {
        initialCountry: 'id',      // Default Indonesia
        separateDialCode: true,    // Tampilkan +62 di luar input
        autoPlaceholder: 'off',    // Matikan placeholder bawaan
        utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.js',
    });

    // ================================================
    // Gabungkan kode negara ke nomor sebelum submit
    // Contoh: 812345678 -> +62812345678
    // ================================================
    form.addEventListener('submit', function () {
        const fullNumber = iti.getNumber();
        inputPhone.value = fullNumber;
    });

});