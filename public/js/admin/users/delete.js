function deleteUser(id) {
    return fetch(`/api/user/delete/${id}`, {
        method: "DELETE",
        headers: { 
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        }
    }).then(response => {
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status} - ${response.statusText}`);
        }
        return response.json();
    }).catch(error => {
        throw new Error("Error de conexión: " + error);
    });
}