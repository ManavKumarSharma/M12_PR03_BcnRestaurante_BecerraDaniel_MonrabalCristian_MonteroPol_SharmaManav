<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class UserController 
{
    /**
     * Muestra el formulario de edición de perfil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.profile', ['user' => $user]);
    }
    
    /**
     * Muestra la vista de usuarios para el administrador.
     */
    public function showUsersAdminView()
    {
        $title = 'usuarios';
        return view('admin.users', ['title' => $title]);
    }

    /**
     * Devuelve todos los usuarios con su rol incluido.
     */
    public function getAllUsersFromDB()
    {
        // Se asume que en el modelo User está definida la relación 'role'
        $users = User::select('id_user', 'name', 'email', 'created_at')
                     ->with('role:id_rol,name')
                     ->get();
        
        return response()->json($users);
    }

    /**
     * Actualiza los datos del perfil del usuario.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'Usuario no autenticado.']);
        }
        
        // Si el request tiene un archivo 'photo' y no se envían otros datos (o los otros campos están vacíos),
        // asumimos que se trata solo de actualizar la foto.
        if ($request->hasFile('photo') && !$request->filled('name')) {
            $validated = $request->validate([
                'photo' => 'nullable|image|max:2048',
            ]);
            
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img'), $filename);
                // Actualiza el campo en la base de datos:
                $user->profile_image = $filename;
                $user->save();
            }
            
            return redirect()->route('user.edit')->with('status', 'Foto de perfil actualizada correctamente');
        }
        
        // Si se envían otros datos, validamos y actualizamos todo el perfil
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'password'     => 'nullable|min:6',
            'photo'        => 'nullable|image|max:2048',
        ]);
        
        $updateData = [
            'name'         => $validated['name'],
            'last_name'    => $validated['last_name'],
            'email'        => $validated['email'],
            'phone_number' => $validated['phone_number'] ?? null,
        ];
        
        if (!empty($validated['password'])) {
            $updateData['password'] = bcrypt($validated['password']);
        }
        
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            // Usamos move() para guardar directamente en public/img
            $file->move(public_path('img'), $filename);
            $updateData['profile_image'] = $filename;
        }
        
        $user->update($updateData);
        
        return redirect()->route('user.edit')->with('status', 'Perfil actualizado correctamente');
    }


public function destroyPhoto(Request $request)
{
    $user = auth()->user();

    if ($user->profile_image && File::exists(public_path('img/' . $user->profile_image))) {
        File::delete(public_path('img/' . $user->profile_image));
    }

    $user->profile_image = null;
    $user->save();

    return redirect()->back()->with('success', 'Foto eliminada correctamente');
}
public function profileAll()
{
    // Aquí puedes procesar datos o lógica adicional si lo necesitas
    $user = Auth::user();

    return view('profile.profile-all',['user' => $user]); // Asegúrate de tener esta vista creada en resources/views
}

    
    

}
