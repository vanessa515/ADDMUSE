<?php
namespace App\Http\Controllers;

use App\Models\Canciones;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Importar la clase DB
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;

class regcan extends Controller
{
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:45',  
            'imagen' => 'required|file|mimes:jpg,jpeg,png|max:2048', 
            'musica' => 'required|file|mimes:mp3,wav|max:5048', 
            'duracion' => 'required|string|max:45', 
          
            'fk_categoria' => 'required|int',
        ]);

        // Procesar el archivo de imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
        }

        // Procesar el archivo de música
        if ($request->hasFile('musica')) {
            $musica = $request->file('musica');
            $musicaPath = $request->file('musica')->store('musica', 'public');

            $nombreMusica = $musica->getClientOriginalName(); // Obtener el nombre original del archivo
        }

       
        // Crear nueva canción
        $canciones = new Canciones();

        //NOTA:
        //nombre = substr($nombreMusica, 0, 45); [ese fragmento de codigo nos permite truncar(acortar el nombre del archivo original)]
        
        $canciones->nombre = substr($nombreMusica, 0, 45);
        $canciones->imagen = $imagenPath;
        $canciones->musica = $musicaPath; 
        $canciones->duracion = $validated['duracion'];
        $canciones->fecha = Carbon::now(); 
        $canciones->estatus = 1; 
        $canciones->fk_categoria = $validated['fk_categoria'];
        $canciones->fk_usuario = auth()->id(); // Asigna el usuario autenticado
        $canciones->save(); 

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Canción registrada exitosamente');
    }

    

    public function showcat()
    {
        $categorias = DB::table('categorias')
            ->select('pk_categorias', 'nombre_cat') 
            ->get();

        return view('registroCanciones', compact('categorias')); // Pasamos los datos a la vista
    }

    public function showcan()
    {
        $canciones = DB::table('canciones')
            ->select(
   'pk_cancion',
            'nombre',
            'imagen',
            'musica',
            'duracion',
            'fecha'
            ) 
            ->get();

        return view('home', compact('canciones')); // Pasamos los datos a la vista
    }

    
}



