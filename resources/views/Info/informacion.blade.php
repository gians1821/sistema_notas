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
            @foreach ($alumnos as $index => $alumno)
            <div class="carousel-item {{ $index == $indexito ? 'active' : '' }}">
                <div class="container container-sections">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card datos-generales">
                                <div class="card-body text-center">
                                    <label class="form-label mb-3"><strong>Datos del Alumno</strong></label>
                                    <div class="col-md-6 mx-auto d-flex flex-column align-items-center"> 
                                        <label for="profile_photo_alumno" class="form-label"><strong>Foto de Perfil</strong></label>
                                        <img src="{{ $alumnos[$index]->profile_photo ? asset('storage/' . $alumnos[$index]->profile_photo) : asset('images/default-user.png') }}" 
                                            alt="Foto de Perfil" 
                                            class="img-fluid rounded-circle mb-3" 
                                            style="width: 200px; height: 200px;">
                                    </div>
                                    <p><strong>DNI: </strong> {{ $alumnos[$index]->dni }}</p>
                                    <p><strong>Apoderado: </strong> {{ $alumnos[$index]->padre->nombres . ' ' . $alumnos[$index]->padre->apellidos }}</p>
                                    <p><strong>Telefóno: </strong> {{ $alumnos[$index]->telefono }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <p><strong>Alumno: </strong> {{ $alumnos[$index]->nombre_alumno . ' ' . $alumnos[$index]->apellido_alumno }}</p>
                                            <p><strong>Año Matricula: </strong> {{ $alumnos[$index]->periodo }}</p>
                                            <p><strong>País: </strong> {{ $alumnos[$index]->pais }} </p>
                                            <p><strong>Departamento: </strong> {{ $alumnos[$index]->region }} </p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <p><strong>Nivel: </strong> {{ $alumnos[$index]->seccion->grado->nivel->nombre_nivel }} </p>
                                            <p><strong>Grado: </strong> {{ $alumnos[$index]->seccion->grado->nombre_grado }} </p>
                                            <p><strong>Seccion: </strong> {{ $alumnos[$index]->seccion->nombre_seccion }} </p>
                                            <p><strong>Nacimiento: </strong> {{ $alumnos[$index]->fecha_nacimiento }} </p>
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
                                        @foreach ($alumnos[$index]->seccion->grado->cursos as $curso)
                                            <li><strong>{{ $curso->nombre_curso }}: </strong> 
                                                Prof. {{ $curso->catedra->docente ? $curso->catedra->docente->nombre . ' ' . $curso->catedra->docente->apellido : 'No asignado' }}
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
                                        @foreach ($alumnos[$index]->seccion->grado->cursos as $index2 => $curso)
                                            <li>
                                                <strong>{{ $curso->nombre_curso }}:</strong>
                                                {{ $alumnos[$index]->promedios[$index2]->valor ?? 'Sin nota' }}
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Gráfico con las Notas -->
                    <div class="card grafico">
                        <div class="card-body">
                            <h5 class="section-title">Gráfico con las Notas</h5>
                            <canvas id="gradesChart{{ $index }}" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        <!-- hasta aqui -->
        </div>

        <button class="carousel-control-prev bg-primary text-white rounded-circle border-0 p-2" style="left: 300px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px;" type="button" data-bs-target="#alumnosCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon d-flex justify-content-center align-items-center" style="width: 20px; height: 20px;" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next bg-primary text-white rounded-circle border-0 p-2" style="right: 300px; top: 50%; transform: translateY(-50%); width: 40px; height: 40px;" type="button" data-bs-target="#alumnosCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon d-flex justify-content-center align-items-center" style="width: 20px; height: 20px;" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

@endsection

@section('script')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const charts = {}; // Object to store chart instances

        @foreach($alumnos as $index => $alumno)
            const labels{{ $index }} = @json($alumno->seccion->grado->cursos->pluck('nombre_curso'));
            const data{{ $index }} = @json($alumno->promedios->pluck('valor')->map(function($value) {
                switch ($value) {
                    case 'AD': return 20;
                    case 'A': return 17;
                    case 'B': return 14;
                    case 'C': return 10;
                    default: return 0;
                }
            }));

            const ctx{{ $index }} = document.getElementById('gradesChart{{ $index }}').getContext('2d');

            // If a chart already exists in this context, destroy it
            if (charts['gradesChart{{ $index }}']) {
                charts['gradesChart{{ $index }}'].destroy();
            }

            // Create a new chart instance and store it
            charts['gradesChart{{ $index }}'] = new Chart(ctx{{ $index }}, {
                type: 'bar',
                data: {
                    labels: labels{{ $index }},
                    datasets: [{
                        label: 'Notas',
                        data: data{{ $index }},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        hoverBackgroundColor: 'rgba(75, 192, 192, 0.4)',
                        hoverBorderColor: 'rgba(75, 192, 192, 1)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            max: 20,
                            title: {
                                display: true,
                                text: 'Notas',
                                font: {
                                    size: 16
                                }
                            },
                            ticks: {
                                stepSize: 1,
                                color: '#4b4b4b',
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Cursos',
                                font: {
                                    size: 16
                                }
                            },
                            ticks: {
                                color: '#4b4b4b',
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#4b4b4b',
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 12
                            },
                            footerFont: {
                                size: 10
                            }
                        }
                    }
                }
            });
        @endforeach
    });
</script>
@endsection