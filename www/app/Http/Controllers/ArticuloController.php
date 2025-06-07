<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::with('desguace')->get();
        return view('articulos.index', compact('articulos'));
    }

    public function show($id)
    {
        $articulo = Articulo::findOrFail($id);
        return view('articulos.show', compact('articulo'));
    }

    public function showCreate(Request $request)
    {
        return view('articulos.create');
    }

    public function doCreate(Request $request)
    {
        $user = Auth::user();
        $desguace = $user->desguace;

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'precio' => 'required|numeric|min:0',
            'imagen' => 'required|image|max:2048',
        ]);

        $articulo = Articulo::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'categoria' => $validated['categoria'],
            'marca' => $validated['marca'],
            'modelo' => $validated['modelo'],
            'anio' => $validated['anio'],
            'precio' => $validated['precio'],
            'imagen' => 'fotos_articulo/default.svg',
            'desguace_id' => $desguace->id,
        ]);

        if ($request->hasFile('imagen')) {

            $file = $request->file('imagen');
            $filename = "a-{$articulo->id}." . $file->getClientOriginalExtension();

            $path = $file->storeAs('fotos_articulo', $filename, 'public');

            $articulo->imagen = $path;
        }

        $articulo->save();

        return redirect()->route('desguaces.show', $desguace->id )->with('success', 'Artículo creado correctamente.');
    }

    public function showEdit($id)
    {
        $articulo = Articulo::findOrFail($id);
        return view('articulos.edit', compact('articulo'));
    }

    public function doEdit(Request $request, $id)
    {
        $articulo = Articulo::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria' => 'required|string',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'precio' => 'required|numeric|min:0',
        ]);

        $articulo->update($validated);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = "a-{$articulo->id}." . $file->getClientOriginalExtension();
            if ($articulo->imagen !== 'fotos_articulo/default.svg') {
                Storage::delete($articulo->imagen);
            }
            $path = $file->storeAs('fotos_articulo', $filename, 'public');

            $articulo->imagen = $path;
        }

        $articulo->save();

        return redirect()->route('desguaces.show', $articulo->desguace->id )->with('success', 'Artículo actualizado correctamente.');
    }

    public function doDelete(Request $request, $id)
    {
        $articulo = Articulo::findOrFail($id);
        $desguace = $articulo->desguace;

        if ($articulo->imagen !== 'fotos_articulo/default.svg') {
            Storage::delete($articulo->imagen);
        }

        $articulo->delete();

        return redirect()->route('desguaces.show', $desguace->id )->with('success', 'Artículo eliminado correctamente.');
    }
}
