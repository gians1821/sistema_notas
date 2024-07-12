@extends('layout.plantilla')
@section('contenido')
<div class="container">
    <h1>Desea eliminar registro ? Codigo : {{ $producto->id }} - Descripcion : {{ $producto->descripcion }} </h1>
    <form method="POST" action="{{ route('productos.destroy',$producto->id)}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
        <a href="{{ route('cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i> NO</button></a>
    </form>
</div>
@endsection