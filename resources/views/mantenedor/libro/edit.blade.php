@extends('layout.plantilla')
@section('contenido')
<div class="container">
    <h1>Editar Registro</h1>
    <form method="POST" action="{{ route('categoria.update', $categoria -> idcategoria)}}">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="">Código</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ $categoria->idcategoria }}" disabled>
        </div>
        <div class="form-group">
            <label for="">Descripción</label>
            <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" value="{{ $categoria->descripcion }}">
            @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
        <a href="{{ route('cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
</div>
@endsection