<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['email' => 'Credenciales incorrectas'])
                ->withInput()
                ->with('modal', 'login-modal'); // Indicar que se debe abrir el modal
        }
    
        Auth::login($user);
        return redirect('/')->with('success', 'Inicio de sesión exitoso');
    }
    
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => true, 'message' => 'Registro exitoso']);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['success' => true, 'message' => 'Sesión cerrada']);
    }
}
