function deleteUser(id) {
    return fetch(`http://127.0.0.1:8000/api/user/delete?userId=${id}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken // Agregar el token CSRF al encabezado
        }
    }).then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status} - ${response.statusText}`);
        }

        return response.json();
    }).catch(error => {
        throw new Error("Error de conexión");
    });
}