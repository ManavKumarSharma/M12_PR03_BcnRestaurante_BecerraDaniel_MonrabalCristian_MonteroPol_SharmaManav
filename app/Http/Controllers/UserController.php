<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController 
{
    /**
     * Muestra el formulario de edición de perfil.
     */
    public function profile()
{
    // Aquí pones la lógica que necesites (por ejemplo, obtener datos del usuario).
    // Finalmente retornas la vista, por ejemplo:
    return view('profile.profile'); // o 'profile.profile' si está en la carpeta 'profile'
}
  // Método que muestra todos los usuarios
    public function showUsersAdminView() {
        $title = 'usuarios';
        return view('admin.users', compact('title'));
    }

    public function getAllUsersFromDB () {
        // Devolver todos los usuarios con el rol incluído
        return response()->json(User::select('id_user', 'name', 'email', 'created_at')->with('role: id_rol, name')->get());
    }
    public function update(Request $request){
        // Aquí pones la lógica que necesites (por ejemplo, actualizar los datos del usuario).
        // Finalmente rediriges a la ruta que quieras, por ejemplo:
        var_dump($request->all());
        $current_user = new User();
        $current_user->name = $request->name;
        $current_user->email = $request->email;
        $current_user->phone_number = $request->phone_number;
        

        var_dump($current_user);
        // Auth::user()->update($request->all());
        // return redirect()->route('user.profile');


        die();
        
    }
}
