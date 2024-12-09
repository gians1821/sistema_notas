@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Registro de Alumnos -->
    <h1 class="h3 mb-3"><strong>Registro</strong> Capacidad</h1>
    <form method="POST" action="{{ route('Capacidad.store') }}">
        @csrf
        <div class="form-group">
            <label for="nivel">Nivel</label>
            <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel">
                <option value="" disabled {{ old('nivel') ? '' : 'selected' }}>Seleccione Nivel</option>
            </select>
            @error('nivel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="grado">Grado</label>
            <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado">
                <option value="" disabled {{ old('grado') ? '' : 'selected' }}>Seleccione Grado</option>
            </select>
            @error('grado')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="curso">Curso</label>
            <select class="form-control @error('curso') is-invalid @enderror" id="curso" name="curso">
                <option value="" disabled {{ old('curso') ? '' : 'selected' }}>Seleccione Curso</option>
            </select>
            @error('curso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="nombre_competencia">Nombre de la Capacidad</label>
            <input type="text" class="form-control @error('nombre_competencia') is-invalid @enderror"
                id="nombre_competencia" name="nombre_competencia" value="{{ old('nombre_competencia') }}">
            @error('nombre_competencia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
        <a href="{{ route('CancelarCapacidad') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Cargar niveles al iniciar la página
            $.ajax({
                url: '/api/niveles',
                type: 'GET',
                success: function(niveles) {
                    $.each(niveles, function(key, nivel) {
                        $('#nivel').append('<option value="' + nivel.id_nivel + '"' +
                            (nivel.id_nivel == {{ old('nivel', 'null') }} ? ' selected' :
                                '') + '>' +
                            nivel.nombre_nivel + '</option>');
                    });

                    // Disparar el evento change para cargar grados si hay un nivel seleccionado
                    if ("{{ old('nivel') }}") {
                        $('#nivel').trigger('change');
                    }
                },
                error: function() {
                    alert('Ocurrió un error al cargar los niveles.');
                }
            });

            // Cargar grados cuando se selecciona un nivel
            $('#nivel').change(function() {
                var nivel = $(this).val();

                $('#grado').empty().append('<option value="">Seleccione Grado</option>');

                if (nivel) {
                    $.ajax({
                        url: '/api/grados/' + nivel,
                        type: 'GET',
                        success: function(grados) {
                            $.each(grados, function(key, grado) {
                                $('#grado').append('<option value="' + grado.id_grado +
                                    '"' +
                                    (grado.id_grado == {{ old('grado', 'null') }} ?
                                        ' selected' : '') + '>' +
                                    grado.nombre_grado + '</option>');
                            });

                            // Disparar el evento change para cargar cursos si hay un grado seleccionado
                            if ("{{ old('grado') }}") {
                                $('#grado').trigger('change');
                            }
                        },
                        error: function() {
                            alert('Ocurrió un error al cargar los grados.');
                        }
                    });
                }
            });

            // Cargar cursos cuando se selecciona un grado
            $('#grado').change(function() {
                var gradoId = $(this).val();

                $('#curso').empty().append('<option value="">Seleccione Curso</option>');

                if (gradoId) {
                    $.ajax({
                        url: '/api/grado/' + gradoId + '/cursos',
                        type: 'GET',
                        success: function(cursos) {
                            $.each(cursos, function(key, curso) {
                                $('#curso').append('<option value="' + curso.id_curso +
                                    '"' +
                                    (curso.id_curso == {{ old('curso', 'null') }} ?
                                        ' selected' : '') + '>' +
                                    curso.nombre_curso + '</option>');
                            });
                        },
                        error: function() {
                            alert('Ocurrió un error al cargar los cursos.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
