<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PAGINATION = 6;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSeccionesPorGrado($id_grado)
    {
        $secciones = Seccion::where('grado_id_grado', $id_grado)->get(); 
        return response()->json($secciones); 
    }

    public function index(Request $request)
    {
        $nivel = $request->get('nivel');
        $grado = $request->get('grado');
        $seccion = $request->get('seccion');
    
        // Iniciar la consulta en Seccion
        $query = Seccion::query();
    
        if ($nivel) {

            $grados = Grado::where('id_nivel', $nivel)->pluck('id_grado'); 
    
            if ($grados->isNotEmpty()) {
                $query->whereIn('grado_id_grado', $grados);
            }
        }

        if ($grado) {
            $query->where('grado_id_grado', $grado);
        }
    
        if ($seccion) {
            $query->where('id_seccion', $seccion); 
        }
    
        $filtro = $query->paginate($this::PAGINATION);
    
        $niveles = Nivel::all();
        $grados = Grado::all();
        $secciones = Seccion::all();
    
        $filtro->appends(['nivel' => $nivel, 'grado' => $grado, 'seccion' => $seccion]);
    
        return view('Seccion.Seccion', compact('filtro', 'niveles', 'grados', 'secciones', 'seccion', 'grado', 'nivel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nivel = Nivel::all();
        return view('Seccion.create', compact('nivel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nivel1' => 'nullable|required_with:grado1,seccion1|exists:nivels,id_nivel', 
            'grado1' => 'nullable|required_with:nivel1,seccion1|exists:grados,id_grado', 
            'seccion1' => [
            'nullable',
            'required_with:nivel1,grado1',
            'string',
            Rule::unique('seccions', 'nombre_seccion')->where(function ($query) use ($request) {
                return $query->where('grado_id_grado', $request->grado1);
            }),
            ],
        
            'nivel2' => 'nullable|required_with:grado2,seccion2|exists:nivels,id_nivel',
            'grado2' => 'nullable|required_with:nivel2,seccion2',
            'seccion2' => [
            'nullable',
            'required_with:nivel2,grado2',
            'string',
            Rule::unique('seccions', 'nombre_seccion')->where(function ($query) use ($request) {
                return $query->where('grado_id_grado', function ($query) use ($request) {
                return $query->select('id_grado')->from('grados')->where('nombre_grado', $request->grado2)->where('id_nivel', $request->nivel2)->first();
                });
            }),
            ],
        
            'nivel3' => 'nullable|required_with:grado3,seccion3|unique:nivels,nombre_nivel',
            'grado3' => 'nullable|required_with:nivel3,seccion3',
            'seccion3' => [
            'nullable',
            'required_with:nivel3,grado3',
            'string',
            Rule::unique('seccions', 'nombre_seccion')->where(function ($query) use ($request) {
                return $query->where('grado_id_grado', $request->grado3);
            }),
            ],
        ],
        [
            'nivel1.required_with' => 'El campo nivel es requerido.',
            'grado1.required_with' => 'El campo grado es requerido.',
            'seccion1.required_with' => 'El campo sección es requerido.',
            'seccion1.unique' => 'La sección ya existe.',

            'nivel2.required_with' => 'El campo nivel es requerido.',
            'grado2.required_with' => 'El campo grado es requerido.',
            'seccion2.required_with' => 'El campo sección es requerido.',
            'grado2.unique' => 'El grado ya existe.',
            'seccion2.unique' => 'La sección ya existe.',


            'nivel3.required_with' => 'El campo nivel es requerido.',
            'grado3.required_with' => 'El campo grado es requerido.',
            'seccion3.required_with' => 'El campo sección es requerido.',
            'nivel3.unique' => 'El nivel ya existe.',
            'grado3.unique' => 'El grado ya existe.',
            'seccion3.unique' => 'La sección ya existe.',

        ]);

        
        if ($request->filled('nivel1') || $request->filled('grado1') || $request->filled('seccion1')) {

            DB::table('seccions')->insert([
                'grado_id_grado' => $request->grado1,
                'nombre_seccion' => $request->seccion1,
            ]);
        } elseif ($request->filled('nivel2') || $request->filled('grado2') || $request->filled('seccion2')) {

                $nivelito = $request->nivel2;
                $grado = new Grado();
                $grado->nombre_grado = $request->grado2;
                $grado->id_nivel = $nivelito;
                $grado->save();
                $seccion = new Seccion();
                $seccion->grado_id_grado = $grado->id_grado;
                $seccion->nombre_seccion = $request->seccion2;
                $seccion->save();
            
        } elseif ($request->filled('nivel3') || $request->filled('grado3') || $request->filled('seccion3')) {
            
                $nivelito = new Nivel();
                $nivelito->nombre_nivel = $request->nivel3;
                $nivelito->save();
                $grado = new Grado();
                $grado->nombre_grado = $request->grado3;
                $grado->id_nivel = $nivelito->id_nivel;
                $grado->save();
                $seccion = new Seccion();
                $seccion->grado_id_grado = $grado->id_grado;
                $seccion->nombre_seccion = $request->seccion3;
                $seccion->save();

        }

    else {
        
        return redirect()->back()->withErrors(['error' => 'No se ha registrado ninguna sección.'])->withInput();
    }

        return redirect()->route('Seccion.index')->with('datos', 'Registro Guardado..!');
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
    public function edit($id_seccion)
    {
        $seccion = Seccion::findOrFail($id_seccion);
        return view('Seccion.edit', compact('seccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_seccion)
    {
        
    }


    /**
     * Remove the specified resource from storage.
     */

    public function confirmar($id_seccion)
    {
        $seccion = Seccion::findOrFail($id_seccion);
        return view('Seccion.confirmar', compact('seccion'));
    }

    public function destroy($id_seccion)
    {
        $seccion = Seccion::findOrFail($id_seccion);
        $alumnos = Alumno::where('seccion_id_seccion', $id_seccion)->get();
        if ($alumnos->isNotEmpty()) {
            return redirect()->route('Seccion.index')->with('danger', 'No se puede eliminar la sección porque tiene alumnos registrados.');
        }
        else {
            $seccion->delete();
            return redirect()->route('Seccion.index')->with('datos', 'Registro Eliminado..');
        }
    }
}
