<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\canciones;
use App\Models\categorias;
use App\Models\usuario;
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
            'fk_usuario' => 'required|int',
        ]);
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
        }
        
        $album = new album();
        $album -> nombre_album = $validate['nombre_album'];
        $album->imagen = $imagenPath; 
        $album->estatus = 1;
        $album->fk_categoria = $validate['fk_categoria'];
        $album -> fk_usuario = auth()->id();
        $album -> save();

        return redirect()->back()->with('success', 'Album registrada exitosamente');
        
    }

    public function showcat()
{
    $categorias = DB::table('categorias')
        ->select('pk_categorias', 'nombre_cat')
        ->get();
        $usuario=new usuario();
        $usuarios = $usuario->showperfil();
            //  dd($categorias);
    return view('registroAlbum', compact('categorias')); // Pasamos los datos a la vista
}

public function showalbum()
{
    $albumes = DB::table('canciones')
        ->join('albumes', 'canciones.fk_album', '=', 'albumes.pk_album')
        ->join('usuarios', 'canciones.fk_usuario', '=', 'usuarios.pk_usuarios')
        ->select(
            'pk_cancion',
            'nombre',
            'canciones.imagen',
            'canciones.estatus',
            'albumes.imagen as imagen_album',
            'musica',
            'duracion',
            'fecha',
            'fk_album',
            'pk_album',
            'albumes.nombre_album'
        )
        ->where('usuarios.pk_usuarios', '=', Auth::id())
            
        ->get();  
        $albumes = $albumes->groupBy('nombre_album');
   
    $usuario = new usuario();
    $usuarios = $usuario->showperfil();

    
    return view('vistaAlbum', compact('albumes', 'usuarios'));
}

public function update(Request $request)
{
    try {
   
        $validatedData = $request->validate([
            'pk_cancion' => 'required|exists:canciones,pk_cancion', 
            'nombre' => 'required|string|max:45',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', 
            'pk_album' => 'required|exists:albumes,pk_album', 
            'nombre_album' => 'required|string|max:250',
            'imagen_album' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

   
        $cancion = canciones::findOrFail($validatedData['pk_cancion']);
        $cancion->nombre = $validatedData['nombre'];

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('canciones', 'public');
            $cancion->imagen = $path;
        }

        $cancion->save();

        
         $album = album::findOrFail($validatedData['pk_album']);
         $album->nombre_album = $validatedData['nombre_album'];

         if ($request->hasFile('imagen_album')) {
             $path = $request->file('imagen_album')->store('albumes', 'public');
             $album->imagen = $path;
         }
         $album->save();


        return redirect()->back()->with('success', 'Datos actualizados correctamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al ejecutar la consulta: ' . $e->getMessage());
    }
}




public function delete(Request $request)
{
   
    $validatedData = $request->validate([
        'pk_cancion' => 'required|exists:canciones,pk_cancion',
    ]);

    $cancion = canciones::findOrFail($validatedData['pk_cancion']);

    if ($cancion->estatus == 1) {
        $cancion->estatus = 0; 
        $cancion->save();

    
}else{
    
        $cancion->estatus = 1; 
        $cancion->save();

        return redirect()->back()->with('error', 'La canción esta de nuevo en linea.');

 }
 return redirect()->back()->with('success', 'Canción eliminada correctamente.');

}

public function EliminarAlb($id)
{

   $album = album::where('pk_album', $id)
   ->where('fk_usuario', auth()->id())  
   ->first();

if (!$album) {
return redirect()->back()->with('error', 'Album no encontrada.');
}

$album->delete();

return redirect()->back()->with('success', 'Album eliminada de favoritas.');

   
}

}