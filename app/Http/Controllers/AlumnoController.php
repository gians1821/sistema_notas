<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Periodo;
use App\Models\Seccion;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;
use App\Models\Padre;

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


        return view('Alumno.Alumnos', compact(
            'alumnos', 'periodos' , 'periodo' ,'buscarporNom', 'buscarporApell', 'nivel', 'grado', 
            'seccion', 'niveles', 'grados', 'secciones'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $añoactual = Carbon::now()->year;
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
                'periodo' => 'required',
                'profile_photo' => 'required|image|max:2048',
                'dni_apoderado' => 'required|string|max:8',
                'nombre_apoderado' => 'required|string|max:30',
                'apellido_apoderado' => 'required|string|max:30',
                'email_apoderado' => 'required|email|unique:padres,email',
                'password' => 'required|string|min:8',
                'confirmar_password' => 'required|same:password',
                
                'nombre_alumno' => 'required|string|max:30',
                'apellido_alumno' => 'required|string|max:30',
                'fecha_nacimiento' => 'required|date',
                'dni' => 'required|string|max:8',
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

                'profile_photo.required' => 'La foto es obligatoria.',
                'profile_photo.image' => 'El archivo debe ser una imagen.',
                'profile_photo.max' => 'La imagen no debe exceder los 2MB.',

                'dni_apoderado.required' => 'Ingrese el DNI del apoderado.',
                'dni_apoderado.string' => 'El DNI del apoderado debe ser una cadena de texto.',
                'dni_apoderado.max' => 'El DNI del apoderado no debe exceder los 8 caracteres.',

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

                'apellido_alumno.required' => 'Ingrese el apellido del alumno.',
                'apellido_alumno.string' => 'El apellido del alumno debe ser una cadena de texto.',
                'apellido_alumno.max' => 'El apellido del alumno no debe exceder los 30 caracteres.',

                'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento.',
                'fecha_nacimiento.date' => 'Ingrese una fecha válida.',

                'dni.required' => 'Ingrese el DNI del alumno.',
                'dni.string' => 'El DNI del alumno debe ser una cadena de texto.',
                'dni.max' => 'El DNI del alumno no debe exceder los 8 caracteres.',

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

        $alumnos = new Alumno();
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
        // Obtener el valor de sección desde el formulario y asignarlo
        $nivel = $request->nivel;
        $grado = $request->grado;
        $seccion = $request->seccion;

        // Variable para almacenar el valor de id_seccion
        $id_seccion = 0;

        // Lógica para asignar el valor de id_seccion basado en nivel, grado y sección
        switch ($nivel) {
            case 'Primaria':
                switch ($grado) {
                    case 'Primero':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 1;
                                break;
                            case 'B':
                                $id_seccion = 2;
                                break;
                            case 'C':
                                $id_seccion = 3;
                                break;
                        }
                        break;
                    case 'Segundo':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 4;
                                break;
                            case 'B':
                                $id_seccion = 5;
                                break;
                            case 'C':
                                $id_seccion = 6;
                                break;
                        }
                        break;
                    case 'Tercero':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 7;
                                break;
                            case 'B':
                                $id_seccion = 8;
                                break;
                            case 'C':
                                $id_seccion = 9;
                                break;
                        }
                        break;
                    case 'Cuarto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 10;
                                break;
                            case 'B':
                                $id_seccion = 11;
                                break;
                            case 'C':
                                $id_seccion = 12;
                                break;
                        }
                        break;
                    case 'Quinto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 13;
                                break;
                            case 'B':
                                $id_seccion = 14;
                                break;
                            case 'C':
                                $id_seccion = 15;
                                break;
                        }
                        break;
                    case 'Sexto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 16;
                                break;
                            case 'B':
                                $id_seccion = 17;
                                break;
                            case 'C':
                                $id_seccion = 18;
                                break;
                        }
                        break;
                }
                break;
            case 'Secundaria':
                switch ($grado) {
                    case 'Primero':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 19;
                                break;
                            case 'B':
                                $id_seccion = 20;
                                break;
                            case 'C':
                                $id_seccion = 21;
                                break;
                        }
                        break;
                    case 'Segundo':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 22;
                                break;
                            case 'B':
                                $id_seccion = 23;
                                break;
                            case 'C':
                                $id_seccion = 24;
                                break;
                        }
                        break;
                    case 'Tercero':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 25;
                                break;
                            case 'B':
                                $id_seccion = 26;
                                break;
                            case 'C':
                                $id_seccion = 27;
                                break;
                        }
                        break;
                    case 'Cuarto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 28;
                                break;
                            case 'B':
                                $id_seccion = 29;
                                break;
                            case 'C':
                                $id_seccion = 30;
                                break;
                        }
                        break;
                    case 'Quinto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 31;
                                break;
                            case 'B':
                                $id_seccion = 32;
                                break;
                            case 'C':
                                $id_seccion = 33;
                                break;
                        }
                        break;
                }
                break;
        }

        // Asignar el valor de id_seccion al modelo Alumno
        $alumnos->seccion_id_seccion = $id_seccion;
        $alumnos->save();
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
        return view('Alumno.edit', compact('alumnos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_alumno)
    {
        $alumnos = Alumno::findOrFail($id_alumno);
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
        // Obtener el valor de sección desde el formulario y asignarlo
        $nivel = $request->nivel;
        $grado = $request->grado;
        $seccion = $request->seccion;

        // Variable para almacenar el valor de id_seccion
        $id_seccion = 0;

        // Lógica para asignar el valor de id_seccion basado en nivel, grado y sección
        switch ($nivel) {
            case 'Primaria':
                switch ($grado) {
                    case 'Primero':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 1;
                                break;
                            case 'B':
                                $id_seccion = 2;
                                break;
                            case 'C':
                                $id_seccion = 3;
                                break;
                        }
                        break;
                    case 'Segundo':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 4;
                                break;
                            case 'B':
                                $id_seccion = 5;
                                break;
                            case 'C':
                                $id_seccion = 6;
                                break;
                        }
                        break;
                    case 'Tercero':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 7;
                                break;
                            case 'B':
                                $id_seccion = 8;
                                break;
                            case 'C':
                                $id_seccion = 9;
                                break;
                        }
                        break;
                    case 'Cuarto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 10;
                                break;
                            case 'B':
                                $id_seccion = 11;
                                break;
                            case 'C':
                                $id_seccion = 12;
                                break;
                        }
                        break;
                    case 'Quinto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 13;
                                break;
                            case 'B':
                                $id_seccion = 14;
                                break;
                            case 'C':
                                $id_seccion = 15;
                                break;
                        }
                        break;
                    case 'Sexto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 16;
                                break;
                            case 'B':
                                $id_seccion = 17;
                                break;
                            case 'C':
                                $id_seccion = 18;
                                break;
                        }
                        break;
                }
                break;
            case 'Secundaria':
                switch ($grado) {
                    case 'Primero':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 19;
                                break;
                            case 'B':
                                $id_seccion = 20;
                                break;
                            case 'C':
                                $id_seccion = 21;
                                break;
                        }
                        break;
                    case 'Segundo':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 22;
                                break;
                            case 'B':
                                $id_seccion = 23;
                                break;
                            case 'C':
                                $id_seccion = 24;
                                break;
                        }
                        break;
                    case 'Tercero':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 25;
                                break;
                            case 'B':
                                $id_seccion = 26;
                                break;
                            case 'C':
                                $id_seccion = 27;
                                break;
                        }
                        break;
                    case 'Cuarto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 28;
                                break;
                            case 'B':
                                $id_seccion = 29;
                                break;
                            case 'C':
                                $id_seccion = 30;
                                break;
                        }
                        break;
                    case 'Quinto':
                        switch ($seccion) {
                            case 'A':
                                $id_seccion = 31;
                                break;
                            case 'B':
                                $id_seccion = 32;
                                break;
                            case 'C':
                                $id_seccion = 33;
                                break;
                        }
                        break;
                }
                break;
        }

        // Asignar el valor de id_seccion al modelo Alumno
        $alumnos->seccion_id_seccion = $id_seccion;
        $alumnos->save();
        return redirect()->route('Alumno.index')->with('datos', 'Registro Actualizado..!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmar($id_alumno)
    {
        $alumnos = Alumno::findOrFail($id_alumno);
        return view('Alumno.confirmar', compact('alumnos'));
    }

    public function destroy($id_alumno)
    {
        $alumno = Alumno::findOrFail($id_alumno);
        $alumno->delete();
        return redirect()->route('Alumno.index')->with('datos', 'Registro Eliminado..');
    }

    public function generarPdf(Request $request)
    {
        $idseccion = (int) $request->idseccion;

        // Consulta para buscar por nombre, apellido, nivel, grado y sección
        $query = Alumno::query();

        if ($idseccion) {
            $query->whereHas('seccion', function ($query) use ($idseccion) {
                $query->where('id_seccion', $idseccion); // Cambia 'seccion' por el campo correcto en la tabla 'seccion'
            });
        }

        $alumnos = $query->paginate($this::PAGINACION);

        // Agrega los filtros a los parámetros de paginación
        $alumnos->appends([
            'seccion' => $idseccion,
        ]);

        // // Asegúrate de manejar los parámetros correctamente
        // $idgrado = (int) $idgrado;
        // $idseccion = (int) $idseccion;

        // // Validar si los valores son válidos
        // if ($idgrado === 0 || $idseccion === 0) {
        //     // Manejo de errores si los valores son '0'
        //     return redirect()->back()->with('datos', 'Grado o Sección no válidos.');
        // }

        // // Aquí puedes hacer la lógica para obtener los datos necesarios y generar el PDF
        // $alumnos = Alumno::where('seccion_id_seccion', $idseccion)
        //     ->get();
        // $seccion = Seccion::where('id_seccion', $idseccion)->get();
        // $grado = $seccion->grado()->id_grado;

        $seccion = Seccion::where('id_seccion', $idseccion)->get()[0];
        $pdf = Pdf::loadView('Alumno.pdf', ['alumnos' => $alumnos, 'seccion' => $seccion]);

        return $pdf->stream('alumnos.pdf');
    }
}
