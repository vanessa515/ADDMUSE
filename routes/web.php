<?php

use App\Http\Controllers\albumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\registrousuario;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\favoritaController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\PerfilEditController;
use App\Http\Controllers\regcan;
use App\Http\Controllers\regcat;
use App\Http\Controllers\usuarioController;

Route::get('/login', function() {
    return view('login'); 
})->name('login');

Route::post('/login', [logincontroller::class, 'login'])->name('login.post');
Route::post('/logout', [logincontroller::class, 'logout'])->name('logout');


Route::get('/registrous', function () {
    return view('registro');
})->name('register.form');

Route::post('/registrous', [registrousuario::class, 'store'])->name('register.store');


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/registrocat', function () {
    return view('registroCategoria');
})->middleware('auth')->name('registrocat');;

Route::post('/registrocat', [regcat::class, 'store'])->name('regcat.store');

Route::get('/registrocan', function () {
    return view('registroCanciones');
})->middleware('auth')->name('registrocan');


Route::post('/registrocan', [regcan::class, 'store'])->name('regcan.store');
Route::get('/registrocan', [regcan::class, 'showcat'])->middleware('auth')->name('registrocan');
Route::get('/home', [regcan::class, 'showcan'])->middleware('auth')->name('home');
// Route::get('/registrocan', [regcan::class, 'showalbum'])->name('albumshow');

Route::get('/perfil', [perfilController::class, 'showperfil'])->middleware('auth')->name('perfil');;


//////


Route::get('/registroAlbum', [albumController::class, 'showcat'])->middleware('auth')->name('registroAlbum');
Route::post('/registroAlbum', [albumController::class, 'store'])->middleware('auth')->name('album.store');

Route::get('/vistaAlbum', [albumController::class, 'showalbum'])->name('albumshow')->middleware('auth')->name('/vistaAlbum');;

Route::post('/favorita/store', [favoritaController::class, 'store'])->name('favorita.store');

///editar

Route::middleware('auth')->group(function () {
    
    Route::put('perfil', [perfilController::class, 'update'])->name('perfil.update');
});





