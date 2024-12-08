<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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
        $permisos = Permission::all(); 
        return view('Perfiles.Create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|unique:roles,name',
            'descripcion' => 'required',
            'permissions' => 'required|array|min:3'
        ],
        [
            'name.required' => 'Ingrese nombre del rol',
            'name.unique' => 'El nombre del rol ya existe',
            'descripcion.required' => 'Ingrese una descripción para el rol',
            'permissions.required' => 'Debe seleccionar al menos 3 permisos',
            'permissions.min' => 'Debe seleccionar al menos 3 permisos'
        ]);
    
        $role = Role::create([
            'name' => $request->name,
            'descripcion' => $request->descripcion,
        ]);

        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }
    
        return redirect()->route('admin.perfil.index')->with('datos', 'Rol creado exitosamente.');
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
    
        $permissions = Permission::all();
    
        return view('Perfiles.Edit', compact('rol', 'permissions'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id, 
            'descripcion' => 'required', 
            'permissions' => 'required|array|min:3' 
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.string' => 'El nombre del rol debe ser un texto válido.',
            'name.max' => 'El nombre del rol no puede exceder los 255 caracteres.',
            'name.unique' => 'El nombre del rol ya existe en el sistema. Por favor, elige otro.',
            'descripcion.required' => 'Ingrese una descripción para el rol',
            'permissions.required' => 'Debe seleccionar al menos 3 permisos',
            'permissions.min' => 'Debe seleccionar al menos 3 permisos'
        ]);

        $rol = Role::findOrFail($id);

        $rol->name = $request->input('name');
        $rol->descripcion = $request->input('descripcion'); 

        $rol->permissions()->sync($request->input('permissions', [])); 

        $rol->save();

        return redirect()->route('admin.perfil.index')->with('datos', 'Rol actualizado correctamente');
    }

    public function confirmar($id)
    {
        $rol = Role::findOrFail($id);
        return view('Perfiles.confirmar', compact('rol'));
    }

    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $user = $rol->users->count();
        if ($user > 0) {
            return redirect()->route('admin.perfil.index')->with('danger', 'No se puede eliminar el rol, tiene usuarios asignados..');
        } else {
            $rol->delete();
            return redirect()->route('admin.perfil.index')->with('datos', 'Registro Eliminado..');
        }
    }
}
