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
                <input type="text" class="form-control" placeholder="Buscar restaurante" style="max-width: 250px; min-width: 200px;">
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
        <li class="nav-item"><a class="nav-link" href="#">Community</a></li>
        
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
        <div class="social-icons d-flex align-items-center">
        <a href="https://www.instagram.com/bcnrestaurantescom/" class="bi bi-instagram"></a>
        <a href="https://x.com/BcnRestaurantes" class="bi bi-twitter"></a>
        <a href="https://www.facebook.com/bcnrestaurantes" class="bi bi-facebook"></a>
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
    <div class="filter-section text-white py-5" style="background: url('{{ asset('img/header.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container">
            <form action="#" method="GET" class="row g-3 align-items-center">
                <!-- Precio -->
                <div class="col-md-4">
                    <label for="precio" class="form-label">Precio (€)</label>
                    <input type="number" name="precio" id="precio" class="form-control" placeholder="Ej. 20">
                </div>

                <!-- Valoración -->
                <div class="col-md-4">
                    <label for="valoracion" class="form-label">Valoración</label>
                    <select name="valoracion" id="valoracion" class="form-select">
                        <option value="">Selecciona</option>
                        <option value="1">1 ⭐</option>
                        <option value="2">2 ⭐</option>
                        <option value="3">3 ⭐</option>
                        <option value="4">4 ⭐</option>
                        <option value="5">5 ⭐</option>
                    </select>
                </div>

                <!-- Tipos de cocina -->
                <div class="col-md-4">
                    <label for="tipo_cocina" class="form-label">Tipo de Cocina</label>
                    <select name="tipo_cocina" id="tipo_cocina" class="form-select">
                        {{-- <option value="">Selecciona</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- RESTAURANTES DESTACADOS --}}

    <div class="container my-5">
        <h2 class="text-center fw-bold">RESTAURANTES DESTACADOS</h2>
        <p class="text-center text-muted">MEJORES RESEÑAS</p>

        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/pacomeralgo.jpg') }}" class="card-img-top" alt="Restaurantes con encanto">
                    <div class="card-body">
                        <h5 class="card-title">Con encanto</h5>
                        <p class="card-text">
                            Hay restaurantes que, solo con poner un pie en ellos, te envuelven en un clima único asegurándote la mejor experiencia gastronómica. 
                            Descubre los mejores restaurantes con encanto de Barcelona para ocasiones especiales.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/disfrutar.jpg') }}" class="card-img-top" alt="Restaurantes italianos y pizzerías">
                    <div class="card-body">
                        <h5 class="card-title">Italiana. Pizzería.</h5>
                        <p class="card-text">
                            Conoce los mejores restaurantes italianos y las mejores pizzerías de la ciudad. ¡Te sentirás como en Italia!
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/pacomeralgo.jpg') }}" class="card-img-top" alt="Restaurantes con oferta">
                    <div class="card-body">
                        <h5 class="card-title">Con oferta</h5>
                        <p class="card-text">
                            Aprovecha nuestras super ofertas y disfruta de los mejores restaurantes a un precio irresistible.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- NUEVOS RESTAURANTES --}}

    <div class="container my-5">
        <h2 class="text-center fw-bold">NUEVOS RESTAURANTES</h2>
        <p class="text-center text-muted">NUEVAS INCORPORACIONES</p>

        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/pacomeralgo.jpg') }}" class="card-img-top" alt="Restaurantes con encanto">
                    <div class="card-body">
                        <h5 class="card-title">Con encanto</h5>
                        <p class="card-text">
                            Hay restaurantes que, solo con poner un pie en ellos, te envuelven en un clima único asegurándote la mejor experiencia gastronómica. 
                            Descubre los mejores restaurantes con encanto de Barcelona para ocasiones especiales.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/disfrutar.jpg') }}" class="card-img-top" alt="Restaurantes italianos y pizzerías">
                    <div class="card-body">
                        <h5 class="card-title">Italiana. Pizzería.</h5>
                        <p class="card-text">
                            Conoce los mejores restaurantes italianos y las mejores pizzerías de la ciudad. ¡Te sentirás como en Italia!
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/pacomeralgo.jpg') }}" class="card-img-top" alt="Restaurantes con oferta">
                    <div class="card-body">
                        <h5 class="card-title">Con oferta</h5>
                        <p class="card-text">
                            Aprovecha nuestras super ofertas y disfruta de los mejores restaurantes a un precio irresistible.
                        </p>
                    </div>
                </div>
            </div>
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