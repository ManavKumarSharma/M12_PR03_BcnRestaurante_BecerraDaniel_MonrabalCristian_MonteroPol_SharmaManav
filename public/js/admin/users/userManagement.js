const content = document.getElementById('table-content');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Diccionario de columnas referenciales a la base de datos
const columnDictionary = {
    'Id': 'id',
    'Nombres': 'name',
    'Apellidos': 'last_name',
    'Email': 'email',
    'Número de teléfono': 'phone_number',
    'Rol': 'rol_id',
    'Fecha de creación': 'created_at'
}

// Delegación de eventos
content.addEventListener('click', handleContentClick);

function handleContentClick(event) {
    const target = event.target;

    if (target.classList.contains("deleteUserButton")) {
        handleDeleteUser(target.id);
    } else if (target.classList.contains("clickable-sort-column")) {
        const th = target.closest('th');
        orderByClickedColumn(th);
    } else if (target.classList.contains("btn-custom-edit")) {
        listRoles();
        handleEditUser(target.id);
    } else if (target.id === 'displayModalBtn') {
        listRoles();
    } else if (target.id === 'searcherButton') {
        const searchValue = document.getElementById('input-search').value;
        search(searchValue);
    }else if (target.id === 'filterButton') {
        const searchValue = document.getElementById('input-search').value;
        search(searchValue);
    }
}

// Función para la búsqueda de usuarios
function search(searchValue) {
    if (searchValue && searchValue.trim().length > 0) {
        filters.search = searchValue;
        AsyncGetUsersFromAPI(filters);
    }
}

// Ordenar las columnas
function orderByClickedColumn(th) {
    if (filters.sortColumn === columnDictionary[th.id]) {
        filters.orderColumn = filters.orderColumn === 'asc' ? 'desc' : 'asc';
    } else {
        filters.sortColumn = columnDictionary[th.id];
        filters.orderColumn = 'asc';
    }
    loadContent(filters);
}

// Eliminar usuario
function handleDeleteUser(userId) {
    askSweetAlert()
        .then(confirmation => {
            if (!confirmation) return;
            deleteUser(userId)
                .then(response => {
                    if (response.icon === 'success') {
                        displaySweetAlert(response);
                        loadContent(filters);
                    }
                })
                .catch(error => {
                    displaySweetAlert({ icon: 'error', title: 'Error', text: 'No se pudo eliminar el usuario por un problema del servidor' });
                });
        });
}

// Abrir el modal y cargar los datos del usuario
function handleEditUser(userId) {
    fetch(`/api/user/${userId}`)
        .then(response => response.json())
        .then(user => {
            populateModalWithUserData(user);
            setupEditUserButton(userId);
            modal.show();
        })
        .catch(error => {
            console.error("Error al obtener los datos del usuario:", error);
        });
}

// Rellenar el modal con los datos del usuario
function populateModalWithUserData(user) {
    const roleNames = { 1: 'administrator', 2: 'client', 3: 'manager' };
    document.getElementById("name").value = user.name;
    document.getElementById("last_name").value = user.last_name;
    document.getElementById("email").value = user.email;
    document.getElementById("phone_number").value = user.phone_number;

    // Asignar el rol en el select
    const roleSelect = document.getElementById("rol_id");
    roleSelect.value = roleNames[user.rol_id];

    // Ocultar los campos de contraseña y sus etiquetas si estamos editando un usuario
    document.getElementById("password").hidden = true;
    document.getElementById("password_confirmation").hidden = true;
    document.querySelector('label[for="password"]').hidden = true;
    document.querySelector('label[for="password_confirmation"]').hidden = true;

    // Cambiar el botón de 'Crear' a 'Editar'
    document.getElementById("addUserButton").hidden = true;
    document.getElementById("editUserButton").hidden = false;

    // Asignar el id del usuario al botón de editar dentro del modal
    document.getElementById("editUserButton").setAttribute("data-user-id", user.id);
}

// Configurar el botón de edición para actualizar al usuario
function setupEditUserButton(userId) {
    const editUserButton = document.getElementById("editUserButton");
    
    editUserButton.hidden = false;
    editUserButton.setAttribute("data-user-id", userId);
    
    editUserButton.replaceWith(editUserButton.cloneNode(true));
    
    const newEditUserButton = document.getElementById("editUserButton");
    newEditUserButton.addEventListener("click", function (event) {
        event.preventDefault();
        validateData(userId);
    });
}