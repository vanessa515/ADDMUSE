<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorita extends Model
{
    use HasFactory;

    protected $table = 'favoritas';
    public $timestamps = false;
    protected $primaryKey = 'pk_favorita';

    protected $fillable = [
        'fk_usuario',
        'fk_cancion',
        'fk_album',
    ];
}
