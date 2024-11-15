<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\canciones;
use App\Models\usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class perfilController extends Controller
{

    public function showperfil(){
        $userId = Auth::id (); // Obtiene el ID del usuario autenticado
        $usuarios = DB::table('usuarios AS u')
        ->select(
           'u.user_name AS Nombre_usuario',
            'u.correo AS Correo_electronico', 
            'c.nombre AS Musica', 
            'c.imagen AS imagen',
            'c.musica', 
            'c.duracion', 
            'c.fecha',
           'u.foto AS imagen_perfil'
        )
        ->leftjoin ('canciones AS c', 'u.pk_usuarios', '=', 'c.fk_usuario' )
        ->where('u.pk_usuarios', $userId) 
        ->get();

        $favoritas = DB::table('favoritas')
        ->join('usuarios', 'favoritas.fk_usuario', '=', 'usuarios.pk_usuarios')
        ->join('canciones', 'favoritas.fk_cancion', '=', 'canciones.pk_cancion')
        ->join('albumes', 'favoritas.fk_album', '=', 'albumes.pk_album')
        ->where('usuarios.pk_usuarios', '=', Auth::id())
        ->select('albumes.nombre_album', 'canciones.nombre', 'canciones.imagen', 'canciones.musica')
        ->orderBy('albumes.nombre_album') 
        ->where('canciones.estatus', '=', '1')
        ->get()
        ->groupBy('nombre_album'); 
        
      
        //  $info = Auth::user(); 
        //  dd($favoritas);
        return view('perfil', compact('usuarios',  'favoritas'));
    }
////////////////////

public function update(Request $request)
{
    try {
        $usuario = Auth::user(); 

        $validatedData = $request->validate([
            'user_name' => 'required|string|max:250',
            'foto' => 'nullable|file|mimes:jpg,jpeg,gif,png|max:2048', 
        ]);

        $usuario->user_name = $validatedData['user_name'];

   
        if ($request->hasFile('foto')) {
        
            $path = $request->file('foto')->store('storage', 'public'); 

            //dd($path);  // Verifica el path de la imagen guardada

            $usuario->foto = str_replace('public/', 'storage/', $path); // Ajustar la ruta para uso público
        }

        $usuario->save();

        return redirect()->back()->with('success', 'Datos actualizados correctamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
    }
}
}
