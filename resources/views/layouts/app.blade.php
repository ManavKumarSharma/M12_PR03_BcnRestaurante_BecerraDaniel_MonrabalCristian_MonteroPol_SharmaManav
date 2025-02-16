<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Bcn Restaurantes</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <header class="bg-white border-bottom py-3">
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!-- Logo -->
        <div class="mb-3 mb-md-0">
          <img src="{{ asset('img/bcn-logo.png') }}" alt="Bcn Restaurantes" class="img-fluid" style="max-height:50px;">
        </div>
        <!-- Buscador -->
        <div class="flex-grow-1 mb-3 mb-md-0 mx-md-3">
          <input type="text" class="form-control" placeholder="Buscar restaurante">
        </div>
        <!-- Dropdowns -->
        <div class="d-none d-md-flex align-items-center gap-3">
          <!-- Dropdown de Cuenta -->
          <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              @if(Auth::check())
                {{ Auth::user()->name }} (Autenticado)
              @else
                Mi cuenta (No autenticado)
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
                <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mi Perfil</a></li>
              @else
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Entra</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a></li>
                <li><a class="dropdown-item" href="#">Tus reservas</a></li>
              @endif
            </ul>
          </div>
          <!-- Dropdown de Ayuda -->
          <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="helpDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
    </div>
  </header>
  
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <!-- Botón Toggler para móviles -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" 
              aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Menú colapsable -->
      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Restaurantes</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Colecciones</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Community</a></li>
        </ul>
        <!-- Redes Sociales -->
        <div class="d-flex">
          <a href="https://www.instagram.com/bcnrestaurantescom/" class="text-dark me-3"><i class="bi bi-instagram"></i></a>
          <a href="https://x.com/BcnRestaurantes" class="text-dark me-3"><i class="bi bi-twitter"></i></a>
          <a href="https://www.facebook.com/bcnrestaurantes" class="text-dark"><i class="bi bi-facebook"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <!-- CONTENIDO PRINCIPAL -->
  <div class="container mt-4">
    @yield('content')
  </div>
  
  <!-- FOOTER -->
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
      <div class="row">
        <!-- Búsquedas de interés -->
        <div class="col-12 col-md-8 mb-3 mb-md-0">
          <h5 class="mb-3">Búsquedas de interés</h5>
          <div class="d-flex flex-wrap">
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes románticos en Barcelona</a>
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes nuevos en Barcelona</a>
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes japoneses en Barcelona</a>
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes chinos en Barcelona</a>
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes italianos en Barcelona</a>
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes con terraza en Barcelona</a>
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes con encanto en Barcelona</a>
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes económicos en Barcelona</a>
            <a href="#" class="text-white text-decoration-none me-3 mb-2">Restaurantes con oferta en Barcelona</a>
          </div>
          <a href="#" class="text-white text-decoration-none">Ver todas</a>
        </div>
        <!-- Enlaces y datos legales -->
        <div class="col-12 col-md-4">
          <div class="mb-3">
            <a href="#" class="text-white text-decoration-none me-2">Clientes</a> -
            <a href="#" class="text-white text-decoration-none me-2">Contactar</a> -
            <a href="#" class="text-white text-decoration-none me-2">Dar de alta un restaurante</a> -
            <a href="#" class="text-white text-decoration-none me-2">Mis reservas</a> -
            <a href="#" class="text-white text-decoration-none me-2">Español</a> -
            <a href="#" class="text-white text-decoration-none me-2">Català</a> -
            <a href="#" class="text-white text-decoration-none">English</a>
          </div>
          <div>
            <small class="d-block">
              © 2025 ADenTro.com - Aviso legal - Política de privacidad - Política de cookies - 933 300 303
            </small>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS (Bundle incluye Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  @yield('scripts')
</body>
</html>
