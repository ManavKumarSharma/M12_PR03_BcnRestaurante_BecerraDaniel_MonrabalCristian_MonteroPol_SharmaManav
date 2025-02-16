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
        return response()->json(User::select('id_user AS ID', 'name AS Nombre', 'email AS Email', 'created_at AS Fecha de creación')->get());
    }

    public function update(Request $request){
        // Aquí pones la lógica que necesites (por ejemplo, actualizar los datos del usuario).
        // Finalmente rediriges a la ruta que quieras, por ejemplo:
        var_dump($request->all());
        $current_user = new User();
        $current_user->name = $request->name;
        $current_user->email = $request->email;
        $current_user->phone_number = $request->phone_number;
        $current_user->password_hash = $request->password_hash;
        $current_user->save();
        // Auth::user()->update($request->all());
        return redirect()->route('user.profile');
    
        

        var_dump($current_user);
        // Auth::user()->update($request->all());
        // return redirect()->route('user.profile');


        die();
        
    }
}
