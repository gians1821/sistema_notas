@extends('layout.plantilla')
@section('contenido')
<div class="container">
    <h1>Registro Nuevo</h1>
    <form method="POST" action="{{  route('unidades.store') }}">
        @csrf
        <div class="form-group">
            <label for="">Descripción</label>
            <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">
            @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                Mg. Ing. Robert Jerry Sanchez Ticona
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Grabar
        </button>
        <a href="{{ route('unidades.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
</div>
@endsection