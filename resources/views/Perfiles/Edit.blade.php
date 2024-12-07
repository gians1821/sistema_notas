@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Editar</strong> Rol</h1>
    <br>
    <form method="POST" action="{{ route('admin.perfil.update', $rol->id) }}">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">

                <!-- Nombre del Rol -->
                @include('components.text_input', [
                    'label' => 'Nombre del Rol',
                    'name' => 'name',
                    'value' => $rol->name
                ])

                <!-- Descripción del Rol -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label"><strong> Descripción del Rol </strong></label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="3">{{ $rol->descripcion }}</textarea>
                </div>

                <!-- Permisos -->
                <label for="descripcion" class="form-label"><strong> Seleccione los Permisos </strong></label>
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                    @if($rol->permissions->contains($permission)) checked @endif>
                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label><br>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-save"></i> Actualizar </button>
                <a href="{{ route('CancelarPerfil') }}" class="btn btn-danger mt-4"><i class="fas fa-ban"></i> Cancelar</a>
            </div>
        </div>
    </form>
@endsection

