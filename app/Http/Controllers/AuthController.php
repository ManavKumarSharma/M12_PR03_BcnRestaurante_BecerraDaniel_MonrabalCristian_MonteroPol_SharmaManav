<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController 
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLoginForm()
    {
        // Si el usuario ya está autenticado, redirecciona a la página principal
        if (Auth::check()) {
            return redirect('/')->with('success', 'Ya has iniciado sesión.');
        }
        
        return view('auth.login');
    }

    /**
     * Valida las credenciales e inicia sesión.
     */
    public function login(Request $request)
    {
        // Si ya hay una sesión iniciada, redirecciona
        if (Auth::check()) {
            return redirect('/')->with('success', 'Ya has iniciado sesión.');
        }

        // Validar los datos ingresados en el formulario
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Intentar autenticar al usuario con Auth::attempt
        if (Auth::attempt($credentials)) {
            // Regenera la sesión para prevenir ataques de fijación de sesión
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Inicio de sesión exitoso');
        }

        // Si falla la autenticación, redirige de vuelta con un error
        return back()->withErrors([
            'password' => 'Las credenciales son incorrectas.'
        ])->withInput();
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Has cerrado sesión correctamente.');
    }
}
