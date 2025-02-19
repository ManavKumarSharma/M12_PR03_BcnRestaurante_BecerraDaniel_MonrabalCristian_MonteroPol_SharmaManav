<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\FoodImage;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RestaurantController
{
    public function getAllRestaurantsFromDB(Request $request) {
        // Inicia la consulta
        $query = Restaurant::select('id', 'name', 'description', 'location', 'average_price', 'phone');

        
        // Obtiene los elementos para la página actual
        $restaurants = $query->get();

        // Transforma los datos
        $restaurants = $restaurants->map(function ($restaurant) {
        return [
            'Id' => $restaurant->id,
            'Nombre' => $restaurant->name,
            'Descripción' => $restaurant->description,
            'Localización' => $restaurant->location,
            'Precio medio' => $restaurant->average_price,
            'Teléfono' => $restaurant->phone
        ];
    });

        return response()->json($restaurants);
    }

    // Método que muestra todos los restaurantes
    public function showRestaurantsAdminView() {
        $title = 'restaurantes';
        return view('admin.restaurants', compact('title'));
    }

    public function todo(Request $request) {

        $etiqueta = $request->input('etiqueta');
        $zona = $request->input('zona');
        $busqueda = $request->input('busqueda');
        $orden = $request->input('orden');
        $pagina = $request->input('pagina', 1);
    
        $filtro = 'Todos los tipos';
        $filtro2 = 'Ordenar';
    
        // Crear una consulta base de restaurantes
        $consultaRestaurantes = Restaurant::with('tags');
    
        // Filtrar por etiqueta si se pasó
        if ($etiqueta && $etiqueta !== 'Todos') {

            $consultaRestaurantes->whereHas('tags', function ($query) use ($etiqueta) {
                $query->where('name', $etiqueta);
            });
            
            $filtro = $etiqueta;
            
        }
            
        // Filtrar por zona si se pasó
        if ($zona) {
            $consultaRestaurantes->whereHas('zone', function ($query) use ($zona) {
                $query->where('name_zone', $zona);
            });
        }
            
    
        // Filtrar por búsqueda si se pasó
        if ($busqueda) {
            $consultaRestaurantes->where('name', 'like', '%' . $busqueda . '%');
        }

        // Aplicar ordenación según el filtro seleccionado
        switch ($orden) {
            case 'precio-mayor-menor':
                $consultaRestaurantes->orderByDesc('average_price');
                $filtro2 = 'Precio de Mayor a Menor';
                break;
            case 'precio-menor-mayor':
                $consultaRestaurantes->orderBy('average_price');
                $filtro2 = 'Precio de Menor a Mayor';
                break;
            case 'mejor-valorados':
                $consultaRestaurantes->withAvg('reviews', 'score')->orderByDesc('reviews_avg_score');
                $filtro2 = 'Mejor Valorados';
                break;
            case 'peor-valorados':
                $consultaRestaurantes->withAvg('reviews', 'score')->orderBy('reviews_avg_score');
                $filtro2 = 'Peor Valorados';
                break;
            case 'antiguos':
                $consultaRestaurantes->orderBy('id');
                $filtro2 = 'Más Antiguos';
                break;
            case 'nuevos':
                $consultaRestaurantes->orderByDesc('id');
                $filtro2 = 'Más Nuevos';
                break;
        }
        
        // Realizar la paginación después de aplicar los filtros
        $restaurantes = $consultaRestaurantes->get();
    
        // Obtener las zonas disponibles para usarlas en el filtro
        $zonas = Zone::all();
    
        $mediaEstrellas = [];
        $zonaRestaurante = [];

        // Inicializamos las variables de estrellas y zona
        foreach ($restaurantes as $restaurante) {
            $id = $restaurante->id;
            
            // Obtenemos la media de estrellas de cada restaurante
            $valoracion = Review::where('restaurants_id', $id)->selectRaw('ROUND(AVG(score), 1) as media_estrellas')->first();

            
            $mediaEstrellas[$id] = $valoracion ? $valoracion->media_estrellas : 'No hay valoraciones';
    
            // Obtenemos la zona del restaurante
            $zonaRestaurante[$id] = Zone::where('id', $restaurante->zones_id)->select('name_zone')->first()->name_zone;
        }
        
        // Contamos los restaurantes por etiqueta
        $restaurantesPorEtiqueta = Restaurant::with('tags')->get()
        // Obtenemos todas las etiqueta que estén relacionadas con restaurantes (et1, et2,...)
        ->flatMap(function ($restaurante) {
            return $restaurante->tags;
        })
        // Agrupamos las etiquetas por su nombre
        ->groupBy('name')
        // Miramos cada grupo de etiquetas que hemos obtenido y contamos cuantos restaurantes tienen cada etiqueta
        ->map(function ($etiquetas) {
            return $etiquetas->count();
        });

        // dd($mediaEstrellas);
    
        // Indicador para mostrar el paginador
        $mostrarPaginador = true;

        $mostrarBarraInicio = true;
    
        return view('restaurantes.todos', compact('filtro', 'filtro2', 'restaurantes', 'mediaEstrellas', 'zonaRestaurante', 'restaurantesPorEtiqueta', 'mostrarPaginador', 'mostrarBarraInicio', 'zonas'));
    }

    public function tresMejoresValoradosMasNuevos() {

        $mejoresValorados = Restaurant::withAvg('reviews', 'score')->orderByDesc('reviews_avg_score')->limit(3)->get();

        // Crear el array mediaEstrellas
        $mediaEstrellas = [];

        foreach ($mejoresValorados as $restaurante) {
            // Asignamos la valoración promedio al array

            $valoracion = Review::where('restaurants_id', $restaurante->id)->selectRaw('ROUND(AVG(score), 1) as media_estrellas')->first();
            $mediaEstrellas[$restaurante->id] = $valoracion ? $valoracion->media_estrellas : 'No hay valoraciones';
        }

        $nuevosRestaurantes = Restaurant::orderByDesc('id')->limit(3)->get();

        foreach ($nuevosRestaurantes as $restaurante) {
            // Asignamos la valoración promedio al array
            $valoracion = Review::where('restaurants_id', $restaurante->id)->selectRaw('ROUND(AVG(score), 1) as media_estrellas')->first();
            $mediaEstrellas[$restaurante->id] = $valoracion ? $valoracion->media_estrellas : 'No hay valoraciones';
        }

        // Contamos los restaurantes por etiqueta
        $restaurantesPorEtiqueta = Restaurant::with('tags')->limit(4)->get()
        // Obtenemos todas las etiqueta que estén relacionadas con restaurantes (et1, et2,...)
        ->flatMap(function ($restaurante) {
            return $restaurante->tags;
        })
        // Agrupamos las etiquetas por su nombre
        ->groupBy('name')
        // Miramos cada grupo de etiquetas que hemos obtenido y contamos cuantos restaurantes tienen cada etiqueta
        ->map(function ($etiquetas) {
            return $etiquetas->count();
        });

        // Contamos los restaurantes por zona
        $restaurantesPorZona = Zone::withCount('restaurants')->limit(7)->get();

        return view('index', compact('mejoresValorados', 'nuevosRestaurantes', 'restaurantesPorZona', 'mediaEstrellas','restaurantesPorEtiqueta'));
    }

    public function busqueda() {

        return view('categorias');
    }


    public function mostrarElRestaurante($id) {
        $userId = Auth::id();

        $restaurante = Restaurant::find($id);
        $valoraciones = Review::with('user')->where('restaurants_id', $id)->whereNotNull('comment')->get();
        $estrella = Review::where('users_id', $userId)->where('restaurants_id', $id)->first();
        $zona = Zone::where('id', $restaurante->zones_id)->value('name_zone');
        $favorito = Favorite::where('users_id', $userId)->where('restaurants_id', $id)->first();
        $fotosComidas = FoodImage::where('restaurants_id', $id)->pluck('image_url');
        $mediaEstrellas = Review::where('restaurants_id', $id)->selectRaw('ROUND(AVG(score), 1) as media_estrellas')->first()->media_estrellas;

        $mostrarBarraInicio = false;

        return view('restaurantes.restaurante', compact('userId', 'restaurante', 'valoraciones', 'estrella', 'zona', 'favorito', 'fotosComidas', 'mediaEstrellas', 'mostrarBarraInicio'));
    }

    public function puntuarRestaurante(Request $request) {

        try {

            $request->validate([
                'puntuacion' => 'required|integer|min:1|max:5',
                'restaurante_id' => 'required|exists:restaurants,id',
            ]);

            if (!Auth::check()) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            $userId = Auth::id();
            $restaurantId = $request->input('restaurante_id');
            $puntuacion = $request->input('puntuacion');

            $review = Review::updateOrCreate(
                ['users_id' => $userId, 'restaurants_id' => $restaurantId],
                ['score' => $puntuacion]
            );

            return response("ok");

        } catch (\Exception $e) {

            return response("Error: " . $e->getMessage(), 500);

        }

    }

    public function comentarRestaurante(Request $request) {

        try {

            $request->validate([
                'comentario' => 'required|string',
                'restaurante_id' => 'required|exists:restaurants,id',
            ]);
    
            if (!Auth::check()) {
                return response("Usuario no autenticado", 401);
            }
    
            $userId = Auth::id();
            $restaurantId = $request->input('restaurante_id');
            $comentario = $request->input('comentario');
    
            $review = Review::updateOrCreate(
                ['users_id' => $userId, 'restaurants_id' => $restaurantId],
                ['comment' => $comentario]
            );
    
            return response("ok");
    
        } catch (\Exception $e) {

            return response("Error: " . $e->getMessage(), 500);

        }

    }

    public function eliminarPuntuacion($restauranteId) {
        try {
            if (!Auth::check()) {
                return response("Usuario no autenticado", 401);
            }

            $userId = Auth::id();

            $review = Review::where('users_id', $userId)
                            ->where('restaurants_id', $restauranteId)
                            ->first();

            if (!$review) {
                return response("No tienes una puntuación para eliminar", 404);
            }

            $review->delete();

            return response("ok");

        } catch (\Exception $e) {
            return response("Error: " . $e->getMessage(), 500);
        }
    }


    public function darFavorito(Request $request) {
    
        try {
            $request->validate([
                'restaurante_id' => 'required|exists:restaurants,id',
            ]);
    
            if (!Auth::check()) {
                return response("Usuario no autenticado", 401);
            }
    
            $userId = Auth::id();
            $restaurantId = $request->input('restaurante_id');
    
            // Verifica si el restaurante ya está en los favoritos
            $favorite = Favorite::where('users_id', $userId)->where('restaurants_id', $restaurantId)->first();
    
            if ($favorite) {
                // Si está en favoritos, lo elimina
                $favorite->delete();
                return response('borrado');
            } else {
                // Si no está en favoritos, lo agrega
                Favorite::create([
                    'users_id' => $userId,
                    'restaurants_id' => $restaurantId
                ]);
                return response('añadido');
            }
    
        } catch (\Exception $e) {
            Log::error("Error en darFavorito: " . $e->getMessage());
            return response("Error: " . $e->getMessage(), 500);
        }
    }
    public function paginaCategorias() {

        // Contamos los restaurantes por etiqueta
        $restaurantesPorEtiqueta = Restaurant::with('tags')->get()
        // Obtenemos todas las etiqueta que estén relacionadas con restaurantes (et1, et2,...)
        ->flatMap(function ($restaurante) {
            return $restaurante->tags;
        })
        // Agrupamos las etiquetas por su nombre
        ->groupBy('name')
        // Miramos cada grupo de etiquetas que hemos obtenido y contamos cuantos restaurantes tienen cada etiqueta
        ->map(function ($etiquetas) {
            return $etiquetas->count();
        });

        // Contamos los restaurantes por zona
        $restaurantesPorZona = Zone::withCount('restaurants')->get();

        return view('categorias', compact('restaurantesPorEtiqueta', 'restaurantesPorZona'));
    }
    


}