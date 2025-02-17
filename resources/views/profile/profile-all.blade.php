{{-- @extends('layouts.plantilla_restaurante')

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
    <div class="text-center py-5" 
         style="background: url('{{ asset('img/zona-usuario.jpg') }}') center/cover no-repeat;">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
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
                Mis restaurantes ({{ $restaurants->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="recomendados-tab" 
                    data-bs-toggle="tab" data-bs-target="#recomendados" 
                    type="button" role="tab" aria-controls="recomendados" 
                    aria-selected="false">
                Recomendados ({{ $recommended->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="opiniones-tab" 
                    data-bs-toggle="tab" data-bs-target="#opiniones" 
                    type="button" role="tab" aria-controls="opiniones" 
                    aria-selected="false">
                Opiniones ({{ $opinions->count() }})
            </button>
        </li>
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content mt-3" id="perfilTabContent">
        <!-- Pestaña: Mis restaurantes -->
        <div class="tab-pane fade show active" id="restaurantes" 
             role="tabpanel" aria-labelledby="restaurantes-tab">
            @if($restaurants->isEmpty())
                <div class="alert alert-light text-center" role="alert">
                    No tienes restaurantes guardados
                </div>
            @else
                <div class="row">
                    @foreach($restaurants as $restaurant)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('img/' . $restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $restaurant->name }}</h5>
                                    <p class="card-text">{{ $restaurant->description }}</p>
                                    <a href="{{ route('restaurant.show', $restaurant->id) }}" class="btn btn-primary">Ver más</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="text-end">
                <a href="{{ route('restaurants.all') }}" class="btn btn-outline-secondary">Ver todos</a>
            </div>
        </div>

        <!-- Pestaña: Recomendados -->
        <div class="tab-pane fade" id="recomendados" 
             role="tabpanel" aria-labelledby="recomendados-tab">
            @if($recommended->isEmpty())
                <div class="alert alert-light text-center" role="alert">
                    No hay restaurantes recomendados
                </div>
            @else
                <div class="row">
                    @foreach($recommended as $restaurant)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('img/' . $restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $restaurant->name }}</h5>
                                    <p class="card-text">{{ $restaurant->description }}</p>
                                    <a href="{{ route('restaurant.show', $restaurant->id) }}" class="btn btn-primary">Ver más</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Pestaña: Opiniones -->
        <div class="tab-pane fade" id="opiniones" 
             role="tabpanel" aria-labelledby="opiniones-tab">
            @if($opinions->isEmpty())
                <div class="alert alert-light text-center" role="alert">
                    No tienes opiniones publicadas
                </div>
            @else
                <div class="list-group">
                    @foreach($opinions as $opinion)
                        <div class="list-group-item">
                            <h5>{{ $opinion->title }}</h5>
                            <p>{{ $opinion->body }}</p>
                            <small class="text-muted">Publicado el {{ $opinion->created_at->format('d/m/Y') }}</small>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@endsection --}}
