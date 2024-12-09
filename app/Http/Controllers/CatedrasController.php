<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Nivel;
use App\Models\Periodo;
use App\Models\Personal;
use Illuminate\Http\Request;

class CatedrasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.catedras.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $docentes = Personal::where('id_tipo_personal', 3)->get();
        $cursos = Curso::get();
        $periodos = Periodo::get();
        $niveles = Nivel::get();
        return view('pages.catedras.create', compact('docentes', 'cursos', 'periodos', 'niveles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_periodo' => 'required|exists:periodos,id',
            'curso_id' => 'required|exists:cursos,id_curso',
            'docente_id' => 'required|exists:personals,id_personal',
        ]);

        

        // Redirigir con un mensaje de éxito
        return redirect()->route('catedras.index')->with('success', 'Cátedra asignada correctamente');
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
}
