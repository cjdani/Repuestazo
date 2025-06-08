<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Desguace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticuloController extends Controller
{
    public function index(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'nombre'     => ['nullable', 'string', 'max:100'],
            'marca'        => ['nullable', 'string', 'max:50'],
            'modelo'       => ['nullable', 'string', 'max:50'],
            'anio'         => ['nullable', 'digits:4', 'integer', 'min:1900', 'max:' . date('Y')],
            'min_precio'   => ['nullable', 'numeric', 'min:0'],
            'max_precio'   => ['nullable', 'numeric', 'min:0'],
            'desguace_id'  => ['nullable', 'exists:desguaces,id'],
        ])->validate();

        $query = Articulo::query();

        if (!empty($validated['nombre'])) {
            $query->where('nombre', 'like', '%' . $validated['nombre'] . '%');
        }

        if (!empty($validated['marca'])) {
            $query->where('marca', 'like', '%' . $validated['marca'] . '%');
        }

        if (!empty($validated['modelo'])) {
            $query->where('modelo', 'like', '%' . $validated['modelo'] . '%');
        }

        if (!empty($validated['anio'])) {
            $query->where('anio', $validated['anio']);
        }

        if (!empty($validated['min_precio'])) {
            $query->where('precio', '>=', $validated['min_precio']);
        }

        if (!empty($validated['max_precio'])) {
            $query->where('precio', '<=', $validated['max_precio']);
        }

        if (!empty($validated['desguace_id'])) {
            $query->where('desguace_id', $validated['desguace_id']);
        }

        $articulos = $query->with('desguace')->get();
        $desguaces = Desguace::all();

        return view('articulos.index', compact('articulos', 'desguaces'));
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
            'nombre' => ['required', 'string', 'max:50', 'regex:/^[\pL\pN\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'descripcion' => ['required', 'string', 'min:10', 'max:1000'],
            'marca' => ['required', 'string', 'max:50', 'regex:/^[\pL\pN\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'modelo' => ['required', 'string', 'max:50', 'regex:/^[\pL\pN\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'anio' => ['required', 'integer', 'between:1900,' . date('Y')],
            'precio' => ['required', 'numeric', 'min:0'],
            'imagen' => ['nullable', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'Máximo 50 caracteres.',
            'nombre.regex' => 'Solo letras, números, espacios y guiones.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'Debe contener al menos 10 caracteres.',
            'descripcion.max' => 'Máximo 1000 caracteres.',

            'marca.required' => 'La marca es obligatoria.',
            'marca.regex' => 'Solo letras, números, espacios y guiones.',

            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.regex' => 'Solo letras, números, espacios y guiones.',

            'anio.required' => 'El año es obligatorio.',
            'anio.between' => 'El año debe estar entre 1900 y ' . date('Y') . '.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.min' => 'El precio debe ser un número positivo.',

            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'Solo se permiten imágenes jpeg, jpg, png o svg.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ]);

        $articulo = Articulo::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
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

        return redirect()->route('desguaces.show', $desguace->id)->with('success', 'Artículo creado correctamente.');
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
            'nombre' => ['required', 'string', 'max:50', 'regex:/^[\pL\pN\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'descripcion' => ['required', 'string', 'min:10', 'max:1000'],
            'marca' => ['required', 'string', 'max:50', 'regex:/^[\pL\pN\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'modelo' => ['required', 'string', 'max:50', 'regex:/^[\pL\pN\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'anio' => ['required', 'integer', 'between:1900,' . date('Y')],
            'precio' => ['required', 'numeric', 'min:0'],
            'imagen' => ['nullable', 'image', 'mimes:jpeg,jpg,png,svg', 'max:2048'],
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras, números, espacios y guiones.',
            'marca.regex' => 'La marca solo puede contener letras, números, espacios y guiones.',
            'modelo.regex' => 'El modelo solo puede contener letras, números, espacios y guiones.',
            'anio.between' => 'El año debe estar entre 1900 y ' . date('Y') . '.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'Solo se permiten imágenes jpeg, jpg, png o svg.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ]);

        $articulo->update($validated);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = "a-{$articulo->id}." . $file->getClientOriginalExtension();
            $path = $file->storeAs('fotos_articulo', $filename, 'public');

            if ($articulo->imagen !== 'fotos_articulo/default.svg' && Storage::disk('public')->exists($articulo->imagen)) {
                Storage::disk('public')->delete($articulo->imagen);
            }

            $articulo->imagen = $path;
        }

        $articulo->save();

        return redirect()->route('desguaces.show', $articulo->desguace->id)->with('success', 'Artículo actualizado correctamente.');
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
