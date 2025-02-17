<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;

Route::get('/', [ViewController::class, 'home'])->name('home');

// Rutas para el UserController
Route::controller(UserController::class)->group(function () {
    Route::get('/admin/users', 'showUsersAdminView')->name('admin.users');
    Route::get('/api/users/list', 'getAllUsersFromDB');
});

// Rutas para el RestaurantController
Route::controller(RestaurantController::class)->group(function () {
    Route::get('/admin/restaurants', 'showRestaurantsAdminView')->name('admin.restaurants'); // Endpoint de CRUD restaurantes
});

// Rutas de autenticación
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Rutas relacionadas con restaurantes
Route::controller(RestaurantController::class)->group(function () {
    Route::get('/restaurantes', 'todo')->name('views.restaurantes');
    Route::get('/restaurantes/{id}', 'mostrarElRestaurante')->name('vistas.restaurante');
    

});


// Rutas del perfil de usuario
Route::controller(UserController::class)->group(function () {
    Route::get('/perfil', 'edit')->name('user.edit'); // Mostrar perfil editable
    Route::put('/perfil', 'update')->name('user.update'); // Actualizar perfil
    Route::delete('/user/photo', 'destroyPhoto')->name('user.photo.delete'); // Eliminar foto
    Route::get('/profile-all', 'profileAll')->name('profile.profile-all'); // Perfil con reviews y favoritos

    
});
