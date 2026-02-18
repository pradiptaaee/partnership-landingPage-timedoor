import intlTelInput from "intl-tel-input";
import "intl-tel-input/build/css/intlTelInput.css";

document.addEventListener("DOMContentLoaded", function () {
    const inputPhone = document.querySelector("#phone");
    const form = document.getElementById("trialForm");

    
    if (inputPhone && form) {
        console.log("Inisialisasi intl-tel-input...");

        const iti = intlTelInput(inputPhone, {
            initialCountry: "id",
            separateDialCode: true,
            autoPlaceholder: "off",
          
            utilsScript: "/node_modules/intl-tel-input/build/js/utils.js"
        });

    
        form.onsubmit = function() {
            const fullNumber = iti.getNumber();
            if (fullNumber) {
                inputPhone.value = fullNumber;
            }
            return true;
        };
    }
});