<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'rol' => 'required|in:rectora,secretaria,contador,docente',
        ]);

        if (Auth::user()->rol === 'secretaria' && $request->rol !== 'docente') {
            abort(403, 'No autorizado para crear este tipo de usuario.');
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'rol' => $request->rol,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');

        } catch (\Exception $e) {
            return back()->withErrors('Ocurrió un error al guardar el usuario: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }


    public function update(Request $request, User $usuario)
    {
        // Si el usuario autenticado es secretaria, limitar campos editables
        if (Auth::user()->rol === 'secretaria') {
            $request->validate([
                'password' => 'nullable|min:6',
            ]);

            $data = [];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $usuario->update($data);

            return redirect()->route('usuarios.index')->with('success', 'Contraseña actualizada correctamente.');
        }

        // Si es rectora, puede actualizar todo
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'rol' => 'required',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        // Solo la rectora puede eliminar usuarios
        if (Auth::user()->rol !== 'rectora') {
            abort(403, 'No autorizado para eliminar usuarios.');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}