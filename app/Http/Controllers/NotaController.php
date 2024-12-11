<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Catedra;
use App\Models\Curso;
use App\Models\CursoHasAlumno;
use App\Models\Nota;
use App\Models\Personal;
use App\Models\Promedio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    const PAGINACION = 10;

    public function index(Request $request)
    {
        // Obtener todos los profesores (docentes) con tipo personal 1
        $docentes = Personal::where('id_tipo_personal', '1')->orderBy('id_personal')->get();

        // Obtener todos los cursos
        $cursos = Curso::orderBy('id_curso')->get();

        // Obtener todas las cátedras
        $catedras = Catedra::with(['curso', 'docente', 'seccion'])
                            ->orderBy('id')
                            ->get();

        // Inicializar la consulta de notas
        $query = Nota::with(['catedra.curso', 'catedra.docente', 'catedra.seccion', 'alumno', 'competencia']);

        // Filtrar por cátedra si se proporciona
        if ($request->has('catedra_id') && !empty($request->catedra_id)) {
            $query->where('catedra_id', $request->catedra_id);
        }

        // Obtener las notas filtradas
        $notas = $query->paginate(10); // Puedes ajustar la paginación según tus necesidades

        return view('pages.notas.index', compact('notas', 'catedras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $nota = Nota::where('id', $id)->first();
        return view('pages.notas.edit', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nota = Nota::findOrFail($id);

        // Validar los datos de entrada
        $request->validate([
            'nota1' => 'required|string|max:10',
            'nota2' => 'required|string|max:10',
            'nota3' => 'required|string|max:10',
            'nota_final' => 'required|string|max:10',
        ]);

        // Actualizar solo los campos editables
        $nota->update($request->only(['nota1', 'nota2', 'nota3', 'nota_final']));

        if ($request->nota_final)
        {
            $promedio = Promedio::where('alumno_id_alumno', $nota->alumno->id_alumno)->where('id', $nota->id_promedio)->first();
            $promedio->valor = $nota->nota_final;
            $promedio->save();
        }

        return redirect()->route('notas.index')->with('success', 'Nota actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pdf(Request $request)
    {
        // Obtener los IDs desde la solicitud
        $gradoId = $request->get('grado');
        $nivelId = $request->get('nivel');
        $cursoId = $request->get('curso');

        // Inicializar variables para los datos
        $grado = null;
        $nivel = null;
        $curso = null;

        // Consultar grado, nivel y curso
        $grado = DB::table('grados')->where('id_grado', $gradoId)->first();
        $nivel = DB::table('nivels')->where('id_nivel', $nivelId)->first();
        $curso = DB::table('cursos')->where('id_curso', $cursoId)->first();

        // Asegurarse de que los datos estén presentes, asignar valores predeterminados si no
        $grado = $grado ? $grado : (object) ['nombre_grado' => 'Desconocido'];
        $nivel = $nivel ? $nivel : (object) ['nombre_nivel' => 'Desconocido'];
        $curso = $curso ? $curso : (object) ['nombre_curso' => 'Desconocido'];

        // Filtrar notas según el ID del curso
        $notas = CursoHasAlumno::when($cursoId, function ($query, $cursoId) {
            return $query->where('curso_id_curso', $cursoId);
        })->get();

        // Generar el PDF con las notas y datos adicionales
        $pdf = Pdf::loadView('Catedra.pdf', compact('notas', 'grado', 'nivel', 'curso'));

        // Devolver el PDF como respuesta
        return $pdf->stream();
    }

    public function PdfAlumno($id_alumno)
    {
        $alumno = Alumno::find($id_alumno);
        $cursos = CursoHasAlumno::where('alumno_id_alumno', $id_alumno)->get();

        $pdf = PDF::loadView('Catedra.PdfAlumno', compact('cursos', 'alumno'));
        return $pdf->stream();
    }

    public function confirmar($id)
    {
        $nota = Nota::findOrFail($id);
        return view('pages.notas.confirmar', compact('nota'));
    }
}
