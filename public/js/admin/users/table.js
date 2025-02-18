function loadContent(filters) {
    const contentContainer = document.getElementById('table-content');

    AsyncGetUsersFromAPI(filters)
        .then(data => {
            contentContainer.innerHTML = "";

            if (data.error) {
                throw new Error(data.error);
            }

            createButton('Crear', 'btn-custom-orange', 'displayModalBtn', '#myModal', contentContainer);

            if (data.length === 0) {
                throw new Error('No se encontraron usuarios.');
            }

            createButton('Filtrar', 'btn-custom-black', '', '', contentContainer);
            
            const tableWrapper = document.createElement('div');
            tableWrapper.classList.add('table-responsive'); // Hace la tabla responsive
            const table = createTable(data);
            tableWrapper.appendChild(table);
            contentContainer.appendChild(tableWrapper);
        })
        .catch(error => handleError(error, contentContainer));
}

function createTable(data) {
    const table = document.createElement('table');
    table.classList.add('table', 'table-bordered', 'table-hover', 'mb-4');

    const thead = createTableHeader(Object.keys(data[0]));
    table.appendChild(thead);

    const tbody = createTableBody(data);
    table.appendChild(tbody);

    return table;
}

function createTableHeader(keys) {
    const thead = document.createElement('thead');
    thead.classList.add('thead-dark');
    const tr = document.createElement('tr');

    keys.forEach(key => {
        const th = document.createElement('th');
        th.scope = 'col';
        th.textContent = key;
        th.classList.add('text-center'); // Alineación para mejor visualización
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
            td.textContent = element[field];
            td.classList.add('text-center');
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
    btnEdit.classList.add('editUserButton');
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
    let url = `http://127.0.0.1:8000/api/users/list`;

    if (filters && filters.length > 0) {
        const queryParams = filters.map(param => {
            return `${encodeURIComponent(param.key)}=${encodeURIComponent(param.value)}`;
        }).join('&');
        
        url += '?' + queryParams;
    }

    console.log(url);

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

window.onload = function() {
    // Inicializamos la variable de filtros como vacío para recuperar todos los usuarios
    filters = [];
    document.getElementById('loader').style.display = 'none';
    document.getElementById('main').style.display = 'block';
    loadContent(filters);
};