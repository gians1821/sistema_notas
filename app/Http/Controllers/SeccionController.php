<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Nivel;

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
        return view('Seccion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos del formulario
        $data = $request->validate([
            'nivel' => 'required|String|max:15',
            'grado' => 'required|String|max:15',
            'secciones' => 'required|string|max:15',
        ], [
            'nivel.required' => 'Seleccione el nivel.',
            'nivel.max' => 'El nivel no debe exceder los 15 caracteres.',

            'grado.required' => 'Seleccione el grado.',
            'grado.max' => 'El grado no debe exceder los 15 caracteres.',

            'secciones.required' => 'Seleccione la sección.',
            'secciones.max' => 'La sección no debe exceder los 15 caracteres.',

        ]);

        // Obtener el valor de sección desde el formulario y asignarlo
        $nivel = $request->nivel;
        $grado = $request->grado;
        // Variable para almacenar el valor de id_seccion
        $id_grado = 0;
        // Lógica para asignar el valor de id_grado basado en nivel
        switch ($nivel) {
            case 'Primaria':
                switch ($grado) {
                    case 'Primero':
                        $id_grado = 1;
                        break;
                    case 'Segundo':
                        $id_grado = 2;
                        break;
                    case 'Tercero':
                        $id_grado = 3;
                        break;
                    case 'Cuarto':
                        $id_grado = 4;
                        break;
                    case 'Quinto':
                        $id_grado = 5;
                        break;
                    case 'Sexto':
                        $id_grado = 6;
                        break;
                }
                break;
            case 'Secundaria':
                switch ($grado) {
                    case 'Primero':
                        $id_grado = 7;
                        break;
                    case 'Segundo':
                        $id_grado = 8;
                        break;
                    case 'Tercero':
                        $id_grado = 9;
                        break;
                    case 'Cuarto':
                        $id_grado = 10;
                        break;
                    case 'Quinto':
                        $id_grado = 11;
                        break;
                }
                break;
        }

        // Verificar si ya existe una sección con el mismo nivel y grado
        $existeSection = Seccion::where('grado_id_grado', $id_grado)->where('nombre_seccion', $data['secciones'])->first();
        if ($existeSection) {
            return redirect()->route('Seccion.index')->with('datos', 'Ya existe una sección con el mismo nivel y grado.');
        }


        $seccion = new Seccion();
        $seccion->nombre_seccion = $data['secciones'];
        $seccion->capacidad = 30;
        // Asignar el valor de id_seccion al modelo Seccion
        $seccion->grado_id_grado = $id_grado;
        $seccion->save();
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
        /** 
        // Obtener el valor de sección desde el formulario y asignarlo
        $nivel = $request->nivel;
        $grado = $request->grado;
        // Variable para almacenar el valor de id_seccion
        $id_grado = 0;
        // Lógica para asignar el valor de id_grado basado en nivel
        switch ($nivel) {
            case 'Primaria':
                switch ($grado) {
                    case 'Primero':
                        $id_grado = 1;
                        break;
                    case 'Segundo':
                        $id_grado = 2;  
                        break;
                    case 'Tercero':
                        $id_grado = 3; 
                        break;
                    case 'Cuarto':
                        $id_grado = 4; 
                        break; 
                    case 'Quinto':
                        $id_grado = 5;
                        break; 
                    case 'Sexto':
                        $id_grado = 6;
                        break;     
                }
                break;            
            case 'Secundaria':
                switch ($grado) {
                    case 'Primero':
                        $id_grado = 7;
                        break;
                    case 'Segundo':
                        $id_grado = 8; 
                        break; 
                    case 'Tercero':
                        $id_grado = 9; 
                        break;
                    case 'Cuarto':
                        $id_grado = 10;
                        break;  
                    case 'Quinto':
                        $id_grado = 11;
                        break;
                }
                break;
        }

        // Verificar si ya existe una sección con el mismo nivel y grado
        $existeSection = Seccion::where('grado_id_grado', $id_grado)->where('nombre_seccion', $data['secciones'])->first();
        if ($existeSection) {
            return redirect()->route('Seccion.index')->with('datos', 'Ya existe una sección con el mismo nivel y grado.');
        }

        $seccion = Seccion::findOrFail($id_seccion);
        $seccion = new Seccion();
        $seccion->nombre_seccion = $data['secciones'];
        $seccion->capacidad = 30;
        // Asignar el valor de id_seccion al modelo Seccion
        $seccion->grado_id_grado = $id_grado;
        $seccion->save();
        return redirect()->route('Seccion.index')->with('datos', 'Registro Guardado..!');
         */
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
        $seccion->delete();
        return redirect()->route('Seccion.index')->with('datos', 'Registro Eliminado..');
    }
}
