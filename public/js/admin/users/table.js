function loadContent(filters) {
    // Recogemos elementos del DOM
    const contentContainer = document.getElementById('table-content');
    
    // Función asíncrona que recoge los usuarios
    AsyncGetUsersFromAPI(filters)
        .then(data => {
            contentContainer.innerHTML = "";

            if (data.error) {
                throw new Error(data.error);
            }

            // Botón para crear nuevo usuario
            createButton('Crear', 'btn-custom-orange', 'displayModalBtn', '#myModal', contentContainer);

            // Botón de filtros
            createButton('Filtrar', 'btn-custom-black', 'filterButton', '', contentContainer); 

            // Agregar el buscador al lado de los botones
            createSearcher(contentContainer);

            if (data.data.length === 0) {
                // Si no hay usuarios en la página actual, verificamos si hay más páginas anteriores
                if (filters.page > 1) {
                    filters.page -= 1; // Reducir página
                    loadContent(filters); // Recargar con la página anterior
                    return; // Salir de la función para evitar renderizar una tabla vacía
                }
                // Si estamos en la página 1 y no hay resultados, mostramos un mensaje
                throw new Error('No se encontraron usuarios');
            }

            const tableWrapper = document.createElement('div');
            tableWrapper.classList.add('table-responsive'); // Hace la tabla responsive
            const table = createTable(data.data);
            tableWrapper.appendChild(table);
            contentContainer.appendChild(tableWrapper);

            // Agregar el contenedor de paginación
            createPaginationControls(contentContainer, filters, data.pagination);
        })
        .catch(error => handleError(error, contentContainer));
}

function createPaginationControls(container, filters, pagination) {
    const paginationWrapper = document.createElement('div');
    paginationWrapper.classList.add('d-flex', 'justify-content-center', 'align-items-center', 'mt-3', 'mb-3'); // Contenedor d-flex centrado

    // Botón de "Anterior"
    const prevButton = document.createElement('button');
    prevButton.textContent = '←';
    prevButton.classList.add('btn', 'btn-outline-secondary', 'me-2');
    prevButton.disabled = filters.page <= 1; // Deshabilitar si estamos en la primera página
    prevButton.addEventListener('click', function() {
        filters.page -= 1;
        loadContent(filters);
    });

    // Mostrar número de página actual
    const pageNumber = document.createElement('span');
    pageNumber.classList.add('mx-2');
    pageNumber.textContent = `Página ${filters.page} de ${pagination.total_pages}`;

    // Botón de "Siguiente"
    const nextButton = document.createElement('button');
    nextButton.textContent = '→';
    nextButton.classList.add('btn', 'btn-outline-secondary');
    nextButton.disabled = filters.page >= pagination.total_pages; // Deshabilitar si estamos en la última página
    nextButton.addEventListener('click', function() {
        filters.page += 1;
        loadContent(filters);
    });

    // Agregar botones y el número de página al contenedor
    paginationWrapper.appendChild(prevButton);
    paginationWrapper.appendChild(pageNumber);
    paginationWrapper.appendChild(nextButton);

    // Agregar los controles de paginación al contenedor
    container.appendChild(paginationWrapper);
}

function createTable(data) {
    const table = document.createElement('table');
    table.classList.add('table', 'table-striped', 'table-hover', 'mb-4');  // Cambiado a table-striped

    const thead = createTableHeader(Object.keys(data[0]));
    table.appendChild(thead);

    const tbody = createTableBody(data);
    table.appendChild(tbody);

    return table;
}

function createTableHeader(keys) {
    const thead = document.createElement('thead');
    // thead.classList.add('');
    const tr = document.createElement('tr');

    keys.forEach(key => {
        const th = document.createElement('th');
        th.scope = 'col';
        th.textContent = key;
        th.classList.add('text-center', 'clickable-sort-column');
        th.id = key;

        // Si filters existe y la columna actual es la ordenada, agregamos el ícono
        if (typeof filters !== 'undefined' && filters.sortColumn === columnDictionary[key]) {
            const sortIcon = document.createElement('i');
            // Según el orden actual, agrega la flecha correspondiente
            if (filters.orderColumn === 'asc') {
                sortIcon.classList.add('bi', 'bi-arrow-up');
            } else {
                sortIcon.classList.add('bi', 'bi-arrow-down');
            }
            // Agrega un pequeño margen para separar el texto del ícono
            sortIcon.style.marginLeft = '5px';
            th.appendChild(sortIcon);
        }

        // Aplicar clases de Bootstrap para ocultar en pantallas pequeñas
        if (['Fecha de creación', 'Nombres', 'Apellidos', 'Número de teléfono'].includes(key)) {
            th.classList.add('d-none', 'd-sm-table-cell');
        }

        tr.appendChild(th);
    });

    const thActions = document.createElement('th');
    thActions.textContent = '⚙️';
    thActions.classList.add('text-center');
    tr.appendChild(thActions);

    thead.appendChild(tr);
    return thead;
}

