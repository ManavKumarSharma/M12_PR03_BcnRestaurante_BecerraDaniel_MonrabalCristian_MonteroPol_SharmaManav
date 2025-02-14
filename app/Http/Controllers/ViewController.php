<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
