import intlTelInput from "intl-tel-input";
import "intl-tel-input/build/css/intlTelInput.css";

document.addEventListener("DOMContentLoaded", function () {
    const inputPhone = document.querySelector("#phone");
    const form = document.getElementById("trialForm");

    // 1. Inisialisasi Library
    const iti = window.intlTelInput(inputPhone, {
        initialCountry: "id",
        separateDialCode: true,
        autoPlaceholder: "off",
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.js",
    });

    // 2. Gabungin Nomor Pas Submit
    form.addEventListener('submit', function() {
        const fullNumber = iti.getNumber();
        inputPhone.value = fullNumber; 
    });
});