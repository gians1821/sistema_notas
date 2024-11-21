<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGINATION = 5;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $users = User::with('roles')
            ->where('name', 'like', "%$buscarpor%")
            ->orWhere('email', 'like', "%$buscarpor%")
            ->paginate($this::PAGINATION);

        return view('Admin.User', compact('users', 'buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('Admin.Create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario


        // Crear el usuario
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        // Guarda los cambios en el usuario antes de actualizar roles
        $usuario->save();

        // Asignar el rol al usuario
        $rol = Role::find($request->input('rol'));
        $usuario->assignRole($rol->name);

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.usuarios.index')->with('datos', 'Usuario registrado correctamente');
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
    public function edit($id)
    {
        $users = User::findOrFail($id);
        $roles = Role::all();
        return view('Admin.Edit', compact('users', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }
        // Obtén el ID del rol desde el formulario
        $newRoleId = $request->input('rol');

        // Guarda los cambios en el usuario antes de actualizar roles
        $usuario->save();

        // Obtén el ID del rol actual del usuario
        $currentRole = DB::table('model_has_roles')
            ->where('model_id', $id)
            ->where('model_type', User::class)
            ->first();

        // Si hay un rol actual, lo actualizamos
        if ($currentRole) {
            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->where('model_type', User::class)
                ->update(['role_id' => $newRoleId]);
        } else {
            // Si no hay rol actual, insertamos el nuevo rol
            DB::table('model_has_roles')->insert([
                'role_id' => $newRoleId,
                'model_id' => $id,
                'model_type' => User::class,
            ]);
        }
        return redirect()->route('admin.usuarios.index')->with('datos', 'Usuario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
