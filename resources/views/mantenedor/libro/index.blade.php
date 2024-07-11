@extends('layout.plantilla')
@section('contenido')
<h3> LISTADO DE LIBROS </h3>
<a href="{{ route('productos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Registro</a>

<div class="container">
  <nav class="navbar navbar-light float-right">
    <form class="form-inline my-2 my-lg-0" method="GET">
      <input name="buscarnp" class="form-control mr-sm-2" type="search" placeholder="Busqueda por descripción" aria-label="Search" value="{{ request('buscarnp') }}">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </nav>
  @if (session('datos'))
  <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
    {{ session('datos') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Código</th>
        <th scope="col">Descripción</th>
        <th scope="col">Categoría</th>
        <th scope="col">Unidad</th>
        <th scope="col">Precio</th>
        <th scope="col">Stock</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productos as $itemproducto)
      <tr>
        <td>{{ $itemproducto->id }}</td>
        <td>{{ $itemproducto->descripcion }}</td>
        <td>{{ $itemproducto->categoria->descripcion }}</td>
        <td>{{ $itemproducto->unidad->descripcion }}</td>
        <td>{{ $itemproducto->precio }}</td>
        <td>{{ $itemproducto->stock }}</td>
        <td>
          <a href="{{ route('productos.edit', $itemproducto->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
          <a href="{{ route('productos.confirmar', $itemproducto->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $productos->links() }}
</div>
@endsection