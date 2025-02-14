<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/perfil', [UserController::class, 'profile'])->name('user.profile');
Route::post('/update', [UserController::class, 'update'])->name('user.update');




