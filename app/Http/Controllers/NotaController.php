<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\CursoHasAlumno;
use App\Models\Nota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    const PAGINACION = 10;

    public function index(Request $request)
    {
        $notas = Nota::get();
        return view('pages.notas.index', compact('notas'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
}
