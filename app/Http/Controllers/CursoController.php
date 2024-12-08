<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
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
        $buscarporNombre = $request->get('buscarporNombre');
        $curso = Curso::where('id_curso', '>', 0)
            ->where(function ($query) use ($buscarporNombre) {
                $query->where('nombre_curso', 'like', '%' . $buscarporNombre . '%');
            })
            ->paginate($this::PAGINACION);
        $curso->appends(['buscarporNombre' => $buscarporNombre]);
        return view('Curso.Cursos', compact('curso', 'buscarporNombre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Curso.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos del formulario
        $data = $request->validate(
            [
                'nivel' => 'required|String|max:15',
                'grado' => 'required|String|max:15',
                'nombre_curso' => 'required|regex:/^[\p{L}\s.\/]+$/u|max:30',
            ],
            [
                'nombre_curso.required' => 'Ingrese el nombre del curso.',
                'nombre_curso.regex' => 'El nombre del curso solo debe contener letras y espacios.',
                'nombre_curso.max' => 'El nombre del curso no debe exceder los 30 caracteres.',

                'nivel.required' => 'Seleccione el nivel.',
                'nivel.max' => 'El nivel no debe exceder los 15 caracteres.',

                'grado.required' => 'Seleccione el grado.',
                'grado.max' => 'El grado no debe exceder los 15 caracteres.',
            ],
        );

        // Obtener el valor de sección desde el formulario y asignarlo
        $nivel = $request->nivel;
        $grado = $request->grado;
        // Variable para almacenar el valor de id_seccion
        $id_grado = 0;
        // Lógica para asignar el valor de id_grado basado en nivel
        switch ($nivel) {
            case 'Primaria':
                switch ($grado) {
                    case 'Primero':
                        $id_grado = 1;
                        break;
                    case 'Segundo':
                        $id_grado = 2;
                        break;
                    case 'Tercero':
                        $id_grado = 3;
                        break;
                    case 'Cuarto':
                        $id_grado = 4;
                        break;
                    case 'Quinto':
                        $id_grado = 5;
                        break;
                    case 'Sexto':
                        $id_grado = 6;
                        break;
                }
                break;
            case 'Secundaria':
                switch ($grado) {
                    case 'Primero':
                        $id_grado = 7;
                        break;
                    case 'Segundo':
                        $id_grado = 8;
                        break;
                    case 'Tercero':
                        $id_grado = 9;
                        break;
                    case 'Cuarto':
                        $id_grado = 10;
                        break;
                    case 'Quinto':
                        $id_grado = 11;
                        break;
                }
                break;
        }

        // Verificar si ya existe una sección con el mismo nivel y grado
        $existeCurso = Curso::where('grado_id_grado', $id_grado)
            ->where('nombre_curso', $data['nombre_curso'])
            ->first();
        if ($existeCurso) {
            return redirect()->route('Curso.index')->with('datos', 'Ya existe el curso.');
        }

        $curso = new Curso();
        $curso->nombre_curso = mb_strtoupper($request->nombre_curso);
        // Asignar el valor de id_seccion al modelo Seccion
        $curso->grado_id_grado = $id_grado;
        $curso->save();
        return redirect()->route('Curso.index')->with('datos', 'Registro Guardado..!');
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
    public function edit($id_curso)
    {
        $curso = Curso::findOrFail($id_curso);
        return view('Curso.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_curso)
    {
        // Validar datos del formulario
        $data = $request->validate(
            [
                'nivel' => 'required|String|max:15',
                'grado' => 'required|String|max:15',
                'nombre_curso' => 'required|regex:/^[\p{L}\s.\/]+$/u|max:30',
            ],
            [
                'nombre_curso.required' => 'Ingrese el nombre del curso.',
                'nombre_curso.regex' => 'El nombre del curso solo debe contener letras y espacios.',
                'nombre_curso.max' => 'El nombre del curso no debe exceder los 30 caracteres.',

                'nivel.required' => 'Seleccione el nivel.',
                'nivel.max' => 'El nivel no debe exceder los 15 caracteres.',

                'grado.required' => 'Seleccione el grado.',
                'grado.max' => 'El grado no debe exceder los 15 caracteres.',
            ],
        );
        // Obtener el valor de sección desde el formulario y asignarlo
        $nivel = $request->nivel;
        $grado = $request->grado;
        // Variable para almacenar el valor de id_seccion
        $id_grado = 0;
        // Lógica para asignar el valor de id_grado basado en nivel
        switch ($nivel) {
            case 'Primaria':
                switch ($grado) {
                    case 'Primero':
                        $id_grado = 1;
                        break;
                    case 'Segundo':
                        $id_grado = 2;
                        break;
                    case 'Tercero':
                        $id_grado = 3;
                        break;
                    case 'Cuarto':
                        $id_grado = 4;
                        break;
                    case 'Quinto':
                        $id_grado = 5;
                        break;
                    case 'Sexto':
                        $id_grado = 6;
                        break;
                }
                break;
            case 'Secundaria':
                switch ($grado) {
                    case 'Primero':
                        $id_grado = 7;
                        break;
                    case 'Segundo':
                        $id_grado = 8;
                        break;
                    case 'Tercero':
                        $id_grado = 9;
                        break;
                    case 'Cuarto':
                        $id_grado = 10;
                        break;
                    case 'Quinto':
                        $id_grado = 11;
                        break;
                }
                break;
        }

        // Verificar si ya existe una sección con el mismo nivel y grado
        $existeCurso = Curso::where('grado_id_grado', $id_grado)
            ->where('nombre_curso', $data['nombre_curso'])
            ->first();
        if ($existeCurso) {
            return redirect()->route('Curso.index')->with('datos', 'Ya existe el curso.');
        }

        $curso = Curso::findOrFail($id_curso);
        $curso->nombre_curso = mb_strtoupper($request->nombre_curso);
        // Asignar el valor de id_seccion al modelo Seccion
        $curso->grado_id_grado = $id_grado;
        $curso->save();
        return redirect()->route('Curso.index')->with('datos', 'Registro Actualizado..!');
    }

    public function confirmar($id_curso)
    {
        $curso = Curso::findOrFail($id_curso);
        return view('Curso.confirmar', compact('curso'));
    }

    public function destroy($id_curso)
    {
        $curso = Curso::findOrFail($id_curso);
        $curso->delete();
        return redirect()->route('Curso.index')->with('datos', 'Registro Eliminado..');
    }

    public function getCursosPorGrado($id_grado)
    {
        // Obtener los cursos asociados al grado
        $cursos = Curso::where('grado_id_grado', $id_grado)->get();

        // Devolver los cursos en formato JSON
        return response()->json($cursos);
    }
}
