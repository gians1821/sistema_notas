@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection

@section('Contenido')

        <br>
        <br>
        <br>
        <br>
        <br>
    <h1 class="h3 mb-3 text-center"> Nivel<strong> -  Grado - </strong>Seccion </h1>
    <br>
    <!-- Carrusel de opciones -->
    <div id="opcionesCarrusel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        
            <!-- Opción 1: Select Nivel, Select Grado, Texto para Sección -->
            <div class="carousel-item active text-center">
                <div class="card mx-auto shadow-lg" style="max-width: 500px; padding: 20px; border-radius: 15px;">
                    <label for="form-label mb-4" style="font-size: 17px;"><strong>Nueva Sección</strong></label>
                    <form method="POST" action="{{ route('Seccion.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nivel1"><strong>Nivel</strong></label>
                            <select class="form-control @error('nivel1') is-invalid @enderror" id="nivel1" name="nivel1" onchange="fetchGrados(this.value)">
                                <option value="" selected disabled>Seleccione un Nivel</option>
                                @foreach ($nivel as $itemniveles)
                                    <option value="{{ $itemniveles->id_nivel }}">{{ $itemniveles->nombre_nivel }}</option>
                                @endforeach
                            </select>
                            @error('nivel1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="grado1"><strong>Grado</strong></label>
                            <select class="form-control @error('grado1') is-invalid @enderror" id="grado1" name="grado1" onchange="fetchSecciones(this.value)">
                                <option value="" selected disabled>Seleccione un Grado</option>
                            </select>
                            @error('grado1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="seccion1">Sección</label>
                            <input type="text" class="form-control @error('seccion1') is-invalid @enderror" id="seccion1" name="seccion1" placeholder="Escriba la Sección">
                            @error('seccion1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        @if ($errors->any())
                        <div class="text-danger" id="error-message1">
                            <ul style="list-style-type: none; padding-left: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary mt-4">Guardar</button>
                        <a href="{{ route('CancelarSeccion') }}" class="btn btn-danger mt-4"><i class="fas fa-ban"></i> Cancelar</button></a>

                    </form>
                </div>
            </div>

            <!-- Opción 2: Select Nivel, Texto para Grado y Sección -->
            <div class="carousel-item text-center">
                <div class="card mx-auto shadow-lg" style="max-width: 500px; padding: 20px; border-radius: 15px;">
                <label for="form-label mb-4" style="font-size: 17px;"><strong>Nuevo Grado - Sección</strong></label>
                    <form method="POST" action="{{ route('Seccion.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nivel2"><strong>Nivel</strong></label>
                            <select class="form-control @error('nivel2') is-invalid @enderror" id="nivel2" name="nivel2">
                                <option value="" selected disabled>Seleccione un Nivel</option>
                                @foreach ($nivel as $itemniveles)
                                    <option value="{{ $itemniveles->id_nivel }}">{{ $itemniveles->nombre_nivel }}</option>
                                @endforeach
                            </select>
                            @error('nivel2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="grado2">Grado</label>
                            <input type="text" class="form-control @error('grado2') is-invalid @enderror" id="grado2" name="grado2" placeholder="Escriba el Grado">
                            @error('grado2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="seccion2">Sección</label>
                            <input type="text" class="form-control @error('seccion2') is-invalid @enderror" id="seccion2" name="seccion2" placeholder="Escriba la Sección">
                            @error('seccion2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($errors->any())
                        <div class="text-danger" id="error-message2">
                            <ul style="list-style-type: none; padding-left: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary mt-4">Guardar</button>
                        <a href="{{ route('CancelarSeccion') }}" class="btn btn-danger mt-4"><i class="fas fa-ban"></i> Cancelar</button></a>

                    </form>
                </div>
            </div>

            <!-- Opción 3: Texto para Nivel, Grado y Sección -->
            <div class="carousel-item text-center">
                <div class="card mx-auto shadow-lg" style="max-width: 500px; padding: 20px; border-radius: 15px;">
                    <label for="form-label mb-4" style="font-size: 17px;"><strong>Nuevo  Nivel - Grado - Sección</strong></label>
                    <form method="POST" action="{{ route('Seccion.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nivel3">Nivel</label>
                            <input type="text" class="form-control @error('nivel3') is-invalid @enderror" id="nivel3" name="nivel3" placeholder="Escriba el Nivel">
                            @error('nivel3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="grado3">Grado</label>
                            <input type="text" class="form-control @error('grado3') is-invalid @enderror" id="grado3" name="grado3" placeholder="Escriba el Grado">
                            @error('grado3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="seccion3">Sección</label>
                            <input type="text" class="form-control @error('seccion3') is-invalid @enderror" id="seccion3" name="seccion3" placeholder="Escriba la Sección">
                            @error('seccion3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($errors->any())
                        <div class="text-danger" id="error-message3">
                            <ul style="list-style-type: none; padding-left: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary mt-4">Guardar</button>
                        <a href="{{ route('CancelarSeccion') }}" class="btn btn-danger mt-4"><i class="fas fa-ban"></i> Cancelar</button></a>

                    </form>
                </div>
            </div>

        </div>

        <!-- Controles del carrusel -->
        <button class="carousel-control-prev bg-primary text-white rounded-circle border-0 p-2" style="left: 300px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px;" type="button" data-bs-target="#opcionesCarrusel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon d-flex justify-content-center align-items-center" style="width: 20px; height: 20px;" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next bg-primary text-white rounded-circle border-0 p-2" style="right: 300px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px;" type="button" data-bs-target="#opcionesCarrusel" data-bs-slide="next">
            <span class="carousel-control-next-icon d-flex justify-content-center align-items-center" style="width: 20px; height: 20px;" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
@endsection

@section('script')
    <script>
        function fetchGrados(nivelId) {
            if (nivelId) {
                fetch(`/api/grados/${nivelId}`) 
                    .then(response => response.json())
                    .then(data => {
                        let gradoSelect = document.getElementById('grado1');
                        gradoSelect.innerHTML = '<option value="" selected disabled>Seleccione un Grado</option>';
                        
                        data.forEach(grado => {
                            let option = document.createElement('option');
                            option.value = grado.id_grado; 
                            option.textContent = grado.nombre_grado; 
                            gradoSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('grado').innerHTML = '<option value="" selected disabled>Seleccione un Grado</option>'; 
            }
        }
        
        function fetchSecciones(gradoId) {
            if (gradoId) {
                fetch(`/api/secciones/${gradoId}`) 
                    .then(response => response.json())
                    .then(data => {
                        let seccionSelect = document.getElementById('seccion1');
                        seccionSelect.innerHTML = '<option value="" selected disabled>Seleccione una Sección</option>';
                        
                        data.forEach(seccion => {
                            let option = document.createElement('option');
                            option.value = seccion.id_seccion; 
                            option.textContent = seccion.nombre_seccion; 
                            seccionSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('seccion').innerHTML = '<option value="" selected disabled>Seleccione una Sección</option>'; 
            }
        }
    </script>
    <script>
        
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message1');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000); 
    </script>
    <script>
        
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message2');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000); 
    </script>
    <script>
        
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message3');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000); 
    </script>
@endsection

