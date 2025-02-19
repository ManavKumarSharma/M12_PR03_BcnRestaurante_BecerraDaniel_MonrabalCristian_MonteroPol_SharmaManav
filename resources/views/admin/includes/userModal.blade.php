<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Agregar un nuevo usuario</h5>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombres</label>
                    <input type="text" class="form-control custom-modal-input" id="name" placeholder="Introduce el nombre del usuario">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Apellidos</label>
                    <input type="text" class="form-control custom-modal-input" id="last_name" placeholder="Introduce el apellido del usuario">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="number" class="form-control custom-modal-input" id="email" placeholder="Introduce un email válido">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Número de teléfono</label>
                    <input type="number" class="form-control custom-modal-input" id="phone_number" placeholder="Introduce un número de teléfono">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="rol_id" class="form-label">Rol</label>
                    <select class="form-control custom-modal-input" id="rol_id">
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control custom-modal-input" id="password" placeholder="Introduce una contraseña">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="rPassword" class="form-label">Repite la Contraseña</label>
                    <input type="password" class="form-control custom-modal-input" id="rPassword" placeholder="Vuelve a introduci la misma contraseña">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom-orange" id="addUserButton">Crear usuario</button>
                <button type="button" class="btn btn-custom-black" id="closeModalBtn" data-bs-dismiss="modal">Cerrar</button>
                <button hidden type="button" class="btn btn-primary" id="editUserButton">Modificar Producto</button>
            </div>
        </div>
    </div>
</div>