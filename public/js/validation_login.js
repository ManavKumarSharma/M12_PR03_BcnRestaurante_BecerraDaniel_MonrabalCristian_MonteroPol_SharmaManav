function validateEmail(input) {
    let email = input.value.trim();
    let emailError = input.parentElement.querySelector('.error-message');
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        input.style.border = "2px solid red";
        emailError.textContent = "El campo de email no puede estar vacío.";
        emailError.style.color = "red";
    } else if (!emailRegex.test(email)) {
        input.style.border = "2px solid red";
        emailError.textContent = "Por favor, introduce un email válido.";
        emailError.style.color = "red";
    } else {
        input.style.border = "2px solid green";
        emailError.textContent = "";
    }
}

function validatePassword(input) {
    let password = input.value.trim();
    let passwordError = input.parentElement.querySelector('.error-message');

    if (password === "") {
        input.style.border = "2px solid red";
        passwordError.textContent = "El campo de contraseña no puede estar vacío.";
        passwordError.style.color = "red";
    } else {
        input.style.border = "2px solid green";
        passwordError.textContent = "";
    }
}
