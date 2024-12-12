@extends('layout.plantilla')

@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')
    <!-- Gestión de Notas -->
    <h1 class="h3 mb-3 titulos"><strong>Gestión de</strong> Notas</h1>
    <br>
    <nav class="navbar navbar-light">
        <!-- Formulario de Búsqueda por Cátedra -->
        @hasanyrole('Admin|Secretaria|Docente')
        <form class="form-inline" method="GET" action="{{ route('notas.index') }}">
            <div class="form-group mb-2">
                <label for="catedra_id" class="sr-only">Cátedra</label>
                <select class="form-control" id="catedra_id" name="catedra_id" style="width: 500px;">
                    <option value="">-- Seleccionar Cátedra --</option>
                    @foreach($catedras as $catedra)
                        <option value="{{ $catedra->id }}" {{ request('catedra_id') == $catedra->id ? 'selected' : '' }}>
                            {{ $catedra->curso->nombre_curso }} - {{ $catedra->docente->nombre }} {{ $catedra->docente->apellido }} - Sección: {{ $catedra->seccion->seccion_nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2 ml-2">Buscar</button>
            <a href="{{ route('notas.index') }}" class="btn btn-secondary mb-2 ml-2">Limpiar</a>
        </form>
        @endrole
        @role('Padre')
        <form class="form-inline" method="GET" action="{{ route('notas.index') }}">
            @include('components.select_input', [
                'name' => 'alumno_id',
                'label' => 'Alumno',
                'options' => $alumnos,
                'id_property' => 'id_alumno',
                'property' => 'nombre_alumno',
            ])
            <button type="submit" class="btn btn-primary mb-2 ml-2">Buscar</button>
            <a href="{{ route('notas.index') }}" class="btn btn-secondary mb-2 ml-2">Limpiar</a>
        </form>
        @endrole
        @isset($alumno_id)
        <a href=" {{ route('alumno.reporte_notas', ['id' => $alumno_id]) }}"
            class="btn btn-secondary" target="_blank">Ver reporte</a>
        @endisset
    </nav>

    @include('components.session_messages')
    <br>

    @include('components.items_table', [
        'data' => $notas, // Los elementos a mostrar en la tabla
        'headers' => [
            'Id',
            'Alumno',
            'Curso',
            'Competencia',
            'Nota 1',
            'Nota 2',
            'Nota 3',
            'Nota Final',
            'Acciones',
        ], // Los títulos de las columnas
        'columns_data' => [
            'id',
            'nombre_alumno',
            'nombre_curso',
            'nombre_competencia',
            'nota1',
            'nota2',
            'nota3',
            'nota_final',
        ], // Las propiedades de los modelos a mostrar
        'edit_route' => 'notas.edit', // Ruta para editar
        'delete_route' => 'notas.confirmar', // Ruta para eliminar
    ])

    {{ $notas->links() }}

@endsection

@push('scripts')
    <!-- Incluir Select2 CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#catedra_id').select2({
                placeholder: "-- Seleccionar Cátedra --",
                allowClear: true,
                width: 'resolve'
            });
        });
    </script>
@endpush