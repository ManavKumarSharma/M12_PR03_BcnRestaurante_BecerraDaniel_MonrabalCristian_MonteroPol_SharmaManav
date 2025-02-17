@section('content')
    @if (!Auth::check())
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @else
    @extends('layouts.plantilla_restaurante')

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
                            <li>Centro (476)</li>
                            <li>Eixample Dret (278)</li>
                            <li>Eixample Esquerre (276)</li>
                            <li>St. Gervasi-Santaló (117)</li>
                            <li>Gràcia (153)</li>
                            <li>La Barceloneta (74)</li>
                            <li>El Gòtic (128)</li>
                            <li><a href="#" class="text-primary">Ver todas</a></li>
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
                            <li>Paella. Arroces (109)</li>
                            <li>Tapas. Medias raciones (342)</li>
                            <li>Italiana. Pizzería. (166)</li>
                            <li>Japonesa (119)</li>
                            <li>Brasería. Carnes. (130)</li>
                            <li>Catalana (264)</li>
                            <li>Creativa. De autor (117)</li>
                            <li><a href="#" class="text-primary">Ver todas</a></li>
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
    
    @endif
@endsection
