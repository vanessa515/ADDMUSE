<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('albumes', function (Blueprint $table) {
            $table->id('pk_album');
            $table->string('nombre_album', 250);
            $table->string('imagen', 90);
            $table->string('estatus', 45);
            $table->unsignedBigInteger('fk_categoria');
        });
    }

    /**
     */
    public function down(): void
    {
        Schema::dropIfExists('albumes');
    }
};
