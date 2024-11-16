<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class logincontroller extends Controller
{
    public function login(Request $request)
    {
        // Validar los campos del formulario
        $validated = $request->validate([
            'user_name' => 'required|string',
            'contraseña' => 'required|string|min:6',
        ]);

        // Buscar al usuario por nombre de usuario 
        $usuario = Usuario::where('user_name', $validated['user_name']) // Permitir login con nombre de usuario
                            ->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && Hash::check($validated['contraseña'], $usuario->contraseña)) {
            // Si la autenticación es exitosa, puedes iniciar sesión manualmente
            Auth::login($usuario);

            // Redirigir al usuario a una página después del login
            return redirect()->route('index')->with('success', 'Has iniciado sesión correctamente');
        }

        // Si la autenticación falla, devolver un error
        return back()->withErrors([
            'user_name' => 'El nombre de usuario o la contraseña son incorrectos.',
        ]);
    }





    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
