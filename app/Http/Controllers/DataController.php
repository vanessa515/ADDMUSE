<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;

class DataController extends Controller
{

    public function data(request $request)
    {
        $usuario=new usuario();
        $usuarios = $usuario->showperfil(); 
        return view('index', compact('usuarios'));
    }

    public function data2(request $request)
    {
        $usuario=new usuario();
        $usuarios = $usuario->showperfil(); 
        return view('sobrenosotros', compact('usuarios'));
    }
    
}
