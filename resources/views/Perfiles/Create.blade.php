@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')
    <style>
        .error-message {
            color: darkred; 
            font-size: 0.8em; 
            margin-top: 15px; 
        }
        .alert-success {
            color: green;
            font-size: 1.0em;
            margin-top: 15px;
            align-items: center;
            justify-content: center;
        }
    </style>
    <h1 class="h3 mb-3 titulos"><strong>Crear un</strong> Rol</h1>
    <br>
    <form method="POST" action="{{ route('admin.perfil.store') }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <!-- Nombre del Rol -->
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Nombre del Rol</strong></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre del rol">
                    @if ($errors->has('name'))
                        <span class="error-message text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>

                <!-- Selección de Permisos -->
                <div class="mb-3">
                    <label class="form-label"><strong>Seleccione los Permisos</strong></label>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="select-all">
                        <label class="form-check-label" for="select-all"><strong>Seleccionar Todos</strong></label>
                    </div>
                    <div class="row">
                        @foreach ($permisos as $permiso)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permiso->id }}" id="permiso-{{ $permiso->id }}">
                                    <label class="form-check-label" for="permiso-{{ $permiso->id }}">
                                        {{ $permiso->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($errors->has('permissions'))
                        <span class="error-message text-danger"><strong>{{ $errors->first('permissions') }}</strong></span>
                    @endif
                </div>

                <!-- Descripción del rol -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label"><strong>Descripción del Rol</strong></label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Ingrese la descripción del rol"></textarea>
                    @if ($errors->has('descripcion'))
                        <span class="error-message text-danger"><strong>{{ $errors->first('descripcion') }}</strong></span>
                    @endif
                </div>

                <!-- Botones -->
                <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-save"></i> Registrar</button>
                <a href="{{ route('CancelarPerfil') }}" class="btn btn-danger mt-4"><i class="fas fa-ban"></i> Cancelar</a>
            </div>
        </div>
    </form>
@endsection

@section('script')
<script>
    document.getElementById('select-all').addEventListener('change', function(e) {
        let checkboxes = document.querySelectorAll('input[type="checkbox"][name="permissions[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });
</script>
@endsection
