@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<!-- Encabezado con imagen de fondo y avatar -->
<div class="bg-dark text-center py-5" style="background: url('{{ asset('img/zona-usuario.jpg') }}') center/cover no-repeat;">
    <div class="container">
        <div class="d-flex flex-column align-items-center">
            <!-- Avatar -->
            <div class="rounded-circle border border-3 border-white overflow-hidden mb-3">
                <img src="{{ asset($user->profile_image ? 'img/' . $user->profile_image : 'img/user.jpg') }}" 
                     alt="Foto de perfil" 
                     class="img-fluid rounded-circle profile-img">
            </div>
            <h3 class="mb-1 text-dark">{{ $user->name }}</h3>
            <p class="mb-3 text-dark">
                Antigüedad: {{ $user->created_at?->diffForHumans() ?? 'No definido' }}
            </p>
            <!-- Formulario oculto para actualizar la foto -->
            <form id="fotoForm" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" style="position: absolute; left: -9999px;">
                @csrf
                @method('PUT')
                <input type="file" name="photo" id="photoInput" onchange="document.getElementById('fotoForm').submit();">
            </form>
            <!-- Botón para subir foto -->
            <button class="btn btn-secondary" id="btnSubirFoto">Subir foto</button>
            <!-- Botón para eliminar foto (visible solo si hay imagen subida) -->
            @if($user->profile_image)
                <form id="deletePhotoForm" action="{{ route('user.photo.delete') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" id="btnEliminarFoto">Eliminar foto</button>
                </form>
            @endif
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
            <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                        @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text">+34</span>
                            <input type="text" class="form-control" id="telefono" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                            @error('phone_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="••••••">
                    </div>
                </div>
                
                <!-- Botón para guardar cambios -->
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

<!-- Scripts -->
<script>
    // Mostrar/Ocultar contraseña
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

    // Al hacer click en "Subir foto", se activa el input de archivo del formulario oculto
    document.getElementById("btnSubirFoto").addEventListener("click", function() {
        document.getElementById("photoInput").click();
    });

    // Evento para eliminar la foto de perfil
    document.getElementById("btnEliminarFoto")?.addEventListener("click", function() {
        if (confirm("¿Estás seguro de eliminar la foto de perfil?")) {
            document.getElementById("deletePhotoForm").submit();
        }
    });
</script>

@endsection
