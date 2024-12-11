<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Capacidad;
use App\Models\Catedra;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Nota;
use App\Models\Periodo;
use App\Models\Seccion;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Padre;
use App\Models\Promedio;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGINACION = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $periodos = Periodo::all();

        $buscarporNom = $request->get('buscarporNom');
        $buscarporApell = $request->get('buscarporApell');
        $nivel = $request->get('nivel');
        $grado = $request->get('grado');
        $seccion = $request->get('seccion');
        $periodo = $request->get('periodo');

        $nueva_pagina = '_self';

        $query = Alumno::query();

        if ($buscarporNom) {
            $query->where('nombre_alumno', 'like', '%' . $buscarporNom . '%');
        }

        if ($buscarporApell) {
            $query->where('apellido_alumno', 'like', '%' . $buscarporApell . '%');
        }

        if ($seccion) {
            $query->whereHas('seccion', function ($query) use ($seccion) {
                $query->where('id_seccion', $seccion);
            });
            $nueva_pagina = '_blank';
        }

        if ($grado) {
            $query->whereHas('seccion', function ($query) use ($grado) {
                $query->whereHas('grado', function ($query) use ($grado) {
                    $query->where('id_grado', $grado);
                });
            });
        }

        if ($nivel) {
            $query->whereHas('seccion', function ($query) use ($nivel) {
                $query->whereHas('grado', function ($query) use ($nivel) {
                    $query->whereHas('nivel', function ($query) use ($nivel) {
                        $query->where('id_nivel', $nivel);
                    });
                });
            });
        }

        if ($periodo) {
            $query->where('periodo', $periodo);
        }

        $alumnos = $query->paginate($this::PAGINACION);

        $alumnos->appends([
            'buscarporNom' => $buscarporNom,
            'buscarporApell' => $buscarporApell,
            'nivel' => $nivel,
            'grado' => $grado,
            'seccion' => $seccion,
            'periodo' => $periodo,
        ]);

        $niveles = Nivel::all();
        $grados = Grado::all();
        $secciones = Seccion::all();

        return view('Alumno.Alumnos', compact('alumnos', 'periodos', 'periodo', 'buscarporNom', 'buscarporApell', 'nivel', 'grado', 'seccion', 'niveles', 'grados', 'secciones', 'nueva_pagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $añoactual = Carbon::now()->year;
        $periodo = Periodo::firstOrCreate(['name' => $añoactual], ['name' => $añoactual]);
        $periodos = Periodo::where('name', $añoactual)->get();

        $nivel = Nivel::all();

        return view('Alumno.create', compact('periodos', 'nivel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos del formulario
        $data = $request->validate(
            [
                'dni_apoderado' => 'required|string|max:8',
            ],
            [
                'dni_apoderado.required' => 'Ingrese el DNI del apoderado.',
                'dni_apoderado.string' => 'El DNI del apoderado debe ser una cadena de texto.',
                'dni_apoderado.max' => 'El DNI del apoderado no debe exceder los 8 caracteres.',
            ],
        );

        $padre = Padre::where('dni', $request->dni_apoderado)->first();

        if (!$padre) {
            $data = $request->validate(
                [
                    'periodo' => 'required',
                    'profile_photo_apoderado' => 'required|image|max:2048',
                    'dni_apoderado' => 'required|string|max:8|unique:padres,dni',
                    'nombre_apoderado' => 'required|string|max:30',
                    'apellido_apoderado' => 'required|string|max:30',
                    'email_apoderado' => 'required|email|unique:users,email',
                    'password' => 'required|string|min:8',
                    'confirmar_password' => 'required|same:password',

                    'nombre_alumno' => 'required|string|max:30',
                    'profile_photo_alumno' => 'required|image|max:2048',
                    'apellido_alumno' => 'required|string|max:30',
                    'fecha_nacimiento' => 'required|date',
                    'dni' => 'required|string|max:8|unique:alumnos,dni',
                    'pais' => 'required|string|max:30',
                    'region' => 'required|string|max:30',
                    'ciudad' => 'required|string|max:30',
                    'distrito' => 'required|string|max:30',
                    'estado_civil' => 'required|string|max:15',
                    'telefono' => 'required|string|max:15',
                    'nivel' => 'required',
                    'grado' => 'required',
                    'seccion' => 'required',
                ],
                [
                    'periodo.required' => 'Seleccione el periodo.',

                    'profile_photo_apoderado.required' => 'La foto es obligatoria.',
                    'profile_photo_apoderado.image' => 'El archivo debe ser una imagen.',
                    'profile_photo_apoderado.max' => 'La imagen no debe exceder los 2MB.',

                    'dni_apoderado.required' => 'Ingrese el DNI del apoderado.',
                    'dni_apoderado.string' => 'El DNI del apoderado debe ser una cadena de texto.',
                    'dni_apoderado.max' => 'El DNI del apoderado no debe exceder los 8 caracteres.',
                    'dni_apoderado.unique' => 'El DNI ya está registrado.',

                    'nombre_apoderado.required' => 'Ingrese el nombre del apoderado.',
                    'nombre_apoderado.string' => 'El nombre del apoderado debe ser una cadena de texto.',
                    'nombre_apoderado.max' => 'El nombre del apoderado no debe exceder los 30 caracteres.',

                    'apellido_apoderado.required' => 'Ingrese el apellido del apoderado.',
                    'apellido_apoderado.string' => 'El apellido del apoderado debe ser una cadena de texto.',
                    'apellido_apoderado.max' => 'El apellido del apoderado no debe exceder los 30 caracteres.',

                    'email_apoderado.required' => 'Ingrese el correo electrónico del apoderado.',
                    'email_apoderado.email' => 'Ingrese un correo electrónico válido.',
                    'email_apoderado.unique' => 'El correo electrónico ya está registrado.',

                    'password.required' => 'Ingrese la contraseña.',
                    'password.string' => 'La contraseña debe ser una cadena de texto.',
                    'password.min' => 'La contraseña debe tener al menos 8 caracteres.',

                    'confirmar_password.required' => 'Confirme la contraseña.',
                    'confirmar_password.same' => 'Las contraseñas no coinciden.',

                    'nombre_alumno.required' => 'Ingrese el nombre del alumno.',
                    'nombre_alumno.string' => 'El nombre del alumno debe ser una cadena de texto.',
                    'nombre_alumno.max' => 'El nombre del alumno no debe exceder los 30 caracteres.',

                    'profile_photo_alumno.required' => 'La foto es obligatoria.',
                    'profile_photo_alumno.image' => 'El archivo debe ser una imagen.',
                    'profile_photo_alumno.max' => 'La imagen no debe exceder los 2MB.',

                    'apellido_alumno.required' => 'Ingrese el apellido del alumno.',
                    'apellido_alumno.string' => 'El apellido del alumno debe ser una cadena de texto.',
                    'apellido_alumno.max' => 'El apellido del alumno no debe exceder los 30 caracteres.',

                    'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento.',
                    'fecha_nacimiento.date' => 'Ingrese una fecha válida.',

                    'dni.required' => 'Ingrese el DNI del alumno.',
                    'dni.string' => 'El DNI del alumno debe ser una cadena de texto.',
                    'dni.max' => 'El DNI del alumno no debe exceder los 8 caracteres.',
                    'dni.unique' => 'El DNI ya está registrado.',

                    'pais.required' => 'Ingrese el país.',
                    'pais.string' => 'El país debe ser una cadena de texto.',
                    'pais.max' => 'El país no debe exceder los 30 caracteres.',

                    'region.required' => 'Ingrese la región.',
                    'region.string' => 'La región debe ser una cadena de texto.',
                    'region.max' => 'La región no debe exceder los 30 caracteres.',

                    'ciudad.required' => 'Ingrese la ciudad.',
                    'ciudad.string' => 'La ciudad debe ser una cadena de texto.',
                    'ciudad.max' => 'La ciudad no debe exceder los 30 caracteres.',

                    'distrito.required' => 'Ingrese el distrito.',
                    'distrito.string' => 'El distrito debe ser una cadena de texto.',
                    'distrito.max' => 'El distrito no debe exceder los 30 caracteres.',

                    'estado_civil.required' => 'Ingrese el estado civil.',
                    'estado_civil.string' => 'El estado civil debe ser una cadena de texto.',
                    'estado_civil.max' => 'El estado civil no debe exceder los 15 caracteres.',

                    'telefono.required' => 'Ingrese el teléfono.',
                    'telefono.string' => 'El teléfono debe ser una cadena de texto.',
                    'telefono.max' => 'El teléfono no debe exceder los 15 caracteres.',

                    'nivel.required' => 'Seleccione el nivel.',

                    'grado.required' => 'Seleccione el grado.',

                    'seccion.required' => 'Seleccione la sección.',
                ],
            );

            $seccion = Seccion::where('id_seccion', $request->seccion)->first();
            if ($seccion->capacidad > 0) {
                $user = new User();
                $user->name = $request->nombre_apoderado . ' ' . $request->apellido_apoderado;
                $user->email = $request->email_apoderado;
                $imagePath_user = $request->file('profile_photo_apoderado')->store('profile_photos', 'public');
                $user->profile_photo = $imagePath_user;
                $user->password = bcrypt($request->password);
                $user->save();

                DB::table('model_has_roles')->insert([
                    'role_id' => 4,
                    'model_id' => $user->id,
                    'model_type' => User::class, 
                ]);

                $padres = new Padre();
                $padres->dni = $request->dni_apoderado;
                $padres->nombres = $request->nombre_apoderado;
                $padres->apellidos = $request->apellido_apoderado;
                $padres->id_users = $user->id;
                $padres->save();

                $alumnos = new Alumno();
                $periodo = Carbon::now()->year;
                $alumnos->periodo = $periodo;
                $imagePath_alumno = $request->file('profile_photo_alumno')->store('profile_photos', 'public');
                $alumnos->profile_photo = $imagePath_alumno;
                $alumnos->nombre_alumno = $request->nombre_alumno;
                $alumnos->apellido_alumno = $request->apellido_alumno;
                $alumnos->fecha_nacimiento = $request->fecha_nacimiento;
                $alumnos->dni = $request->dni;
                $alumnos->pais = $request->pais;
                $alumnos->region = $request->region;
                $alumnos->ciudad = $request->ciudad;
                $alumnos->distrito = $request->distrito;
                $alumnos->estado_civil = $request->estado_civil;
                $alumnos->telefono = $request->telefono;
                $alumnos->seccion_id_seccion = $request->seccion;
                $alumnos->padre_id = $padres->id;
                $alumnos->save();

                $seccion->capacidad -= 1;
                $seccion->save();
            } else {
                return redirect()->route('Alumno.index')->with('danger', 'La sección seleccionada ya no tiene capacidad.');
            }
        } else {
            $data = $request->validate(
                [
                    'periodo' => 'required',

                    'nombre_alumno' => 'required|string|max:30',
                    'profile_photo_alumno' => 'required|image|max:2048',
                    'apellido_alumno' => 'required|string|max:30',
                    'fecha_nacimiento' => 'required|date',
                    'dni' => 'required|string|max:8|unique:alumnos,dni',
                    'pais' => 'required|string|max:30',
                    'region' => 'required|string|max:30',
                    'ciudad' => 'required|string|max:30',
                    'distrito' => 'required|string|max:30',
                    'estado_civil' => 'required|string|max:15',
                    'telefono' => 'required|string|max:15',
                    'nivel' => 'required',
                    'grado' => 'required',
                    'seccion' => 'required',
                ],
                [
                    'periodo.required' => 'Seleccione el periodo.',

                    'nombre_alumno.required' => 'Ingrese el nombre del alumno.',
                    'nombre_alumno.string' => 'El nombre del alumno debe ser una cadena de texto.',
                    'nombre_alumno.max' => 'El nombre del alumno no debe exceder los 30 caracteres.',

                    'profile_photo_alumno.required' => 'La foto es obligatoria.',
                    'profile_photo_alumno.image' => 'El archivo debe ser una imagen.',
                    'profile_photo_alumno.max' => 'La imagen no debe exceder los 2MB.',

                    'apellido_alumno.required' => 'Ingrese el apellido del alumno.',
                    'apellido_alumno.string' => 'El apellido del alumno debe ser una cadena de texto.',
                    'apellido_alumno.max' => 'El apellido del alumno no debe exceder los 30 caracteres.',

                    'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento.',
                    'fecha_nacimiento.date' => 'Ingrese una fecha válida.',

                    'dni.required' => 'Ingrese el DNI del alumno.',
                    'dni.string' => 'El DNI del alumno debe ser una cadena de texto.',
                    'dni.max' => 'El DNI del alumno no debe exceder los 8 caracteres.',
                    'dni.unique' => 'El DNI ya está registrado.',

                    'pais.required' => 'Ingrese el país.',
                    'pais.string' => 'El país debe ser una cadena de texto.',
                    'pais.max' => 'El país no debe exceder los 30 caracteres.',

                    'region.required' => 'Ingrese la región.',
                    'region.string' => 'La región debe ser una cadena de texto.',
                    'region.max' => 'La región no debe exceder los 30 caracteres.',

                    'ciudad.required' => 'Ingrese la ciudad.',
                    'ciudad.string' => 'La ciudad debe ser una cadena de texto.',
                    'ciudad.max' => 'La ciudad no debe exceder los 30 caracteres.',

                    'distrito.required' => 'Ingrese el distrito.',
                    'distrito.string' => 'El distrito debe ser una cadena de texto.',
                    'distrito.max' => 'El distrito no debe exceder los 30 caracteres.',

                    'estado_civil.required' => 'Ingrese el estado civil.',
                    'estado_civil.string' => 'El estado civil debe ser una cadena de texto.',
                    'estado_civil.max' => 'El estado civil no debe exceder los 15 caracteres.',

                    'telefono.required' => 'Ingrese el teléfono.',
                    'telefono.string' => 'El teléfono debe ser una cadena de texto.',
                    'telefono.max' => 'El teléfono no debe exceder los 15 caracteres.',

                    'nivel.required' => 'Seleccione el nivel.',

                    'grado.required' => 'Seleccione el grado.',

                    'seccion.required' => 'Seleccione la sección.',
                ],
            );

            $seccion = Seccion::where('id_seccion', $request->seccion)->first();
            if ($seccion->capacidad > 0) {
                $alumnos = new Alumno();
                $periodo = Carbon::now()->year;
                $alumnos->periodo = $periodo;
                $imagePath_alumno = $request->file('profile_photo_alumno')->store('profile_photos', 'public');
                $alumnos->profile_photo = $imagePath_alumno;
                $alumnos->nombre_alumno = $request->nombre_alumno;
                $alumnos->apellido_alumno = $request->apellido_alumno;
                $alumnos->fecha_nacimiento = $request->fecha_nacimiento;
                $alumnos->dni = $request->dni;
                $alumnos->pais = $request->pais;
                $alumnos->region = $request->region;
                $alumnos->ciudad = $request->ciudad;
                $alumnos->distrito = $request->distrito;
                $alumnos->estado_civil = $request->estado_civil;
                $alumnos->telefono = $request->telefono;
                $alumnos->seccion_id_seccion = $request->seccion;
                $alumnos->padre_id = $padre->id;
                $alumnos->save();

                $seccion->capacidad -= 1;
                $seccion->save();
            } else {
                return redirect()->route('Alumno.index')->with('danger', 'La sección seleccionada ya no tiene capacidad.');
            }
        }

        // CREANDO LOS REGISTROS PARA LAS NOTAS
        $catedras = Catedra::where('seccion_id', $alumnos->seccion->id_seccion)->get();

        if ($catedras->isNotEmpty()) {
            // Iterar sobre cada cátedra
            foreach ($catedras as $catedra) {
                // Suponiendo que Catedra tiene una columna 'curso_id' que apunta a la tabla cursos
                // y que Capacidad (competencia) utiliza 'id_curso' para relacionarse
                $competencias = Capacidad::where('id_curso', $catedra->curso_id)->get();
                $promedio = new Promedio();
                $promedio->valor = 'NAA';
                $promedio->alumno_id_alumno = $alumnos->id_alumno;
                $promedio->save();
                // Iterar sobre cada competencia relacionada con el curso de esta cátedra
                foreach ($competencias as $competencia) {
                    $nota = new Nota();
                    $nota->catedra_id = $catedra->id; // Ajusta según la PK en tu modelo Catedra
                    $nota->alumno_id_alumno = $alumnos->id_alumno;
                    $nota->competencia_id = $competencia->id_competencia;
                    $nota->nota1 = 'SN';
                    $nota->nota2 = 'SN';
                    $nota->nota3 = 'SN';
                    $nota->nota_final = 'SN';
                    $nota->id_promedio = $promedio->id;
                    $nota->save();
                }
            }
        }

        return redirect()->route('Alumno.index')->with('datos', 'Registro Guardado..!');
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
    public function edit($id_alumno)
    {
        $alumnos = Alumno::findOrFail($id_alumno);
        $nivels = Nivel::all();
        $seccion = Seccion::where('id_seccion', $alumnos->seccion_id_seccion)->first();
        $grado = Grado::where('id_grado', $seccion->grado_id_grado)->first();
        $nivel = Nivel::where('id_nivel', $grado->id_nivel)->first();

        return view('Alumno.edit', compact('alumnos', 'nivels', 'nivel', 'grado', 'seccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_alumno)
    {
        $request->validate(
            [
                'nombre_alumno' => 'required|string|max:30',
                'profile_photo_alumno' => 'nullable|image|max:2048',
                'apellido_alumno' => 'required|string|max:30',
                'fecha_nacimiento' => 'required|date',
                'dni' => 'required|string|max:8|unique:alumnos,dni,' . $id_alumno . ',id_alumno',
                'pais' => 'required|string|max:30',
                'region' => 'required|string|max:30',
                'ciudad' => 'required|string|max:30',
                'distrito' => 'required|string|max:30',
                'estado_civil' => 'required|string|max:15',
                'telefono' => 'required|string|max:15',
                'nivel' => 'required',
                'grado' => 'required',
                'seccion' => 'required',
            ],
            [
                'nombre_alumno.required' => 'Ingrese el nombre del alumno.',
                'nombre_alumno.string' => 'El nombre del alumno debe ser una cadena de texto.',
                'nombre_alumno.max' => 'El nombre del alumno no debe exceder los 30 caracteres.',

                'profile_photo_alumno.required' => 'La foto es obligatoria.',
                'profile_photo_alumno.image' => 'El archivo debe ser una imagen.',
                'profile_photo_alumno.max' => 'La imagen no debe exceder los 2MB.',

                'apellido_alumno.required' => 'Ingrese el apellido del alumno.',
                'apellido_alumno.string' => 'El apellido del alumno debe ser una cadena de texto.',
                'apellido_alumno.max' => 'El apellido del alumno no debe exceder los 30 caracteres.',

                'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento.',
                'fecha_nacimiento.date' => 'Ingrese una fecha válida.',

                'dni.required' => 'Ingrese el DNI del alumno.',
                'dni.string' => 'El DNI del alumno debe ser una cadena de texto.',
                'dni.max' => 'El DNI del alumno no debe exceder los 8 caracteres.',
                'dni.unique' => 'El DNI ya está registrado.',

                'pais.required' => 'Ingrese el país.',
                'pais.string' => 'El país debe ser una cadena de texto.',
                'pais.max' => 'El país no debe exceder los 30 caracteres.',

                'region.required' => 'Ingrese la región.',
                'region.string' => 'La región debe ser una cadena de texto.',
                'region.max' => 'La región no debe exceder los 30 caracteres.',

                'ciudad.required' => 'Ingrese la ciudad.',
                'ciudad.string' => 'La ciudad debe ser una cadena de texto.',
                'ciudad.max' => 'La ciudad no debe exceder los 30 caracteres.',

                'distrito.required' => 'Ingrese el distrito.',
                'distrito.string' => 'El distrito debe ser una cadena de texto.',
                'distrito.max' => 'El distrito no debe exceder los 30 caracteres.',

                'estado_civil.required' => 'Ingrese el estado civil.',
                'estado_civil.string' => 'El estado civil debe ser una cadena de texto.',
                'estado_civil.max' => 'El estado civil no debe exceder los 15 caracteres.',

                'telefono.required' => 'Ingrese el teléfono.',
                'telefono.string' => 'El teléfono debe ser una cadena de texto.',
                'telefono.max' => 'El teléfono no debe exceder los 15 caracteres.',

                'nivel.required' => 'Seleccione el nivel.',

                'grado.required' => 'Seleccione el grado.',

                'seccion.required' => 'Seleccione la sección.',
            ],
        );

        $alumnos = Alumno::findOrFail($id_alumno);
        if ($request->hasFile('profile_photo')) {
            if ($alumnos->profile_photo && Storage::exists($alumnos->profile_photo)) {
                Storage::delete($alumnos->profile_photo);
            }
            $alumnos->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }
        $alumnos->nombre_alumno = $request->nombre_alumno;
        $alumnos->apellido_alumno = $request->apellido_alumno;
        $alumnos->fecha_nacimiento = $request->fecha_nacimiento;
        $alumnos->dni = $request->dni;
        $alumnos->pais = $request->pais;
        $alumnos->region = $request->region;
        $alumnos->ciudad = $request->ciudad;
        $alumnos->distrito = $request->distrito;
        $alumnos->estado_civil = $request->estado_civil;
        $alumnos->telefono = $request->telefono;
        $alumnos->seccion_id_seccion = $request->seccion;
        $alumnos->save();

        return redirect()->route('Alumno.index')->with('datos', 'Registro Actualizado..!');
    }

    public function confirmar($id_alumno)
    {
        $alumnos = Alumno::findOrFail($id_alumno);
        return view('Alumno.confirmar', compact('alumnos'));
    }

    public function destroy($id_alumno)
    {
        $alumno = Alumno::findOrFail($id_alumno);
        $seccion = Seccion::where('id_seccion', $alumno->seccion_id_seccion)->first();
        $seccion->capacidad += 1;
        $seccion->save();
        $alumno->delete();
        return redirect()->route('Alumno.index')->with('datos', 'Registro Eliminado..');
    }

    public function generarPdf(Request $request)
    {
        $request->validate(
            [
                'nivel' => 'required',
                'grado' => 'required',
                'seccion' => 'required',
            ],
            [
                'nivel.required' => 'Seleccione el nivel.',
                'grado.required' => 'Seleccione el grado.',
                'seccion.required' => 'Seleccione la sección.',
            ],
        );

        $año_actual = Carbon::now()->year;

        $nivelId = $request->input('nivel');
        $gradoId = $request->input('grado');
        $seccionId = $request->input('seccion');

        $nivel = Nivel::find($nivelId);
        $grado = Grado::find($gradoId);
        $seccion = Seccion::find($seccionId);

        if (!$nivel || !$grado || !$seccion) {
            return back()->withErrors(['error' => 'No se encontraron los datos seleccionados.']);
        }

        $alumnos = Alumno::where('seccion_id_seccion', $seccionId)->get();

        $pdf = Pdf::loadView('Alumno.pdf', [
            'alumnos' => $alumnos,
            'nivel' => $nivel,
            'grado' => $grado,
            'seccion' => $seccion,
            'año_actual' => $año_actual,
        ]);

        return $pdf->stream('alumnos.pdf');
    }
}
