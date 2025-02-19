<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Agregar un nuevo usuario</h5>
                <!-- Botón para cerrar con la X de Bootstrap -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form id="userForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombres</label>
                        <input type="text" class="form-control custom-control-input" id="name" placeholder="Introduce el nombre del usuario">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Apellidos</label>
                        <input type="text" class="form-control custom-control-input" id="last_name" placeholder="Introduce el apellido del usuario">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control custom-control-input" id="email" placeholder="Introduce un email válido">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Número de teléfono</label>
                        <input type="tel" class="form-control custom-control-input" id="phone_number" placeholder="Introduce un número de teléfono">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="rol_id" class="form-label">Rol</label>
                        <select class="form-control custom-control-input" id="rol_id">
                            <!-- Opciones para el rol -->
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control custom-control-input" id="password" placeholder="Introduce una contraseña">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Repetir la Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control custom-control-input" id="password_confirmation" placeholder="Vuelve a introducir la misma contraseña">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>  
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-custom-orange" id="addUserButton">Crear usuario</button>
                        <button hidden type="submit" class="btn btn-custom-orange" id="editUserButton">Editar usuario</button>
                        <button type="reset" class="btn btn-custom-black">Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>