<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Unidad;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    const PAGINATION = 4;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productos = Producto::where('estado', '=', '1')->paginate($this::PAGINATION);
        return view('mantenedor.producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = Categoria::where('estado', '=', '1')->get();
        $unidad = Unidad::where('estado', '=', '1')->get();
        return view('mantenedor.producto.create', compact('categoria', 'unidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
        $data = request()->validate([
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
        ]);
        $producto = new Producto();
        $producto -> descripcion = $request -> descripcion;
        $producto -> categoria_id = $request -> categoria_id;
        
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
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
