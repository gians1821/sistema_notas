<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
   const PAGINATION = 10; // DE 10 EN 10
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function index(Request $request)
   {
      $buscarPor = $request->get('buscarpor');
      $categoria = Categoria::where('estado', '=', '1')->where('descripcion', 'like', '%' . $buscarPor . '%')->paginate($this::PAGINATION);
      return view('mantenedor.categoria.index', compact('categoria'));
   }

   public function create()
   {
      return view('mantenedor.categoria.create');
   }

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
      $categoria = new Categoria();
      $categoria->descripcion = $request->descripcion;
      $categoria->estado = '1';
      $categoria->save();
      return redirect()->route('mantenedor.categoria.index')->with('datos', 'Registro Nuevo Guardado...!');
   }

   public function edit($id)
   {
      $categoria = Categoria::findOrFail($id);
      return view('mantenedor.categoria.edit', compact('categoria'));
   }

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
      $categoria = Categoria::findOrFail($id);
      $categoria->descripcion = $request->descripcion;
      $categoria->save();
      return redirect()->route('categoria.index')->with('datos', 'Registro Actualizado...!');
   }
   public function confirmar($id)
   {
      $categoria = Categoria::findOrFail($id);
      return view('mantenedor.categoria.confirmar', compact('categoria'));
   }
   public function destroy($id)
   {
      $categoria = Categoria::findOrFail($id);
      $categoria->estado = '0';
      $categoria->save();
      return redirect()->route('categoria.index')->with('datos', 'Registro Eliminado...!');
   }
}
