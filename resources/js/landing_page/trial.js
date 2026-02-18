import intlTelInput from "intl-tel-input";
import "intl-tel-input/build/css/intlTelInput.css";
import utils from "intl-tel-input/build/js/utils";

document.addEventListener("DOMContentLoaded", function () {

    const inputPhone = document.querySelector("#phone");
    const form = document.getElementById("trialForm");

    if (!inputPhone || !form) return;

    // ================================================
    // Inisialisasi intl-tel-input
    // ================================================
    const iti = intlTelInput(inputPhone, {
        initialCountry: "id",
        separateDialCode: true,
        autoPlaceholder: "off",
        utilsScript: utils
    });

    // ================================================
    // Gabungkan kode negara ke nomor sebelum submit
    // Contoh: 812345678 -> +62812345678
    // ================================================
    form.addEventListener("submit", function () {
        const fullNumber = iti.getNumber();
        inputPhone.value = fullNumber;
    });

});
