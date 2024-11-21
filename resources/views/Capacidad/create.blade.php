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
                @error('nivel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="Nivel" selected disabled>Seleccione Nivel</option>
                <option value="PRIMARIA">PRIMARIA</option>
                <option value="SECUNDARIA">SECUNDARIA</option>
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
                <option value="Grado" selected disabled>Seleccione Grado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="curso">Curso</label>
            <select class="form-control @error('curso') is-invalid @enderror" id="curso" name="curso">
                @error('curso')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <option value="Curso" selected disabled>Seleccione Curso</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nombre_competencia">Nombre de la Capacidad</label>
            <input type="text" class="form-control @error('nombre_competencia') is-invalid @enderror "
                id="nombre_competencia" name="nombre_competencia">
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
    <script>
        document.getElementById('nivel').addEventListener('change', function() {
            var nivel = this.value;
            var gradoSelect = document.getElementById('grado');
            var cursoSelect = document.getElementById('curso');
            gradoSelect.innerHTML =
            '<option value="Grado" selected disabled>Seleccione Grado</option>'; // Agrega la opción por defecto
            cursoSelect.innerHTML =
            '<option value="Curso" selected disabled>Seleccione Curso</option>'; // Agrega la opción por defecto

            if (nivel === 'PRIMARIA') {
                options = ['PRIMERO', 'SEGUNDO', 'TERCERO', 'CUARTO', 'QUINTO', 'SEXTO'];
                cursoOp = ['CIENCIA Y AMBIENTE', 'ED. FÍSICA', 'ED. RELIGIOSA', 'PERSONAL SOCIAL', 'INGLÉS',
                    'COMPORTAMIENTO', 'ARTE', 'MATEMÁTICA', 'COMUNICACIÓN', 'COMPUTACIÓN/LABORES',
                    'TOTAL DE DEMÉRITOS'
                ];
            } else if (nivel === 'SECUNDARIA') {
                options = ['PRIMERO', 'SEGUNDO', 'TERCERO', 'CUARTO', 'QUINTO'];
                cursoOp = ['CIUDADANÍA Y CÍVICA', 'CIENCIAS SOCIALES', 'ED. PARA EL TRABAJO.', 'ED. FÍSICA',
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
