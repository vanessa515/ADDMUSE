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
            'foto' => 'nullable|file|mimes:jpg,jpeg,gif,png|max:2048',  // Foto opcional
        ]);

        // Procesar el archivo de imagen solo si se proporciona
        if ($request->hasFile('foto')) {
            // Si se sube una foto, almacenarla
            $fotoPath = $request->file('foto')->store('imagenes', 'public');
        } else {
            // Si no se sube foto, asignar una por defecto
            $fotoPath = 'imagenes/default.gif';  // Ruta de la foto por defecto
        }

        // Crear un nuevo usuario
        $usuario = new usuario();
        $usuario->user_name = $validated['user_name'];
        $usuario->correo = $validated['correo'];
        $usuario->contraseña = Hash::make($validated['contraseña']);  // Hashear la contraseña
        $usuario->foto = $fotoPath;  // Guardar la foto (subida o por defecto)
        $usuario->estatus = 1;  // Estatus activo
        $usuario->save();  // Guardar el usuario en la base de datos

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Usuario registrado exitosamente');
    }
}
