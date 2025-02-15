<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <header class="bg-white text-dark py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="{{ asset('img/bcn-logo.png') }}" class="logo h4 mb-0">
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
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a></li>
                            <li><a class="dropdown-item" href="#">Tus reservas</a></li>
                        @else
                            <li><a class="dropdown-item" href="#" data-modal="login-modal">Entra</a></li>
                            <li><a class="dropdown-item" href="#" data-modal="register-modal">Regístrate</a></li>
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

    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Iniciar sesión</h2>
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
    

    <div id="register-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Registrarse</h2>
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
                    <label for="email" class="form-label">Correo electrónico:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Número de teléfono:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/form_modal.js') }}"></script>
    <script src="{{ asset('js/validation_login.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('modal') == 'login-modal' || $errors->any())
                const loginModal = document.getElementById('login-modal');
                if (loginModal) {
                    loginModal.style.display = 'block';
                }
            @endif
        });
    </script>
</body>
</html>