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
    @endif
@endsection
