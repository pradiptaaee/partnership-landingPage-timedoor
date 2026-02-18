import intlTelInput from "intl-tel-input";
import "intl-tel-input/build/css/intlTelInput.css";

document.addEventListener("DOMContentLoaded", function () {
    const inputPhone = document.querySelector("#phone");
    const form = document.getElementById("trialForm");

    if (!inputPhone || !form) return;

    const iti = intlTelInput(inputPhone, {
        initialCountry: "id",
        separateDialCode: true,
        autoPlaceholder: "off",
        loadUtils: () => import("intl-tel-input/build/js/utils"),
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const fullNumber = iti.getNumber();
        console.log("Full number:", fullNumber);

        if (fullNumber) {
            inputPhone.value = fullNumber;
        }

        form.submit();
    });
});
