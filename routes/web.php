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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); 
Route::post('/register', [AuthController::class, 'register']);



Route::middleware('auth')->group(function () {
    Route::get('/perfil', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/perfil', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/photo', [UserController::class, 'destroyPhoto'])->name('user.photo.delete');
    Route::get('/profile-all', [UserController::class, 'profileAll'])->name('profile.profile-all');


    // Otras rutas protegidas...
});

