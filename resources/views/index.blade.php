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
    <header class="bg-white text-dark py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="{{ asset('img/bcn-logo.png') }}" class="logo h4 mb-0" alt="Logo">
            <div class="d-flex align-items-center gap-3">
                <input type="text" class="form-control" placeholder="Buscar restaurante" style="max-width: 300px;">
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
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                            <li><a class="dropdown-item" href="#">Tus reservas</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Entra</a></li>
                            <li><a class="dropdown-item" href="{{ route('login') }}">Regístrate</a></li>
                            <li><a class="dropdown-item" href="#">Tus reservas</a></li>
                        @endif
                    </ul>
                </div>
                
                <div class="dropdown">
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
    

    <nav class="header-bottom navbar navbar-expand-lg">
        <div class="container d-flex justify-content-center">
            <ul class="navbar-nav d-flex justify-content-center">
                <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Restaurantes</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Colecciones</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Community</a></li>
            </ul>
        </div>
        
        <div class="social-icons d-flex align-items-center">
            <a href="https://www.instagram.com/bcnrestaurantescom/" class="bi bi-instagram"></a>
            <a href="https://x.com/BcnRestaurantes" class="bi bi-twitter"></a>
            <a href="https://www.facebook.com/bcnrestaurantes" class="bi bi-facebook"></a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>