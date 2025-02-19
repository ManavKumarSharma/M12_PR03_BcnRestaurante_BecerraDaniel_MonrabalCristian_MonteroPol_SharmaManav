<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ViewController;

Route::get('/', [RestaurantController::class, 'tresMejoresValoradosMasNuevos'])->name('tresMejoresValoradosMasNuevos');
Route::get('/categorias', [RestaurantController::class, 'paginaCategorias'])->name('paginaCategorias');

// Rutas para el UserController
Route::controller(UserController::class)->group(function () {
    Route::get('/admin/users', 'showUsersAdminView')->name('admin.users');
    Route::get('/api/users/list', 'getAllUsersFromDB');
    Route::delete('/api/user/delete', 'deleteUserFromDB');
});

// Rutas para el RolController
Route::controller(RolController::class)->group(function () {
    Route::get('/api/roles/list', 'getAllRolesFromDB')->name('admin.users');
});


// Rutas para el RestaurantController
Route::controller(RestaurantController::class)->group(function () {
    Route::get('/admin/restaurants', 'showRestaurantsAdminView')->name('admin.restaurants'); // Endpoint de CRUD restaurantes
});

// Rutas de autenticación
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/register', 'register') -> name('register');
    Route::post('/logout', 'logout')->name('logout');
});

// Rutas relacionadas con restaurantes
Route::controller(RestaurantController::class)->group(function () {
    Route::get('/restaurantes', 'todo')->name('views.restaurantes');
    Route::get('/restaurantes/{id}', 'mostrarElRestaurante')->name('vistas.restaurante');
    Route::post('/puntuar', 'puntuarRestaurante')->name('puntuar');
    Route::delete('/eliminar-puntuacion/{restauranteId}', 'eliminarPuntuacion')->name('eliminar-puntuacion');
    Route::post('/comentar', 'comentarRestaurante')->name('comentar');
    Route::post('/favorito', 'darFavorito')->name('favorito');
});

// Agrupamos las rutas bajo middleware de autenticación para asegurar que solo usuarios logueados puedan acceder

    Route::controller(UserController::class)->group(function () {
        Route::put('/perfil', 'update')->name('user.update');
        Route::delete('/user/photo', 'destroyPhoto')->name('user.photo.delete');
        Route::get('/perfil', 'profileAll')->name('profile.profile-all');
        Route::delete('/favorites/{favoriteId}', 'removeFavorite')->name('favorites.remove');
    });
