<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



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

    // Método que busca el usuario por id
    public function getUserFromDB(User $user)  // Laravel automáticamente encuentra el usuario
    {
        return response()->json($user, 200);  // Devuelve el usuario encontrado en formato JSON
    }

    public function editUserFromDB(User $user, Request $request)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20',
            'rol_id' => 'required|integer|in:1,2,3',  // Roles disponibles: 1 => admin, 2 => client, 3 => manager
            // 'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional, pero si está presente debe cumplir con los requisitos
        ]);

        try {
            // Asignar los valores al usuario
            $user->name = $validatedData['name'];
            $user->last_name = $validatedData['last_name'];
            $user->email = $validatedData['email'];
            $user->phone_number = $validatedData['phone_number'];
            $user->rol_id = $validatedData['rol_id'];

            // Si se ha enviado una nueva contraseña, la actualizamos
            // if ($request->filled('password')) {
            //     $user->password = Hash::make($validatedData['password']);
            // }

            // Guardar los cambios en el usuario
            $user->save();

            // Devolver respuesta json
            return response()->json([
                'icon' => 'success', 
                'title' => 'Usuario editado', 
                'text' => 'El usuario se ha editado correctamente.'
            ], 200);

        } catch (\Exception $e) {
            // Respuesta de error si algo salió mal
            return response()->json([
                'icon' => 'error', 
                'title' => 'Error', 
                'text' => 'Error al editar el usuario.'
            ], 500);
        }
    }

    // Método que busca el usuario por email
    public function getUserByEmailFromDB(Request $request) {
        try {
            // Validar los parámetros de entrada
            $validated = $request->validate([
                'search' => 'required|string|email|max:255', // El email es requerido y debe ser un formato válido
            ]);
    
            // Obtener el email del request
            $email = $validated['search'];
    
            // Buscar el usuario en la base de datos
            $user = User::where('email', $email)->first();
    
            // Verificar si el usuario existe
            if ($user) {
                // Si existe, devolvemos 'exists' true y el objeto 'user'
                return response()->json(['exists' => true], 200);
            } else {
                // Si no existe, devolvemos 'exists' false
                return response()->json(['exists' => false], 200);
            }
        } catch (\Exception $e) {
            // En caso de error, devolvemos un error con el mensaje
            return response()->json(['error' => 'Error al verificar el usuario: ' . $e->getMessage()], 500);
        }
    }

    // Método que crea un usuario
    public function createUser(Request $request) {
        try {
            // Validación de entrada
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'phoneNumber' => 'required|string|min:9|max:15',
                'role' => 'required|int|exists:rol,id',
                'password' => 'required|string|min:8|confirmed',
            ]);
    
            // Crear usuario
            $user = User::create([
                'name' => $validated['name'],
                'last_name' => $validated['lastName'],
                'email' => $validated['email'],
                'phone_number' => $validated['phoneNumber'],
                'rol_id' => $validated['role'],
                'password' => Hash::make($validated['password']),
            ]);
    
            // Devolver respuesta json
            return response()->json([
                'icon' => 'success', 
                'title' => 'Usuario creado', 
                'text' => 'El usuario se ha creado correctamente'
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Hubo un problema al crear el usuarios.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Devuelve todos los usuarios con su rol incluido.
     */
    public function getAllUsersFromDB(Request $request)
    {
        try {
            // Validar los parámetros de entrada
            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255',
                'phone_number' => 'nullable|string|max:20',
                'rol_id' => 'nullable|integer|exists:rol,id',
                'created_at_start' => 'nullable|date',
                'created_at_end' => 'nullable|date|after_or_equal:created_at_start',
                'sortColumn' => 'nullable|string|in:id,name,last_name,email,phone_number,rol_id,created_at',
                'orderColumn' => 'nullable|string|in:asc,desc',
                'per_page' => 'nullable|integer|min:1|max:100',
                'page' => 'nullable|integer|min:1',
            ]);

            // Construcción de la consulta
            $query = User::select('id', 'name', 'last_name', 'email', 'phone_number', 'rol_id', 'created_at')
                ->with('rol:id,name');

            // Aplicar búsqueda si se proporciona
            if (!empty($validated['search'])) {
                $searchTerm = $validated['search'];
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%$searchTerm%")
                        ->orWhere('last_name', 'like', "%$searchTerm%")
                        ->orWhere('email', 'like', "%$searchTerm%")
                        ->orWhere('phone_number', 'like', "%$searchTerm%")
                        ->orWhereHas('rol', function ($q) use ($searchTerm) {
                            $q->where('name', 'like', "%$searchTerm%");
                        });
                });
            }

            // Aplicar filtros dinámicamente
            if (!empty($validated['name'])) {
                $query->where('name', 'like', "%{$validated['name']}%");
            }
            if (!empty($validated['last_name'])) {
                $query->where('last_name', 'like', "%{$validated['last_name']}%");
            }
            if (!empty($validated['email'])) {
                $query->where('email', 'like', "%{$validated['email']}%");
            }
            if (!empty($validated['phone_number'])) {
                $query->where('phone_number', 'like', "%{$validated['phone_number']}%");
            }
            if (!empty($validated['rol_id'])) {
                $query->where('rol_id', $validated['rol_id']);
            }
            
            
            // Aplicar filtro de rango de fechas con rango completo del día
            if (!empty($validated['created_at_start']) && !empty($validated['created_at_end'])) {
                $startDate = Carbon::parse($validated['created_at_start'])->startOfDay(); // 00:00:00
                $endDate = Carbon::parse($validated['created_at_end'])->endOfDay(); // 23:59:59
                $query->whereBetween('created_at', [$startDate, $endDate]);
            } elseif (!empty($validated['created_at_start'])) {
                $query->where('created_at', '>=', Carbon::parse($validated['created_at_start'])->startOfDay());
            } elseif (!empty($validated['created_at_end'])) {
                $query->where('created_at', '<=', Carbon::parse($validated['created_at_end'])->endOfDay());
            }


            // Aplicar ordenación si se proporciona
            if (!empty($validated['sortColumn']) && !empty($validated['orderColumn'])) {
                $query->orderBy($validated['sortColumn'], $validated['orderColumn']);
            }

            // Definir paginación con valores por defecto
            $perPage = $validated['per_page'] ?? 10;
            $users = $query->paginate($perPage);

            // Formatear los datos
            $formattedUsers = $users->map(function ($user) {
                return [
                    'Id' => $user->id,
                    'Nombres' => $user->name,
                    'Apellidos' => $user->last_name,
                    'Email' => $user->email,
                    'Número de teléfono' => $user->phone_number,
                    'Rol' => $user->rol->name ?? null,
                    'Fecha de creación' => $user->created_at
                ];
            });

            // Responder con los datos y la paginación
            return response()->json([
                'data' => $formattedUsers,
                'pagination' => [
                    'total_items' => $users->total(),
                    'total_pages' => $users->lastPage(),
                    'current_page' => $users->currentPage(),
                    'per_page' => $users->perPage(),
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Hubo un problema al obtener los usuarios.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }


    public function deleteUserFromDB(User $user) {
        DB::beginTransaction(); // Inicia la transacción

        try {
            // Eliminar primero los registros relacionados en otras tablas
            $user->favorites()->delete(); 
            $user->reviews()->delete(); 
            $user->restaurants()->delete();

            // Luego, eliminar el usuario
            $user->delete();

            DB::commit(); // Confirmar la transacción

            // Devolver respuesta json
            return response()->json([
                'icon' => 'success', 
                'title' => 'Usuario eliminado', 
                'text' => 'El usuario se ha eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack(); // Revierte la transacción si hay error

            return response()->json([
                'icon' => 'error',
                'title' => 'Error',
                'text' => $e->getMessage()
            ], 500);
        }
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
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|min:9|max:9',
            'password'     => 'nullable|min:8',
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