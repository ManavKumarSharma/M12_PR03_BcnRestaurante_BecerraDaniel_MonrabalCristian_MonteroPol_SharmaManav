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


    public function getAllUsersFromDB(Request $request)
    {
        // Inicia la consulta
        $query = User::select('id', 'name', 'last_name', 'email', 'phone_number', 'rol_id', 'created_at')
            ->with('rol:id,name');

        // Define los campos que pueden ser filtrados
        $filters = [
            'name' => 'name',
            'last_name' => 'last_name',
            'email' => 'email',
            'phone_number' => 'phone_number',
            'rol' => 'rol:name',
            'created_at' => 'created_at',
            // No hace referencia a ninguna tabla
            'end_date' => null
        ];

        // Aplica filtros dinámicos según los parámetros de la solicitud
        foreach ($filters as $param => $column) {
            if ($request->has($param)) {
                // Si es un campo normal, aplica el filtro
                if ($param !== 'rol' && $param !== 'created_at' && $param !== 'end_date') {
                    $query->where($column, 'like', '%' . $request->input($param) . '%');
                } else {
                    // Si es el campo 'rol', usamos whereHas para la relación
                    $query->whereHas('rol', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->input('rol') . '%');
                    });
                }
            }
        }

        // Filtro por fecha (rango de fechas)
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            
            $query->whereBetween('created_at', [
                $startDate . ' 00:00:00', // Hora de inicio
                $endDate . ' 23:59:59'    // Hora de fin
            ]);

        } elseif ($request->has('start_date')) {
            $startDate = $request->input('start_date');
            $query->where('created_at', '>=', $startDate . ' 00:00:00');
        } elseif ($request->has('end_date')) {
            $endDate = $request->input('end_date');
            $query->where('created_at', '<=', $endDate . ' 23:59:59');
        }

        // Obtiene los datos y los transforma
        $users = $query->get()->map(function ($user) {
            return [
                'Id' => $user->id,
                'Nombres' => $user->name,
                'Apellidos' => $user->last_name,
                'Email' => $user->email,
                'Número de teléfono' => $user->phone_number,
                'Rol' => $user->rol->name ?? null,
                'Fecha de creación' => date("d/m/Y", strtotime($user->created_at))
            ];
        });

        // Devuelve un json
        return response()->json($users);
    }



    // Método que elimina el usuario de la base de datos
    public function deleteUserFromDB(Request $request) {
        // Validar el ID del usuario
        $request->validate([
            'userId' => 'required|exists:users,id'
        ]);
    
        // Obtener el usuario por el ID proporcionado
        $user = User::findOrFail($request->userId);
    
        // Eliminar el usuario de la base de datos
        $user->delete();
    
        // Responder con un mensaje de éxito
        return response()->json(['icon' => 'success', 'title' => 'Usuario eliminado', 'text' => 'El usuario se ha eliminado correctamente'], 200);
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