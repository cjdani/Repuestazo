<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    public function index()
    {
        $users = User::with('desguace')->get();
        return view('users.index', compact('users'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
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
}
