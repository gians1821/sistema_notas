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
        // Obtener filtros desde la solicitud
        $buscarporNombre = $request->input('buscarporNombre');
        $buscarporGrado = $request->input('buscarporGrado');
        $buscarporNivel = $request->input('buscarporNivel');
        $buscarporCurso = $request->input('buscarporCurso');

        // Iniciar la consulta
        $capacidades = Capacidad::query()->with('curso.grado.nivel');

        // Filtrar por nombre de competencia
        if ($buscarporNombre) {
            $capacidades->where('nombre_competencia', 'like', '%' . mb_strtoupper($buscarporNombre) . '%');
        }

        // Filtrar por curso
        if ($buscarporCurso) {
            $capacidades->where('id_curso', $buscarporCurso);
        }

        // Filtrar por grado
        if ($buscarporGrado) {
            $capacidades->whereHas('curso.grado', function ($query) use ($buscarporGrado) {
                $query->where('id_grado', $buscarporGrado);
            });
        }

        // Filtrar por nivel
        if ($buscarporNivel) {
            $capacidades->whereHas('curso.grado.nivel', function ($query) use ($buscarporNivel) {
                $query->where('id_nivel', $buscarporNivel);
            });
        }

        // Paginación
        $capacidades = $capacidades->paginate(10);

        // Mantener los filtros en la paginación
        $capacidades->appends([
            'buscarporNombre' => $buscarporNombre,
            'buscarporGrado' => $buscarporGrado,
            'buscarporNivel' => $buscarporNivel,
            'buscarporCurso' => $buscarporCurso,
        ]);

        // Definir encabezados y columnas
        $headers = ['ID', 'Nivel', 'Grado', 'Curso', 'Competencia'];
        $columns_data = ['id_competencia', 'curso.grado.nivel.nombre_nivel', 'curso.grado.nombre_grado', 'curso.nombre_curso', 'nombre_competencia'];

        // Definir rutas
        $edit_route = 'Capacidad.edit';
        $delete_route = 'Capacidad.destroy';

        return view('Capacidad.Capacidades', compact('capacidades', 'buscarporNombre', 'buscarporGrado', 'buscarporNivel', 'buscarporCurso', 'headers', 'columns_data', 'edit_route', 'delete_route'));
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
        $data = $request->validate(
            [
                'nivel' => 'required|integer', // Ahora esperamos un ID numérico
                'grado' => 'required|integer', // Ahora esperamos un ID numérico
                'curso' => 'required|integer', // Ahora esperamos un ID numérico
                'nombre_competencia' => 'required|regex:/^[\pL\s.]+$/u|max:30', // Letras, espacios y tildes
            ],
            [
                'nombre_competencia.required' => 'Ingrese el nombre de la competencia.',
                'nombre_competencia.regex' => 'El nombre de la competencia solo debe contener letras y espacios.',
                'nombre_competencia.max' => 'El nombre de la competencia no debe exceder los 30 caracteres.',

                'nivel.required' => 'Seleccione el nivel.',
                'nivel.integer' => 'El nivel seleccionado no es válido.',

                'grado.required' => 'Seleccione el grado.',
                'grado.integer' => 'El grado seleccionado no es válido.',

                'curso.required' => 'Seleccione el curso.',
                'curso.integer' => 'El curso seleccionado no es válido.',
            ],
        );

        // Obtener los IDs seleccionados desde el formulario
        $nivelId = $request->nivel; // ID del nivel
        $gradoId = $request->grado; // ID del grado
        $cursoId = $request->curso; // ID del curso

        // Verificar si ya existe una capacidad con el mismo curso y nombre de competencia
        $existeCapacidad = Capacidad::where('id_curso', $cursoId)
            ->where('nombre_competencia', $data['nombre_competencia'])
            ->first();

        if ($existeCapacidad) {
            return redirect()->route('Capacidad.index')->with('datos', 'Ya existe una capacidad con este curso y competencia.');
        }

        // Crear y guardar la nueva capacidad
        $capacidad = new Capacidad();
        $capacidad->nombre_competencia = $request->nombre_competencia;
        $capacidad->id_curso = $cursoId; // Usamos directamente el ID del curso seleccionado
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
        // Validar los datos de la solicitud
        $data = $request->validate(
            [
                'nivel' => 'required|integer|exists:nivels,id_nivel',
                'grado' => 'required|integer|exists:grados,id_grado',
                'curso' => 'required|integer|exists:cursos,id_curso',
                'nombre_competencia' => 'required|regex:/^[\pL\s]+$/u|max:30', // LETRAS Y TILDES
            ],
            [
                'nombre_competencia.required' => 'Ingrese el nombre de la competencia.',
                'nombre_competencia.regex' => 'El nombre de la competencia solo debe contener letras y espacios.',
                'nombre_competencia.max' => 'El nombre de la competencia no debe exceder los 30 caracteres.',

                'nivel.required' => 'Seleccione el nivel.',
                'nivel.integer' => 'El nivel seleccionado no es válido.',
                'nivel.exists' => 'El nivel seleccionado no existe.',

                'grado.required' => 'Seleccione el grado.',
                'grado.integer' => 'El grado seleccionado no es válido.',
                'grado.exists' => 'El grado seleccionado no existe.',

                'curso.required' => 'Seleccione el curso.',
                'curso.integer' => 'El curso seleccionado no es válido.',
                'curso.exists' => 'El curso seleccionado no existe.',
            ],
        );

        // Obtener los valores de los selects
        $nivel_id = $request->nivel;
        $grado_id = $request->grado;
        $curso_id = $request->curso;
        $nombre_competencia = $request->nombre_competencia;

        // Verificar que el grado pertenece al nivel seleccionado
        $grado = Grado::find($grado_id);
        if (!$grado || $grado->id_nivel != $nivel_id) {
            return redirect()
                ->back()
                ->withErrors(['grado' => 'El grado seleccionado no pertenece al nivel elegido.'])
                ->withInput();
        }

        // Verificar que el curso pertenece al grado seleccionado
        $curso = Curso::find($curso_id);
        if (!$curso || $curso->grado_id_grado != $grado_id) {
            return redirect()
                ->back()
                ->withErrors(['curso' => 'El curso seleccionado no pertenece al grado elegido.'])
                ->withInput();
        }

        // Verificar si ya existe una capacidad con el mismo curso y nombre, excluyendo la actual
        $existeCapacidad = Capacidad::where('id_curso', $curso_id)->where('nombre_competencia', $nombre_competencia)->where('id_competencia', '!=', $id_competencia)->first();

        if ($existeCapacidad) {
            return redirect()->route('Capacidad.edit', $id_competencia)->with('datos', 'Ya existe una competencia con este curso y nombre.')->withInput();
        }

        // Actualizar la capacidad existente
        $capacidad = Capacidad::findOrFail($id_competencia);
        $capacidad->nombre_competencia = $nombre_competencia;
        $capacidad->id_curso = $curso_id;
        $capacidad->save();

        return redirect()->route('Capacidad.index')->with('datos', 'Registro Actualizado Correctamente.');
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
