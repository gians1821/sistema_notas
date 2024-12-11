<?php

namespace App\Http\Controllers;

use App\Models\Catedra;
use App\Models\Curso;
use App\Models\Nivel;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\TipoPersonal;
use Illuminate\Http\Request;

class CatedrasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catedras = Catedra::get();
        return view('pages.catedras.index', compact('catedras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_tipo_docente = TipoPersonal::where('nombre_tipopersonal', 'DOCENTE')->first()->id_tipo_personal;
        $docentes = Personal::where('id_tipo_personal', $id_tipo_docente)->get();
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
            'seccion_id' => 'required|exists:seccions,id_seccion',
        ]);

        // Iniciar una transacción para asegurar la integridad de los datos
        \DB::beginTransaction();

        try {
            // Opcional: Verificar si ya existe una cátedra similar para evitar duplicados
            $existingCatedra = Catedra::where('periodo_id', $validated['id_periodo'])
                ->where('curso_id', $validated['curso_id'])
                ->where('seccion_id', $validated['seccion_id'])
                ->where('docente_id', $validated['docente_id'])
                ->first();

            if ($existingCatedra) {
                // Si ya existe, lanzar una excepción personalizada
                throw new \Exception('Esta cátedra ya está asignada para el periodo, curso, sección y docente seleccionados.');
            }

            // Crear una nueva instancia de Catedra con los datos validados
            $catedra = new Catedra();
            $catedra->periodo_id = $validated['id_periodo'];
            $catedra->curso_id = $validated['curso_id'];
            $catedra->docente_id = $validated['docente_id'];
            $catedra->seccion_id = $validated['seccion_id'];
            $catedra->save(); // Guardar en la base de datos

            // Confirmar la transacción
            \DB::commit();

            // Redireccionar con un mensaje de éxito
            return redirect()->route('catedras.index')->with('success', 'Cátedra asignada exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            \DB::rollBack();

            // Registrar el error para depuración
            \Log::error('Error al asignar cátedra: ' . $e->getMessage());

            // Redireccionar de vuelta con un mensaje de error
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
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

    public function confirmar($id)
    {
        $catedra = Catedra::findOrFail($id);
        return view('pages.catedras.confirmar', compact('catedra'));
    }
}
