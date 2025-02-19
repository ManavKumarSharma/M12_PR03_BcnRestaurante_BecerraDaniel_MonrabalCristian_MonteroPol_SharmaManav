document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#register-modal form");

    function validateInput(input, regex, errorMessage) {
        value = input.value.trim();
        errorElement = input.parentElement.querySelector('.error-message');

        if (!errorElement) {
            errorElement = document.createElement("div");
            errorElement.classList.add("error-message");
            input.parentElement.appendChild(errorElement);
        }

        if (value === "") {
            input.style.border = "2px solid red";
            errorElement.textContent = "Este campo no puede estar vacío.";
            errorElement.style.color = "red";
        } else if (!regex.test(value)) {
            input.style.border = "2px solid red";
            errorElement.textContent = errorMessage;
            errorElement.style.color = "red";
        } else {
            input.style.border = "2px solid green";
            errorElement.textContent = "";
        }
    }

    function validateName(input) {
        validateInput(input, /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/, "Debe contener solo letras y al menos 2 caracteres.");
    }

    function validateEmail(input) {
        validateInput(input, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Por favor, introduce un email válido.");
    }

    function validatePhone(input) {
        validateInput(input, /^[0-9]{9}$/, "Ingrese un número de teléfono válido (9 dígitos).");
    }

    document.querySelector("#name").addEventListener("blur", function () {
        validateName(this);
    });
    document.querySelector("#last_name").addEventListener("blur", function () {
        validateName(this);
    });
    document.querySelector("#email").addEventListener("blur", function () {
        validateEmail(this);
    });
    document.querySelector("#phone_number").addEventListener("blur", function () {
        validatePhone(this);
    });
});
