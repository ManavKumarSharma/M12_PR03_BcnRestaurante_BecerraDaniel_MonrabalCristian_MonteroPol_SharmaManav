<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class UserController
{

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

        // Caso: Solo se actualiza la foto (sin otros datos)
        if ($request->hasFile('photo') && !$request->filled('name')) {
            $validated = $request->validate([
                'photo' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                // Elimina la foto anterior si existe
                if ($user->profile_image && File::exists(public_path('img/' . $user->profile_image))) {
                    File::delete(public_path('img/' . $user->profile_image));
                }

                $file->move(public_path('img'), $filename);
                // Actualiza el campo en la base de datos:
                $user->profile_image = $filename;
                $user->save();
            }

            return redirect()->route('profile.profile-all')->with('status', 'Foto de perfil actualizada correctamente');
        }

        // Caso: Se actualizan otros datos junto con la foto (si se envía)
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

        // Si se envía una nueva foto, eliminar la anterior antes de guardarla
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Elimina la foto anterior si existe
            if ($user->profile_image && File::exists(public_path('img/' . $user->profile_image))) {
                File::delete(public_path('img/' . $user->profile_image));
            }

            // Guarda la nueva foto
            $file->move(public_path('img'), $filename);
            $updateData['profile_image'] = $filename;
        }

        $user->update($updateData);

        return redirect()->route('profile.profile-all')->with('status', 'Perfil actualizado correctamente');
    }


    public function destroyPhoto(Request $request)
    {
        $user = auth()->user();

        if ($user->profile_image && File::exists(public_path('img/' . $user->profile_image))) {
            File::delete(public_path('img/' . $user->profile_image));
        }

        $user->profile_image = null;
        $user->save();

        return redirect()->route('profile.profile-all')
            ->with('status', 'Foto eliminada correctamente');
    }

    public function profileAll()
    {
        $user = Auth::user();
        $reviews = Review::where('users_id', $user->id)
            ->with('restaurant')
            ->orderBy('created_at', 'desc')
            ->get();

        $favorites = Favorite::where('users_id', $user->id)
            ->with('restaurant')
            ->get();

        return view('profile.profile-all', compact('user', 'reviews', 'favorites'));
    }

    public function removeFavorite($favoriteId)
    {
        // Obtenemos el usuario autenticado
        $user = Auth::user();

        // Buscamos el registro Favorite por ID, asegurándonos de que pertenezca al usuario
        $favorite = Favorite::where('id', $favoriteId)
            ->where('users_id', $user->id)
            ->first();

        // Si no existe o no pertenece al usuario, mostramos un mensaje de error
        if (!$favorite) {
            return redirect()->route('profile.profile-all')->withErrors(['msg' => 'No se encontró el favorito o no te pertenece.']);
        }

        // Eliminamos el favorito
        $favorite->delete();

        // Redirigimos a la página de perfil con un mensaje de éxito
        return redirect()->to(route('profile.profile-all') . '#favoritos-pane')
            ->with('status', 'El restaurante se ha eliminado de tus favoritos.');
    }
}