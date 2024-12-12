@extends('layout.plantilla')

@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')
    <!-- Registro de Personal -->
    <h1 class="h3 mb-3"><strong>Asignación</strong> de Cátedras</h1>
    <form method="POST" action="{{ route('catedras.update', [$catedra->id]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-2">
                @include('components.select_input', [
                    'name' => 'id_periodo',
                    'label' => 'Periodo',
                    'options' => $periodos,
                    'attributes' => 'hidden',
                    'selected' => $catedra->periodo->id,
                ])
                @include('components.select_input', [
                    'name' => 'id_periodo',
                    'label' => 'Periodo',
                    'options' => $periodos,
                    'attributes' => 'disabled',
                    'selected' => $catedra->periodo->id,
                ])
            </div>
        </div>

        <div class="card p-3">
            <div class="row">
                <div class="col-3">
                    <!-- Nivel Select -->
                    @include('components.select_input', [
                        'name' => 'id_nivel',
                        'label' => 'Nivel',
                        'options' => $niveles, // Este será el arreglo de niveles que tienes en tu controlador -->'id_property' => 'id_nivel',
                        'property' => 'nombre_nivel',
                        'id_property' => 'id_nivel',
                        'attributes' => 'disabled',
                        'selected' => $catedra->curso->grado->nivel->id_nivel,
                    ])
                </div>
                <div class="col-3">
                    <!-- Grado Select -->
                    <div id="grado-container">
                        @include('components.select_input', [
                            'name' => 'id_grado',
                            'label' => 'Grado',
                            'options' => $grados, // Inicialmente vacío, se llenará después con AJAX -->'id_property' => 'id_grado',
                            'id_property' => 'id_grado',
                            'property' => 'nombre_grado',
                            'attributes' => 'disabled',
                            'selected' => $catedra->curso->grado->id_grado,
                        ])
                    </div>
                </div>
                <div class="col-6">
                    <!-- Curso Select -->
                    <div id="curso-container">
                        @include('components.select_input', [
                            'name' => 'curso_id',
                            'label' => 'Curso',
                            'options' => $cursos, // Inicialmente vacío, se llenará después con AJAX -->'id_property' => 'id_curso',
                            'id_property' => 'id_curso',
                            'property' => 'nombre_curso',
                            'attributes' => 'readonly',
                            'selected' => $catedra->curso->id_curso,
                        ])
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-3">
            <div class="row">
                <div class="col-3">
                    @include('components.select_input', [
                        'name' => 'docente_id',
                        'label' => 'Docente',
                        'options' => $docentes,
                        'id_property' => 'id_personal',
                        'property' => 'dni',
                        'selected' => $catedra->docente->id_personal,
                    ])
                </div>
            </div>

            <!-- Campos para nombre, apellido, dirección y teléfono -->
            <div class="row">
                <div class="col-3">
                    @include('components.text_input', [
                        'label' => 'Nombre',
                        'name' => 'nombre',
                        'attributes' => 'disabled',
                        'value' => $docente->nombre,
                    ])
                </div>

                <div class="col-3">
                    @include('components.text_input', [
                        'label' => 'Apellido',
                        'name' => 'apellido',
                        'attributes' => 'disabled',
                        'value' => $docente->apellido,
                    ])
                </div>

                <div class="col-3">
                    @include('components.text_input', [
                        'label' => 'Dirección',
                        'name' => 'direccion',
                        'attributes' => 'disabled',
                        'value' => $docente->direccion,
                    ])
                </div>

                <div class="col-3">
                    @include('components.text_input', [
                        'label' => 'Teléfono',
                        'name' => 'telefono',
                        'attributes' => 'disabled',
                        'value' => $docente->telefono,
                    ])
                </div>
            </div>
        </div>

        <div class="card p-3">
            <div class="row">
                @include('components.select_input', [
                    'name' => 'seccion_id',
                    'label' => 'Seccion',
                    'options' => $secciones,
                    'id_property' => 'id_seccion',
                    'property' => 'nombre_seccion',
                    'attributes' => 'readonly',
                    'selected' => $catedra->seccion->id_seccion,
                ])
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Editar</button>
        <a href="{{ route('CancelarCatedras') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    </form>
@endsection

@section('script')
    <!-- Para docentes -->
    <script>
        // AJAX para obtener los datos del docente y llenar los campos
        document.querySelector('[name="docente_id"]').addEventListener('change', function() {
            const docenteId = this.value;
            if (docenteId) {
                fetch(`/api/docente/${docenteId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Llena los campos de texto con los datos del docente
                        if (data) {
                            // Habilitar los campos y completar con la información del docente
                            document.querySelector('[name="nombre"]').value = data.nombre;
                            document.querySelector('[name="apellido"]').value = data.apellido;
                            document.querySelector('[name="direccion"]').value = data.direccion;
                            document.querySelector('[name="telefono"]').value = data.telefono;
                        }
                    });
            }
        });
    </script>
@endsection
