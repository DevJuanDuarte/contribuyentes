<?php

namespace App\Http\Controllers;

use App\Models\Contribuyentes;
use App\Models\User;
use Illuminate\Http\Request;

class ContribuyentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contribuyentes = Contribuyentes::orderBy('id', 'desc')->paginate(10);
        return view("contribuyentes.index", compact("contribuyentes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("contribuyentes.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validar la solicitud
        $rules = [
            'tipo_documento' => 'required|max:255',
            'documento' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'celular' => 'required|max:255',
            'email' => 'required|max:255'
        ];

        // Validar nombres y apellidos según el tipo de documento
        if ($request->tipo_documento === 'NIT') {
            $rules['nombres'] = 'required';
            $rules['apellidos'] = 'required';
        } else {
            $rules['nombres'] = 'required|max:255';
            $rules['apellidos'] = 'required|max:255';
        }

        $request->validate($rules);

        // Si es NIT, los campos nombres y apellidos ya vendrán separados
        // gracias a la lógica del frontend

        // Crear el contribuyente
        $contribuyente = Contribuyentes::create([
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'email' => $request->email,
            'usuario_id' => auth()->id(),
            'nombre_completo' => "{$request->nombres} {$request->apellidos}",
        ]);

        return redirect()->route('contribuyentes.index')
            ->with('success', 'Contribuyente creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Contribuyentes $contribuyentes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contribuyente = Contribuyentes::findOrFail($id);
        return view('contribuyentes.edit', compact('contribuyente'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contribuyentes $contribuyente)
    {
        // Validar la solicitud
        $rules = [
            'tipo_documento' => 'required|max:255',
            'documento' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
            'celular' => 'required|max:255',
            'email' => 'required|max:255'
        ];

        // Validar nombres y apellidos según el tipo de documento
        if ($request->tipo_documento === 'NIT') {
            $rules['nombres'] = 'required';
            $rules['apellidos'] = 'required';
        } else {
            $rules['nombres'] = 'required|max:255';
            $rules['apellidos'] = 'required|max:255';
        }

        $request->validate($rules);

        // Actualizar el contribuyente
        $contribuyente->update([
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'email' => $request->email,
            'nombre_completo' => "{$request->nombres} {$request->apellidos}",
        ]);

        return redirect()->route('contribuyentes.index')
            ->with('success', 'Contribuyente actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contribuyentes $contribuyente)
    {
        $contribuyente->delete();

        return redirect()->route('contribuyentes.index')->with('success', 'Contribuyente eliminado correctamente');
    }
}
