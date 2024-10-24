<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('canciones', function (Blueprint $table) {
            $table->id('pk_cancion')->autoIncrement();
            $table->string('nombre', 45);
            $table->string('imagen', 90);
            $table->string('musica', 255);
            $table->string('duracion', 45);
            $table->dateTime('fecha'); 
            $table->string('estatus', 45);
            $table->unsignedBigInteger('fk_categoria');
            $table->unsignedBigInteger('fk_usuario');
        });
    }

    /**

     */
    public function down(): void
    {
        Schema::dropIfExists('canciones');
    }
};


  