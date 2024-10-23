<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::with('roles')->orderBy('id', 'desc')->paginate(3);
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



    public function edit(User $usuario)
    {
        // Obtener el rol actual del usuario
        $currentRole = $usuario->roles->first()->name ?? '';

        // Aquí no necesitas buscar de nuevo al usuario
        return view('usuarios.edit', compact('usuario', 'currentRole'));
    }


    public function update(Request $request, User $usuario)
    {
        try {
            // Validación
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
                'password' => 'nullable|string|min:8|confirmed',
                'role' => 'required|in:superadmin,administrador',
            ]);

            DB::beginTransaction();

            // Actualizar el usuario
            $usuario->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? Hash::make($validated['password']) : $usuario->password,
            ]);

            // Asignar el rol, si es necesario
            if (!$usuario->hasRole($validated['role'])) {
                $usuario->syncRoles([$validated['role']]); // Puedes usar syncRoles para evitar duplicados
            }

            DB::commit();

            // Redireccionar con mensaje de éxito
            return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar usuario: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }


    public function destroy(User $usuario)
    {
        try {
            // Verificar que no se esté eliminando a sí mismo
            if (auth()->id() === $usuario->id) {
                return redirect()
                    ->back()
                    ->with('error', 'No puedes eliminar tu propio usuario.');
            }

            DB::beginTransaction();

            // Eliminar roles del usuario
            $usuario->roles()->detach();

            // Eliminar el usuario
            $usuario->delete();

            DB::commit();

            return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario eliminado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar usuario: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}