<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;

Route::get('/', function () {
    return view('index');
});

// Rutas para el UserController
Route::controller(UserController::class)->group(function () {
    Route::get('/admin/users', 'showUsersAdminView')->name('admin.users'); 
    Route::get('/api/users/list', 'getAllUsersFromDB');
});
 
// Rutas para el RestaurantController
Route::controller(RestaurantController::class)->group(function () {
    Route::get('/admin/restaurants', 'showRestaurantsAdminView')->name('admin.restaurants'); // Endpoint de CRUD restaurantes
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(RestaurantController::class)->group( function(){

    Route::get('/restaurantes', 'todo')->name('views.restaurantes');

    Route::get('/restaurantes/etiqueta', 'filtrarPorEtiqueta')->name('vistas.filtrar-restaurantes');    

    Route::get('/{id}', 'mostrarElRestaurante')->name('vistas.restaurante');

});


Route::get('/perfil', [UserController::class, 'profile'])->name('user.profile');
Route::post('/update', [UserController::class, 'update'])->name('user.update');