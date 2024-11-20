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
        $buscarporGrado = $request->get('buscarporGrado');
        $buscarporNivel = $request->get('buscarporNivel');
        // Inicializa una variable para guardar el id_grado encontrado
        $id_grado = [];
        $id_nivel = [];

        // Si hay un valor para buscar por grado, busca el id_grado correspondiente
        if ($buscarporGrado) {
            $grado = Grado::where('nombre_grado', 'like', '%' . $buscarporGrado . '%')->get();
            if ($grado) {
                $id_grado = $grado->pluck('id_grado')->toArray();
            }
        }

        if ($buscarporNivel) {
            $nivel = Nivel::where('nombre_nivel', 'like', '%' . $buscarporNivel . '%')->get();
            if ($nivel) {
                $id_nivel = $nivel->pluck('id_nivel')->toArray();
            }
        }

        $curso = Curso::where('id_curso', '>', '0')
            ->where(function ($query) use ($id_grado, $id_nivel) {
                if (!empty($id_grado)) {
                    $query->whereIn('grado_id_grado', $id_grado);
                }
                if (!empty($id_nivel)) {
                    $query->whereHas('grado', function ($q) use ($id_nivel) {
                        $q->where('id_nivel', $id_nivel);
                    });
                }
            })
            ->paginate($this::PAGINATION);
        $curso->appends(['buscarporGrado' => $buscarporGrado, 'buscarporNivel' => $buscarporNivel]);

        return view('CursoPorGrado.cursoxGrado', compact('curso', 'buscarporGrado', 'buscarporNivel'));
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
