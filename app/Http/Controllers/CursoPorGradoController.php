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
    const PAGINATION = 8;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $nivel = $request->get('nivel');
        $grado = $request->get('grado');

        $query = Curso::query();

        if ($nivel) {

            $grados = Grado::where('id_nivel', $nivel)->pluck('id_grado'); 
    
            if ($grados->isNotEmpty()) {
                $query->whereIn('grado_id_grado', $grados);
            }
        }

        if ($grado) {
            $query->where('grado_id_grado', $grado);
        }

        $curso = $query->paginate(self::PAGINATION);

        $curso->appends([
            'nivel' => $nivel,
            'grado' => $grado,
        ]);

        $niveles = Nivel::all(); 
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
