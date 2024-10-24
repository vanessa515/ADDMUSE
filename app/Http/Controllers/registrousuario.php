<?php

namespace App\Http\Controllers;

use App\Models\usuario; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registrousuario extends Controller
{
    public function store(Request $request)
    {
     
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'correo' => 'required|email|unique:users,email',
            'contraseña' => 'required|string|min:6|confirmed',
        
        ]);

       
        $usuario = new usuario();
        $usuario->user_name = $validated['user_name'];
        $usuario->correo = $validated['correo'];
        $usuario->contraseña = Hash::make($validated['contraseña']);// Hashear la contraseña
        $usuario->estatus = 1; 
        $usuario->save(); // Guardar en la base de datos

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Usuario registrado exitosamente');
    }
}
