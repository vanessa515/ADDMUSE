<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'pk_categoria';

    protected $fillable = [
        'nombre_cat',
        'estatus',
    ];

}
