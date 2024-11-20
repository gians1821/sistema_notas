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

    public function index(Request $request)
    {
        $buscarporSeccion = $request->get('buscarporSeccion');
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

        $seccion = Seccion::where('id_seccion', '>', '0')
            ->where(function ($query) use ($buscarporSeccion, $id_grado, $id_nivel) {
                //FILTRAR POR NOMBRE
                if ($buscarporSeccion) {
                    $query->where('nombre_seccion', 'like', '%' . $buscarporSeccion . '%');
                }
                //FILTAR SOLO POR GRADO-COMO SELECT GRADO YA TIENE OPCIONES 
                if (!empty($id_grado)) {
                    $query->whereIn('grado_id_grado', $id_grado);
                }
                //FILTRAR POR GRADO Y NIVEL
                if (!empty($id_nivel)) {
                    $query->whereHas('grado', function ($q) use ($id_nivel) {
                        $q->where('id_nivel', $id_nivel);
                    });
                }
            })
            ->paginate($this::PAGINATION);
        $seccion->appends(['buscarporSeccion' => $buscarporSeccion, 'buscarporGrado' => $buscarporGrado, 'buscarporNivel' => $buscarporNivel]);

        return view('Seccion.Seccion', compact('seccion', 'buscarporSeccion', 'buscarporGrado', 'buscarporNivel'));
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
