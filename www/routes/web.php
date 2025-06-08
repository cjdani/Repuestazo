<?php

use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\DesguaceController;
use App\Http\Controllers\UserController;



Route::get('/', [InicioController::class, 'inicio'])->name('inicio');

Route::get('/articulos', [ArticuloController::class, 'index'])->name('articulos.index');
Route::get('/desguaces', [DesguaceController::class, 'index'])->name('desguaces.index');

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserController::class, 'doRegister']);
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserController::class, 'doLogin']);
});

Route::middleware('auth')->group(function () {

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/usuario', [UserController::class, 'show'])->name('user.show');
    Route::get('/usuario/editar', [UserController::class, 'showEditSelf'])->name('user.editSelf');
    Route::post('/usuario/editar', [UserController::class, 'doEditSelf']);
    Route::post('/usuario/delete', [UserController::class, 'doDeleteSelf'])->name('user.deleteSelf');

    Route::middleware('role:cliente')->group(function () {
        Route::get('/desguaces/create', [DesguaceController::class, 'showCreate'])->name('desguaces.create');
        Route::post('/desguaces/create', [DesguaceController::class, 'doCreate']);
    });

    Route::middleware('role:empleado')->group(function () {
        Route::post('/desguaces/delete', [DesguaceController::class, 'doDeleteSelf'])->name('desguaces.deleteSelf');
        Route::get('/desguaces/edit', [DesguaceController::class, 'showEditSelf'])->name('desguaces.editSelf');
        Route::post('/desguaces/edit', [DesguaceController::class, 'doEditSelf']);
        Route::get('/articulos/create', [ArticuloController::class, 'showCreate'])->name('articulos.create');
        Route::post('/articulos/create', [ArticuloController::class, 'doCreate']);
    });

    Route::middleware('role:empleado,admin')->group(function () {
        Route::get('/articulos/{id}/edit', [ArticuloController::class, 'showEdit'])->name('articulos.edit');
        Route::post('/articulos/{id}/edit', [ArticuloController::class, 'doEdit']);
        Route::post('/articulos/{id}/delete', [ArticuloController::class, 'doDelete'])->name('articulos.delete');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
        Route::get('/usuario/{id}', [UserController::class, 'showUserDetails'])->name('user.details');
        Route::get('/usuario/{id}/edit', [UserController::class, 'showEdit'])->name('user.edit');
        Route::post('/usuario/{id}/edit', [UserController::class, 'doEdit']);
        Route::post('/desguaces/{id}/delete', [DesguaceController::class, 'doDelete'])->name('desguaces.delete');
        Route::get('/desguaces/{id}/edit', [DesguaceController::class, 'showEdit'])->name('desguaces.edit');
        Route::post('/desguaces/{id}/edit', [DesguaceController::class, 'doEdit']);
        Route::post('/usuario/{id}/delete', [UserController::class, 'doDelete'])->name('user.delete');
    });
});

// Para que no de conflicto con /create
Route::get('/desguaces/{id}', [DesguaceController::class, 'show'])->name('desguaces.show');
