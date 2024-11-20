<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Nivel;
use App\Models\Grado;
use Illuminate\Http\Request;

class CursoPorGradoController extends Controller
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
        $nivel = $request->get('nivel');
        $grado = $request->get('grado');

        $query = Curso::query();

        // Si hay un valor para buscar por grado, busca el id_grado correspondiente
        if ($grado) {
            $query->whereHas('grado', function ($query) use ($grado) {
                $query->where('id_grado', $grado); // Cambia 'grado' por el campo correcto en la tabla 'grado'
            });
        }

        if ($nivel) {
            
            $query->whereHas('grado', function ($query) use ($nivel) {
                $query->whereHas('nivel', function ($query) use ($nivel) {
                    $query->where('id_nivel', $nivel); // Cambia 'nivel' por el campo correcto en la tabla 'nivel'
                });
            });
        }

        $curso = $query->paginate(self::PAGINATION);

        $curso->appends([
            'nivel' => $nivel,
            'grado' => $grado,
        ]);

        $niveles = Nivel::all(); // Con esto envio todos los niveles a la vista
        $grados = Grado::all();

        return view('CursoPorGrado.cursoxGrado', compact('curso', 'nivel', 'grado' , 'niveles', 'grados'));
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
}
