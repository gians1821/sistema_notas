@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection('BarraNavegacion')
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3"><strong>Crear </strong>Grados y Secciones</h1>
    <form method="POST" action="{{ route('Seccion.store') }}">
        @csrf
        <div class="form-group">
            <label for="nivel">Nivel</label>
            <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel">
                @error('nivel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="" selected disabled>Seleccione Nivel</option>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
            </select>
        </div>
        <div class="form-group">
            <label for="grado">Grado</label>
            <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado">
                @error('grado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="" selected disabled>Seleccione Grado</option>
            </select>
        </div>

        <!--SECCION-->
        <div class="form-group">
            <label for="secciones">Sección</label>
            <select class="form-control @error('secciones') is-invalid @enderror" id="secciones" name="secciones">
                @error('secciones')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="" selected disabled>Seleccione Sección</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>


        <button href="" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
        <a href="{{ route('CancelarSeccion') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
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
