<?php

namespace App\Http\Controllers;

use App\Models\Capacidad;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGINATION = 6;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $buscarporNombre = $request->get('buscarporNombre');
        $buscarporGrado = $request->get('buscarporGrado');
        $buscarporNivel = $request->get('buscarporNivel');
        $buscarporCurso = $request->get('buscarporCurso');

        $id_grado = null;
        $id_curso = [];

        // Buscar id_grado basado en el nivel y grado
        if ($buscarporNivel) {
            $nivel = Nivel::where('nombre_nivel', 'like', '%' . $buscarporNivel . '%')->first();
            if ($nivel) {
                $id_nivel = $nivel->id_nivel;
                if ($buscarporGrado) {
                    $grado = Grado::where('nombre_grado', 'like', '%' . $buscarporGrado . '%')
                        ->where('id_nivel', $id_nivel)  // Asumiendo que el Grado está relacionado con Nivel
                        ->first();
                    if ($grado) {
                        $id_grado = $grado->id_grado;
                    }
                }
            }
        }

        // Buscar id_curso basado en id_grado y nombre del curso
        if ($id_grado) {
            $cursos = Curso::where('grado_id_grado', $id_grado);

            if ($buscarporCurso) {
                $cursos = $cursos->where(strtoupper('nombre_curso'), 'like', '%' . $buscarporCurso . '%');
            }

            $cursos = $cursos->get();
            if ($cursos) {
                $id_curso = $cursos->pluck('id_curso')->toArray();
            }
        }

        // Buscar compeetencia
        $capacidad = Capacidad::where('id_competencia', '>', '0')
            ->where(function ($query) use ($buscarporNombre, $id_curso) {
                if ($buscarporNombre) {
                    $query->where('nombre_competencia', 'like', '%' . mb_strtoupper($buscarporNombre) . '%');
                }
                if (!empty($id_curso)) {
                    $query->whereIn('id_curso', $id_curso);
                }
            })
            ->paginate($this::PAGINATION);

        $capacidad->appends([
            'buscarporNombre' => $buscarporNombre,
            'buscarporGrado' => $buscarporGrado,
            'buscarporNivel' => $buscarporNivel,
            'buscarporCurso' => $buscarporCurso
        ]);

        return view('Capacidad.Capacidades', compact('capacidad', 'buscarporNombre', 'buscarporGrado', 'buscarporNivel', 'buscarporCurso'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Capacidad.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos del formulario
        $data = $request->validate([
            'nivel' => 'required|String|max:15',
            'grado' => 'required|String|max:15',
            'curso' => 'required|regex:/^[\p{L}\s.\/]+$/u|max:30',
            'nombre_competencia' => 'required|regex:/^[\pL\s.]+$/u|max:30', //LETRAS Y TILDES
        ], [

            'nombre_competencia.required' => 'Ingrese el nombre del curso.',
            'nombre_competencia.regex' => 'El nombre del curso solo debe contener letras y espacios.',
            'nombre_competencia.max' => 'El nombre del curso no debe exceder los 30 caracteres.',

            'nivel.required' => 'Seleccione el nivel.',
            'nivel.max' => 'El nivel no debe exceder los 15 caracteres.',

            'grado.required' => 'Seleccione el grado.',
            'grado.max' => 'El grado no debe exceder los 15 caracteres.',

            'curso.required' => 'Seleccione el curso.',
            'curso.max' => 'El curso no debe exceder los 30 caracteres.',

        ]);

        // Obtener el valor de sección desde el formulario y asignarlo
        $nivel = $request->nivel;
        $grado = $request->grado;
        $curso = $request->curso;

        // Variable para almacenar el valor de id_seccion
        $id_grado = 0;

        // Lógica para asignar el valor de id_grado basado en nivel
        switch ($nivel) {
            case 'PRIMARIA':
                switch ($grado) {
                    case 'PRIMERO':
                        $id_grado = 1;
                        break;
                    case 'SEGUNDO':
                        $id_grado = 2;
                        break;
                    case 'TERCERO':
                        $id_grado = 3;
                        break;
                    case 'CUARTO':
                        $id_grado = 4;
                        break;
                    case 'QUINTO':
                        $id_grado = 5;
                        break;
                    case 'SEXTO':
                        $id_grado = 6;
                        break;
                }
                break;
            case 'SECUNDARIA':
                switch ($grado) {
                    case 'PRIMERO':
                        $id_grado = 7;
                        break;
                    case 'SEGUNDO':
                        $id_grado = 8;
                        break;
                    case 'TERCERO':
                        $id_grado = 9;
                        break;
                    case 'CUARTO':
                        $id_grado = 10;
                        break;
                    case 'QUINTO':
                        $id_grado = 11;
                        break;
                }
                break;
        }
        // Obtener el id_curso del curso que cumple con las condiciones
        $cursoEncontrado = Curso::where('grado_id_grado', $id_grado)
            ->whereRaw('LOWER(nombre_curso) = ?', [strtolower($curso)]) // Aquí usas el nombre del curso seleccionado
            ->pluck('id_curso') // Extrae solo el valor de 'id_curso'
            ->first();

        //Verificar si ya existe una sección con el mismo nivel y grado
        $existeCapacidad = Capacidad::where('id_curso', $cursoEncontrado)->where('nombre_competencia', $data['nombre_competencia'])->first();
        if ($existeCapacidad) {
            return redirect()->route('Capacidad.index')->with('datos', 'Ya existe');
        }

        $capacidad = new Capacidad();
        $capacidad->nombre_competencia = strtoupper($request->nombre_competencia);
        $capacidad->id_curso = $cursoEncontrado;
        $capacidad->save();
        return redirect()->route('Capacidad.index')->with('datos', 'Registro Guardado..!');
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
    public function edit($id_competencia)
    {
        $capacidad = Capacidad::findOrFail($id_competencia);
        return view('Capacidad.edit', compact('capacidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_competencia)
    {
        $data = $request->validate([
            'nivel' => 'required|String|max:15',
            'grado' => 'required|String|max:15',
            'required|regex:/^[\p{L}\s.\/]+$/u|max:30',
            'nombre_competencia' => 'required|regex:/^[\pL\s]+$/u|max:15', //LETRAS Y TILDES
        ], [

            'nombre_competencia.required' => 'Ingrese el nombre del curso.',
            'nombre_competencia.regex' => 'El nombre del curso solo debe contener letras y espacios.',
            'nombre_competencia.max' => 'El nombre del curso no debe exceder los 30 caracteres.',

            'nivel.required' => 'Seleccione el nivel.',
            'nivel.max' => 'El nivel no debe exceder los 15 caracteres.',

            'grado.required' => 'Seleccione el grado.',
            'grado.max' => 'El grado no debe exceder los 15 caracteres.',

            'curso.required' => 'Seleccione el curso.',
            'curso.max' => 'El curso no debe exceder los 30 caracteres.',

        ]);

        // Obtener el valor de sección desde el formulario y asignarlo
        $nivel = $request->nivel;
        $grado = $request->grado;
        $curso = $request->curso;

        // Variable para almacenar el valor de id_seccion
        $id_grado = 0;

        // Lógica para asignar el valor de id_grado basado en nivel
        switch ($nivel) {
            case 'PRIMARIA':
                switch ($grado) {
                    case 'PRIMERO':
                        $id_grado = 1;
                        break;
                    case 'SEGUNDO':
                        $id_grado = 2;
                        break;
                    case 'TERCERO':
                        $id_grado = 3;
                        break;
                    case 'CUARTO':
                        $id_grado = 4;
                        break;
                    case 'QUINTO':
                        $id_grado = 5;
                        break;
                    case 'SEXTO':
                        $id_grado = 6;
                        break;
                }
                break;
            case 'SECUNDARIA':
                switch ($grado) {
                    case 'PRIMERO':
                        $id_grado = 7;
                        break;
                    case 'SEGUNDO':
                        $id_grado = 8;
                        break;
                    case 'TERCERO':
                        $id_grado = 9;
                        break;
                    case 'CUARTO':
                        $id_grado = 10;
                        break;
                    case 'QUINTO':
                        $id_grado = 11;
                        break;
                }
                break;
        }
        // Obtener el id_curso del curso que cumple con las condiciones
        $cursoEncontrado = Curso::where('grado_id_grado', $id_grado)
            ->whereRaw('LOWER(nombre_curso) = ?', [strtolower($curso)]) // Aquí usas el nombre del curso seleccionado
            ->pluck('id_curso') // Extrae solo el valor de 'id_curso'
            ->first();

        //Verificar si ya existe una capcaidad 
        $existeCapacidad = Capacidad::where('id_curso', $cursoEncontrado)->where('nombre_competencia', $data['nombre_competencia'])->first();
        if ($existeCapacidad) {
            return redirect()->route('Capacidad.index')->with('datos', 'Ya existe');
        }

        $capacidad = Capacidad::findOrFail($id_competencia);
        $capacidad->nombre_competencia = strtoupper($request->nombre_competencia);
        $capacidad->id_curso = $cursoEncontrado;
        $capacidad->save();
        return redirect()->route('Capacidad.index')->with('datos', 'Registro Actualizado..!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmar($id_competencia)
    {
        $capacidad = Capacidad::findOrFail($id_competencia);
        return view('Capacidad.confirmar', compact('capacidad'));
    }

    public function destroy($id_competencia)
    {
        $capacidad = Capacidad::findOrFail($id_competencia);
        $capacidad->delete();
        return redirect()->route('Capacidad.index')->with('datos', 'Registro Eliminado..');
    }
}
