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
        $orden = $request->input('orden');
    
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
                $consultaRestaurantes->orderBy('created_at');
                $filtro2 = 'Más Antiguos';
                break;
            case 'nuevos':
                $consultaRestaurantes->orderByDesc('created_at');
                $filtro2 = 'Más Nuevos';
                break;
        }
    
        // Realizar la paginación después de aplicar los filtros
        $restaurantes = $consultaRestaurantes->paginate(3);
    
        // Obtener las zonas disponibles para usarlas en el filtro
        $zonas = Zone::all();
    
        $mediaEstrellas = [];
        $zonaRestaurante = [];
    
        // Contam los restaurantes por etiqueta
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
    
        // Inicializamos las variables de estrellas y zona
        foreach ($restaurantes as $restaurante) {
            $id = $restaurante->id;
            
            // Obtenemos la media de estrellas de cada restaurante
            $valoracion = Review::where('restaurants_id', $id)->selectRaw('ROUND(AVG(score), 1) as media_estrellas')->first();

            
            $mediaEstrellas[$id] = $valoracion ? $valoracion->media_estrellas : 'No hay valoraciones';
    
            // Obtenemos la zona del restaurante
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