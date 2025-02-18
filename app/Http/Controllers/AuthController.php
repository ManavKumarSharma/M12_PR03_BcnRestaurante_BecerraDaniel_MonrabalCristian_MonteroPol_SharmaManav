<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/')->with('success', 'Ya has iniciado sesión.');
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('/')->with('success', 'Ya has iniciado sesión.');
        }
    
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
            if ($user->rol_id == 2) {
                return redirect('/admin/users')->with('success', 'Inicio de sesión exitoso como admin.');
            }
    
            return redirect()->intended('/')->with('success', 'Inicio de sesión exitoso.');
        }
    
        return back()->withErrors([
            'password' => 'Las credenciales son incorrectas.'
        ])->withInput();
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Has cerrado sesión correctamente.');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request) {
    $validator = Validator::make($request->all(), [
        'name'      => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email',
        'phone'     => 'required|digits:9|unique:users,phone_number',
        'password'  => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        return redirect('/login')
            ->withErrors($validator)
            ->withInput()
            ->with('showRegisterModal', true);
    }

    $user = User::create([
        'name'      => $request->name,
        'last_name' => $request->last_name,
        'email'     => $request->email,
        'phone'     => $request->phone_number,
        'password'  => Hash::make($request->password),
        'rol_id'    => 1
    ]);

    Auth::login($user);

    return redirect('/');
}

}
