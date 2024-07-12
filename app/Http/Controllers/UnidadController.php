<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidad;

class UnidadController extends Controller
{
    const PAGINATION = 10; // DE 10 EN 10
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $buscarPor = $request->get('buscarpor');
        $unidad = Unidad::where('estado', '=', '1')->where('descripcion', 'like', '%' . $buscarPor . '%')->paginate($this::PAGINATION);
        return view('mantenedor.unidad.index', compact('unidad'));
    }

    public function create()
    {
        return view('mantenedor.unidad.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'descripcion' => 'required|max:30'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de unidad',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
        $unidad = new Unidad();
        $unidad->descripcion = $data['descripcion'];
        $unidad->estado = '1';
        $unidad->save();
        return redirect()->route('unidades.index')->with('datos', 'Registro Nuevo Guardado...!');
    }

    public function edit($id)
    {
        $unidad = Unidad::findOrFail($id);
        return view('mantenedor.unidad.edit', compact('unidad'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'descripcion' => 'required|max:30',
            ],
            [
                'descripcion.required' => 'Ingrese descripción de unidad',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
        $unidad = Unidad::findOrFail($id);
        $unidad->descripcion = $data['descripcion'];
        $unidad->save();
        return redirect()->route('unidades.index')->with('datos', 'Registro Actualizado...!');
    }

    public function confirmar($id)
    {
        $unidad = Unidad::findOrFail($id);
        return view('mantenedor.unidad.confirmar', compact('unidad'));
    }

    public function destroy($id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->estado = '0';
        $unidad->save();
        return redirect()->route('unidades.index')->with('datos', 'Registro Eliminado...!');
    }

    public function cancelar()
    {
        return redirect()->route('unidades.index')
            ->with('datos', 'Acción Cancelada ..!');
    }
}
