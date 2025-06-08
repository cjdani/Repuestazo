<?php

namespace App\Http\Controllers;

use App\Models\Desguace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:255',
            'role'         => 'nullable|in:cliente,empleado,admin',
            'desguace_id'  => 'nullable|exists:desguaces,id',
        ], [
            'name.string'         => 'El nombre debe ser un texto válido.',
            'name.max'            => 'El nombre no puede tener más de 255 caracteres.',
            'email.email'         => 'Introduce un email válido.',
            'email.max'           => 'El email no puede superar los 255 caracteres.',
            'role.in'             => 'El rol seleccionado no es válido.',
            'desguace_id.exists'  => 'El desguace seleccionado no existe.',
        ]);

        $query = User::with('desguace');

        if (!empty($validated['name'])) {
            $query->where('name', 'like', '%' . $validated['name'] . '%');
        }

        if (!empty($validated['email'])) {
            $query->where('email', 'like', '%' . $validated['email'] . '%');
        }

        if (!empty($validated['role'])) {
            $query->where('role', $validated['role']);
        }

        if (!empty($validated['desguace_id'])) {
            $query->where('desguace_id', $validated['desguace_id']);
        }

        $users = $query->get();
        $roles = ['cliente', 'empleado', 'admin' ];
        $desguaces = Desguace::all();

        return view('users.index', compact('users', 'roles', 'desguaces'));
    }


    public function showEditSelf()
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }

    public function showEdit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function doEditSelf(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:20',
                'regex:/^[\pL\s\-]+$/u',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede superar los 20 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, espacios y guiones.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'avatar.image' => 'El archivo debe ser una imagen.',
            'avatar.mimes' => 'Solo se permiten imágenes jpeg, jpg, png o svg.',
            'avatar.max' => 'La imagen no debe superar los 2MB.',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = "u-{$user->id}." . $file->getClientOriginalExtension();
            if ($user->avatar !== 'fotos_perfil/default.svg') {
                Storage::delete($user->avatar);
            }
            $path = $file->storeAs('fotos_perfil', $filename, 'public');
            $user->avatar = $path;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('user.show')->with('success', 'Usuario actualizado correctamente.');
    }

    public function doEdit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:20',
                'regex:/^[\pL\s\-]+$/u',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede superar los 20 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, espacios y guiones.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'avatar.image' => 'El archivo debe ser una imagen.',
            'avatar.mimes' => 'Solo se permiten imágenes jpeg, jpg, png o svg.',
            'avatar.max' => 'La imagen no debe superar los 2MB.',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = "u-{$user->id}." . $file->getClientOriginalExtension();
            if ($user->avatar !== 'fotos_perfil/default.svg') {
                Storage::delete($user->avatar);
            }
            $path = $file->storeAs('fotos_perfil', $filename, 'public');
            $user->avatar = $path;
        }

        if ($user->role !== 'empleado') {
            $user->role = $request->has('is_admin') ? 'admin' : 'cliente';
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('user.details', $user->id)->with('success', 'Usuario actualizado correctamente.');
    }

    public function showUserDetails($id)
    {
        $user = User::with('desguace')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function showRegister()
    {
        return view('users.register');
    }

    public function doRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:5',
                'max:20',
                'regex:/^[\pL\s\-]+$/u',
            ],
            'email' => 'required|email:rfc,dns|unique:users,email',

            'password' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],

            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 5 caracteres.',
            'name.max' => 'El nombre no debe exceder los 20 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, espacios y guiones.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y un símbolo.',

            'avatar.image' => 'El archivo debe ser una imagen.',
            'avatar.mimes' => 'Solo se permiten imágenes jpeg, png, jpg o svg.',
            'avatar.max' => 'La imagen no debe superar los 2MB.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'cliente',
            'desguace_id' => null,
            'avatar' => 'fotos_perfil/default.svg',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = "u-{$user->id}." . $file->getClientOriginalExtension();
            $path = $file->storeAs('fotos_perfil', $filename, 'public');
            $user->avatar = $path;
            $user->save();
        }

        auth()->login($user);
        return redirect()->route('user.show')->with('success', 'Registro completado correctamente.');
    }


    public function showLogin()
    {
        return view('users.login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.show');
        }

        return back()->withErrors([
            'email' => 'Credenciales inválidas.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }

    public function doDeleteSelf(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'empleado') {
            $desguace = $user->desguace;
            $articulos = $desguace->articulos;
            foreach ($articulos as $articulo) {
                Storage::delete($articulo->imagen);
                $articulo->delete();
            }
            Storage::delete($desguace->imagen);
            $desguace->delete();
        }

        $user->delete();

        return redirect()->route('inicio');
    }

    public function doDelete(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'empleado') {
            $desguace = $user->desguace;
            $articulos = $desguace->articulos;
            foreach ($articulos as $articulo) {
                Storage::delete($articulo->imagen);
                $articulo->delete();
            }
            Storage::delete($desguace->imagen);
            $desguace->delete();
        }

        $user->delete();

        return redirect()->route('inicio');
    }
}
