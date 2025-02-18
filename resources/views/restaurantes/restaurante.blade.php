@extends('layouts.plantilla_restaurante')

@section('title', $restaurante->name)

@section('content')

    @php
        use Carbon\Carbon;
    @endphp

    <div class="container mt-5">

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="position-relative mb-4">
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
                        <img src="{{ asset('img/' . $restaurante->img_restaurant) }}" alt="{{ $restaurante->nombre_restaurante }}" class="img-fluid rounded">
                        <div class="position-absolute top-0 start-0 p-2 bg-dark text-white rounded">
                            @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                                <span class="badge bg-success">Nuevo</span>
                            @endif
                            <span>{{ $valoracion ?? "No hay valoraciones" }}</span>
                        </div>
                    @else
                        <img src="{{ asset('img/predefinida.jpg') }}" alt="Imagen Predeterminada" class="img-fluid rounded">
                        <div class="position-absolute top-0 start-0 p-2 bg-dark text-white rounded">
                            @if (Carbon::parse($restaurante->created_at)->diffInDays(Carbon::now()) < 7)
                                <span class="badge bg-success">Nuevo</span>
                            @endif
                            <span>{{ $valoracion ?? "No hay valoraciones" }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="p-4 bg-light rounded shadow-sm">
                    <h1 class="mb-3">{{ $restaurante->name }}</h1>
                    <p><strong>Zona:</strong> {{ $zona ?? "No hay zona asignada" }}</p>
                    <p><strong>Dirección:</strong> {{ $restaurante->address }}</p>
                    <p><strong>Precio medio:</strong> {{ $restaurante->average_price }}€</p>
                    <p><strong>Teléfono:</strong> {{ $restaurante->phone }}</p>
                    <p><strong>Horario:</strong> {{ $restaurante->opening_hours }} - {{ $restaurante->closing_hours }}</p>

                    <h3 class="mt-4">P L A T O S:</h3>
                    <div class="row">
                        @foreach($fotosComidas as $foto)
                            <div class="col-6 col-md-4 mb-3">
                                <img src="{{ asset('img/' . $foto) }}" alt="Imagen de comida" class="img-fluid rounded">
                            </div>
                        @endforeach
                    </div>

            <div>
                <form class="puntuarForm" id="puntuarForm">
                    <input type="hidden" name="user" id="user" value="{{ $userId }}">
                    <input type="hidden" name="restaurante" id="restaurante" value="{{ $restaurante->id }}">
                    <p class="clasificacion">
                        <label for="radio1"></label>
                        <input id="radio1" type="radio" name="estrellas" value="5"
                            @if ($estrella && $estrella->num_estrellas == 5) checked @endif>
                        <label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4"
                            @if ($estrella && $estrella->num_estrellas == 4) checked @endif>
                        <label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3"
                            @if ($estrella && $estrella->num_estrellas == 3) checked @endif>
                        <label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2"
                            @if ($estrella && $estrella->num_estrellas == 2) checked @endif>
                        <label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1"
                            @if ($estrella && $estrella->num_estrellas == 1) checked @endif>
                        <label for="radio5">★</label>
                    </p>
                    <button type="button" id="enviarPuntuacion">Puntuar</button>
                </form>
                <div id="mensajePuntuacion"></div>
            </div>

        </div>

    </div>
@endsection

@section('script')
    
    <script>

        var enviarPuntuacion = document.getElementById('enviarPuntuacion');

        // Se ejecuta cuando se hace clic en el botón de puntuar
        enviarPuntuacion.onclick = = function() {
            puntuar();
        }

        function puntuar() {

            var puntuacionSeleccionada = document.querySelector('input[name="estrellas"]:checked');

            if (!puntuacionSeleccionada) {
                document.getElementById('mensajePuntuacion').innerHTML =
                    '<p style="color: red;">Por favor, selecciona una puntuación</p>';
                return;
            }

            var puntuacion = puntuacionSeleccionada.value;
            var restauranteId = {{ $restaurante->id }};
            var userId = {{ $userId }};

            var formData = new FormData();
            formData.append('puntuacion', puntuacion);
            formData.append('restaurante_id', restauranteId);
            formData.append('user', userId);

            // Petición AJAX usando fetch
            fetch('/puntuar', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "ok") {
                    document.getElementById('mensajePuntuacion').innerHTML =
                        '<p style="color: green;">Puntuación insertada con éxito</p>';
                } else {
                    console.log(data);
                    document.getElementById('mensajePuntuacion').innerHTML =
                        '<p style="color: red;">Error al insertar la puntuación</p>';
                }
            })
            .catch(error => {
                console.error('Error en la petición:', error);
                document.getElementById('mensajePuntuacion').innerHTML =
                    '<p style="color: red;">Error de conexión</p>';
            });
        }


    // document.addEventListener("DOMContentLoaded", function() {
    //     var valorar = document.getElementById('valorar');
    //     var restaurante = document.getElementById('restaurante').value;
    //     valorar.addEventListener("click", function() {
    //         var errorValorar = document.getElementById('errorValorar');
    //         var descripcion = document.getElementById('descripcion').value.trim();
    //         if (descripcion === "") {
    //             errorValorar.innerHTML = "Por favor, inserte texto en la valoracion.";
    //         } else {
    //             errorValorar.innerHTML = "";
    //             var form = document.getElementById('valorarForm');
    //             var formdata = new FormData(form);
    //             var ajax = new XMLHttpRequest();
    //             ajax.open('POST', '/acciones/valorar.php');
    //             ajax.onload = function() {
    //                 if (ajax.status === 200) {
    //                     if (ajax.responseText === "ok") {
    //                         window.location.replace(restaurante);
    //                     }
    //                 }
    //             };
    //             ajax.send(formdata);
    //         }
    //     });
    // });

    </script>
@endsection