@extends('layouts.plantilla_restaurante')

@section('title', 'Todas las categorías')

@section('content')

    <div class="container my-5 text-center">
        <div class="row justify-content-center">

            {{-- Etiquetas --}}
            <div class="col-12 col-md-8 mb-4">
                <h5 class="fw-bold fs-3" style="color: black;">Comida</h5>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    @foreach($restaurantesPorEtiqueta as $tag => $contados)
                        <a href="{{ route('views.restaurantes', ['etiqueta' => $tag]) }}" style="color: white; background-color: rgb(255, 119, 0);" class="btn btn-warning btn-lg">
                            {{ $tag }} ({{ $contados }})
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Categorías (Zonas) --}}
            <div class="col-12 col-md-8">
                <h5 class="fw-bold fs-3" style="color: black;">Zona</h5>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    @foreach($restaurantesPorZona as $zona)
                        <a href="{{ route('views.restaurantes', ['zona' => $zona->name_zone]) }}" style="color: white; background-color: rgb(255, 119, 0);" class="btn btn-info btn-lg">
                            {{ $zona->name_zone }} ({{ $zona->restaurants_count }})
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection
