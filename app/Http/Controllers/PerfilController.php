<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PerfilController extends Controller
{
    const PAGINATION = 2;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $roles = Role::all();
        return view('Perfiles.perfil', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Perfiles.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name', // El nombre debe ser único en la tabla roles
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.string' => 'El nombre del rol debe ser un texto válido.',
            'name.max' => 'El nombre del rol no puede exceder los 255 caracteres.',
            'name.unique' => 'El nombre del rol ya existe en el sistema. Por favor elige otro.',
        ]);

        // Crear un nuevo rol
        $rol = new Role();
        $rol->name = $request->input('name');

        // Guardar el rol en la base de datos
        $rol->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.perfil.index')->with('success', 'Rol registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rol = Role::findOrFail($id);
        return view('Perfiles.Edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos del formulario con mensajes personalizados
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id, // Permite mantener el nombre actual del rol
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.string' => 'El nombre del rol debe ser un texto válido.',
            'name.max' => 'El nombre del rol no puede exceder los 255 caracteres.',
            'name.unique' => 'El nombre del rol ya existe en el sistema. Por favor, elige otro.',
        ]);

        // Encontrar el rol por su ID
        $rol = Role::findOrFail($id);

        // Actualizar el nombre del rol
        $rol->name = $request->input('name');

        // Guardar los cambios en la base de datos
        $rol->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.perfil.index')->with('success', 'Rol actualizado correctamente');
    }

    public function confirmar($id)
    {
        $rol = Role::findOrFail($id);
        return view('Perfiles.confirmar', compact('rol'));
    }

    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();
        return redirect()->route('admin.perfil.index')->with('datos', 'Registro Eliminado..');
    }
}
