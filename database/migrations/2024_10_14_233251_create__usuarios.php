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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('pk_usuarios')->autoIncrement();
            $table->string('user_name', 45);
            $table->string('correo', 45)->unique();
            $table->string('contraseña', 100);
            $table->string('estatus', 45);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
