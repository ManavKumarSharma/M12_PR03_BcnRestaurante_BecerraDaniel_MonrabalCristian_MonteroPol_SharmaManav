<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

</head>
<body>
  <!-- Header -->
  <header class="bg-white text-dark py-2">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
      <img src="{{ asset('img/bcn-logo.png') }}" class="logo h4 mb-2 mb-lg-0" alt="Logo BCN">
      <div class="d-flex flex-wrap align-items-center gap-3">
        <input type="text" class="form-control" placeholder="Buscar restaurante" style="max-width: 300px;">
        <!-- Cuenta -->
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
        <!-- Ayuda -->
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

  <!-- Navbar -->
  <nav class="header-bottom navbar navbar-expand-lg navbar-dark" style="background-color: #f26522;">
    <div class="container">
      <a class="navbar-brand d-lg-none" href="#">Menú</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('views.restaurantes') }}">Restaurantes</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Categorías</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Colecciones</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Community</a></li>
        </ul>
      </div>
      <div class="social-icons d-none d-lg-flex align-items-center">
        <a href="https://www.instagram.com/bcnrestaurantescom/" class="bi bi-instagram me-3"></a>
        <a href="https://x.com/BcnRestaurantes" class="bi bi-twitter me-3"></a>
        <a href="https://www.facebook.com/bcnrestaurantes" class="bi bi-facebook"></a>
      </div>
    </div>
  </nav>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Iniciar sesión</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form id="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico:</label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" onblur="validateEmail(this)">
              <div class="error-message">
                @error('email') {{ $message }} @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password" id="password" name="password" class="form-control" onblur="validatePassword(this)">
              <div class="error-message">
                @error('password') {{ $message }} @enderror
              </div>
            </div>
            @if(session('error'))
              <div class="text-danger">
                <p>{{ session('error') }}</p>
              </div>
            @endif
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Register Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Registrarse</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Nombre:</label>
              <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="last_name" class="form-label">Apellidos:</label>
              <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="emailReg" class="form-label">Correo electrónico:</label>
              <input type="email" id="emailReg" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Número de teléfono:</label>
              <input type="tel" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="passwordReg" class="form-label">Contraseña:</label>
              <input type="password" id="passwordReg" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts de Bootstrap y tus JS personalizados -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/form_modal.js') }}"></script>
  <script src="{{ asset('js/validation_login.js') }}"></script>
  
  @yield('content')
  
</body>
</html>
