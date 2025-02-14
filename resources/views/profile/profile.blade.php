@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

<!-- Encabezado con imagen de fondo y avatar -->
<div class="bg-dark text-white text-center py-5" style="background: url('{{ asset('img/zona-usuario.jpg') }}') center/cover no-repeat;">
    <div class="container">
        <div class="d-flex flex-column align-items-center">
            <!-- Avatar -->
            <div class="rounded-circle border border-3 border-white overflow-hidden mb-3" style="width: 100px; height: 100px;">
                <img src="{{ asset('img/zona-usuario.jpg') }}" alt="Foto de perfil" class="img-fluid">
            </div>
            <h3 class="mb-1"></h3>
            <p class="text-light mb-3">Antigüedad: </p>
            <button class="btn btn-secondary">Subir foto</button>
        </div>
    </div>
</div>

<!-- Contenedor de pestañas -->
<div class="container mt-4">
    <!-- Navegación de pestañas -->
    <ul class="nav nav-tabs" id="perfilTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos" type="button" role="tab" aria-controls="datos" aria-selected="true">
                Mis datos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reservas-tab" data-bs-toggle="tab" data-bs-target="#reservas" type="button" role="tab" aria-controls="reservas" aria-selected="false">
                Mis reservas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="delieuros-tab" data-bs-toggle="tab" data-bs-target="#delieuros" type="button" role="tab" aria-controls="delieuros" aria-selected="false">
                Mis deliEuros
            </button>
        </li>
    </ul>

    <!-- Botón lateral "Mi perfil" -->
    <div class="text-end mt-2">
        <a href="#" class="btn btn-warning text-white" style="background-color: #f26522; border: none;">Mi perfil</a>
    </div>

    <!-- Contenido de las pestañas -->
    <div class="tab-content mt-4" id="perfilTabContent">
        <!-- Pestaña: Mis datos -->
        <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="datos-tab">
            <h5>Mis datos</h5>

            <form action="{{ route('user.update') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="name">
                    </div>
                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="last_name">
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text">+34</span>
                            <input type="text" class="form-control" id="telefono" name="phone_number">
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••">
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>

        <!-- Pestaña: Mis reservas -->
        <div class="tab-pane fade" id="reservas" role="tabpanel" aria-labelledby="reservas-tab">
            <h5 class="mt-4">Mis reservas</h5>
            <p>Aquí aparecerá el listado de reservas del usuario.</p>
        </div>

        <!-- Pestaña: Mis deliEuros -->
        <div class="tab-pane fade" id="delieuros" role="tabpanel" aria-labelledby="delieuros-tab">
            <h5 class="mt-4">Mis deliEuros</h5>
            <p>Aquí aparecerá el balance de deliEuros, transacciones, etc.</p>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseña -->
<script>
    document.querySelector(".toggle-password").addEventListener("click", function () {
        let passwordInput = document.getElementById("password");
        let icon = this.querySelector("i");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    });
</script>

@endsection
