<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario  extends Authenticatable
{
    use HasFactory;
    protected $table = 'usuarios';

    protected $primaryKey = 'pk_usuarios';
    protected $fillable = ['user_name','correo','contraseña','estatus'];


}
