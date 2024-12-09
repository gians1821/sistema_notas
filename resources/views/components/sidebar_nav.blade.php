<ul class="sidebar-nav">
    <!-- TITULO 1 -->
    <li class="sidebar-header">
        PRINCIPAL
    </li>
    <!-- DASHBOARD -->

    @can('Home.index')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Home') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('Home.index') }}">
                <i class="align-middle" data-feather="home"></i> <span> Inicio </span>
            </a>
        </li>
    @endcan

    <!-- PROFILE -->
    @can('Admin.users.index')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.usuarios') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('admin.usuarios.index') }}">
                <i class="align-middle" data-feather="user"></i> <span> Usuarios </span>
            </a>
        </li>
    @endcan

    @can('Admin.perfiles.index')
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
    @hasanyrole('Admin|Secretaria')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Alumno') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Alumno') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Registrar Matrícula </span>
            </a>
        </li>
    @endhasanyrole
    @role('Admin')
        <!-- GESTION DE GRADOS -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Seccion') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Seccion') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Grados </span>
            </a>
        </li>
        <!-- GESTION DE CURSOS -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Curso.') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Curso') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Cursos </span>
            </a>
        </li>
        <!-- GESTION DE CURSOS POR GRADOS -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'CursoPorGrado') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/CursoPorGrado') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Cursos por Grados </span>
            </a>
        </li>
    @endrole
    <!-- GESTION DE CAPACIDADES -->
    @role('Admin')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Capacidad') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Capacidad') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Capacidades </span>
            </a>
        </li>
    @endrole
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('Catedra.index') }}">
            <i class="align-middle" data-feather="check-circle"></i> <span> Gestión Notas </span>
        </a>
    </li>
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('Catedra.index') }}">
            <i class="align-middle" data-feather="check-circle"></i> <span> Reporte de Notas </span>
        </a>
    </li>
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? '' : '' }}">
        <a class="sidebar-link" href="{{ route('Catedra.index') }}">
            <i class="align-middle" data-feather="check-circle"></i> <span> Revisar Notas </span>
        </a>
    </li>
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? '' : '' }}">
        <a class="sidebar-link" href="{{ route('Catedra.index') }}">
            <i class="align-middle" data-feather="check-circle"></i> <span> Registrar Notas </span>
        </a>
    </li>
    <!-- TITULO 3 -->
    <li class="sidebar-header">
        GESTIÓN ADMINISTRATIVA
    </li>
    @role('Admin')
        <!-- GESTION DE PERSONAL -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Personal') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('Personal.index') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Personal </span>
            </a>
        </li>
    @endrole
    
</ul>
