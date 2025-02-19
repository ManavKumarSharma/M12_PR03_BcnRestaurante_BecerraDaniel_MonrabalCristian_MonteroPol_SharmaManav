// // Función para alternar la visibilidad de la contraseña
// document.getElementById("togglePassword1").addEventListener("click", function () {
//     var passwordField = document.getElementById("password");
//     var passwordIcon = this.querySelector("i");
//     if (passwordField.type === "password") {
//         passwordField.type = "text";
//         passwordIcon.classList.remove("bi-eye-slash");
//         passwordIcon.classList.add("bi-eye");
//     } else {
//         passwordField.type = "password";
//         passwordIcon.classList.remove("bi-eye");
//         passwordIcon.classList.add("bi-eye-slash");
//     }
// });

// document.getElementById("togglePassword2").addEventListener("click", function () {
//     var passwordField = document.getElementById("rPassword");
//     var passwordIcon = this.querySelector("i");
//     if (passwordField.type === "password") {
//         passwordField.type = "text";
//         passwordIcon.classList.remove("bi-eye-slash");
//         passwordIcon.classList.add("bi-eye");
//     } else {
//         passwordField.type = "password";
//         passwordIcon.classList.remove("bi-eye");
//         passwordIcon.classList.add("bi-eye-slash");
//     }
// });

function displaySweetAlert(message) {
    Swal.fire({
        icon: message.icon,
        title: message.title,
        text: message.text,
        confirmButtonColor: '#e65c00'
      });
}

function askSweetAlert() {
  return new Promise((resolve) => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#686868',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Mantener'
    }).then((result) => {
        resolve(result.isConfirmed);  // Devuelve el resultado cuando se resuelve la promesa
    });
});
}


// Lista los roles en el modal
function listRoles() {
    const rolSelect = document.getElementById('rol_id');
    rolSelect.innerHTML = ''; // Limpiar select

    // Agregar opción predeterminada
    const defaultOption = createOption('', 'Seleccione un rol', true, true);
    rolSelect.appendChild(defaultOption);

    // Obtener los roles desde la API
    fetch('http://127.0.0.1:8000/api/roles/list', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al cargar los roles');
        }
        return response.json();
    })
    .then(roles => {
        if (roles.length > 0) {
            roles.forEach(rol => {
                const option = createOption(rol.name, rol.name);
                rolSelect.appendChild(option);
            });
        } else {
            const noRolesOption = createOption('', 'No hay roles disponibles', true, true);
            rolSelect.appendChild(noRolesOption);
        }
    })
    .catch(error => {
        console.error('Error al listar los roles', error);
        const errorOption = createOption('', 'Error al cargar roles', true, true);
        rolSelect.appendChild(errorOption);
    });
}

// Crea un nuevo elemento option
function createOption(value, text, selected = false, disabled = false) {
    const option = document.createElement('option');
    option.value = value;
    option.textContent = text;
    option.selected = selected;
    option.disabled = disabled;
    return option;
}

// Relacionado con el formulario
const modalElement = document.getElementById('myModal');
const modal = new bootstrap.Modal(modalElement);

// Limpia los campos del formulario cuando se cierra el modal
modalElement.addEventListener('hidden.bs.modal', () => {
    const inputs = document.querySelectorAll('.custom-control-input');
    inputs.forEach(input => {
        input.classList.remove('is-invalid', 'is-valid');
        input.value = ''; // Limpiar el valor del input
    });

    // Mostrar nuevamente los campos de contraseña y labels
    document.getElementById("password").hidden = false;
    document.getElementById("password_confirmation").hidden = false;

    // Mostrar los labels de las contraseñas
    document.querySelector('label[for="password"]').hidden = false;
    document.querySelector('label[for="password_confirmation"]').hidden = false;

    // Resetear el formulario
    document.getElementById('userForm').reset();

    // Volver a ocultar el botón de editar y mostrar el de crear cuando el modal se cierre
    document.getElementById("addUserButton").hidden = false;
    document.getElementById("editUserButton").hidden = true;
});

// Validar un email único desde la bbdd
function validateUniqueEmail(emailInput) {
    return fetch(`/api/users/email?search=${emailInput}`)
    .then(response => response.json())
    .then(data => data.exists === true) // Retorna true si existe, false si no
    .catch(error => {
        console.log('Error en la solicitud: ' + error);
        return false; // En caso de error, considera como no válido
    });
}

// Función para mostrar errores
function showError(input, message) {
    let feedback = input.parentElement.querySelector(".invalid-feedback");
    if (!feedback) return;
    input.classList.add("is-invalid");
    feedback.textContent = message;
}

// Función para limpiar errores
function clearError(input) {
    let feedback = input.parentElement.querySelector(".invalid-feedback");
    if (!feedback) return;
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
    feedback.textContent = "";
}

