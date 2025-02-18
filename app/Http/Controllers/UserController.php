<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
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
