@extends('layouts.plantilla_restaurante')

@section('title','Todos los restaurantes')

@section('content')

    <div class="contenido">
        <div class="filtro1">
            <div class="filtroTipos">
                <p>Restaurantes de &nbsp;</p>
                <nav class="nav-item filtrozonas dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <p class="filtros"><i class="fa-solid filtrozonas fa-filter"></i> {{ $filtro }}</p>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('views.restaurantes') }}">Todos los tipos</a></li>
                                 
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Vegetariano']) }}">Vegetariano</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Vegano']) }}">Vegano</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Sin Gluten']) }}">Sin Gluten</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Comida Rápida']) }}">Comida Rápida</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Alta Cocina']) }}">Alta Cocina</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Buffet']) }}">Buffet</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Mariscos']) }}">Mariscos</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Carnes']) }}">Carnes</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Sushi']) }}">Sushi</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Postres']) }}">Postres</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Café']) }}">Café</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Comida Casera']) }}">Comida Casera</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Barbacoa']) }}">Barbacoa</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Mexicana']) }}">Mexicana</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Italiana']) }}">Italiana</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'China']) }}">China</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Japonesa']) }}">Japonesa</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Tailandesa']) }}">Tailandesa</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'India']) }}">India</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Mediterránea']) }}">Mediterránea</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Francesa']) }}">Francesa</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Española']) }}">Española</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Argentina']) }}">Argentina</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Peruana']) }}">Peruana</a></li>
                            <li><a class="dropdown-item" href="{{ route('vistas.filtrar-restaurantes', ['etiqueta' => 'Hamburguesas']) }}">Hamburguesas</a></li>
                        </ul>
                        
                    </a>
                </nav>
            </div>

            {{-- <div class="filtroBuscar">
                <form action="{{ route('vistas.buscar-restaurantes') }}" method="GET">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" name="busqueda" placeholder="Buscar restaurantes">
                </form>
            </div> --}}
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
                            <a href="">
                                @if (file_exists(public_path('img/' . $restaurante->img_restaurant)))
                                    <img src="{{ asset('img/' . $restaurante->img_restaurant) }}"
                                        alt="{{ $restaurante->nombre_restaurante }}">
                                @else
                                    <img src="{{ asset('img/predefinida.jpg') }}" alt="Imagen Predeterminada">
                                    @endif
                                </a>
                        </div>
                        <div class="informacionRestaurante">
                            {{-- <p class="tipocomidaRestaurante">{{ $restaurante->tipo_comida }}</p> --}}
                            <div class="cuboinfoRestaurante">
                                <a href="{{ route('vistas.restaurante', $restaurante->id) }}">
                                    <h3>{{ $restaurante->name }}</h3>
                                </a>
                                <p class="numerosRestaurantes"><i class="fa-solid fa-dollar-sign"></i>
                                    {{ number_format($restaurante->average_price) }}
                                </p>
                            </div>
                            <div class="cuboinfoRestaurante">
                                <p><i class="fa-solid fa-location-dot fa-l"></i> {{ $restaurante->localizacion }}</p>
                                @foreach ($mediaEstrellas as $id => $media)
                                    @if ($id == $restaurante->id)
                                        <p class="numerosRestaurantes"><i class="fa-solid fa-star"></i> {{ $media ?? '-' }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection