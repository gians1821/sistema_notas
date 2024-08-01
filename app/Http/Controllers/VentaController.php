<?php

namespace App\Http\Controllers;

use App\Models\Cabeceraventa;
use App\Models\Cliente;
use App\Models\Detalleventa;
use App\Models\Parametro;
use App\Models\Producto;
use App\Models\Tipo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{

    const PAGINATION = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $venta = Cabeceraventa::where('estado', '=', '1')->paginate($this::PAGINATION);
        return view('mantenedor.venta.index', compact('venta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = DB::table('clientes')->get();
        $producto = DB::table('productos')->get();
        $tipo = Tipo::all();
        $tipou = Tipo::select('tipo_id', 'descripcion')->orderBy('tipo_id', 'DESC')->get();
        $parametros = Parametro::findOrFail($tipou[0]->tipo_id);
        return view('mantenedor.venta.create', compact('tipo', 'parametros', 'cliente', 'producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            DB::beginTransaction();
            /* Grabar Cabecera */
            /* Obtiene codigo cliente a partir del dni */
            $cliente = Cliente::where('ruc_dni', '=', $request->ruc)->get();
            $cliente_id = $cliente[0]->cliente_id;
            $venta = new CabeceraVenta();
            $venta->cliente_id = $cliente_id;
            $venta->nrodoc = $request->get('nrodoc');
            $venta->tipo_id = $request->seltipo;
            $arr = explode('/', $request->fecha);
            $nFecha = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
            $venta->fecha_venta = $nFecha;
            if ($request->seltipo = '2') {
                $venta->total = $request->total;
                $venta->subtotal = '0';
                $venta->igv = '0';
            } else {
                $venta->total = $request->total;
                $venta->subtotal = $request->total - ($request->total * 0.18);
                $venta->igv = $request->total * 0.18;
            }
            $venta->estado = '1';
            $venta->save();
            /* Grabar Detalle */
            //$detalleventa=$request->get('detalles');
            $idproducto = $request->get('cod_producto');
            $cantidad = $request->get('cantidad');
            $pventa = $request->get('pventa');
            $cont = 0;
            while ($cont < count($idproducto)) {
                $detalle = new Detalleventa();
                $detalle->venta_id = $venta->venta_id;
                $detalle->idproducto = $idproducto[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio = $pventa[$cont];
                $detalle->save();
                /* Actualizar stock */
                Producto::ActualizarStock($detalle->idproducto, $detalle->cantidad);
                $cont = $cont + 1;
            }
            /* Actualizar el numero de documento en la tabla parametro */
            $numeracion = '';
            $numeracion = $this->dar_formato($request->numeracion + 1);
            Parametro::ActualizarNumero($venta->tipo_id, $numeracion);
            DB::commit();
            return redirect()->route('ventas.index');
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
