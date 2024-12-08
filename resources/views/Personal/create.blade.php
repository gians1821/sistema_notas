@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <!-- Registro de Personal -->
    <h1 class="h3 mb-3"><strong>Registro</strong> Personal</h1>
    <form method="POST" action="{{ route('Personal.store') }}">
        @csrf
        <!--DNI-->
        @include('components.text_input', [
            'label' => 'DNI',
            'name' => 'dni'
        ])
        
        <!--NOMBRE-->
        @include('components.text_input', [
            'label' => 'Nombre',
            'name' => 'nombre'
        ])

        <!--APELLIDO-->
        @include('components.text_input', [
            'label' => 'Apellido',
            'name' => 'apellido'
        ])

        <!--DIRECCION-->
        @include('components.text_input', [
            'label' => 'Dirección',
            'name' => 'direccion'
        ])

        <!--FECHA DE NACIMIENTO-->
        @include('components.date_input', [
            'label' => 'Fecha de Nacimiento',
            'name' => 'fecha_nacimiento'
        ])

        <!--TELEFONO-->
        @include('components.text_input', [
            'label' => 'Teléfono',
            'name' => 'telefono'
        ])
        
        <!--TIPO DE PERSONAL-->
        @include('components.select_input', [
            'label' => 'Tipo de Personal',
            'name' => 'id_tipo_personal',
            ''
        ])
        <div class="form-group">
            <label for="id_tipo_personal">TIPO PERSONAL</label>
            <select class="form-control @error('id_tipo_personal') is-invalid @enderror" id="id_tipo_personal"
                name="id_tipo_personal">
                @error('id_tipo_personal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="TIPO DE PERSONAL" selected disabled>SELECCIONE</option>
                <option value="DOCENTE">DOCENTE</option>
                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                <option value="DIRECTOR">DIRECTOR</option>
                <option value="ASISTENTE">ASISTENTE</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nivel">NIVEL</label>
            <select class="form-control @error('nivel') is-invalid @enderror" id="nivel" name="nivel" disabled>
                @error('nivel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="Nivel" selected disabled>SELECCIONE</option>
                <option value="PRIMARIA">PRIMARIA</option>
                <option value="SECUNDARIA">SECUNDARIA</option>
            </select>
        </div>
        <div class="form-group">
            <label for="grado">GRADO</label>
            <select class="form-control @error('grado') is-invalid @enderror" id="grado" name="grado" disabled>
                @error('grado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="Grado" selected disabled>SELECCIONE</option>

            </select>
        </div>
        <div class="form-group">
            <label for="curso">CURSO</label>
            <select class="form-control @error('curso') is-invalid @enderror" id="curso" name="curso" disabled>
                @error('curso')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="Curso" selected disabled>SELECCIONE</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
        <a href="{{ route('CancelarPersonal') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
    </form>
@endsection
@section('script')
    <script>
        document.getElementById('id_tipo_personal').addEventListener('change', function() {
            var tipoPersonal = this.value;
            var nivelSelect = document.getElementById('nivel');
            var gradoSelect = document.getElementById('grado');
            var cursoSelect = document.getElementById('curso');

            if (tipoPersonal === 'DOCENTE') {
                nivelSelect.disabled = false;
                gradoSelect.disabled = false;
                cursoSelect.disabled = false;
            } else {
                nivelSelect.disabled = true;
                gradoSelect.disabled = true;
                cursoSelect.disabled = true;
            }
        });
        document.getElementById('nivel').addEventListener('change', function() {
            var nivel = this.value;
            var gradoSelect = document.getElementById('grado');
            var cursoSelect = document.getElementById('curso');
            gradoSelect.innerHTML =
            '<option value="Grado" selected disabled>SELECCIONE</option>'; // Agrega la opción por defecto
            cursoSelect.innerHTML =
            '<option value="Curso" selected disabled>SELECCIONE</option>'; // Agrega la opción por defecto

            if (nivel === 'Nivel') {
                var options = ['Grado'];
                var cursoOp = ['Curso'];
            }
            if (nivel === 'PRIMARIA') {
                var options = ['PRIMERO', 'SEGUNDO', 'TERCERO', 'CUARTO', 'QUINTO', 'SEXTO'];
                var cursoOp = ['CIENCIA Y AMBIENTE', 'ED. FÍSICA', 'ED. RELIGIOSA', 'PERSONAL SOCIAL', 'INGLÉS',
                    'COMPORTAMIENTO', 'ARTE', 'MATEMÁTICA', 'COMUNICACIÓN', 'COMPUTACIÓN/LABORES',
                    'TOTAL DE DEMÉRITOS'
                ];
            } else if (nivel === 'SECUNDARIA') {
                var options = ['PRIMERO', 'SEGUNDO', 'TERCERO', 'CUARTO', 'QUINTO'];
                var cursoOp = ['CIUDADANÍA Y CÍVICA', 'CIENCIAS SOCIALES', 'ED. PARA EL TRABAJO.', 'ED. FÍSICA',
                    'COMUNICACIÓN', 'ARTE Y CULTURA', 'INGLÉS', 'MATEMÁTICA', 'CIENCIA Y TECNOLOGÍA',
                    'ED. RELIGIOSA', 'COMPORTAMIENTO', 'TOTAL DE DEMÉRITOS'
                ];
            }

            options.forEach(function(option) {
                var opt = document.createElement('option');
                opt.value = option;
                opt.innerHTML = option;
                gradoSelect.appendChild(opt);
            });

            cursoOp.forEach(function(option) {
                var opt = document.createElement('option');
                opt.value = option;
                opt.innerHTML = option;
                cursoSelect.appendChild(opt);
            });
        });
    </script>
@endsection
