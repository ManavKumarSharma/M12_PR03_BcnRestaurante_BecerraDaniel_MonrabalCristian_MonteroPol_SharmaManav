<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RestaurantController extends Controller
{
    // Método que muestra todos los restaurantes
    public function showRestaurantsAdminView() {
        $title = 'restaurantes';
        return view('admin.restaurants', compact('title'));
    }

    public function todo(Request $request) {
        // Obtener el parámetro 'etiqueta' y 'busqueda' de la URL
        $etiqueta = $request->input('etiqueta');
        $busqueda = $request->input('busqueda');
    
        $filtro = 'Todos los tipos';
        $filtro2 = '-';
    
        // Crear una consulta base de restaurantes
        $consultaRestaurantes = Restaurant::with('tags');
    
        // Filtrar por etiqueta si se pasó
        if ($etiqueta && $etiqueta !== 'Todos') {

            $consultaRestaurantes->whereHas('tags', function ($query) use ($etiqueta) {
                $query->where('name', $etiqueta);
            });
            
            $filtro = $etiqueta;
            
        }
    
        // Filtrar por búsqueda si se pasó
        if ($busqueda) {
            $consultaRestaurantes->where('name', 'like', '%' . $busqueda . '%');
        }
    
        // Realizar la paginación después de aplicar los filtros
        $restaurantes = $consultaRestaurantes->paginate(3);
    
        // Obtener las zonas disponibles para usarlas en el filtro
        $zonas = Zone::all();
    
        $mediaEstrellas = [];
        $zonaRestaurante = [];
    
        // Contar los restaurantes por etiqueta
        $restaurantesPorEtiqueta = Restaurant::with('tags')->get()->flatMap(function ($restaurante) {
            return $restaurante->tags;
        })->groupBy('name')->map(function ($etiquetas) {
            return $etiquetas->count();
        });
    
        // Inicializar las variables de estrellas y zona
        foreach ($restaurantes as $restaurante) {
            $id = $restaurante->id;
            
            // Obtener la media de estrellas de cada restaurante
            $valoracion = Review::where('restaurants_id', $id)->selectRaw('ROUND(AVG(score), 1) as media_estrellas')->first();
            $mediaEstrellas[$id] = $valoracion ? $valoracion->media_estrellas : 'No hay valoraciones';
    
            // Obtener la zona del restaurante
            $zonaRestaurante[$id] = Zone::where('id', $restaurante->zones_id)->select('name_zone')->first()->name_zone;
        }
    
        // Indicador para mostrar el paginador
        $mostrarPaginador = true;
    
        return view('restaurantes.todos', compact('filtro', 'filtro2', 'restaurantes', 'mediaEstrellas', 'zonaRestaurante', 'restaurantesPorEtiqueta', 'mostrarPaginador', 'zonas'));
    }
    

    public function mostrarElRestaurante($id)
    {
        $userId = session('user_id');

        $restaurante = Restaurant::find($id);
        $valoraciones = Review::with('usuario')->where('restaurants_id', $id)->get();
        $estrella = Review::where('users_id', $userId)->where('restaurants_id', $id)->first();
        $mediaEstrellas = Review::where('restaurants_id', $id)->selectRaw('ROUND(AVG(core), 1) as media_estrellas')->first()->media_estrellas;

        return view('vistas.restaurante', compact('userId', 'restaurante', 'valoraciones', 'estrella', 'mediaEstrellas'));
    }
}