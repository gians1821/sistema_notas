<?php

namespace App\Http\Controllers;

use App\Models\CursoHasAlumno;
use Illuminate\Http\Request;

class CursoHasAlumnoController extends Controller
{

    const PAGINACION = 10;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = CursoHasAlumno::paginate($this::PAGINACION);
        return view('Catedra.Catedra', compact('notas'));
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
    public function show(CursoHasAlumno $cursoHasAlumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_alumno, $id_curso)
    {
        $nota = CursoHasAlumno::where('curso_id_curso', $id_curso)->where('alumno_id_alumno', $id_alumno)->first();
        return view('Catedra.edit', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_alumno, $id_curso)
    {
        // Validar los datos
        $request->validate([
            'nota1' => 'required|numeric|between:0,20',
            'nota2' => 'required|numeric|between:0,20',
            'nota3' => 'required|numeric|between:0,20',
        ]);

        $nota = CursoHasAlumno::where('alumno_id_alumno', $id_alumno)
            ->where('curso_id_curso', $id_curso)
            ->first();

        // Verificar si el registro existe
        if (!$nota) {
            return redirect()->route('Nota.index')->with('error', 'Registro no encontrado.');
        }

        $nota1 = $request->nota1;
        $nota2 = $request->nota2;
        $nota3 = $request->nota3;

        try {
            $nota->update([
                'nota1' => $nota1,
                'nota2' => $nota2,
                'nota3' => $nota3,
            ]);
            return redirect()->route('Nota.index')->with('datos', 'Registro Actualizado..!');
        } catch (\Exception $e) {
            return redirect()->route('Nota.index')->with('datos', 'Error al actualizar el registro: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CursoHasAlumno $cursoHasAlumno)
    {
        //
    }
}
