<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController
{
    // Método que muestra todos los restaurantes
    public function showRestaurantsAdminView() {
        $title = 'restaurantes';
        return view('admin.restaurants', compact('title'));
    }
}