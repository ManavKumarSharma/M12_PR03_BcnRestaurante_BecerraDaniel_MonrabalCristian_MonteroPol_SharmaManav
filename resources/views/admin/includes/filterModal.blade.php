<!-- Modal de Filtros -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filtrar Usuarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="filterForm">
                    <div class="mb-3">
                        <label for="filter_name" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="filter_name" placeholder="Introduce un nombre">
                    </div>
                    <div class="mb-3">
                        <label for="filter_last_name" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="filter_last_name" placeholder="Introduce un apellido">
                    </div>
                    <div class="mb-3">
                        <label for="filter_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="filter_email" placeholder="Introduce un email">
                    </div>
                    <div class="mb-3">
                        <label for="filter_phone_number" class="form-label">Número de teléfono</label>
                        <input type="tel" class="form-control" id="filter_phone_number" placeholder="Introduce un número de teléfono">
                    </div>
                    <div class="mb-3">
                        <label for="filter_rol" class="form-label">Rol</label>
                        <select class="form-control" id="filter_rol">
                            <option value="">Selecciona un rol</option>
                            <option value="administrator">administrator</option>
                            <option value="manager">manager</option>
                            <option value="client">client</option>
                            <!-- Opciones de roles -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de creación (Desde - Hasta)</label>
                        <div class="d-flex">
                            <input type="date" class="form-control me-2" id="filter_creation_date_start" placeholder="Desde">
                            <input type="date" class="form-control" id="filter_creation_date_end" placeholder="Hasta">
                        </div>
                    </div>                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" id="applyFiltersButton">Aplicar Filtros</button>
                        <button type="reset" class="btn btn-secondary">Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>