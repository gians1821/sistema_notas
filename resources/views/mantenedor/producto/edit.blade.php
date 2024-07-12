@extends('layout.plantilla')
@section('contenido')
<div class="container">
    <h1>Editar Registro</h1>
    <form method="POST" action="{{ route('productos.update', $producto -> id)}}">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="">Código</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ $producto->id }}" disabled>
        </div>
        <!-- DESCRIPCIÓN -->
        <div class="form-group">
            <label for="">Descripción</label>
            <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" value="{{ $producto->descripcion }}">
            @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
        <!-- CATEGORÍAS -->
        <div class="form-group">
            <label for="">Categorías</label>
            <select class="form-control" name="categoria_id" id="categoria_id">
                @foreach($categoria as $itemcategoria)
                <option value="{{ $itemcategoria->idcategoria }}" {{ $itemcategoria -> idcategoria == $producto -> categoria_id ? 'selected' : '' }}>{{ $itemcategoria->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <!-- UNIDAD -->
        <div class="form-group">
            <label for="">Unidad</label>
            <select class="form-control" name="unidad_id" id="unidad_id">
                @foreach($unidad as $itemunidad)
                <option value="{{ $itemunidad->id }}" {{ $itemunidad -> id == $producto -> unidad_id ? 'selected' : '' }}>{{ $itemunidad->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <!-- PRECIO -->
        <div class="form-group">
            <label for="">Precio</label>
            <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ $producto->precio }}">
            @error('precio')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <!-- STOCK -->
        <div class="form-group">
            <label for="">Stock</label>
            <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ $producto->stock }}">
            @error('stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
            Grabar
        </button>
        <a href="{{ route('productos.cancelar')}}" class="btn btn-danger">
            <i class="fas fa-ban"></i>
            Cancelar
        </a>
    </form>
</div>
@endsection