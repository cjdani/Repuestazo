<?php

namespace App\Http\Controllers;

use App\Models\Desguace;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DesguaceController extends Controller
{
    public function index()
    {
        $desguaces = Desguace::all();
        return view('desguaces.index', compact('desguaces'));
    }

    public function show($id)
    {
        $desguace = Desguace::with('articulos')->findOrFail($id);
        return view('desguaces.show', compact('desguace'));
    }

    public function showCreate()
    {
        return view('desguaces.create');
    }

    public function doCreate(Request $request)
    {
        $validated = $request->validate([
            'nombre'     => 'required|string|max:255',
            'direccion'  => 'required|string|max:255',
            'telefono'   => 'required|string|max:20',
            'email'      => 'required|email|max:255',
            'ciudad'     => 'required|string|max:100',
            'provincia'  => 'required|string|max:100',
            'imagen'     => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'ubicacion' => [
                'required',
                'regex:/^-?\d{1,3}(?:\.\d+)?,\s*-?\d{1,3}(?:\.\d+)?$/'
            ],
        ]);

        $desguace = new Desguace();
        $desguace->nombre    = $validated['nombre'];
        $desguace->direccion = $validated['direccion'];
        $desguace->telefono  = $validated['telefono'];
        $desguace->email     = $validated['email'];
        $desguace->ciudad    = $validated['ciudad'];
        $desguace->provincia = $validated['provincia'];
        $desguace->imagen    = 'fotos_desguace/default.jpg';
        $desguace->lat_lon   = $validated['ubicacion'];

        $desguace->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $ext = $file->getClientOriginalExtension();
            $filename = 'd-' . $desguace->id . '.' . $ext;
            $file->storeAs('fotos_desguace/', $filename, 'public');
            $desguace->imagen = "fotos_desguace/{$filename}";
            $desguace->save();
        }

        $user = Auth::user();

        $user->role = 'empleado';

        $user->desguace_id = $desguace->id;

        $user->save();

        return redirect()->route('desguaces.show', $desguace->id)->with('success', 'Desguace creado correctamente.');
    }

    public function doDeleteSelf(Request $request)
    {
        $user = Auth::user();
        $desguace = $user->desguace;
        $user->role = 'cliente';
        $user->save();
        $articulos = $desguace->articulos;
        foreach ($articulos as $articulo) {
            $articulo->delete();
        }
        Storage::delete($desguace->imagen);
        $desguace->delete();
        return redirect()->route('desguaces.index')->with('success', 'Desguace eliminado correctamente.');
    }

    public function doDelete(Request $request, $id)
    {
        $desguace = Desguace::findOrFail($id);
        $user = $desguace->user;
        $user->role = 'cliente';
        $user->save();
        $articulos = $desguace->articulos;
        foreach ($articulos as $articulo) {
            $articulo->delete();
        }
        $desguace->delete();
        return redirect()->route('desguaces.index')->with('success', 'Desguace eliminado correctamente.');
    }

    public function showEditSelf(Request $request)
    {
        $user = Auth::user();
        $desguace = $user->desguace;
        return view('desguaces.edit', [
            'desguace' => $desguace,
            'isAdmin' => Auth::user()->role === 'admin',
        ]);
    }

    public function showEdit(Request $request, $id)
    {
        $desguace = Desguace::findOrFail($id);
        return view('desguaces.edit', [
            'desguace' => $desguace,
            'isAdmin' => Auth::user()->role === 'admin',
        ]);
    }

    public function doEditSelf(Request $request)
    {
        $user = Auth::user();
        $desguace = $user->desguace;

        return $this->handleDesguaceUpdate($request, $desguace, false);
    }

    public function doEdit(Request $request, $id)
    {
        $desguace = Desguace::findOrFail($id);

        return $this->handleDesguaceUpdate($request, $desguace, true);
    }

    private function handleDesguaceUpdate(Request $request, Desguace $desguace, $isAdmin)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'telefono'    => 'required|string|max:20',
            'email'       => 'required|email|max:255',
            'direccion'   => 'required|string|max:255',
            'ciudad'      => 'required|string|max:255',
            'provincia'   => 'required|string|max:255',
            'imagen'      => 'nullable|image|max:2048',
            'ubicacion' => [
                'required',
                'regex:/^-?\d{1,3}(?:\.\d+)?,\s*-?\d{1,3}(?:\.\d+)?$/'
            ],
        ]);

        $desguace->nombre    = $validated['nombre'];
        $desguace->direccion = $validated['direccion'];
        $desguace->telefono  = $validated['telefono'];
        $desguace->email     = $validated['email'];
        $desguace->ciudad    = $validated['ciudad'];
        $desguace->provincia = $validated['provincia'];
        $desguace->lat_lon   = $validated['ubicacion'];

        if ($request->hasFile('imagen')) {
            if ($desguace->imagen !== 'fotos_desguace/default.jpg') {
                Storage::delete($desguace->imagen);
            }
            $file = $request->file('imagen');
            $ext = $file->getClientOriginalExtension();
            $filename = 'd-' . $desguace->id . '.' . $ext;
            $file->storeAs('fotos_desguace/', $filename, 'public');
            $desguace->imagen = "fotos_desguace/{$filename}";
        }

        $desguace->save();

        return redirect()->route($isAdmin ? 'user.index' : 'user.show')
            ->with('success', 'Desguace actualizado correctamente.');
    }
}
