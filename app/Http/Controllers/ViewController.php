<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ViewController
{
    public function home()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    // public function restaurantes()
    // {
    //     return view('restaurantes.todos');
    // }
}
