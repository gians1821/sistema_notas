@extends('layout.plantilla')

@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')
    <!-- Gestión de Capacidades -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Capacidades</h1>
    <br>
    <nav class="navbar navbar-light">
        @role('Admin')
            <a class="btn btn-primary" href="{{ route('Capacidad.create') }}">
                <i class="fas fa-plus"></i> Nuevo Registro
            </a>
        @endrole
        <form class="form-inline my-lg-0" method="GET" action="{{ route('Capacidad.index') }}">
            <div class="d-flex align-items-center">
                <!-- Campo de búsqueda por nombre -->
                <input name="buscarporNombre" class="form-control mr-sm-2" type="search" placeholder="CAPACIDAD"
                    aria-label="Search" value="{{ old('buscarporNombre') }}">

                <!-- Select de Nivel -->
                <select class="form-control w-auto mr-4 @error('buscarporNivel') is-invalid @enderror" id="buscarporNivel"
                    name="buscarporNivel">
                    <option value="" disabled {{ old('buscarporNivel') ? '' : 'selected' }}>SELECCIONE NIVEL</option>
                </select>
                @error('buscarporNivel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <!-- Select de Grado -->
                <select class="form-control w-auto mr-4 @error('buscarporGrado') is-invalid @enderror" id="buscarporGrado"
                    name="buscarporGrado" {{ old('buscarporNivel') ? '' : 'disabled' }}>
                    <option value="" disabled {{ old('buscarporGrado') ? '' : 'selected' }}>SELECCIONE GRADO</option>
                </select>
                @error('buscarporGrado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <!-- Select de Curso -->
                <select class="form-control w-auto mr-4 @error('buscarporCurso') is-invalid @enderror" id="buscarporCurso"
                    name="buscarporCurso" {{ old('buscarporGrado') ? '' : 'disabled' }}>
                    <option value="" disabled {{ old('buscarporCurso') ? '' : 'selected' }}>SELECCIONE CURSO</option>
                </select>
                @error('buscarporCurso')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <!-- Botón de búsqueda -->
                <button class="btn btn-success" type="submit">BUSCAR</button>
            </div>
        </form>
    </nav>

    <!-- Mensajes de sesión -->
    <div id="mensaje">
        @if (session('datos'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{ session('datos') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <br>

    <!-- Tabla de Capacidades -->
    @include('components.items_table', [
        'data' => $capacidades, // Los elementos a mostrar en la tabla
        'headers' => ['ID', 'Competencia', 'Curso', 'Grado', 'Nivel', 'Acciones'], // Los títulos de las columnas
        'columns_data' => [
            'id_competencia',
            'nombre_competencia',
            'curso.nombre_curso',
            'curso.grado.nombre_grado',
            'curso.grado.nivel.nombre_nivel',
        ], // Las propiedades de los modelos a mostrar
        'edit_route' => 'Capacidad.edit', // Ruta para editar
        'delete_route' => 'Capacidad.destroy', // Ruta para eliminar
    ])

    <!-- Paginación -->
    {{ $capacidades->links() }}
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Función para cargar niveles
            function cargarNiveles(selectedNivel = null) {
                $.ajax({
                    url: '/api/niveles',
                    type: 'GET',
                    success: function(niveles) {
                        niveles.forEach(function(nivel) {
                            $('#buscarporNivel').append('<option value="' + nivel.id_nivel +
                                '"' +
                                (nivel.id_nivel == "{{ old('buscarporNivel') }}" ?
                                    ' selected' : '') + '>' +
                                nivel.nombre_nivel + '</option>');
                        });

                        // Si hay un nivel seleccionado, cargar grados
                        if ("{{ old('buscarporNivel') }}") {
                            $('#buscarporNivel').trigger('change');
                        }
                    },
                    error: function() {
                        alert('Ocurrió un error al cargar los niveles.');
                    }
                });
            }

            // Función para cargar grados
            function cargarGrados(nivelId, selectedGrado = null) {
                $.ajax({
                    url: '/api/grados/' + nivelId,
                    type: 'GET',
                    success: function(grados) {
                        $('#buscarporGrado').empty().append(
                            '<option value="" disabled {{ old('buscarporGrado') ? '' : 'selected' }}>SELECCIONE GRADO</option>'
                            );
                        $('#buscarporCurso').empty().append(
                            '<option value="" disabled selected>SELECCIONE CURSO</option>').prop(
                            'disabled', true);

                        grados.forEach(function(grado) {
                            $('#buscarporGrado').append('<option value="' + grado.id_grado +
                                '"' +
                                (grado.id_grado == "{{ old('buscarporGrado') }}" ?
                                    ' selected' : '') + '>' +
                                grado.nombre_grado + '</option>');
                        });

                        $('#buscarporGrado').prop('disabled', false);

                        // Si hay un grado seleccionado, cargar cursos
                        if ("{{ old('buscarporGrado') }}") {
                            $('#buscarporGrado').trigger('change');
                        }
                    },
                    error: function() {
                        alert('Ocurrió un error al cargar los grados.');
                    }
                });
            }

            // Función para cargar cursos
            function cargarCursos(gradoId, selectedCurso = null) {
                $.ajax({
                    url: '/api/grado/' + gradoId + '/cursos',
                    type: 'GET',
                    success: function(cursos) {
                        $('#buscarporCurso').empty().append(
                            '<option value="" disabled selected>SELECCIONE CURSO</option>');

                        cursos.forEach(function(curso) {
                            $('#buscarporCurso').append('<option value="' + curso.id_curso +
                                '"' +
                                (curso.id_curso == "{{ old('buscarporCurso') }}" ?
                                    ' selected' : '') + '>' +
                                curso.nombre_curso + '</option>');
                        });

                        $('#buscarporCurso').prop('disabled', false);
                    },
                    error: function() {
                        alert('Ocurrió un error al cargar los cursos.');
                    }
                });
            }

            // Cargar niveles al iniciar
            cargarNiveles();

            // Evento cambio en el select de nivel
            $('#buscarporNivel').change(function() {
                var nivelId = $(this).val();
                if (nivelId) {
                    cargarGrados(nivelId, "{{ old('buscarporGrado') }}");
                } else {
                    $('#buscarporGrado').empty().append(
                        '<option value="" disabled selected>SELECCIONE GRADO</option>').prop('disabled',
                        true);
                    $('#buscarporCurso').empty().append(
                        '<option value="" disabled selected>SELECCIONE CURSO</option>').prop('disabled',
                        true);
                }
            });

            // Evento cambio en el select de grado
            $('#buscarporGrado').change(function() {
                var gradoId = $(this).val();
                if (gradoId) {
                    cargarCursos(gradoId, "{{ old('buscarporCurso') }}");
                } else {
                    $('#buscarporCurso').empty().append(
                        '<option value="" disabled selected>SELECCIONE CURSO</option>').prop('disabled',
                        true);
                }
            });
        });
    </script>
@endsection
