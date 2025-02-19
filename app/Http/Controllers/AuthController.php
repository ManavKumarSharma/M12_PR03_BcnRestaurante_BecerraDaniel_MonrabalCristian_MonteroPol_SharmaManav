<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Zone;
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
        $mejoresValorados = Restaurant::withAvg('reviews', 'score')->orderByDesc('reviews_avg_score')->limit(3)->get();

        // Crear el array mediaEstrellas
        $mediaEstrellas = [];

        foreach ($mejoresValorados as $restaurante) {
            // Asignamos la valoración promedio al array

            $valoracion = Review::where('restaurants_id', $restaurante->id)->selectRaw('ROUND(AVG(score), 1) as media_estrellas')->first();
            $mediaEstrellas[$restaurante->id] = $valoracion ? $valoracion->media_estrellas : 'No hay valoraciones';
        }

        $nuevosRestaurantes = Restaurant::orderByDesc('id')->limit(3)->get();

        foreach ($nuevosRestaurantes as $restaurante) {
            // Asignamos la valoración promedio al array
            $valoracion = Review::where('restaurants_id', $restaurante->id)->selectRaw('ROUND(AVG(score), 1) as media_estrellas')->first();
            $mediaEstrellas[$restaurante->id] = $valoracion ? $valoracion->media_estrellas : 'No hay valoraciones';
        }

        // Contamos los restaurantes por etiqueta
        $restaurantesPorEtiqueta = Restaurant::with('tags')->get()
        // Obtenemos todas las etiqueta que estén relacionadas con restaurantes (et1, et2,...)
        ->flatMap(function ($restaurante) {
            return $restaurante->tags;
        })
        // Agrupamos las etiquetas por su nombre
        ->groupBy('name')
        // Miramos cada grupo de etiquetas que hemos obtenido y contamos cuantos restaurantes tienen cada etiqueta
        ->map(function ($etiquetas) {
            return $etiquetas->count();
        });

        // Contamos los restaurantes por zona
        $restaurantesPorZona = Zone::withCount('restaurants')->get();
        
        return view('auth.login', compact('mejoresValorados', 'nuevosRestaurantes', 'restaurantesPorZona', 'mediaEstrellas','restaurantesPorEtiqueta'));
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
