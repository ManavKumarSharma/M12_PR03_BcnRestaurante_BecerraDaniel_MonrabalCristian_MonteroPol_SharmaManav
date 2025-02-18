@extends('layouts.plantilla_restaurante')

@section('title','Todos los restaurantes')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp
    <link rel="stylesheet" href="{{ asset('css/restaurantes.css') }}">
    <div class="contenido">
        {{-- F I L T R O S --}}
        <div class="filter-section text-white py-5" style="background: url('{{ asset('img/header.jpg') }}') no-repeat center center; background-size: cover;">
            <div class="container">
                <form action="{{ route('views.restaurantes') }}" method="GET" class="row g-3 align-items-center">
                    <!-- Menú desplegable (select) para elegir una etiqueta (tipo de restaurante) -->
                    <div class="col-md-4">
                        <label for="etiqueta" class="form-label">Tipo de Restaurante</label>
                        <select name="etiqueta" id="etiqueta" class="form-select" onchange="this.form.submit()">
                            <option value="Todos" {{ request('etiqueta') == 'Todos' ? 'selected' : '' }}>Todos</option>
                            @foreach($restaurantesPorEtiqueta as $tag => $contados)
                                <option value="{{ $tag }}" {{ request('etiqueta') == $tag ? 'selected' : '' }}>{{ $tag." ($contados)" }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo de texto para buscar los restaurantes por su nombre -->
                    <div class="col-md-4">
                        <label for="busqueda" class="form-label">Buscar Restaurantes</label>
                        <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Buscar restaurantes" value="{{ request('busqueda') }}">
                    </div>

                    <!-- Menú desplegable para ordenar -->
                    <div class="col-md-4">
                        <label for="orden" class="form-label">Ordenar por</label>
                        <select name="orden" id="orden" class="form-select" onchange="this.form.submit()">
                            <option value="" disabled selected>Ordenar por</option>
                            <option value="precio-mayor-menor" {{ request('orden') == 'precio-mayor-menor' ? 'selected' : '' }}>Precio de Mayor a Menor</option>
                            <option value="precio-menor-mayor" {{ request('orden') == 'precio-menor-mayor' ? 'selected' : '' }}>Precio de Menor a Mayor</option>
                            <option value="mejor-valorados" {{ request('orden') == 'mejor-valorados' ? 'selected' : '' }}>Mejor Valorados</option>
                            <option value="peor-valorados" {{ request('orden') == 'peor-valorados' ? 'selected' : '' }}>Peor Valorados</option>
                            <option value="antiguos" {{ request('orden') == 'antiguos' ? 'selected' : '' }}>Más Antiguos</option>
                            <option value="nuevos" {{ request('orden') == 'nuevos' ? 'selected' : '' }}>Más Nuevos</option>
                        </select>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('views.restaurantes') }}'">Borrar Filtros</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- FIN FILTROS --}}

        <div class="d-flex justify-content-center">

            <div class="grid-container lista-restaurantes row">
                @foreach ($restaurantes as $restaurante)
                    <div class="restaurante col-12 col-md-6 col-lg-4 mb-4">
                        <div class="imagenesRestaurante">
                            @if (file_exists(public_path('img/' . $restaurante->img_restaurant)))
                                <img src="{{ asset('img/' . $restaurante->img_restaurant) }}" alt="{{ $restaurante->nombre_restaurante }}">
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
                                <img src="{{ asset('img/predefinida.jpg') }}" alt="Imagen Predeterminada">
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
                        </div>
                        <div class="informacionRestaurante">
                            {{-- <p class="tipocomidaRestaurante">{{ $restaurante->tipo_comida }}</p> --}}
                            <div class="cuboinfoRestaurante">
                                <a href="{{ route('vistas.restaurante', $restaurante->id) }}">
                                    <h3>{{ $restaurante->name }}</h3>
                                </a>
                                <p class="propiedadesRestaurante">
                                    {{ $restaurante->tags->pluck('name')->implode(', ') }}
                                </p>
                                <p class="propiedadesRestaurante">
                                    {{ $zonaRestaurante[$restaurante->id] ?? "No hay zona asignada" }}
                                </p>
                                <p class="propiedadesRestaurante">
                                    {{ number_format($restaurante->average_price)}} €
                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection