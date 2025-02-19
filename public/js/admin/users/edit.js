function updateUser(user) {
    return fetch(`/api/user/edit/${user.id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(user)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw new Error(err.message || 'Error en la solicitud'); });
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error("Error de conexión: " + error);
    });
}

function validateData(userId) {
    const nameInput = document.getElementById("name");
    const lastNameInput = document.getElementById("last_name");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone_number");
    const roleInput = document.getElementById("rol_id");

    if (!validateTextField(nameInput, "Nombres") ||
        !validateTextField(lastNameInput, "Apellidos") ||
        !validateEmail(emailInput) ||
        !validatePhoneNumber(phoneInput) ||
        !validateRole(roleInput)) {
        return;
    }

    const roleIds = {
        'administrator': 1,
        'client': 2,
        'manager': 3
    };

    const updatedUser = {
        id: userId,
        name: nameInput.value,
        last_name: lastNameInput.value,
        email: emailInput.value,
        phone_number: phoneInput.value,
        rol_id: roleIds[roleInput.value],
    };

    updateUser(updatedUser)
    .then(() => {
        displaySweetAlert({
            icon: 'success',
            title: 'Usuario actualizado',
            text: 'El usuario se ha actualizado correctamente.'
        });
        modal.hide();
        AsyncGetUsersFromAPI(filters);
    })
    .catch(error => {
        displaySweetAlert({
            icon: 'error',
            title: 'Error',
            text: error
        });
    });
}