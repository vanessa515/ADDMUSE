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

        return view('perfil', compact('usuarios'));
    }

}
