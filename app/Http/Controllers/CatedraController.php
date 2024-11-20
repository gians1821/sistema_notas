<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\CursoHasAlumno;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class CatedraController extends Controller
{
    const PAGINACION = 10;

    public function index(Request $request)
    {
        // Obtener todos los cursos
        $nivel = DB::table('nivels')->get();
        $grado = collect(); // Colección vacía para inicializar los grados
        $cursos = collect();

        if ($request->has('nivel')) {
            $grado = DB::table('grados')->where('id_nivel', $request->input('nivel'))->get();
        }

        if ($request->has('grado')) {
            $cursos = DB::table('cursos')->where('grado_id_grado', $request->input('grado'))->get();
        }

        // Obtener el ID del curso desde el formulario
        $cursoId = $request->get('curso');
        $notas = collect(); // Inicializar una colección vacía de notas

        if ($cursoId) {
            // Filtrar las notas por el ID del curso
            $notas = CursoHasAlumno::where('curso_id_curso', '=', $cursoId)->paginate($this::PAGINACION);
        } else {
            // Si no se selecciona un curso específico, paginar todas las notas
            $notas = CursoHasAlumno::paginate($this::PAGINACION);
        }
        $notas->appends(['curso' => $cursoId, 'nivel', 'grado']);
        return view('Catedra.Catedra', compact('notas', 'cursos', 'cursoId', 'nivel', 'grado', 'cursos'));
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
}
