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
        Schema::create('favoritas', function (Blueprint $table) {
            $table->id('pk_favorita')->autoIncrement();
            $table->unsignedBigInteger('fk_usuario');
            $table->unsignedBigInteger('fk_cancion');
            $table->unsignedBigInteger('fk_album');
        });
    }

    /**
 
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritas');
    }
};
