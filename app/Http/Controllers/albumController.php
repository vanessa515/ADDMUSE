<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\categorias;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class albumController extends Controller
{

    public function store (Request $request)
    {
  
        $validate = $request ->validate([
            'nombre_album' => 'required|string|max:250',
            'imagen' => 'required|file|mimes:jpg,jpeg,png|max:2048', 
            'fk_categoria' => 'required|int',
        ]);
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
        }
        
        $album = new album();
        $album -> nombre_album = $validate['nombre_album'];
        $album->imagen = $imagenPath; 
        $album->estatus = 1;
        $album->fk_categoria = $validate['fk_categoria'];
        $album -> save();

        return redirect()->back()->with('success', 'Album registrada exitosamente');
        
    }

    public function showcat()
{
    $categorias = DB::table('categorias')
        ->select('pk_categorias', 'nombre_cat')
        ->get();
            //  dd($categorias);
    return view('registroAlbum', compact('categorias')); // Pasamos los datos a la vista
}

public function showalbum()
{
    $albumes = DB::table('albumes')
        ->select('pk_album', 'nombre_album', 'imagen')
        ->get();
            //   dd($albumes);
    return view('vistaAlbum', compact('albumes')); // Pasamos los datos a la vista
}


}



