<?php
namespace App\Http\Controllers;

use App\Models\can_alb;
use App\Models\Canciones;
use App\Models\usuario;
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
            'fk_album' => 'required|int',
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
        
        $canciones->nombre =  $validated['nombre'];
        $canciones->imagen = $imagenPath;
        $canciones->musica = $musicaPath; 
        $canciones->duracion = $validated['duracion'];
        $canciones->fecha = Carbon::now(); 
        $canciones->estatus = 1; 
        $canciones->fk_categoria = $validated['fk_categoria'];
        $canciones->fk_usuario = auth()->id(); // Asigna el usuario autenticado
        $canciones->fk_album = $validated['fk_album'];
        $canciones->save(); 

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Canción registrada exitosamente');
    }

    

    public function showcat()
    {
        $categorias = DB::table('categorias')
            ->select('pk_categorias', 'nombre_cat') 
            ->get();
            $albumes = DB::table('albumes')
            ->select('pk_album', 'nombre_album', 'imagen')
            ->where('fk_usuario', Auth::id())
            ->get();
            $usuario=new usuario();
            $usuarios = $usuario->showperfil();
        return view('registroCanciones', compact('categorias', 'albumes', 'usuarios')); // Pasamos los datos a la vista
    }

    public function showcan(Request $request)
    {
    
    // Aquí se carga siempre las canciones limitadas por álbum, incluso si no se realiza búsqueda
    $canciones = DB::table(DB::raw('
        (SELECT 
            pk_cancion,
            nombre,
            canciones.imagen,
            musica,
            duracion,
            fecha,
            fk_album,
            albumes.nombre_album,
            ROW_NUMBER() OVER (PARTITION BY fk_album ORDER BY fecha) AS row_num
        FROM canciones
        JOIN albumes ON canciones.fk_album = albumes.pk_album
        WHERE canciones.estatus = 1) AS canciones_limitadas
    '))
    ->where('row_num', '<=', 4)  // Limita a las primeras 4 canciones por álbum
    ->select(
        'pk_cancion',
        'nombre',
        'imagen',
        'musica',
        'duracion',
        'fecha',
        'fk_album',
        'nombre_album'
    )
    ->get()
    ->groupBy('nombre_album');
    
    // Cargar álbumes
    $albumes = DB::table('albumes')
        ->select('pk_album', 'nombre_album')
        ->where('fk_usuario', Auth::id())
        ->get();
    
    // Obtener datos del usuario
    $usuario = new Usuario();
    $usuarios = $usuario->showperfil();

    return view('home', compact('canciones', 'albumes', 'usuarios'));
}


 
}