function createTableBody(data) {
    const tbody = document.createElement('tbody');

    data.forEach(element => {
        const trow = document.createElement('tr');

        Object.keys(element).forEach(field => {
            const td = document.createElement('td');

            // console.log(field);

            td.textContent = element[field];
            td.classList.add('text-center');

            if (['Nombres', 'Apellidos', 'Fecha de creación', 'Número de teléfono'].includes(field)) {
                td.classList.add('d-none', 'd-sm-table-cell');
            }

            trow.appendChild(td);
        });

        const tdActions = createActionsCell(element.Id);
        trow.appendChild(tdActions);

        tbody.appendChild(trow);
    });

    return tbody;
}

function createActionsCell(elementID) {
    const tdActions = document.createElement('td');
    tdActions.classList.add('text-center');

    const btnEdit = createActionButton('✏️', 'btn-custom-edit');
    const btnDelete = createActionButton('🗑️', 'btn-custom-delete');
    btnEdit.id = elementID;
    btnDelete.id = elementID;
    btnDelete.classList.add('deleteUserButton');

    tdActions.appendChild(btnEdit);
    tdActions.appendChild(btnDelete);

    return tdActions;
}

function createActionButton(text, btnClass) {
    const button = document.createElement('button');
    button.textContent = text;
    button.classList.add('btn', btnClass, 'm-2');
    return button;
}

function createSearcher(container) {
    // Crear un grupo de entrada con Bootstrap
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-2', 'me-2');

    // Crear el campo de búsqueda
    const input = document.createElement('input');
    input.type = 'text';
    input.classList.add('form-control');
    input.placeholder = 'Buscar...';
    input.setAttribute('aria-label', 'Buscar');
    
    // Rellenar el input con el valor que ya exista en filters.search (si lo hubiera)
    if (filters.search) {
        input.value = filters.search;
    }

    // Crear el botón de búsqueda
    const button = document.createElement('button');
    button.type = 'button';
    button.classList.add('btn', 'btn-outline-secondary');
    button.textContent = 'Buscar';

    // Al hacer clic en el botón, actualizamos los filtros y recargamos el contenido
    button.addEventListener('click', function() {
        filters.search = input.value;   // Guardamos la búsqueda
        loadContent(filters);           // Recargamos con el nuevo filtro
    });

    // Agregar el input y el botón al grupo
    inputGroup.appendChild(input);
    inputGroup.appendChild(button);

    // Agregar el grupo al contenedor
    container.appendChild(inputGroup);
}


function handleError(error, container) {
    const errorMessage = error.message === 'No se encontraron usuarios.' 
        ? 'No se encontraron usuarios.' 
        : `Error: ${error.message}`;
    
    console.error(errorMessage, error);
    
    // Crear el contenedor de error si no existe
    let errorContainer = document.createElement('div');
    errorContainer.className = 'd-flex justify-content-center align-items-center';
    errorContainer.style.minHeight = '10px';
    
    // Crear el mensaje de error
    const p = document.createElement('p');
    p.textContent = errorMessage;
    p.className = 'text-danger fw-bold text-center';
    
    // agregar el mensaje
    errorContainer.appendChild(p);
    container.appendChild(errorContainer);
}

function createButton(text, btnClass, id, target, container) {
    const button = document.createElement('button');
    button.textContent = text;
    button.classList.add('btn', btnClass, 'mb-2', 'me-2');
    
    if (id) button.id = id;
    if (target) {
        button.setAttribute('data-bs-toggle', 'modal');
        button.setAttribute('data-bs-target', target);
    }
    container.appendChild(button);
}

function AsyncGetUsersFromAPI(filters) {
    let url = "http://127.0.0.1:8000/api/users/list";

    if (filters && Object.keys(filters).length > 0) {
        const queryParams = Object.entries(filters)
            .filter(([key, value]) => value != null && value !== '')
            .map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(value)}`)
            .join("&");
        
        if (queryParams) {
            url += "?" + queryParams;
        }
    }

    // console.log(url);

    return fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.statusText}`);
            }
            return response.json();
        })
        .catch(error => {
            throw new Error("Error de conexión: " + error.message);
        });
}

// Cuando se carguen todos los elementos del DOM
window.onload = function() {
    // Inicializamos la variable filtros por defecto (Ordenar por ID, orden ASC, 10 páginas)
    filters = {
        'sortColumn': 'id',
        'orderColumn': 'asc',
        'per_page': 10,
        'page': 1
    };

    // Ocultamos el loader y mostramos le contenido
    document.getElementById('loader').style.display = 'none';
    document.getElementById('main').style.display = 'block';

    // Llamamos a la función
    loadContent(filters);
};