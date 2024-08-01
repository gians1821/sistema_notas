@extends('layout.plantilla')
@section('contenido')
<div class="container">
  <h1>Registrar Venta</h1>
  <div class="alert hidden" role="alert"></div>
  <form method="POST" action="{{ route('ventas.store')}}">
    @csrf
    <div class="row">
      <div class="col-md-1">
        <label for="">Fecha</label>
      </div>
      <div class="col-md-2">
        <div class="form-group">

          <div class="input-group date" data-target-input="nearest">

            <input type="text" id="fecha" name="fecha" class="form-control datetimepicker-input" data-target="#fecha" value="{{ Carbon\Carbon::now()->format('d/m/Y') }}">

            <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">

              <div class="input-group-text"><i class="fa fa-calendar"></i></div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1">
        <label for="">Tipo</label>
      </div>
      <div class="col-md-2">

        <select class="form-control" id="seltipo" name="seltipo" onchange="mostrarTipo()">

          @foreach($tipo as $itemtipo)
          <option value="{{$itemtipo['tipo_id']}}" selected>{{$itemtipo['descripcion']}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-1">
        <label for="">No Doc. :</label>
      </div>
      <div class="col-md-3">

        <input type="text" class="form-control" name="nrodoc" id="nrodoc" value="{{ $parametros->serie.$parametros->numeracion }}">
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">

          <label for="cliente_id">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">Cliente</font>
            </font>
          </label>

          <select class="form-control select2 select2-hiddenaccessible selectpicker" style="width: 100%;" data-select2-id="1" tabindex="-1" ariahidden="true" id="cliente_id" name="cliente_id" data-live-search="true">

            <option value="0" selected>- Seleccione Cliente -
            </option>
            @foreach($cliente as $itemcliente) <option value="{{ $itemcliente->id }}_{{ $itemcliente->ruc_dni }}_{{ $itemcliente->direccion }}">{{ $itemcliente->nombres }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <label for="">RUC/DNI </label>
        <div class="input-group">

          <input type="text" class="form-control" name="ruc" id="ruc" readonly="readonly">

        </div>
      </div>
    </div>
    <div class="row pt-2">
      <div class="col-md-1">
        <label for="">Dirección </label>
      </div>
      <div class="col-md-11">

        <input type="text" class="form-control" name="direccion" id="direccion" readonly="readonly">

      </div>
    </div>
    <div class="row pt-3">
      <div class="col-md-1">
        <label for="">Producto </label>
      </div>
      <div class="col-md-6">

        <select class="form-control select2 select2-hidden-accessible selectpicker" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="idproducto" name="idproducto" data-live-search="true">
          <option value="0" selected>- Seleccione Producto -
          </option>
          @foreach($producto as $itemproducto)
          <option value="{{ $itemproducto->id }}">{{ $itemproducto->descripcion }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-1" style="text-align:right;">
        <label for="">Unidad :</label>
      </div>
      <div class="col-md-3">

        <input type="text" class="form-control" name="unidad" id="unidad" readonly="readonly">

      </div>
    </div>
    <div class="row pt-3">
      <div class="col-md-1">
        <label for="">Precio </label>
      </div>
      <div class="col-md-2">

        <input type="text" class="form-control" name="precio" id="precio" readonly="readonly">

      </div>
      <div class="col-md-1">
        <label for="">Cantidad </label>
      </div>
      <div class="col-md-2">
        <input type="number" step=".1" min="0.1" value="1" class="form-control" name="cantidad" id="cantidad">
      </div>
      <div class="col-md-3">
        <button type="button" id="btnadddet" class="btn btn-success"><i class="fas fa-shopping-cart"></i>

          Agregar al carrito</button>
      </div>
      <div class="col-md-2">

        <input hidden type="number" class="form-control" name="stock" id="stock">

      </div>
    </div>
    <div class="col-md-12 pt-3">
      <div class="table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" style='background-color:#FFFFFF;'>

          <thead class="thead-default" style="background-color:#3c8dbc;color: #fff;">

            <th width="10" class="text-center">OPCIONES</th>
            <th class="text-center">CODIGO</th>
            <th>DESCRIPCIÓN</th>
            <th>UNIDAD</th>
            <th class="text-center">CANTIDAD</th>
            <th class="text-center">P.VENTA</th>
            <th>IMPORTE</th>
          </thead>
          <tfoot>
          </tfoot>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
      </div>
      <div class="col-md-2">
        <label for="">Total : </label>
      </div>
      <div class="col-md-2">

        <input type="text" class="form-control text-right" name="total" id="total" readonly="readonly">

      </div>
    </div>
    <div class="col-md-12 text-center">
      <div id="guardar">
        <div class="form-group">

          <button class="btn btn-primary" id="btnRegistrar" data-loading-text="<i class='fa a-spinner fa-spin'></i> Registrando">

            <i class='fas fa-save'></i> Registrar</button>

          <a href="{{URL::to('venta')}}" class='btn btn-danger'><i class='fas fa-ban'></i> Cancelar</a>

        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@section('js')
<link rel="stylesheet" href="/select2/bootstrap-select.min.css">
<script src="/select2/bootstrap-select.min.js"></script>
<script src="/adminlte/plugins/moment/moment.min.js"></script>
<script src="/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>

<script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="{{ asset('js/createdoc.js') }}?v=1"></script>
<script type="text/javascript">
  $('#fecha').datetimepicker({
    format: 'DD/MM/YYYY',
  });
</script>
@endsection