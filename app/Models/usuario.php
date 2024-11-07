<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class usuario  extends Authenticatable
{
    use HasFactory;
    protected $table = 'usuarios';

    protected $primaryKey = 'pk_usuarios';
    protected $fillable = ['user_name','correo','contraseña','estatus'];

public function showperfil(){
    $userId = Auth::id(); // Obtiene el ID del usuario autenticado
    $usuarios = DB::table('usuarios AS u')
    ->select(
       'u.user_name AS Nombre_usuario',
        'u.correo AS Correo_electronico', 
    )
    ->where('u.pk_usuarios', $userId)
    ->get();
    return $usuarios;
    }
    
}


