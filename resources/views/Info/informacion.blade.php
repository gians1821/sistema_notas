@extends('layout.plantilla')
@section('BarraNavegacion')
    @include('components.sidebar_nav')
@endsection
@section('Contenido')
    <style>
        /* Carousel container */
        .carousel {
        width: 80%;  /* Adjust width as needed */
        margin: 0 auto;  /* Center the carousel horizontally */
        border-radius: 10px; /* Rounded corners */
        }

        /* Slide container */
        .carousel-item {
        transition: transform 0.8s ease-in-out;  /* Smooth transitions */
        }

        .carousel-item.active {
        transform: translateX(0);  /* Position the active slide */
        }

        .carousel-item.active + .carousel-item {
        transform: translateX(-100%);  /* Position the next slide */
        }

        .carousel-item.active ~ .carousel-item {
        transform: translateX(100%);  /* Position the previous slide */
        }

        /* Slide content */
        .container-sections {
        padding: 20px;
        background-color: #eee;
        border-radius: 10px; /* Rounded corners for individual sections */
        }

        /* Card styling */
        .card {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .card-body {
        padding: 15px;
        }

        .section-title {
        color: #333;
        font-weight: bold;
        margin-bottom: 10px;
        }

        /* Photo container */
        .photo-container {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #ddd; /* Add border for photo */
        }

        .photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        }

        /* List styling */
        .card ul {
        list-style: none;
        padding: 0;
        margin: 0;
        }

        .card ul li {
        margin-bottom: 5px;
        }

        /* Navigation controls */
        .carousel-control-prev,
        .carousel-control-next {
        background-color: rgba(0, 0, 0, 0.5);  /* Semi-transparent background */
        color: #fff;  /* White icons */
        width: 50px;  /* Adjust width as needed */
        height: 50px;  /* Adjust height as needed */
        border: none;  /* Remove default border */
        border-radius: 50%;  /* Rounded buttons */
        opacity: 0.8;  /* Initial opacity */
        transition: opacity 0.2s ease-in-out;  /* Smooth hover effect */
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
        opacity: 1;  /* Increase opacity on hover */
        }

        .carousel-control-prev {
        left: -50px;  /* Adjust position as needed */
        }

        .carousel-control-next {
        right: -50px;  /* Adjust position as needed */
        }
    </style>

    <h1 class="h3 mb-3 titulos text-center"><strong>Información </strong> General</h1>

    <div id="alumnosCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            
            <!-- Aqui logica de rehuso -->
            <div class="carousel-item active">
                <div class="container container-sections">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card datos-generales">
                                <div class="card-body text-center">
                                    <label class="form-label mb-3"><strong>Datos del Alumno</strong></label>
                                    <div class="col-md-6 mx-auto d-flex flex-column align-items-center"> 
                                        <label for="profile_photo_alumno" class="form-label"><strong>Foto de Perfil</strong></label>
                                        <img src="{{ $alumnos->profile_photo ? asset('storage/' . $alumnos->profile_photo) : asset('images/default-user.png') }}" 
                                            alt="Foto de Perfil" 
                                            class="img-fluid rounded-circle mb-3" 
                                            style="width: 200px; height: 200px;">
                                    </div>
                                    <p><strong>DNI: </strong> {{ $alumnos->dni }}</p>
                                    <p><strong>Apoderado: </strong> {{ $alumnos->padre->nombres . ' ' . $alumnos->padre->apellidos }}</p>
                                    <p><strong>Telefóno: </strong> {{ $alumnos->telefono }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <p><strong>Nombre Completo: </strong> {{ $alumnos->nombre_alumno . ' ' . $alumnos->apellido_alumno }}</p>
                                            <p><strong>Año Matricula: </strong> {{ $alumnos->periodo }}</p>
                                            <p><strong>País: </strong> {{ $alumnos->pais }} </p>
                                            <p><strong>Departamento: </strong> {{ $alumnos->region }} </p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <p><strong>Nivel: </strong> {{ $alumnos->seccion->grado->nivel->nombre_nivel }} </p>
                                            <p><strong>Grado: </strong> {{ $alumnos->seccion->grado->nombre_grado }} </p>
                                            <p><strong>Seccion: </strong> {{ $alumnos->seccion->nombre_seccion }} </p>
                                            <p><strong>Nacimiento: </strong> {{ $alumnos->fecha_nacimiento }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card docentes-cursos">
                                <div class="card-body">
                                    <div style="text-align: center;">
                                        <label class="form-label mb-3"><strong>Docentes - Cursos</strong></label>
                                    </div>
                                    
                                    <ul>
                                        @foreach ($alumnos->seccion->grado->cursos as $curso)
                                            <li><strong>{{ $curso->nombre_curso }}: </strong> 
                                                Prof. {{ $curso->personal ? $curso->personal->nombre . ' ' . $curso->personal->apellido : 'No asignado' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="card notas-alumno">
                                <div class="card-body">
                                    <div style="text-align: center;">
                                        <label class="form-label mb-3"><strong>Notas del Alumno</strong></label>
                                    </div>
                                    <ul>
                                        @foreach ($alumnos->seccion->grado->cursos as $curso) 
                                            <li><strong>{{ $curso->nombre_curso }}: </strong>  </li> 
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card grafico">
                        <div class="card-body">
                        <h5 class="section-title">Gráfico con las Notas</h5>
                        <canvas id="gradesChart1" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        <!-- hasta aqui -->
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#alumnosCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#alumnosCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

@endsection

@section('script')

@endsection
