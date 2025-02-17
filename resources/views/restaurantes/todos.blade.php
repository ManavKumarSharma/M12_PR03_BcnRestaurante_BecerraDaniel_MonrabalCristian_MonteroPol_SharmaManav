@extends('layouts.plantilla_restaurante')

@section('title','Todos los restaurantes')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp

    <div class="contenido">

        <div class="filtro1">
            <div class="filtroTipos">
                <form action="{{ route('views.restaurantes') }}" method="GET">

                    {{-- Menú desplegable (select) para elegir una etiqueta (tipo de restaurante) --}}
                    {{-- Este select envía los datos al formulario cada vez que se selecciona una etiqueta --}}
                    <select name="etiqueta" onchange="this.form.submit()">
                        
                        {{-- Opción por defecto: "Todos", que muestra todos los restaurantes, si está seleccionado, esta opción estará seleccionada --}}
                        <option value="Todos" {{ request('etiqueta') == 'Todos' ? 'selected' : '' }}>Todos</option>

                        {{-- Por cada restaurantes contados por etiquetas, devuelveme la cuenta de cuantos tienen esa etiqueta --}}
                        @foreach($restaurantesPorEtiqueta as $tag => $contados)
                            
                            {{-- Mostramos una opción por cada etiqueta que tenga un o varios restaurantes relacionados --}}
                            {{-- Si la etiqueta seleccionada coincide con la actual, la marca como seleccionada --}}
                            <option value="{{ $tag }}" {{ request('etiqueta') == $tag ? 'selected' : '' }}>{{ $tag." ($contados)" }}</option>

                        @endforeach
                    </select>

                    {{-- Campo de texto buscar los restaurantes por su nombre, mostramos el valor cuando lo recojemos por value="{{ request('busqueda') }}" --}}
                    <input type="text" name="busqueda" placeholder="Buscar restaurantes" value="{{ request('busqueda') }}">

                    <!-- Menú desplegable para ordenar -->
                    <select name="orden" onchange="this.form.submit()">
                        <option value="" disabled selected>Ordenar por</option>
                        <option value="precio-mayor-menor" {{ request('orden') == 'precio-mayor-menor' ? 'selected' : '' }}>Precio de Mayor a Menor</option>
                        <option value="precio-menor-mayor" {{ request('orden') == 'precio-menor-mayor' ? 'selected' : '' }}>Precio de Menor a Mayor</option>
                        <option value="mejor-valorados" {{ request('orden') == 'mejor-valorados' ? 'selected' : '' }}>Mejor Valorados</option>
                        <option value="peor-valorados" {{ request('orden') == 'peor-valorados' ? 'selected' : '' }}>Peor Valorados</option>
                        <option value="antiguos" {{ request('orden') == 'antiguos' ? 'selected' : '' }}>Más Antiguos</option>
                        <option value="nuevos" {{ request('orden') == 'nuevos' ? 'selected' : '' }}>Más Nuevos</option>
                    </select>

                    <button type="button" onclick="window.location='{{ route('views.restaurantes') }}'">Borrar Filtros</button>
                    
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