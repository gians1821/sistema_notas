<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Unidad;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    const PAGINATION = 4;

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
        $productos = Producto::where('estado', '=', '1')
            ->where('descripcion', 'like', '%' . $buscarPor . '%')
            ->paginate($this::PAGINATION);
        return view('mantenedor.producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::where('estado', '=', '1')->get();
        $unidades = Unidad::where('estado', '=', '1')->get();
        return view('mantenedor.producto.create', compact('categorias', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate(
            [
                'descripcion' => 'required|max:30',
                'precio' => 'required|min:0',
                'stock' => 'required|min:0',
            ],
            [
                'descripcion.required' => 'Ingrese descripcion de producto',
                'descripcion.max' => 'Maximo 30 caracteres para la descripcion',
                'precio.required' => 'Ingrese precio de producto',
                'precio.min' => 'Precio no puede ser negativo',
                'stock.required' => 'Ingrese stock de producto',
                'stock.min' => 'Stock no puede ser negativo',
            ]
        );
        $producto = new Producto();
        $producto->descripcion = $request->descripcion;
        $producto->categoria_id = $request->categoria_id;
        $producto->unidad_id = $request->unidad_id;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->estado = '1';
        $producto->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Nuevo Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categoria = Categoria::where('estado', '=', '1')->get();
        $unidad = Unidad::where('estado', '=', '1')->get();
        return view('mantenedor.producto.edit', compact('producto', 'categoria', 'unidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'descripcion' => 'required|max:30',
                'categoria_id' => 'required',
                'unidad_id' => 'required',
                'precio' => 'required',
                'stock' => 'required',
            ],
            [
                'descripcion.required' => 'Ingrese descripción del producto',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
        $producto = Producto::findOrFail($id);
        $producto->descripcion = $data['descripcion'];
        $producto->categoria_id = $data['categoria_id'];
        $producto->unidad_id = $data['unidad_id'];
        $producto->precio = $data['precio'];
        $producto->stock = $data['stock'];
        $producto->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Actualizado...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->estado = '0';
        $producto->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Eliminado...!');
    }
    public function cancelar()
    {
        return redirect()->route('productos.index')->with('datos', 'Accion cancelada');
    }

    public function confirmar($id)
    {
        $producto = Producto::findOrFail($id);
        return view('mantenedor.producto.confirmar', compact('producto'));
    }
}
