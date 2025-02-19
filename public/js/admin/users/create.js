function createUser(name, lastName, email, phoneNumber, role, password, rPassword) {
    const roleIds = {
        'administrator': 1,
        'client': 2,
        'manager': 3
    };

    // Crear el objeto de datos para enviar al servidor
    const userData = {
        name: name,
        lastName: lastName,
        email: email,
        phoneNumber: phoneNumber,
        role: roleIds[role],
        password: password,
        password_confirmation: rPassword
    };

    return fetch(`/api/user/create`, {
        method: "POST",
        headers: { 
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken 
        },
        body: JSON.stringify(userData)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || `Error ${response.status}: ${response.statusText}`);
            });
        }
        return response.json(); // Convertir la respuesta en JSON solo si la solicitud fue exitosa
    })
    .catch(error => {
        console.error("Error en createUser:", error);
        return { icon: 'error', title: 'Error', text: error.message };
    });
}