// Validación de nombres y apellidos
function validateTextField(input, fieldName) {
    const value = input.value.trim();
    if (!value) {
        showError(input, `${fieldName} no puede estar vacío.`);
        return false;
    } else if (value.length <= 3) {
        showError(input, `${fieldName} debe tener más de 3 caracteres.`);
        return false;
    } else if (!/^[a-zA-Z\s]+$/.test(value)) {
        showError(input, `${fieldName} solo puede contener letras.`);
        return false;
    } else {
        clearError(input);
        return true;
    }
}

// Validación de email
function validateEmail(input) {
    const value = input.value.trim();
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!value) {
        showError(input, "El email no puede estar vacío.");
        return false;
    } else if (!emailPattern.test(value)) {
        showError(input, "El formato del email no es válido.");
        return false;
    } else {
        clearError(input);
        return true;
    }
}

// Validación de teléfono
function validatePhoneNumber(input) {
    const value = input.value.trim();
    const phonePattern = /^[0-9]{9,15}$/; // Solo números, entre 9 y 15 dígitos
    if (!value) {
        showError(input, "El número de teléfono no puede estar vacío.");
        return false;
    } else if (!phonePattern.test(value)) {
        showError(input, "El número de teléfono debe contener solo números y tener entre 9 y 15 dígitos.");
        return false;
    } else {
        clearError(input);
        return true;
    }
}

// Validación de rol
function validateRole(input) {
    const value = input.value.trim().toLowerCase();
    const validRoles = ["manager", "client", "administrator"];
    if (!validRoles.includes(value)) {
        showError(input, "Rol inválido. Debe ser Manager, Client o Administrator.");
        return false;
    } else {
        clearError(input);
        return true;
    }
}

// Validación de contraseña
function validatePassword(input) {
    const value = input.value.trim();
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!value) {
        showError(input, "La contraseña no puede estar vacía.");
        return false;
    } else if (!passwordPattern.test(value)) {
        showError(input, "Debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.");
        return false;
    } else {
        clearError(input);
        return true;
    }
}

// Validación de repetir contraseña
function validateRepeatPassword(passwordInput, repeatInput) {
    if (!repeatInput.value.trim()) {
        showError(repeatInput, "La confirmación de contraseña no puede estar vacía.");
        return false;
    } else if (repeatInput.value.trim() !== passwordInput.value.trim()) {
        showError(repeatInput, "Las contraseñas no coinciden.");
        return false;
    } else {
        clearError(repeatInput);
        return true;
    }
}

// Evento del formulario
document.getElementById("userForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Evita el envío si hay errores
    let isValid = true;

    // Obtener elementos del formulario
    const nameInput = document.getElementById("name");
    const lastNameInput = document.getElementById("last_name");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone_number");
    const roleInput = document.getElementById("rol_id");
    const passwordInput = document.getElementById("password");
    const repeatPasswordInput = document.getElementById("password_confirmation");

    // Ejecutar validaciones   
    const isNameValid = validateTextField(nameInput, "Nombres");
    const isLastNameValid = validateTextField(lastNameInput, "Apellidos");
    const isEmailValid = validateEmail(emailInput);
    const isPhoneValid = validatePhoneNumber(phoneInput);
    const isRoleValid = validateRole(roleInput);
    const isPasswordValid = validatePassword(passwordInput);
    const isRepeatPasswordValid = validateRepeatPassword(passwordInput, repeatPasswordInput);

    // Comprobar si todas las validaciones son válidas
    if (!isNameValid || !isLastNameValid || !isEmailValid || !isPhoneValid || !isRoleValid || !isPasswordValid || !isRepeatPasswordValid) {
        return; // Detener el envío si hay errores
    }

    // Validación por parte del servidor para email único
    validateUniqueEmail(emailInput.value.trim())
        .then(EmailExists => {
            if (EmailExists === true) {
                showError(emailInput, "El email ya está registrado.");
                isValid = false;
            }

            // Enviar formulario si es válido
            if (isValid) {
                modal.hide(); // Cierra el modal

                // Llama a la función en create.js
                createUser (
                    nameInput.value.trim(),
                    lastNameInput.value.trim(),
                    emailInput.value.toLowerCase().trim(),
                    phoneInput.value.trim(),
                    roleInput.value.toLowerCase().trim(),
                    passwordInput.value.trim(),
                    repeatPasswordInput.value.trim()
                )
                .then(response => {
                    if (response.icon === 'success') {
                        displaySweetAlert({ 
                            icon: 'success', 
                            title: 'Usuario creado', 
                            text: 'Se ha creado el usuario correctamente' 
                        });
                        loadContent(filters);
                    } else {
                        displaySweetAlert({ 
                            icon: 'error', 
                            title: 'Error', 
                            text: response.text || 'Hubo un problema al crear el usuario.' 
                        });
                    }
                })
                .catch(error => {
                    console.error("Error al crear el usuario:", error);
                    displaySweetAlert({ 
                        icon: 'error', 
                        title: 'Error', 
                        text: 'No se pudo completar la solicitud. Inténtalo nuevamente.' 
                    });
                });
            }
        });
});