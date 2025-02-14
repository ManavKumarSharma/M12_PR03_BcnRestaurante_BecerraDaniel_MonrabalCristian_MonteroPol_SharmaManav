<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BcnRestaurantes')</title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    @stack('styles')  
</head>
<body>
    <!-- HEADER -->
    <header class="bg-light border-bottom py-3">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('img/bcn-logo.png') }}" alt="Logo" height="40">
            </a>
            <div class="d-none d-md-block">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar restaurante">
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="d-none d-md-flex gap-3">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">daniel</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-star"></i> Mis restaurantes</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-chat-left-text"></i> Mis opiniones</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-right"></i> Siguiendo</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Mis datos</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">Ayuda</button>
                    <ul class="dropdown-menu">
                        <li><span class="dropdown-item-text text-muted">Tel. 933 300 303</span></li>
                        <li><a class="dropdown-item" href="#">Contactar</a></li>
                        <li><a class="dropdown-item" href="#">Dar de alta</a></li>
                    </ul>
                </div>
            </div>
            <button class="btn btn-outline-dark d-md-none" data-bs-toggle="collapse" data-bs-target="#mobileHeader">
                <i class="bi bi-list fs-2"></i>
            </button>
        </div>
    </header>

    <!-- MENÚ MÓVIL -->
    <div class="collapse d-md-none bg-light p-3" id="mobileHeader">
        <div class="container">
            <div class="list-group">
                <a href="#" class="list-group-item">Idioma: ES / EN</a>
                <a href="#" class="list-group-item">Usuario: daniel</a>
                <a href="#" class="list-group-item">Ayuda: Tel. 933 300 303</a>
            </div>
        </div>
    </div>

    <!-- NAVBAR INFERIOR -->
    <nav class="bg-warning py-2 d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="navbar-nav flex-row gap-3 mb-0">
                <li class="nav-item"><a class="nav-link text-white" href="#">Inicio</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Restaurantes</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Categorías</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Colecciones</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">DeliEuros</a></li>
            </ul>
            <div class="d-flex gap-3">
                <a href="#"><i class="bi bi-instagram text-white fs-4"></i></a>
                <a href="#"><i class="bi bi-twitter text-white fs-4"></i></a>
                <a href="#"><i class="bi bi-facebook text-white fs-4"></i></a>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h5>Búsquedas de interés</h5>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="text-warning text-decoration-none">Restaurantes románticos</a>
                        <a href="#" class="text-warning text-decoration-none">Restaurantes con terraza</a>
                        <a href="#" class="text-warning text-decoration-none">Restaurantes de tapas</a>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <p class="mb-0">&copy; 2025 BcnRestaurantes</p>
                    <p class="small">
                        <a class="text-light text-decoration-none" href="#">Aviso legal</a> - 
                        <a class="text-light text-decoration-none" href="#">Política de privacidad</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
