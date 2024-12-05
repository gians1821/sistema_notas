@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3 titulos"><strong>Asignar un</strong> Rol</h1>
    <br>
    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label class="h5">nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="">
                </div>

                <div class="form-group">
                    <label class="h5">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="">
                </div>

                <div class="form-group">
                    <label class="h5">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" value="">
                </div>

                <h2 class="h5 mt-3"> Listado de Roles</h2>
                <select class="form-control w-100 mr-4" id="rol" name="rol">
                    <option value="Nivel" selected disabled>Seleccione Rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-save"></i> Registrar</button>
                <a href="{{ route('CancelarUsuario') }}" class="btn btn-danger mt-4"><i class="fas fa-ban"></i>
                    Cancelar</button></a>

            </div>
        </div>
    </form>
@endsection
