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
                    <li><a class="dropdown-item" href="#" data-modal="login-modal">Entra</a></li>
                    <li><a class="dropdown-item" href="#" data-modal="register-modal">Regístrate</a></li>
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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  

  @yield('content')
  @yield('scripts')

</body>
</html>
