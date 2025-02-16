// Función que carga la tabla
function loadTable() {
    // Función asíncrona que devuelve los usuarios
    getUsersFromAPIAsync()
        .then(users => {
            createTable(users)
        })
        .catch(error => {
            console.error("Error al cargar los usuarios:", error);
        });
}

// Función que crea la tabla
function createTable(users) {
    document.getElementById('')
}

// Función para obtener los usuarios desde la API usando fetch
function getUsersFromAPIAsync() {
    return fetch('http://127.0.0.1:8000/api/users/list')
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la respuesta de la API");
            }
            return response.json(); // Convierte la respuesta a JSON
        })
        .catch(error => {
            console.error("Error al obtener los usuarios:", error);
            return []; // Retorna un array vacío en caso de error
        });
}


// Función de carga
window.onload = function() {
    // Ocultamos el loader
    document.getElementById('loader').style.display = 'none';
    // Mostramos el contenido
    document.getElementById('main').style.display = 'block';

    // Llamamos a loadTable para cargar la tabla
    loadTable();
};