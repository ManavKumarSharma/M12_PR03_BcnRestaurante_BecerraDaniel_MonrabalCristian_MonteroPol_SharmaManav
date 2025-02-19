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
                            <img src="{{ asset('img/food/' . $foto) }}" 
                                 alt="Imagen de comida" 
                                 class="img-fluid rounded img-fixed-size">
                        </div>
                        
                        @endforeach
                    </div>

            <div class="puntuacion">
                <form class="puntuarForm" id="puntuarForm">
                    <input type="hidden" name="user" id="user" value="{{ $userId }}">
                    <input type="hidden" name="restaurante" id="restaurante" value="{{ $restaurante->id }}">
                    <p class="clasificacion">
                        <label for="radio1"></label>
                        <input id="radio1" type="radio" name="estrellas" value="5"
                            @if ($estrella && $estrella->score == 5) checked @endif>
                        <label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4"
                            @if ($estrella && $estrella->score == 4) checked @endif>
                        <label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3"
                            @if ($estrella && $estrella->score == 3) checked @endif>
                        <label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2"
                            @if ($estrella && $estrella->score == 2) checked @endif>
                        <label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1"
                            @if ($estrella && $estrella->score == 1) checked @endif>
                        <label for="radio5">★</label>
                    </p>
                    <button type="button" id="enviarPuntuacion">Puntuar</button>
                </form>
                <button id="eliminarPuntuacion">Eliminar puntuación</button>
                <div id="mensajePuntuacion"></div>
            </div>

            <div class="comentario">

                <form class="valorarForm" id="valorarForm">
                    <h6>VALORAR</h6>
                    <label for="descripcion">Tu valoración:</label>
                    <input type="hidden" name="user" id="user" value="{{ $userId }}">
                    <input type="hidden" name="restaurante" id="restaurante" value="{{ $restaurante->id }}">
                    <textarea name="descripcion" id="descripcion" rows="6" required></textarea>
                    <span id="errorValorar"></span>
                    <br>
                    <input class="editarbtn" type="button" value="Valorar Restaurante" id="valorar">
                </form>

                <hr>

                <h6>COMENTARIOS</h6>
                @foreach ($valoraciones as $valoracion)
                    <p class="comentario"><b>{{ $valoracion->user->name }}:</b> {{ $valoracion->comment }}</p>
                @endforeach
            </div>

            <div class="favoritos">
                <i id="noFavorito" class="bi bi-hand-thumbs-up" style="display: {{ $favorito ? 'none' : 'inline' }};"></i>
                <i id="favorito" class="bi bi-hand-thumbs-up-fill {{ $favorito ? 'favorito-activo' : '' }}" style="display: {{ $favorito ? 'inline' : 'none' }};"></i>
            </div>

        </div>
    </div>
@endsection

@section('script')
    
    <script>

        var enviarPuntuacion = document.getElementById('enviarPuntuacion');

        var eliminarPuntuacion = document.getElementById('eliminarPuntuacion');

        var comentarRestaurante = document.getElementById('valorar');

        var mensajePuntuacion = document.getElementById('mensajePuntuacion');

        var mensajeError = document.getElementById('errorValorar');

        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var noFavorito = document.getElementById('noFavorito');

        var darFavorito = document.getElementById('favorito');


        enviarPuntuacion.onclick = puntuar;

        eliminarPuntuacion.onclick = eliminar;
        
        comentarRestaurante.onclick = comentar;

        noFavorito.onmouseover = mostrarNoFavorito;

        noFavorito.onmouseout = mostrarFavorito;

        noFavorito.onclick = favorito;

        darFavorito.onclick = favorito;


        var restauranteId = {{ $restaurante->id }};
        var userId = {{ $userId }};
        
        
        function puntuar() {
            
            var puntuacionSeleccionada = document.querySelector('input[name="estrellas"]:checked');
            
            console.log('Puntuando...');
            
            if (!puntuacionSeleccionada) {
                mensajePuntuacion.innerHTML = '<p style="color: red;">Por favor, selecciona una puntuación</p>';
                return;
            }

            var puntuacion = puntuacionSeleccionada.value;

            var formData = new FormData();
            formData.append('puntuacion', puntuacion);
            formData.append('restaurante_id', restauranteId);
            formData.append('user', userId);

            // Petición AJAX usando fetch
            fetch('/puntuar', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "ok") {
                    mensajePuntuacion.innerHTML = "";
                    mensajePuntuacion.innerHTML = '<p style="color: green;">Puntuación insertada con éxito</p>';
                } else {
                    console.log(data);
                    mensajePuntuacion.innerHTML = "";
                    mensajePuntuacion.innerHTML = '<p style="color: red;">Error al insertar la puntuación</p>';
                }
            })
            .catch(error => {
                console.error('Error en la petición:', error);
                mensajePuntuacion.innerHTML = "";
                mensajePuntuacion.innerHTML = '<p style="color: red;">Error de conexión</p>';
            });
        }

        function comentar() {
            
            var comentario = document.getElementById('descripcion').value.trim();

            if (!comentario) {
                mensajeError.innerHTML = '<p style="color: red;">Por favor, escribe un comentario</p>';
                return;
            }

            var formData = new FormData();
            formData.append('comentario', comentario);
            formData.append('restaurante_id', restauranteId);
            formData.append('user', userId);

            fetch('/comentar', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "ok") {
                    mensajeError.innerHTML = '<p style="color: green;">Comentario agregado con éxito</p>';
                } else {
                    console.log(data);
                    mensajeError.innerHTML = '<p style="color: red;">Error al agregar el comentario</p>';
                }
            })
            .catch(error => {
                console.error('Error en la petición:', error);
                mensajeError.innerHTML = '<p style="color: red;">Error de conexión</p>';
            });
        }


        function favorito() {
            var formData = new FormData();
            formData.append('restaurante_id', {{ $restaurante->id }});

            fetch('/favorito', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === 'añadido') {
                    noFavorito.style.display = 'none';
                    darFavorito.style.display = 'inline';
                    darFavorito.classList.add('favorito-activo');
                } else if (data.trim() === 'borrado') {
                    noFavorito.style.display = 'inline';
                    darFavorito.style.display = 'none';
                    darFavorito.classList.remove('favorito-activo');
                }
            })
            .catch(error => {
                console.error('Error en la petición:', error);
            });
        }

        function mostrarNoFavorito() {
            noFavorito.style.display = 'none';
            darFavorito.style.display = 'inline';
        }

        function mostrarFavorito() {
            if (!darFavorito.classList.contains('favorito-activo')) {
                noFavorito.style.display = 'inline';
                darFavorito.style.display = 'none';
            }
        }


        function eliminar() {

            var formData = new FormData();
            formData.append('restaurante_id', restauranteId);

            fetch(`/eliminar-puntuacion/${restauranteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "ok") {
                    mensajePuntuacion.innerHTML = '<p style="color: green;">Puntuación eliminada con éxito</p>';
                } else {
                    console.log(data);
                    mensajePuntuacion.innerHTML = '<p style="color: red;">Error al eliminar la puntuación</p>';
                }
            })
            .catch(error => {
                console.error('Error en la petición:', error);
                mensajePuntuacion.innerHTML = '<p style="color: red;">Error de conexión</p>';
            });
        }



    </script>

@endsection