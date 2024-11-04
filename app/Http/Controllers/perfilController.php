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
        $userId = Auth::id(); // Obtiene el ID del usuario autenticado
        $usuarios = DB::table('usuarios AS u')
        ->select(
           'u.user_name AS Nombre_usuario',
            'u.correo AS Correo_electronico', 
            'c.nombre AS Musica', 
            'c.imagen AS imagen',
            'c.musica', 
            'c.duracion', 
            'c.fecha', 
        )
        ->leftjoin ('canciones AS c', 'u.pk_usuarios', '=', 'c.fk_usuario' )
        ->where('u.pk_usuarios', $userId) 
        ->get();
        $favoritas = DB::table('favoritas')
        ->join('usuarios', 'favoritas.fk_usuario', '=', 'usuarios.pk_usuarios')
        ->join('canciones', 'favoritas.fk_cancion', '=', 'canciones.pk_cancion')
        ->join('albumes', 'favoritas.fk_album', '=', 'albumes.pk_album')
    ->where('albumes.nombre_album', '=', 'Favoritos')->where('usuarios.pk_usuarios', '=', Auth::id())
        ->select('albumes.nombre_album', 'canciones.nombre', 'canciones.imagen', 'canciones.musica')
        ->get();

        return view('perfil', compact('usuarios',  'favoritas'));
    }

}
