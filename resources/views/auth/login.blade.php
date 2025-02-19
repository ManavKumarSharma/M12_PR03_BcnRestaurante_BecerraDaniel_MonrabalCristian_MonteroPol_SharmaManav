@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bcn Restaurantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <header class="bg-white text-dark py-2 d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="{{ asset('img/bcn-logo.png') }}" class="logo h4 mb-2 mb-lg-0" alt="Logo BCN">
            <div class="d-flex align-items-center gap-3 flex-nowrap" style="white-space: nowrap;">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::check())
                            {{ Auth::user()->name }}
                        @else
                            Mi cuenta
                        @endif
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                        @if(Auth::check())
                            <li><a class="dropdown-item" href="#">Tus reservas</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mis datos</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mis Opiniones</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.edit') }}">Favoritos</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        @else
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Entra</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a></li>
                        @endif
                    </ul>
                </div>
                <div class="dropdown order-last">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="helpDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Ayuda
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="helpDropdown">
                        <li><a class="dropdown-item" href="#">Preguntas frecuentes</a></li>
                        <li><a class="dropdown-item" href="#">Contacto</a></li>
                        <li><a class="dropdown-item" href="#">Soporte</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #f26522;">
    <div class="container">
    <a class="navbar-brand d-lg-none" href="#">
        <img src="{{ asset('img/bcn-logo.png') }}" class="logo" alt="Logo BCN" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('views.restaurantes') }}">Restaurantes</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Colecciones</a></li>
        
        @if(Auth::check() && Auth::user()->rol_id == 2)
            <li class="nav-item"><a class="nav-link" href="/admin/users">Admin site</a></li>
        @endif
        </ul>
        <div class="d-lg-none">
        <input type="text" class="form-control mb-2" placeholder="Buscar restaurante">
        <div class="dropdown mb-2">
            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="accountDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false">
            @if(Auth::check())
                {{ Auth::user()->name }}
            @else
                Mi cuenta
            @endif
            </button>
            <ul class="dropdown-menu" aria-labelledby="accountDropdownMobile">
            @if(Auth::check())
                <li><a class="dropdown-item" href="#">Tus reservas</a></li>
                <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mis datos</a></li>
                <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mis Opiniones</a></li>
                <li><a class="dropdown-item" href="{{ route('user.edit') }}">Favoritos</a></li>
                <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                </form>
                </li>
            @else
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Entra</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a></li>
            @endif
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="helpDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false">
            Ayuda
            </button>
            <ul class="dropdown-menu" aria-labelledby="helpDropdownMobile">
            <li><a class="dropdown-item" href="#">Preguntas frecuentes</a></li>
            <li><a class="dropdown-item" href="#">Contacto</a></li>
            <li><a class="dropdown-item" href="#">Soporte</a></li>
            </ul>
        </div>
        </div>

    </div>
    </div>
</nav>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="login-form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico:</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" onblur="validateEmail(this)">
                            <div class="error-message"></div>
                        </div>
        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" onblur="validatePassword(this)">
                            <div class="error-message">
                                @error('password') {{ $message }} @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Registrarse</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                            <div class="error-message">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Apellidos:</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}">
                            <div class="error-message">{{ $errors->first('last_name') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico:</label>
                            <input type="email" id="email_register" name="email" class="form-control" value="{{ old('email') }}">
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Número de teléfono:</label>
                            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                            <div class="error-message">{{ $errors->first('phone') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" id="password_register" name="password" class="form-control">
                            <div class="error-message">{{ $errors->first('password') }}</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('img/bcn-logo.png') }}" class="logo h4 mb-2 mb-lg-0" alt="Logo BCN">
                </div>
                <div class="col-md-3 text-md-end">
                    <h5>Síguenos en</h5>
                    <a href="https://www.instagram.com/bcnrestaurantescom/" class="bi bi-instagram me-3"></a>
                    <a href="https://x.com/BcnRestaurantes" class="bi bi-twitter me-3"></a>
                    <a href="https://www.facebook.com/bcnrestaurantes" class="bi bi-facebook"></a>
                </div>
            </div>
            <hr class="bg-white">
            <div class="row text-center">
                <div class="col">
                    <a href="#" class="text-white me-3">Clientes</a>
                    <a href="#" class="text-white me-3">Contactar</a>
                    <a href="#" class="text-white me-3">Dar de alta un restaurante</a>
                    <a href="#" class="text-white me-3">Tus reservas</a>
                    <a href="#" class="text-white me-3">Español</a>
                    <a href="#" class="text-white me-3">Català</a>
                    <a href="#" class="text-white">English</a>
                </div>
            </div>
            <div class="row text-center mt-3">
                <div class="col">
                    <p class="mb-0">&copy; 2025 AlDente.com - <a href="#" class="text-white">Aviso legal</a> - <a href="#" class="text-white">Política de privacidad</a> - <a href="#" class="text-white">Política de cookies</a> - 933 300 303</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/form_modal.js') }}"></script>
    <script src="{{ asset('js/validation_login.js') }}"></script>
    <script src="{{ asset('js/validation_register.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('modal') == 'login-modal' || $errors->any())
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            @endif

            @if(session('showRegisterModal'))
                const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
                registerModal.show();
            @endif
        });
    </script>
</body>
</html>