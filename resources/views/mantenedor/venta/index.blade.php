@extends('layout.plantilla')
@section('contenido')
<div class="container">
  <h3> LISTADO DE VENTAS </h3>
  <br>

  <a href="{{route('ventas.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>

  <nav class="navbar navbar-light float-right">
    <form class="form-inline my-2 my-lg-0" method="GET">

      <input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="Busqueda por descripcion" aria-label="Search" value="">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>

    </form>
  </nav>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Código</th>
        <th scope="col">Descripción</th>
        <th scope="col">Fecha</th>
        <th scope="col">RUC/DNI</th>
        <th scope="col">Nombres/Razon</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($venta as $itemventa)
      <tr>
        <td>{{$itemventa->venta_id}}</td>
        <td>{{$itemventa->tipo->descripcion}}</td>
        <td>{{$itemventa->fecha_venta}}</td>
        <td>{{$itemventa->clientes->ruc_dni}}</td>
        <td>{{$itemventa->clientes->nombres}}</td>
        <td>{{$itemventa->total}}</td>
        <td>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $venta->links()}}
</div>
@endsection