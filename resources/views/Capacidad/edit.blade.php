@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Edición de Capacidad -->
    <h1 class="h3 mb-3"><strong>Editar</strong> Capacidad</h1>
    <form method="POST" action="{{ route('Capacidad.update', $capacidad->id_competencia) }}">
        @method('put')
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="">Id Capacidad</label>
                <input type="text" class="form-control" id="id_competencia" name="id_competencia"
                    value="{{ $capacidad->id_competencia }}" disabled>
            </div>
            <label for="nivel">Nivel</label>
            <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel">
                <option value="Nivel" selected disabled>Seleccione Nivel</option>
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
                <option value="Grado" selected disabled>Seleccione Grado</option>
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
                <option value="Curso" selected disabled>Seleccione Curso</option>
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
                id="nombre_competencia" name="nombre_competencia" value="{{ $capacidad->nombre_competencia }}">
            @error('nombre_competencia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
        <a href="{{ route('CancelarCapacidad') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Cargar niveles al iniciar la página y seleccionar el nivel actual
            $.ajax({
                url: '/niveles', // URL para obtener los niveles
                type: 'GET',
                success: function(niveles) {
                    $.each(niveles, function(key, nivel) {
                        $('#nivel').append('<option value="' + nivel.id_nivel + '">' + nivel
                            .nombre_nivel + '</option>');
                    });

                    // Seleccionar el nivel actual
                    $('#nivel').val('{{ $capacidad->curso->grado->nivel->id_nivel }}').change();
                },
                error: function() {
                    alert('Ocurrió un error al cargar los niveles.');
                }
            });

            // Cargar grados cuando se selecciona un nivel
            $('#nivel').change(function() {
                var nivel = $(this).val(); // Obtener el valor del select nivel

                $('#grado').empty().append('<option value="">Seleccione Grado</option>');

                if (nivel) {
                    $.ajax({
                        url: '/grados/' + nivel,
                        type: 'GET',
                        success: function(grados) {
                            $.each(grados, function(key, grado) {
                                $('#grado').append('<option value="' + grado.id_grado +
                                    '">' + grado.nombre_grado + '</option>');
                            });

                            // Seleccionar el grado actual
                            $('#grado').val('{{ $capacidad->curso->grado->id_grado }}')
                        .change();
                        },
                        error: function() {
                            alert('Ocurrió un error al cargar los grados.');
                        }
                    });
                }
            });

            // Cargar cursos cuando se selecciona un grado
            $('#grado').change(function() {
                var gradoId = $(this).val(); // Obtener el valor del select grado

                $('#curso').empty().append('<option value="">Seleccione Curso</option>');

                if (gradoId) {
                    $.ajax({
                        url: '/grado/' + gradoId + '/cursos',
                        type: 'GET',
                        success: function(cursos) {
                            $.each(cursos, function(key, curso) {
                                $('#curso').append('<option value="' + curso.id_curso +
                                    '">' + curso.nombre_curso + '</option>');
                            });

                            // Seleccionar el curso actual
                            $('#curso').val('{{ $capacidad->curso->id_curso }}');
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
