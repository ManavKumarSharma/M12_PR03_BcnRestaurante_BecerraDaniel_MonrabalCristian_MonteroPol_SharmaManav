@extends('layouts.plantilla_restaurante')

@section('title', 'Mi Perfil')

@section('content')
@if (!Auth::check())
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @else
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
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <!-- Sección de Reseñas -->
        <div class="col-md-6">
            <h4>Mis Reseñas</h4>
            @if ($reviews->isEmpty())
                <p>No has dejado ninguna reseña todavía.</p>
            @else
                @foreach ($reviews as $review)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                @if(isset($review->restaurant) && $review->restaurant !== null)
                                    {{ $review->restaurant->name }}
                                @else
                                    <span class="text-danger">Restaurante no disponible</span>
                                @endif
                            </h5>
                            
                            <p class="card-text">Calificación: {{ $review->rating }} ⭐</p>
                            <p class="card-text">{{ $review->comment }}</p>
                            <small class="text-muted">Publicado el {{ $review->created_at->format('d/m/Y') }}</small>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
        
        

        <!-- Sección de Favoritos -->
        <div class="col-md-6">
            <h4>Mis Favoritos</h4>
            @if ($favorites->isEmpty())
                <p>No has agregado restaurantes a favoritos.</p>
            @else
                @foreach ($favorites as $favorite)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->restaurant->name }}</h5>
                            <p class="card-text">
                                <a href="{{ route('restaurant.show', $favorite->restaurant->id) }}" class="btn btn-sm btn-primary">Ver Restaurante</a>
                                <form action="{{ route('favorites.remove', $favorite->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endif

@endsection
