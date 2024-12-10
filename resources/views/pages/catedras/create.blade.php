@extends('layout.plantilla')

@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')
    <!-- Registro de Personal -->
    <h1 class="h3 mb-3"><strong>Asignación</strong> de Cátedras</h1>
    <form method="POST" action="{{ route('catedras.store') }}">
        @csrf

        <div class="row">
            <div class="col-2">
                @include('components.select_input', [
                    'name' => 'id_periodo',
                    'label' => 'Periodo',
                    'options' => $periodos,
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
                    ])
                </div>
                <div class="col-3">
                    <!-- Grado Select -->
                    <div id="grado-container">
                        @include('components.select_input', [
                            'name' => 'id_grado',
                            'label' => 'Grado',
                            'options' => [], // Inicialmente vacío, se llenará después con AJAX -->'id_property' => 'id_grado',
                            'id_property' => 'id_grado',
                            'property' => 'nombre_grado',
                        ])
                    </div>
                </div>
                <div class="col-6">
                    <!-- Curso Select -->
                    <div id="curso-container">
                        @include('components.select_input', [
                            'name' => 'curso_id',
                            'label' => 'Curso',
                            'options' => [], // Inicialmente vacío, se llenará después con AJAX -->'id_property' => 'id_curso',
                            'id_property' => 'id_curso',
                            'property' => 'nombre_curso',
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
                    ])
                </div>

                <div class="col-3">
                    @include('components.text_input', [
                        'label' => 'Apellido',
                        'name' => 'apellido',
                        'attributes' => 'disabled',
                    ])
                </div>

                <div class="col-3">
                    @include('components.text_input', [
                        'label' => 'Dirección',
                        'name' => 'direccion',
                        'attributes' => 'disabled',
                    ])
                </div>

                <div class="col-3">
                    @include('components.text_input', [
                        'label' => 'Teléfono',
                        'name' => 'telefono',
                        'attributes' => 'disabled',
                    ])
                </div>
            </div>
        </div>

        <div class="card p-3">
           <div class="row">
               @include('components.select_input', [
                   'name' => 'seccion_id',
                   'label' => 'Seccion',
                   'options' => [],
               ])
           </div>
       </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
        <a href="{{ route('CancelarCatedras') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    </form>
@endsection

@section('script')
    <!-- Para cursos -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const nivelSelect = document.querySelector('[name="id_nivel"]');
            const gradoSelect = document.querySelector('[name="id_grado"]');
            const cursoSelect = document.querySelector('[name="curso_id"]');
            const seccionSelect = document.querySelector('[name="seccion_id"]');

            if (nivelSelect) {
                // Cargar grados según el nivel seleccionado
                nivelSelect.addEventListener('change', function() {
                    const nivelId = this.value;
                    if (nivelId) {
                        fetch(`/api/grados/${nivelId}`)
                            .then(response => response.json())
                            .then(data => {
                                gradoSelect.innerHTML = '<option value="">Seleccione un grado</option>';
                                data.forEach(grado => {
                                    gradoSelect.innerHTML +=
                                        `<option value="${grado.id_grado}">${grado.nombre_grado}</option>`;
                                });
                                // Limpiar el curso y sección cuando se cambia el nivel
                                cursoSelect.innerHTML = '<option value="">Seleccione un curso</option>';
                                seccionSelect.innerHTML =
                                    '<option value="">Seleccione una sección</option>';
                            });
                    } else {
                        // Si no hay nivel seleccionado, limpiamos los demás
                        gradoSelect.innerHTML = '<option value="">Seleccione un grado</option>';
                        cursoSelect.innerHTML = '<option value="">Seleccione un curso</option>';
                        seccionSelect.innerHTML = '<option value="">Seleccione una sección</option>';
                    }
                });
            }

            if (gradoSelect) {
                // Cargar cursos según el grado seleccionado
                gradoSelect.addEventListener('change', function() {
                    const gradoId = this.value;
                    if (gradoId) {
                        fetch(`/api/grado/${gradoId}/cursos`)
                            .then(response => response.json())
                            .then(data => {
                                cursoSelect.innerHTML = '<option value="">Seleccione un curso</option>';
                                data.forEach(curso => {
                                    cursoSelect.innerHTML +=
                                        `<option value="${curso.id_curso}">${curso.nombre_curso}</option>`;
                                });
                                // Limpiar la sección cuando se cambia el grado
                                seccionSelect.innerHTML =
                                    '<option value="">Seleccione una sección</option>';
                            });
                    } else {
                        // Si no se seleccionó grado, limpiar cursos y secciones
                        cursoSelect.innerHTML = '<option value="">Seleccione un curso</option>';
                        seccionSelect.innerHTML = '<option value="">Seleccione una sección</option>';
                    }

                    if (gradoId) {
                        fetch(`/api/secciones/${gradoId}`)
                            .then(response => response.json())
                            .then(data => {
                                seccionSelect.innerHTML =
                                    '<option value="">Seleccione una sección</option>';
                                data.forEach(seccion => {
                                    seccionSelect.innerHTML +=
                                        `<option value="${seccion.id_seccion}">${seccion.nombre_seccion}</option>`;
                                });
                            });
                    } else {
                        // Si no hay curso seleccionado, limpiar secciones
                        seccionSelect.innerHTML = '<option value="">Seleccione una sección</option>';
                    }
                });
            }
        });
    </script>
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
