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
    const PAGINATION = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $filtrarPorRol = $request->get('rol');
        $roles = Role::all(); 

        $query = User::with('roles')
            ->where(function ($query) use ($buscarpor) {
                $query->where('name', 'like', "%$buscarpor%")
                    ->orWhere('email', 'like', "%$buscarpor%");
            });

        if (!empty($filtrarPorRol)) {
            $query->whereHas('roles', function ($q) use ($filtrarPorRol) {
                $q->where('name', $filtrarPorRol);
            });
        }

        $users = $query->paginate($this::PAGINATION);

        return view('Admin.User', compact('users', 'buscarpor', 'filtrarPorRol', 'roles'));
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required', 'exists:roles,id'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.exists' => 'El rol seleccionado no existe.',
        ]);

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

    public function confirmar($id_user)
    {
        $user = User::findOrFail($id_user);
        return view('Admin.confirmar', compact('user'));
    }

    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->delete();
        return redirect()->route('admin.usuarios.index')->with('datos', 'Registro Eliminado..');
    }
}
