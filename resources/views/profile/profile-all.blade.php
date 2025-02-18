@extends('layouts.plantilla_restaurante')

@section('title', 'Mi Perfil')

@section('content')
@if (!Auth::check())
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@else
    <!-- Encabezado (igual que antes) -->
    <div class="bg-dark text-center py-5" style="background: url('{{ asset('img/zona-usuario.jpg') }}') center/cover no-repeat;">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <div class="rounded-circle border border-3 border-white overflow-hidden mb-3" style="width: 120px; height: 120px;">
                    <img src="{{ asset($user->profile_image ? 'img/' . $user->profile_image : 'img/user.jpg') }}" 
                         alt="Foto de perfil" 
                         style="width: 120px; height: 120px;" 
                         class="img-fluid rounded-circle profile-img">
                </div>
                <h3 class="mb-1 text-dark">{{ $user->name }} {{ $user->last_name }}</h3>
                <p class="mb-3 text-dark">
                    Antigüedad: {{ $user->created_at?->diffForHumans() ?? 'No definido' }}
                </p>
                <!-- Botones para foto (igual que antes) -->
                <form id="fotoForm" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" style="position: absolute; left: -9999px;">
                    @csrf
                    @method('PUT')
                    <input type="file" name="photo" id="photoInput" onchange="document.getElementById('fotoForm').submit();">
                </form>
                <div class="d-flex gap-2">
                    <button class="btn btn-secondary" id="btnSubirFoto">
                        <i class="bi bi-upload"></i>
                    </button>
                    @if($user->profile_image)
                        <form id="deletePhotoForm" action="{{ route('user.photo.delete') }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            <i class="bi bi-trash"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(session('status'))
        <div class="container mt-4">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <!-- Navegación de pestañas -->
    <div class="container mt-4">
        <ul class="nav nav-tabs" id="perfilTabs" role="tablist">
            <!-- Pestaña: Mis datos -->
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos-pane" type="button" role="tab" aria-controls="datos-pane" aria-selected="true">
                    Mis datos
                </button>
            </li>
            <!-- Pestaña: Mis reseñas -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reseñas-tab" data-bs-toggle="tab" data-bs-target="#resenas-pane" type="button" role="tab" aria-controls="resenas-pane" aria-selected="false">
                    Mis reseñas ({{ isset($reviews) ? $reviews->count() : 0 }})
                </button>
                
            </li>
            <!-- Pestaña: Mis favoritos -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="favoritos-tab" data-bs-toggle="tab" data-bs-target="#favoritos-pane" type="button" role="tab" aria-controls="favoritos-pane" aria-selected="false">
                    Mis favoritos ({{ isset($favorites) ? $favorites->count() : 0 }})
                </button>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content mt-4" id="perfilTabsContent">
            <!-- Contenido: Mis datos -->
            <div class="tab-pane fade show active" id="datos-pane" role="tabpanel" aria-labelledby="datos-tab">
                @include('profile.partials.profile')
            </div>
            <!-- Contenido: Mis reseñas -->
            <div class="tab-pane fade" id="resenas-pane" role="tabpanel" aria-labelledby="reseñas-tab">
                @include('profile.partials.reviews')
            </div>
            <!-- Contenido: Mis favoritos -->
            <div class="tab-pane fade" id="favoritos-pane" role="tabpanel" aria-labelledby="favoritos-tab">
                @include('profile.partials.favorites')
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar la foto -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              ¿Estás seguro de eliminar la foto de perfil?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </div>
        </div>
    </div>
@endif
@endsection

@section('scripts')
    <script src="{{ asset('js/perfil.js') }}"></script>
    <script src="{{ asset('js/favorites.js') }}"></script>

@endsection
