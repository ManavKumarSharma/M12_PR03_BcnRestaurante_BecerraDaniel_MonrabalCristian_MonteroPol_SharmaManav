@yield('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Token CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- Boostrap 5 css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <!-- Loader (Pantalla de carga) -->
    <div id="loader">
        <div class="spinner-border text-warning" role="status">
        </div>
    </div>
    
    {{-- Contenido principal después del loader --}}
    <div id="main">

        {{-- Header --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-3 mb-5 bg-white rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/bcn-logo.png') }}" alt="" class="img-fluid">
                </a>
        
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item me-4"> <!-- Agregar margen al final -->
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.users' ? 'text-custom-orange' : 'active' }} fs-5" aria-current="page" href="{{ route('admin.users') }}">Usuarios</a>
                        </li>
                        <li class="nav-item me-4"> <!-- Agregar margen al final -->
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.restaurants' ? 'text-custom-orange' : 'active' }} fs-5" href="{{ route('admin.restaurants') }}">Restaurantes</a>
                        </li>
                        <li class="nav-item me-4"> <!-- Agregar margen al final -->
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.home' ? 'text-custom-orange' : 'active' }} fs-5" href="{{ route('home') }}">Página pública</a>
                        </li>
                    </ul>                    

                    <div class="text-end"> 
                        <button class="btn btn-custom-orange">Cerrar Sesión</button>
                    </div>
                </div>
    

            </div>
        </nav>

        {{-- Contenedor de la tabla y las acciones --}}
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <h1>@yield('title')</h1>
            </div>

            {{-- Contenido de la tabla responsive generado dinámicamente por AJAX --}}
            <div id="table-content">
                
            </div>
        </div>

        {{-- Añadimos el modal --}}
        @yield('modal')

        {{-- Scripts adicionales (cargados desde la vista) --}}
        @stack('scripts')

        {{-- Boostrap 5 JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        {{-- SweetAlert JS --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('js/admin/alert.js') }}"></script>
    </div>
</body>
</html>