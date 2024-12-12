<ul class="sidebar-nav">

    @can('Home')
    <li class="sidebar-header">
        PRINCIPAL
    </li>

        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Home') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('Home.index') }}">
                <i class="align-middle" data-feather="home"></i> <span> Inicio </span>
            </a>
        </li>
    @endcan

    <!-- PROFILE -->
    @can('Ver Usuarios')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.usuarios') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('admin.usuarios.index') }}">
                <i class="align-middle" data-feather="user"></i> <span> Usuarios </span>
            </a>
        </li>
    @endcan

    @can('Ver Perfiles')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.perfil') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('admin.perfil.index') }}">
                <i class="align-middle" data-feather="users"></i> <span> Perfiles </span>
            </a>
        </li>
    @endcan

    <!-- SIGN IN -->
    <li class="sidebar-item">
        <form id="logout-form" action="{{ route('User.Logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="sidebar-link" href="{{ route('User.Logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="align-middle" data-feather="log-in"></i> <span> Cerrar Sesión </span>
        </a>
    </li>

    <!-- TITULO 2 -->
    <li class="sidebar-header">
        GESTIÓN ACADÉMICA
    </li>
    <!-- AQUI ES DONDE TRABAJAREMOS -->
    <!-- GESTION DE ALUMNOS -->
    @can('Informacion General')
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Info') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('Info', ['indexito' => 0]) }}">
            <i class="align-middle" data-feather="info"></i> <span> Informacion General </span>
        </a>
    </li>
    @endcan

    @can('Ver Alumnos Matriculados')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Alumno') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Alumno') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Registrar Matrícula </span>
            </a>
        </li>
    @endcan

    @can('Ver Vacantes')
        <!-- GESTION DE GRADOS -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Seccion') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Seccion') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Vacantes </span>
            </a>
        </li>
    @endcan

    @can('Ver Cursos')
        <!-- GESTION DE CURSOS -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Curso.') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Curso') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Cursos </span>
            </a>
        </li>
    @endcan

    <!-- GESTION DE CAPACIDADES -->
    @can('Ver Capacidades')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Capacidad') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Capacidad') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Capacidades </span>
            </a>
        </li>
    @endcan
    
    @can('Ver notas')
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('notas.index') }}">
            <i class="align-middle" data-feather="check-circle"></i>
            <span>
                Notas
            </span>
        </a>
    </li>
    @endcan

    <!-- TITULO 3 -->

    @can('Ver Personal')
        <li class="sidebar-header">
            GESTIÓN ADMINISTRATIVA
        </li>
        <!-- GESTION DE PERSONAL -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Personal') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('Personal.index') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Personal </span>
            </a>
        </li>
    @endcan

    @can('Ver Cátedras')
        <!-- GESTION DE PERSONAL -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'catedra') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('catedras.index') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Cátedras </span>
            </a>
        </li>
    @endcan
    
</ul>
