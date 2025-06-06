<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\DesguaceController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('inicio');
    })->name('inicio');

//Articulos
Route::get('/articulos',
    [ArticuloController::class, 'index']
    )->name('articulos.index');

//Desguaces
Route::get('/desguaces',
    [DesguaceController::class, 'index']
    )->name('desguaces.index');

Route::get('/desguaces/create',
    [DesguaceController::class, 'showCreate']
    )->name('desguaces.create');

Route::post('/desguaces/create',
    [DesguaceController::class, 'doCreate']);

Route::get('/desguaces/{id}',
    [DesguaceController::class, 'show']
    )->name('desguaces.show');

//Usuarios
Route::get('/usuario',
    [UserController::class, 'show']
    )->name('user.show');
Route::get('/usuario/{id}',
    [UserController::class, 'showUserDetails']
    )->name('user.details');
Route::get('/usuarios',
    [UserController::class, 'index']
    )->name('user.index');

//Autenticación
Route::get('/register',
    [UserController::class, 'showRegister']
        )->name('register');

Route::post('/register',
    [UserController::class, 'doRegister']
);

Route::get('/login',
    [UserController::class, 'showLogin']
    )->name('login');

Route::post('/login',
    [UserController::class, 'doLogin']
);

Route::get('/logout',
    [UserController::class, 'logout']
    )->name('logout');
