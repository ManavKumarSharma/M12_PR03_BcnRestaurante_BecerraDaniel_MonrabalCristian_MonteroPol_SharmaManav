@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

@if(session('status'))
    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    </div>
@endif

<!-- Encabezado con imagen de fondo y avatar -->
<div class="container-fluid p-0">
    <!-- Sección con fondo a pantalla completa -->
    <div class="text-center py-5" 
         style="background: url('{{ asset('img/zona-usuario.jpg') }}') center/cover no-repeat; 
                ;">
        <!-- Si quieres mantener un .container interno para centrar el contenido -->
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <!-- Tu contenido (avatar, nombre, etc.) aquí -->
                <div class="rounded-circle border border-3 border-white overflow-hidden mb-2" 
                     style="width: 120px; height: 120px;">
                    <img src="{{ asset($user->profile_image ? 'img/' . $user->profile_image : 'img/user.jpg') }}" 
                         alt="Foto de perfil" 
                         class="img-fluid rounded-circle w-100 h-100 object-fit-cover">
                </div>
                <h3 class="mb-0">{{ $user->name }} {{ $user->last_name }}</h3>
                <small class="text-muted">Perfil público</small>
                <div class="mt-2">
                    <button class="btn btn-warning text-white" 
                            style="background-color: #f26522; border: none;">
                        Compartir
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Contenedor de pestañas -->
<div class="container mt-4">
    <ul class="nav nav-tabs" id="perfilTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="restaurantes-tab" 
                    data-bs-toggle="tab" data-bs-target="#restaurantes" 
                    type="button" role="tab" aria-controls="restaurantes" 
                    aria-selected="true">
                Mis restaurantes (0)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="recomendados-tab" 
                    data-bs-toggle="tab" data-bs-target="#recomendados" 
                    type="button" role="tab" aria-controls="recomendados" 
                    aria-selected="false">
                Recomendados (1)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="opiniones-tab" 
                    data-bs-toggle="tab" data-bs-target="#opiniones" 
                    type="button" role="tab" aria-controls="opiniones" 
                    aria-selected="false">
                Opiniones (1)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="siguiendo-tab" 
                    data-bs-toggle="tab" data-bs-target="#siguiendo" 
                    type="button" role="tab" aria-controls="siguiendo" 
                    aria-selected="false">
                Siguiendo (0)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="seguidores-tab" 
                    data-bs-toggle="tab" data-bs-target="#seguidores" 
                    type="button" role="tab" aria-controls="seguidores" 
                    aria-selected="false">
                Seguidores (0)
            </button>
        </li>
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content mt-3" id="perfilTabContent">
        <!-- Pestaña: Mis restaurantes -->
        <div class="tab-pane fade show active" id="restaurantes" 
             role="tabpanel" aria-labelledby="restaurantes-tab">
             
            <!-- Filtros: Ordenar, Filtrar, Guardados -->
            <div class="d-flex align-items-center mb-3">
                <span class="me-2">Ordenar: relevancia</span>
                <span class="me-2">|</span>
                <span class="me-2">Filtrar</span>
                <span class="me-2">|</span>
                <span>Guardados</span>
            </div>
            
            <!-- Mensaje de "No tienes restaurantes guardados" -->
            <div class="alert alert-light text-center" role="alert">
                No tienes restaurantes guardados
            </div>
            <!-- Botón "Ver todos" -->
            <div class="text-end">
                <button class="btn btn-outline-secondary">
                    Ver todos
                </button>
            </div>
        </div>

        <!-- Pestaña: Recomendados -->
        <div class="tab-pane fade" id="recomendados" 
             role="tabpanel" aria-labelledby="recomendados-tab">
            <h5 class="mt-3">Recomendados</h5>
            <p>Contenido de la pestaña Recomendados (1).</p>
        </div>

        <!-- Pestaña: Opiniones -->
        <div class="tab-pane fade" id="opiniones" 
             role="tabpanel" aria-labelledby="opiniones-tab">
            <h5 class="mt-3">Opiniones</h5>
            <p>Contenido de la pestaña Opiniones (1).</p>
        </div>

        <!-- Pestaña: Siguiendo -->
        <div class="tab-pane fade" id="siguiendo" 
             role="tabpanel" aria-labelledby="siguiendo-tab">
            <h5 class="mt-3">Siguiendo</h5>
            <p>Contenido de la pestaña Siguiendo (0).</p>
        </div>

        <!-- Pestaña: Seguidores -->
        <div class="tab-pane fade" id="seguidores" 
             role="tabpanel" aria-labelledby="seguidores-tab">
            <h5 class="mt-3">Seguidores</h5>
            <p>Contenido de la pestaña Seguidores (0).</p>
        </div>
    </div>
</div>

@endsection
