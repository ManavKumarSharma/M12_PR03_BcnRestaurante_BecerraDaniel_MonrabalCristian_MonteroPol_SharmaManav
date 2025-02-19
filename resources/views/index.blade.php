@php
    use Carbon\Carbon;
@endphp

@section('content')
    @if (!Auth::check())
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @else
    @extends('layouts.plantilla_restaurante')

    <!-- Filtro -->
    <div class="filter-section text-white" style="background: url('{{ asset('img/header.jpg') }}') no-repeat center center; background-size: cover;padding:7%">
     
    </div>

    {{-- RESTAURANTES POR CATEGORÍAS --}}
    <div class="container my-5">
        
        <h2 class="text-center fw-bold">RESTAURANTES POR CATEGORÍAS</h2>
        <p class="text-center text-muted">TODAS LAS CATEGORÍAS</p>

        <div class="row g-4 mt-4 justify-content-center">
            <!-- Zona -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/zona.png') }}" class="card-img-top" alt="Zona">
                    <div class="card-body">
                        <h5 class="card-title">Zona</h5>
                        <ul class="list-unstyled">
                            @foreach($restaurantesPorZona as $zona)
                                <li>{{ $zona->name_zone }} ({{ $zona->restaurants_count }})</li>
                            @endforeach
                            <li><a href="{{ route('paginaCategorias') }}" class="text-primary">Ver todas</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Comida -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/comida.png') }}" class="card-img-top" alt="Comida">
                    <div class="card-body">
                        <h5 class="card-title">Comida</h5>
                        <ul class="list-unstyled">
                            @foreach($restaurantesPorEtiqueta as $tag => $contados)
                                <li>{{ $tag." ($contados)" }}</li>
                            @endforeach
                            <li><a href="{{ route('paginaCategorias') }}" class="text-primary">Ver todas</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RESTAURANTES DESTACADOS --}}

    <div class="container my-5">
        <h2 class="text-center fw-bold">RESTAURANTES DESTACADOS</h2>
        <p class="text-center text-muted">MEJORES RESEÑAS</p>
    
        <div class="row g-4 mt-4">
            @foreach ($mejoresValorados as $restaurante)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        @if (file_exists(public_path('img/' . $restaurante->img_restaurant)))
                            <img src="{{ asset('img/' . $restaurante->img_restaurant) }}" class="card-img-top" alt="{{ $restaurante->name }}">
                            <div style="position: relative;">

                                <div class="valoracionDiv">

                                    @foreach ($mediaEstrellas as $id => $media)

                                        @php

                                        $valoracion = "No hay valoraciones";
                                    
                                        if ($media !== null) {
                                            switch (true) {
                                                case $media <= 2:
                                                    $valoracion = "$media · Mediocre";
                                                    break;
                                                case $media <= 4:
                                                    $valoracion = "$media · Bueno";
                                                    break;
                                                case $media <= 4.5:
                                                    $valoracion = "$media · Muy bueno";
                                                    break;
                                                case $media <= 5:
                                                    $valoracion = "$media · Excelente";
                                                    break;
                                            }
                                        }

                                        @endphp

                                        @if ($id == $restaurante->id)

                                            @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                                                <span class="nuevo">Nuevo</span>
                                            @endif

                                            <span class="valoracion">{{ $valoracion ?? "No hay valoraciones" }}</span>

                                        @endif

                                    @endforeach

                                </div>
                            </div>
                        @else
                            <img src="{{ asset('img/predefinida.jpg') }}" class="card-img-top" alt="Imagen Predeterminada">
                            <div style="position: relative;">

                                <div class="valoracionDiv">
    
                                    @foreach ($mediaEstrellas as $id => $media)
    
                                        @php
    
                                        $valoracion = "No hay valoraciones";
                                    
                                        if ($media !== null) {
                                            switch (true) {
                                                case $media <= 2:
                                                    $valoracion = "$media · Mediocre";
                                                    break;
                                                case $media <= 4:
                                                    $valoracion = "$media · Bueno";
                                                    break;
                                                case $media <= 4.5:
                                                    $valoracion = "$media · Muy bueno";
                                                    break;
                                                case $media <= 5:
                                                    $valoracion = "$media · Excelente";
                                                    break;
                                            }
                                        }
    
                                        @endphp
    
                                        @if ($id == $restaurante->id)
    
                                            @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                                                <span class="nuevo">Nuevo</span>
                                            @endif
    
                                            <span class="valoracion">{{ $valoracion ?? "No hay valoraciones" }}</span>
    
                                        @endif
    
                                    @endforeach
    
                                </div>

                            </div>
                        @endif
                        <div class="card-body">
                            <a href="{{ route('vistas.restaurante', $restaurante->id) }}" style="text-decoration: none; color: black;">
                                <h5 class="card-title">{{ $restaurante->name }}</h5>
                            </a>
                            <p class="card-text">{{ $restaurante->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- NUEVOS RESTAURANTES --}}

    <div class="container my-5">
        <h2 class="text-center fw-bold">NUEVOS RESTAURANTES</h2>
        <p class="text-center text-muted">NUEVAS INCORPORACIONES</p>

        <div class="row g-4 mt-4">
            @foreach ($nuevosRestaurantes as $restaurante)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        @if (file_exists(public_path('img/' . $restaurante->img_restaurant)))
                            <img src="{{ asset('img/' . $restaurante->img_restaurant) }}" class="card-img-top" alt="{{ $restaurante->name }}">
                            <div style="position: relative;">
                                <div class="valoracionDiv">

                                    @foreach ($mediaEstrellas as $id => $media)

                                        @php

                                        $valoracion = "No hay valoraciones";
                                    
                                        if ($media !== null) {
                                            switch (true) {
                                                case $media <= 2:
                                                    $valoracion = "$media · Mediocre";
                                                    break;
                                                case $media <= 4:
                                                    $valoracion = "$media · Bueno";
                                                    break;
                                                case $media <= 4.5:
                                                    $valoracion = "$media · Muy bueno";
                                                    break;
                                                case $media <= 5:
                                                    $valoracion = "$media · Excelente";
                                                    break;
                                            }
                                        }

                                        @endphp

                                        @if ($id == $restaurante->id)

                                            @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                                                <span class="nuevo">Nuevo</span>
                                            @endif

                                            <span class="valoracion">{{ $valoracion ?? "No hay valoraciones" }}</span>

                                        @endif

                                    @endforeach

                                </div>
                            </div>
                        @else
                            <img src="{{ asset('img/predefinida.jpg') }}" class="card-img-top" alt="Imagen Predeterminada">
                            <div style="position: relative;">
                                <div class="valoracionDiv">

                                    @foreach ($mediaEstrellas as $id => $media)

                                        @php

                                        $valoracion = "No hay valoraciones";
                                    
                                        if ($media !== null) {
                                            switch (true) {
                                                case $media <= 2:
                                                    $valoracion = "$media · Mediocre";
                                                    break;
                                                case $media <= 4:
                                                    $valoracion = "$media · Bueno";
                                                    break;
                                                case $media <= 4.5:
                                                    $valoracion = "$media · Muy bueno";
                                                    break;
                                                case $media <= 5:
                                                    $valoracion = "$media · Excelente";
                                                    break;
                                            }
                                        }

                                        @endphp

                                        @if ($id == $restaurante->id)

                                            @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                                                <span class="nuevo">Nuevo</span>
                                            @endif

                                            <span class="valoracion">{{ $valoracion ?? "No hay valoraciones" }}</span>

                                        @endif

                                    @endforeach
                                    
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <a href="{{ route('vistas.restaurante', $restaurante->id) }}" style="text-decoration: none; color: black;">
                                <h5 class="card-title">{{ $restaurante->name }}</h5>
                            </a>
                            <p class="card-text">{{ $restaurante->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
  
    @endif
@endsection
