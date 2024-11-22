<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class canciones extends Model
{
    use HasFactory;

    
    protected $table = 'canciones';

    protected $primaryKey = 'pk_cancion';

    public $timestamps = false;
    protected $fillable = [
    'nombre',
    'imagen',
    'musica',
    'duracion',
    'fecha_lanzamiento',
    'estatus',
    'fk_categoria',
    'fk_usuario',
    'fk_album',
];

    
}

