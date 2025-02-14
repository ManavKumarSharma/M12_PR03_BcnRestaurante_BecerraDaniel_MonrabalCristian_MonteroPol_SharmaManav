<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController
{
    // Método que muestra todos los usuarios
    public function showUsersAdminView() {
        $title = 'usuarios';
        return view('admin.users', compact('title'));
    }

    public function getAllUsersFromDB () {
        // Devolver todos los usuarios con el rol incluído
        return response()->json(User::select('id_user', 'name', 'email', 'created_at')->with('role: id_rol, name')->get());
    }
}