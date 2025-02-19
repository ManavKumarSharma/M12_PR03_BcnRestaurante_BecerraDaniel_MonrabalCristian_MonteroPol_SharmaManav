<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController
{
    public function getAllRolesFromDB() {
        // Selecciona
        try {
            $roles = Rol::select('name')->get();

            return response()->json($roles, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
