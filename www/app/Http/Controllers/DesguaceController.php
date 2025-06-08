<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Desguace;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DesguaceController extends Controller
{
    public function index(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
        ])->validate();

        $query = Desguace::query();

        if (!empty($validated['nombre'])) {
            $query->where('nombre', 'like', '%' . $validated['nombre'] . '%');
        }

        if (!empty($validated['ciudad'])) {
            $query->where('ciudad', 'like', '%' . $validated['ciudad'] . '%');
        }

        if (!empty($validated['provincia'])) {
            $query->where('provincia', 'like', '%' . $validated['provincia'] . '%');
        }

        $desguaces = $query->get();

        return view('desguaces.index', compact('desguaces'));
    }

    public function show(Request $request, $id)
    {
        $desguace = Desguace::findOrFail($id);

        $validated = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:100',
            'modelo' => 'nullable|string|max:100',
            'anio' => 'nullable|integer|min:1900|max:' . date('Y'),
            'min_precio'   => ['nullable', 'numeric', 'min:0'],
            'max_precio'   => ['nullable', 'numeric', 'min:0'],
        ])->validate();

        $query = $desguace->articulos()->newQuery();

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

        $articulos = $query->get();

        return view('desguaces.show', compact('desguace', 'articulos'));
    }

    public function showCreate()
    {
        return view('desguaces.create');
    }

    public function doCreate(Request $request)
    {
        $validated = $request->validate([
            'nombre'     => ['required', 'string', 'max:100', 'regex:/^[\pL\pN\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'direccion'  => ['required', 'string', 'max:255'],
            'telefono'   => ['required', 'string', 'max:20', 'regex:/^[\d\s+\-()]+$/'],
            'email'      => ['required', 'email', 'max:255'],
            'ciudad'     => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'provincia'  => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-áéíóúÁÉÍÓÚñÑ]+$/u'],
            'imagen'     => ['required', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'ubicacion'  => ['required', 'regex:/^-?\d{1,3}(?:\.\d+)?,\s*-?\d{1,3}(?:\.\d+)?$/'],
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras, números, espacios y guiones.',
            'telefono.regex' => 'El teléfono contiene caracteres no permitidos.',
            'ciudad.regex' => 'La ciudad solo puede contener letras y espacios.',
            'provincia.regex' => 'La provincia solo puede contener letras y espacios.',
            'ubicacion.regex' => 'La ubicación no tiene un formato válido.',
        ]);

        $desguace = new Desguace();
        $desguace->nombre    = $validated['nombre'];
        $desguace->direccion = $validated['direccion'];
        $desguace->telefono  = $validated['telefono'];
        $desguace->email     = $validated['email'];
        $desguace->ciudad    = $validated['ciudad'];
        $desguace->provincia = $validated['provincia'];
        $desguace->lat_lon   = $validated['ubicacion'];
        $desguace->imagen    = 'fotos_desguace/default.jpg';

        $desguace->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = 'd-' . $desguace->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('fotos_desguace', $filename, 'public');
            $desguace->imagen = $path;
            $desguace->save();
        }

        $user = Auth::user();
        if ($user) {
            $user->role = 'empleado';
            $user->desguace_id = $desguace->id;
            $user->save();
        }

        return redirect()->route('desguaces.show', $desguace->id)
            ->with('success', 'Desguace creado correctamente.');
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
            'telefono' => [
                'required',
                'regex:/^[6789]\d{8}$/'
            ],
            'email'       => 'required|email|max:255',
            'direccion'   => 'required|string|max:255',
            'ciudad'      => 'required|string|max:255',
            'provincia'   => 'required|string|max:255',
            'imagen'      => 'nullable|image|max:2048',
            'ubicacion'   => [
                'required',
                'regex:/^-?\d{1,3}(?:\.\d+)?,\s*-?\d{1,3}(?:\.\d+)?$/'
            ],
        ], [
            'nombre.required'      => 'El nombre del desguace es obligatorio.',
            'nombre.max'           => 'El nombre no puede superar los 255 caracteres.',
            'telefono.required'    => 'El teléfono es obligatorio.',
            'telefono.max'         => 'El teléfono no puede superar los 20 caracteres.',
            'telefono.regex'       => 'El teléfono debe ser un número válido de 9 dígitos en España.',
            'email.required'       => 'El email es obligatorio.',
            'email.email'          => 'Debe ser un correo electrónico válido.',
            'email.max'            => 'El email no puede superar los 255 caracteres.',
            'direccion.required'   => 'La dirección es obligatoria.',
            'direccion.max'        => 'La dirección no puede superar los 255 caracteres.',
            'ciudad.required'      => 'La ciudad es obligatoria.',
            'ciudad.max'           => 'La ciudad no puede superar los 255 caracteres.',
            'provincia.required'   => 'La provincia es obligatoria.',
            'provincia.max'        => 'La provincia no puede superar los 255 caracteres.',
            'imagen.image'         => 'La imagen debe ser un archivo de imagen válido.',
            'imagen.max'           => 'La imagen no puede superar los 2 MB.',
            'ubicacion.required'   => 'La ubicación es obligatoria.',
            'ubicacion.regex'      => 'La ubicación debe estar en formato latitud,longitud (por ejemplo: 40.4168,-3.7038).',
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
