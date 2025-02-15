<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RestaurantController extends Controller
{
    // Método que muestra todos los restaurantes
    public function showRestaurantsAdminView() {
        $title = 'restaurantes';
        return view('admin.restaurants', compact('title'));
    }
}