<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use Illuminate\Http\Request;

class regcat extends Controller
{
    
    public function store(Request $request)
    {
     
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',   
        ]);
       
        $categorias = new categorias();
        $categorias->nombre_cat = $validated['nombre'];
        $categorias->estatus = 1; 
        $categorias->save(); // Guardar en la base de datos

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Categoria registrado exitosamente');
    }
}

    

