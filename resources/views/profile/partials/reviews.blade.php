<!-- resources/views/profile/partials/reviews.blade.php -->
<div>
    <h4>Mis reseñas</h4>
    @if(isset($reviews) && $reviews->isEmpty())
        <p>No has dejado ninguna reseña todavía.</p>
    @elseif(isset($reviews))
        @foreach($reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        @if(isset($review->restaurant) && $review->restaurant !== null)
                            {{ $review->restaurant->name }}
                        @else
                            <span class="text-danger">Restaurante no disponible</span>
                        @endif
                    </h5>
                    <p class="card-text">Calificación: {{ $review->score }} ⭐</p>
                    <p class="card-text">{{ $review->comment }}</p>
                    <small class="text-muted">Publicado el {{ $review->created_at->format('d/m/Y') }}</small>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-danger">Error: No se pudieron cargar las reseñas.</p>
    @endif
</div>
