@extends('layouts.plantilla_restaurante')

@section('title', $restaurante->name)

@section('content')

    @php
        use Carbon\Carbon;
    @endphp

    <div class="paginaRestaurante">

        <div class="imagenRestaurante">
            
            @php

                $valoracion = "No hay valoraciones";
            
                if ($mediaEstrellas !== null) {
                    switch (true) {
                        case $mediaEstrellas <= 2:
                            $valoracion = "$mediaEstrellas · Mediocre";
                            break;
                        case $mediaEstrellas <= 4:
                            $valoracion = "$mediaEstrellas · Bueno";
                            break;
                        case $mediaEstrellas <= 4.5:
                            $valoracion = "$mediaEstrellas · Muy bueno";
                            break;
                        case $mediaEstrellas <= 5:
                            $valoracion = "$mediaEstrellas · Excelente";
                            break;
                    }
                }

            @endphp
            @if (file_exists(public_path('img/' . $restaurante->img_restaurant)))
                <img src="{{ asset('img/' . $restaurante->img_restaurant) }}" alt="{{ $restaurante->nombre_restaurante }}">
                <div style="position: relative;">
                    <div class="valoracionDiv">

                    @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                        <span class="nuevo">Nuevo</span>
                    @endif
            
                    <span class="valoracion">{{ $valoracion ?? "No hay valoraciones" }}</span>

                    </div>
                </div>
            @else
                <img src="{{ asset('img/predefinida.jpg') }}" alt="Imagen Predeterminada">
                <div style="position: relative;">
                    <div class="valoracionDiv">

                        @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                            <span class="nuevo">Nuevo</span>
                        @endif

                        <span class="valoracion">{{ $valoracion ?? "No hay valoraciones" }}</span>

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection