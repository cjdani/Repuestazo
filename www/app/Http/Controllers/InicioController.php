<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Desguace;
use App\Models\User;

class InicioController extends Controller
{
    public function inicio()
    {
        $articulos = Articulo::count();
        $desguaces = Desguace::count();
        $usuarios = User::count();
        return view('inicio', compact('articulos', 'desguaces', 'usuarios'));
    }
}
