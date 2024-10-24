<?php

use App\Http\Controllers\albumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\registrousuario;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\regcan;
use App\Http\Controllers\regcat;

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
})->name('register.form');

Route::post('/registrocat', [regcat::class, 'store'])->name('regcat.store');

Route::get('/registrocan', function () {
    return view('registroCanciones');
})->name('register.form');

Route::post('/registrocan', [regcan::class, 'store'])->name('regcan.store');
Route::get('/registrocan', [regcan::class, 'showcat'])->name('register.form');
Route::get('/home', [regcan::class, 'showcan'])->name('home');

Route::get('/perfil', [perfilController::class, 'showperfil'])->name('perfil');
//////


Route::get('/registroAlbum', [albumController::class, 'showcat'])->name('album');
Route::post('/registroAlbum', [albumController::class, 'store'])->name('album.store');






