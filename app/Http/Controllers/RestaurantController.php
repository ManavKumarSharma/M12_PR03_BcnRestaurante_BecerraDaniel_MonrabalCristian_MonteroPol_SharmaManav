<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RestaurantController
{
    // Método que muestra todos los restaurantes
    public function showRestaurantsAdminView() {
        $title = 'restaurantes';
        return view('admin.restaurants', compact('title'));
    }

    public function todo()
    {
        $filtro = 'Todos los tipos';
        $filtro2 = '-';

        $restaurantes = Restaurant::paginate(3);

        foreach ($restaurantes as $restaurante) {
            $id = $restaurante->id;
            $mediaEstrellas[$id] = Review::where('restaurants_id', $id)
                ->selectRaw('ROUND(AVG(score), 1) as media_estrellas')
                ->first()->media_estrellas;
        }

        $mostrarPaginador = true;
        return view('restaurantes.todos', compact('filtro', 'filtro2', 'restaurantes', 'mediaEstrellas', 'mostrarPaginador'));
    }

    public function filtrarPorEtiqueta(Request $request)
    {
        $etiqueta = $request->input('etiqueta'); // Obtener el tipo desde la solicitud

        // Si no se pasa un tipo o es "todos", mostrar todos los restaurantes
        if (!$etiqueta || $etiqueta === 'todos') {

            $restaurantes = Restaurant::all();

        } else {

            // Obtiene todos los restaurantes que tienen un tag específico pasado como parámetro ($etiqueta) y
            // filtra los registros de la tabla "tags" donde el campo "name" sea igual al valor de $etiqueta (pasando por la tabla intermedia)
            $restaurantes = Restaurant::whereHas('tags', function ($filtro) use ($etiqueta) {
                $filtro->where('name', $etiqueta);
            })->get();

        }

        return view('restaurantes.todos', compact('restaurantes', 'tipo'));
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