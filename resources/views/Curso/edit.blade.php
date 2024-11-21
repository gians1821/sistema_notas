@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- CONTENIDO DE LA PAGINA -->
    <h1 class="h3 mb-3"><strong>Editar </strong>Curso</h1>
    <form method="POST" action="{{ route('Curso.update', $curso->id_curso) }}">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="">Id Curso</label>
            <input type="text" class="form-control" id="id_curso" name="id_curso" value="{{ $curso->id_curso }}" disabled>
        </div>
        <div class="form-group">
            <label for="nivel">Nivel</label>
            <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel"
                value="{{ $curso->id_curso }}">
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
        <div class="form-group">
            <label for="nombre_curso">Nombre del Curso</label>
            <input type="text" class="form-control @error('nombre_curso') is-invalid @enderror " id="nombre_curso"
                name="nombre_curso" value="{{ $curso->nombre_curso }}">
            @error('nombre_curso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
        <a href="{{ route('CancelarCurso') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
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
