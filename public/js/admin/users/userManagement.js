const content = document.getElementById('table-content');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const modalElement = document.getElementById('myModal');

const modal = new bootstrap.Modal(modalElement); // Crear instancia de Bootstrap Modal

// Evento al hacer click en algún botón dentro de 'content'
content.addEventListener('click', function (event) {
    detectButton(event);
});

function detectButton(event) {
    if (event.target && event.target.classList.contains("deleteUserButton")) {
        askSweetAlert().then((answer) => {
            if (answer) {
                const id = event.target.id; // Obtener el ID del producto a eliminar
                
                deleteUser(id)
                    .then(response => {
                        if (response.icon === 'success') {
                            displaySweetAlert(response); // Mostrar alerta con la respuesta del servidor
                            loadContent();
                        } else {
                            displaySweetAlert({ icon: 'error', title: 'Error', text: 'No se pudo eliminar el producto' });
                        }
                    })
                    .catch(error => {
                        displaySweetAlert({ icon: 'error', title: 'Error', text: error.message });
                    });
            }
        });
    }

    if (event.target && event.target.id === 'displayModalBtn') {
        listRoles();
    }
}

// Función que lista los roles para el modal
function listRoles() {
    const rolSelect = document.getElementById('rol_id');

    // Limpiar el select de roles para evitar agregar roles duplicados
    rolSelect.innerHTML = '';

    // Agregar el primer select option
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Seleccione un rol';
    defaultOption.selected = true;
    defaultOption.disabled = true;
    rolSelect.appendChild(defaultOption);

    AsyncGetRolesFromAPI()
        .then(response => {
            if (Array.isArray(response) && response.length > 0) {
                // Recorre cada uno de los roles y agrega una nueva opción
                response.forEach(rol => {
                    const option = document.createElement('option');
                    option.value = rol.id;
                    option.textContent = rol.name;

                    rolSelect.appendChild(option);
                });
            } else {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'No hay roles disponibles';
                option.disabled = true;
                rolSelect.appendChild(option);
            }
        })
        .catch(error => {
            console.error('Error al listar los roles', error);
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'Error al cargar roles';
            option.disabled = true;
            rolSelect.appendChild(option);
        });
}

function AsyncGetRolesFromAPI() {
    return fetch(`http://127.0.0.1:8000/api/roles/list`, {
        method: "GET",
        headers: {
            'X-CSRF-TOKEN': csrfToken // Asegúrate de enviar el CSRF token si es necesario
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

 // Evento que se ejecuta al cerrar el modal
 modalElement.addEventListener('hidden.bs.modal', function () {
        
    // Limpiar los campos del formulario modal
    const inputs = document.querySelectorAll('.custom-modal-input');
    inputs.forEach(input => {
        input.classList.remove('is-invalid', 'is-valid');
        input.value = ''; // Limpiar el valor del input
    });
});