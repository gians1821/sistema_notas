<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Producto;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    const PAGINATION = 10; // DE 10 EN 10
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscarPor = $request->get('buscarpor');
        $libro = Libro::where('TitLibro', 'like', '%' . $buscarPor . '%')->paginate($this::PAGINATION);
        return view('mantenedor.libro.index', compact('libro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mantenedor.libro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'descripcion' => 'required|max:30'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
        $categoria = new Producto();
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = '1';
        $categoria->save();
        return redirect()->route('mantenedor.libro.index')->with('datos', 'Registro Nuevo Guardado...!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('mantenedor.libro.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'descripcion' => 'required|max:30'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
        $categoria = Producto::findOrFail($id);
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        return redirect()->route('categoria.index')->with('datos', 'Registro Actualizado...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Producto::findOrFail($id);
        $categoria->estado = '0';
        $categoria->save();
        return redirect()->route('categoria.index')->with('datos', 'Registro Eliminado...!');
    }

    public function confirmar($id)
    {
        $categoria = Producto::findOrFail($id);
        return view('mantenedor.libro.confirmar', compact('categoria'));
    }
}
