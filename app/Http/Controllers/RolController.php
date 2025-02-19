<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController
{
    public function getAllRolesFromDB() {
        $roles = Rol::all();

        return response()->json($roles, 200);
    }
}
