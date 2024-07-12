@extends('layout.plantilla')
@section('contenido')
<div class="container">
    <h1>Desea eliminar registro ? Codigo : {{ $unidad->id }} - Descripcion : {{ $unidad->descripcion }} </h1>
    <form method="POST" action="{{ route('unidades.destroy',$unidad->id)}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger"><i class="fas fa-check-square"></i> SI</button>
        <a href="{{ route('unidades.cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i> NO</button></a>
    </form>
</div>
@endsection