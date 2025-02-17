@extends('layouts.plantilla_restaurante')

@section('title','Todos los restaurantes')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp

    <div class="contenido">
        <div class="filtro1">
            <div class="filtroTipos">
                <nav class="nav-item filtrozonas dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <p class="filtros"><i class="fa-solid filtrozonas fa-filter"></i> {{ $filtro }}</p>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('views.restaurantes', ['etiqueta' => 'Todos']) }}">Todos los tipos</a></li>                                
                            @foreach ($restaurantesPorEtiqueta as $etiqueta => $contados)
                                <li>
                                    <a class="dropdown-item" href="{{ route('views.restaurantes', ['etiqueta' => $etiqueta]) }}">
                                        {{ $etiqueta }} ({{ $contados }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </a>
                </nav>
            </div>
            <div class="filtroBuscar">
                <form action="{{ route('views.restaurantes') }}" method="GET">
                    <input type="text" name="busqueda" placeholder="Buscar restaurantes" value="{{ request('busqueda') }}">
                    <button type="submit">Buscar</button>
                </form>
            </div>
        </div>

        {{-- <div class="filtro2">
            <nav class="nav-item filtrozonas dropdown">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <p class="filtros">Ordenar por &nbsp;{{ $filtro2 }} &nbsp;<i
                            class="fa-solid fa-arrow-down-short-wide"></i></p>
                    <ul class="dropdown-menu dropdown-menu2">
                        <li><a class="dropdown-item" href="{{ route('vistas.precio-mayor-menor') }}"><i class="fa-solid fa-money-bills"></i> Precio de Mayor a
                                Menor</a></li>
                        <li><a class="dropdown-item" href="{{ route('vistas.precio-menor-mayor') }}"><i class="fa-solid fa-money-bill"></i> Precio de Menor a
                                Mayor</a></li>
                        <li><a class="dropdown-item" href="{{ route('vistas.mejor-valorados') }}"><i class="fa-solid fa-thumbs-up"></i> Mejor Valorados</a></li>
                        <li><a class="dropdown-item" href="{{ route('vistas.peor-valorados') }}"><i class="fa-solid fa-thumbs-down"></i> Peor Valorados</a></li>
                        <li><a class="dropdown-item" href="{{ route('vistas.antiguos') }}"><i class="fa-regular fa-calendar"></i> Mas Antiguos</a></li>
                        <li><a class="dropdown-item" href="{{ route('vistas.nuevos') }}"><i class="fa-regular fa-calendar"></i> Mas Nuevos</a></li>
                    </ul>
                </a>
            </nav>
        </div> --}}

        <div style="display: flex; justify-content: center;">

            <div class="grid-container">
                @foreach ($restaurantes as $restaurante)
                    <div class="restaurante">
                        <div class="imagenesRestaurante">
                            @if (file_exists(public_path('img/' . $restaurante->img_restaurant)))
                                <img src="{{ asset('img/' . $restaurante->img_restaurant) }}" alt="{{ $restaurante->nombre_restaurante }}">
                                <div style="position: relative;">
                                    <div class="valoracionDiv">
                                        @foreach ($mediaEstrellas as $id => $media)

                                            @php

                                                $valoracion = 'No hay valoraciones';
                                            
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
                                        
                                                <span class="valoracion">{{ $valoracion }}</span>

                                            @endif

                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <img src="{{ asset('img/predefinida.jpg') }}" alt="Imagen Predeterminada">
                                <div style="position: relative;">

                                    <div class="valoracionDiv">

                                        @foreach ($mediaEstrellas as $id => $media)

                                            @if ($id == $restaurante->id)

                                                @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                                                    <span class="nuevo">Nuevo</span>
                                                @endif

                                                <span class="valoracion">{{ $valoracion }}</span>

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
                                    {{ $zonaRestaurante[$restaurante->id] }}
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