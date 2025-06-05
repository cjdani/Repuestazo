<?php

namespace App\Http\Controllers;

use App\Models\Desguace;
use Illuminate\Http\Request;

class DesguaceController extends Controller
{
    public function index()
    {
        $desguaces = Desguace::all();
        return view('desguaces.index', compact('desguaces'));
    }

    public function show($id)
    {
        $desguace = Desguace::findOrFail($id);
        return view('desguaces.show', compact('desguace'));
    }
}
