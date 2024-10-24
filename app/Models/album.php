<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    use HasFactory;
      
    protected $table = 'albumes';

    protected $primaryKey = 'pk_album';

    public $timestamps = false;
    protected $fillable = [
    'nombre_album',
    'imagen',
    'estatus',
    'fk_categoria',
    
];

}
