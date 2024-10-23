<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::with('roles')->paginate(10);
        return view("usuarios.index", compact("usuarios"));
    }
    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        \Log::info('Datos recibidos:', $request->all());
        try {
            // 1. Validación
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:superadmin,administrador',
            ]);

            DB::beginTransaction();

            // 2. Crear usuario
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // 3. Asignar rol
            if (!$user->hasRole($validated['role'])) {
                $user->assignRole($validated['role']);
            }

            DB::commit();

            // 4. Redireccionar con mensaje de éxito
            return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear usuario: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }
}