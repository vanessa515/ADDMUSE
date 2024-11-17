<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class albumselectController extends Controller
{
    public function showcanalb($id)
    {
        // Obtener todas las canciones del álbum
        $canciones = DB::table('canciones')
            ->join('albumes', 'canciones.fk_album', '=', 'albumes.pk_album')
            ->select(
                'canciones.pk_cancion',
                'canciones.nombre as nombre_cancion',
                'canciones.imagen as imagen_cancion',
                'canciones.musica',
                'canciones.fecha',
                'albumes.nombre_album',
                'albumes.imagen as imagen_album',
                'albumes.pk_album'
            )
            ->where('albumes.pk_album', '=', $id)
            ->where('canciones.estatus', '=', '1')
            ->where('albumes.estatus', '=', '1')
            ->get(); 

        // Obtener el primer álbum para mostrarlo como encabezado
        $albumInfo = $canciones->first(); 

        // Crear una lista de canciones
        $cancionesList = $canciones->map(function ($cancion) {
            return [
                'pk_cancion' => $cancion->pk_cancion,
                'nombre_cancion' => $cancion->nombre_cancion,
                'imagen_cancion' => $cancion->imagen_cancion,
                'musica' => $cancion->musica,
                'fecha' => $cancion->fecha,
            ];
        });

        // Obtener los detalles del usuario (perfil)
        $usuario = new usuario();
        $usuarios = $usuario->showperfil();

        // Pasar los datos a la vista
        return view('albumselect', [
            'album' => $albumInfo,
            'canciones' => $cancionesList,
            'usuarios' => $usuarios,
        ]);
    }
}
