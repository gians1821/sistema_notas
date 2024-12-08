<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('plantilla/static/img/icons/icon-48x48.png')}}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>
    <style>
        .nav-vino {
            background-color: #0f3b5e !important;
            /* Color azul */
        }

</style>

    </style>

    <link href="{{ asset('plantilla/static/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div class="wrapper ">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar nav-vino ">
                <a class="sidebar-brand" style="height: 200px;" href="{{route('Home.index')}}">
                    <img src="{{ asset('plantilla\src\img\logo\peque.png')}}">
                </a>
                <!-- LISTA DE CONTENIDOS -->
                @yield('BarraNavegacion')
            </div>
        </nav>

        <div class="main">
            <!-- BARRA DE NAVEGACION -->
            <nav class="navbar navbar-expand navbar-light">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <!-- CONTENIDO BARRA DE NAVEGACION -->
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <!-- OPCIONES AL DARLE USUARIO DEL NAV-->
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/default-user.png') }}" class="avatar img-fluid rounded me-1" style="width: 40px; height: 40px; object-fit: cover;"/> <span class="text-dark">{{auth()->user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('Home.index') }}"><i class="align-middle me-1" data-feather="user"></i> Inicio </a>
                                <form id="logout-form" action="{{ route('User.Logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                                <a class="dropdown-item" href="{{ route('User.Logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar Sesión 
                                </a>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- CONTENIDO DE LA PAGINA AQUI HACEN EL YIELD -> EXTENS -->
            <main class="content bg-white">
                <div class="container-fluid p-0">

                    @yield('Contenido')

                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('plantilla/static/js/app.js') }}"></script>
    @yield('script')
    @livewireScripts
</body>

</html>