<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/admin/users', 'showUsersAdminView')->name('admin.users'); 
    Route::get('/api/users/list', 'getAllUsersFromDB');
});

Route::controller(RestaurantController::class)->group(function () {
    Route::get('/admin/restaurants', 'showRestaurantsAdminView')->name('admin.restaurants');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/perfil', [UserController::class, 'profile'])->name('user.profile');
Route::post('/update', [UserController::class, 'update'])->name('user.update');