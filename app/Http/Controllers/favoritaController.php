<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\usuario;
use App\Models\canciones;
use App\Models\favorita;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class favoritaController extends Controller
{
    public function store (Request $request)
    {
  
        $validate = $request ->validate([
            'fk_usuario' => 'required|int',
            'fk_album' => 'required|int',
            'fk_cancion' => 'required|int',
        ]);

        $favorita = new favorita();
        $favorita -> fk_album = $validate['fk_album'];
        $favorita -> fk_cancion = $validate['fk_cancion'];
        $favorita -> fk_usuario = auth()->id();
        $favorita -> save();

        
        

        return redirect()->back()->with('success', 'Favoritas agregadas exitosamente');
        
    }
   

}

