@extends('layout.plantilla')

@section('contenido')
<div class="container">
    <h1>Crear Registro</h1>
    <hr>
    <form method="POST" action="{{ route('productos.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="descripcion">Descripción</label>
                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" maxlength="30" value="{{ old('descripcion') }}">
                @error('descripcion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="categoria_id">Categorías</label>
                <select class="form-control" id="categoria_id" name="categoria_id">
                    @foreach($categorias as $itemcategoria)
                    <option value="{{ $itemcategoria['idcategoria'] }}">{{ $itemcategoria['descripcion'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="unidad_id">Unidades</label>
                <select class="form-control" id="unidad_id" name="unidad_id">
                    @foreach($unidades as $itemunidad)
                    <option value="{{ $itemunidad['id'] }}">{{ $itemunidad['descripcion'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}">
                @error('precio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="stock">Stock</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}">
                @error('stock')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection