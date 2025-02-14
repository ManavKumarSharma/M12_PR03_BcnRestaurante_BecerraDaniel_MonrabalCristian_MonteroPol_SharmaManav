<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Rutas para el UserController
Route::controller(UserController::class)->group(function () {
    Route::get('/admin/users', 'showUsersAdminView')->name('admin.users'); // Endpoint de CRUD usuarios
    Route::get('/api/users/list', 'getAllUsersFromDB'); // Endopoint para obtener todos los usuarios con su rol en JSON
});

// Rutas para el RestaurantController
Route::controller(RestaurantController::class)->group(function () {
    Route::get('/admin/restaurants', 'showRestaurantsAdminView')->name('admin.restaurants'); // Endpoint de CRUD restaurantes
});