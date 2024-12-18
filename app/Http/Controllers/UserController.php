<?php

namespace App\Http\Controllers;

use App\Models\Padre;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

        $query = User::with('roles')->where(function ($query) use ($buscarpor) {
            $query->where('name', 'like', "%$buscarpor%")->orWhere('email', 'like', "%$buscarpor%");
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
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'profile_photo' => ['required', 'image', 'max:2048'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed', 'same:password_confirmation'],
                'password_confirmation' => 'required|same:password',
                'rol' => ['required', 'exists:roles,id'],
            ],
            [
                'name.required' => 'El nombre es obligatorio.',

                'profile_photo.required' => 'La imagen es obligatoria.',
                'profile_photo.image' => 'El archivo debe ser una imagen.',
                'profile_photo.max' => 'La imagen no puede pesar más de 2MB.',

                'email.required' => 'El correo electrónico es obligatorio.',
                'email.unique' => 'Este correo electrónico ya está registrado.',

                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',

                'password_confirmation.required' => 'Confirme la contraseña.',
                'password_confirmation.same' => 'Las contraseñas no coinciden.',

                'rol.required' => 'El rol es obligatorio.',
                'rol.exists' => 'El rol seleccionado no existe.',
            ],
        );

        // Guardar la imagen en el almacenamiento y obtener la ruta
        $imagePath = $request->file('profile_photo')->store('profile_photos', 'public');

        // Crear el usuario
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->profile_photo = $imagePath; // Guardar la ruta de la imagen en la base de datos
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        // Guardar el usuario antes de asignar roles
        $usuario->save();

        // Asignar el rol al usuario
        DB::table('model_has_roles')->insert([
            'role_id' => $request->rol,
            'model_id' => $usuario->id,
            'model_type' => User::class, 
        ]);

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
        $id_rol = DB::table('model_has_roles')->where('model_id', $id)->value('role_id');
        $rolecito = DB::table('roles')->where('id', $id_rol)->value('name');

        $roles = Role::all();
        $padre = Padre::where('id_users', $id)->first();

        return view('Admin.Edit', compact('users', 'rolecito', 'roles', 'padre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info($request->all());
        $padres = Padre::where('id_users', $id)->first();

        if ($padres) {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'dni' => 'required|numeric|digits:8|unique:padres,dni,' . ($padres ? $padres->id : null),
                    'email' => 'required|email|max:255|unique:users,email,' . $id,
                    'password' => 'nullable|string|min:8|confirmed',
                    'password_confirmation' => 'nullable|same:password',
                    'rol' => 'required|exists:roles,id',
                    'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ],
                [
                    'name.required' => 'El nombre es obligatorio.',

                    'dni.required' => 'El DNI es obligatorio.',
                    'dni.numeric' => 'El DNI debe ser un número.',
                    'dni.digits' => 'El DNI debe tener 8 dígitos.',
                    'dni.unique' => 'Este DNI ya está registrado.',

                    'email.required' => 'El correo electrónico es obligatorio.',
                    'email.email' => 'El correo electrónico no es válido.',
                    'email.unique' => 'Este correo electrónico ya está registrado.',

                    'password.min' => 'La contraseña debe tener al menos 8 caracteres.',

                    'password_confirmation.same' => 'Las contraseñas no coinciden.',

                    'rol.required' => 'El rol es obligatorio.',
                    'rol.exists' => 'El rol seleccionado no existe.',

                    'profile_photo.image' => 'El archivo debe ser una imagen.',
                    'profile_photo.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
                    'profile_photo.max' => 'La imagen no puede pesar más de 2MB.',
                ],
            );
            $padre = Padre::findOrFail($padres->id);
            $nombreCompleto = $request->name;
            $nombre = explode(' ', $nombreCompleto);
            $padre->nombres = isset($nombre[0]) ? $nombre[0] : '';
            $padre->apellidos = isset($nombre[1]) ? implode(' ', array_slice($nombre, 1)) : '';
            $padre->dni = $request->dni;
            $padre->save();
        }

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
                'password_confirmation' => 'nullable|same:password',
                'rol' => 'required|exists:roles,id',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser una cadena de texto.',

                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico no es válido.',
                'email.unique' => 'Este correo electrónico ya está registrado.',

                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',

                'password.confirmed' => 'Las contraseñas no coinciden.',

                'rol.required' => 'El rol es obligatorio.',
                'rol.exists' => 'El rol seleccionado no existe.',

                'profile_photo.image' => 'El archivo debe ser una imagen.',
                'profile_photo.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
                'profile_photo.max' => 'La imagen no puede pesar más de 2MB.',
            ],
        );

        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $newRoleId = $request->input('rol');

        if ($request->hasFile('profile_photo')) {
            if ($usuario->profile_photo && Storage::exists($usuario->profile_photo)) {
                Storage::delete($usuario->profile_photo);
            }
            $usuario->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $usuario->save();

        $currentRole = DB::table('model_has_roles')
            ->where('model_id', $id)
            ->where('model_type', User::class)
            ->first();

        if ($currentRole) {
            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->where('model_type', User::class)
                ->update(['role_id' => $newRoleId]);
        } else {
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
        $roles = DB::table('model_has_roles')->where('model_id', $id_user)->first();
        $rol = Role::where('id', $roles->role_id)->first();
        if ($rol->name == 'Padre') {
            $padre = Padre::where('id_users', $id_user)->first();
            $alumno = Alumno::where('padre_id', $padre->id)->first();
            if ($alumno) {
                return redirect()->route('admin.usuarios.index')->with('danger', 'El usuario no se puede eliminar porque tiene un hijo registrado');
            } else {
                $user->delete();
                $padre->delete();
                return redirect()->route('admin.usuarios.index')->with('datos', 'Registro Eliminado..');
            }
        } else {
            $user->delete();
            return redirect()->route('admin.usuarios.index')->with('datos', 'Registro Eliminado..');
        }
        
    }
}
