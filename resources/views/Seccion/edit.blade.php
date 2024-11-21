@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3"><strong>Editar </strong>Grados y Secciones</h1>
    <form method="POST" action="{{ route('Seccion.update', $seccion->id_seccion) }}">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="nombre_seccion">Id Seccion</label>
            <input type="text" class="form-control" id="id_seccion" name="id_seccion" value="{{ $seccion->id_seccion }}"
                disabled>
        </div>
        <div class="form-group">
            <label for="nivel">Nivel</label>
            <select class="form-control" id="nivel" name="nivel">
                <option value="" selected disabled>Seleccione Nivel</option>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
            </select>
        </div>
        <div class="form-group">
            <label for="grado">Grado</label>
            <select class="form-control" id="grado" name="grado">
                <option value="" selected disabled>Seleccione Grado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="secciones">Sección</label>
            <select class="form-control" id="secciones" name="secciones">
                <option value="" selected disabled>Seleccione Sección</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
        <a href="{{ route('Cancelar') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
@endsection
@section('script')
    <script>
        document.getElementById('nivel').addEventListener('change', function() {
            var nivel = this.value;
            var gradoSelect = document.getElementById('grado');
            gradoSelect.innerHTML = '';

            if (nivel === 'Primaria') {
                var options = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto'];
            } else if (nivel === 'Secundaria') {
                var options = ['Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto'];
            }

            options.forEach(function(option) {
                var opt = document.createElement('option');
                opt.value = option;
                opt.innerHTML = option;
                gradoSelect.appendChild(opt);
            });
        });
    </script>
@endsection
